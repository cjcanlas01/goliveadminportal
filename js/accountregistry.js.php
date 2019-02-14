document.getElementById("defaultOpen").click();

function openTab(evt, tabName) {
	// Declare all variables
	var i, tabcontent, tablinks;

	// Get all elements with class="tabcontent" and hide them
	tabcontent = document.getElementsByClassName("tabcontent");
	for (i = 0; i < tabcontent.length; i++) {
	tabcontent[i].style.display = "none";
	}

	// Get all elements with class="tablinks" and remove the class "active"
	tablinks = document.getElementsByClassName("tablinks");
	for (i = 0; i < tablinks.length; i++) {
	tablinks[i].className = tablinks[i].className.replace(" active", "");
	}

	// Show the current tab, and add an "active" class to the button that opened the tab
	document.getElementById(tabName).style.display = "block";
	evt.currentTarget.className += " active";
}

$(document).ready(function(){

	//start of php script for getting session
	"<?php session_start(); $currentUser = $_SESSION['username']; ?>"
	//end

	const toast = Swal.mixin({ //for popup
	  position: 'center',
	  showConfirmButton: false,
	});

	var accounts = $('#accounts').DataTable({
	    "ajax": {
	        "url": "php/accountregistry.php",
	        "type": "post",
	        "data": { action: "loaddata" },
	        "dataType": "json",
	        "dataSrc": "useracc",
	    },
	    "columns": [
	        {data: "Email", width: "15%"},
	        {data: "BusinessName"},
	        {data: "Address"},
	        {data: "PhoneNumber", width: "13%"},
	        {data: "DC", width: "15%", render: function(data) {
	        	return formatDate(data);
	        }}
	    ],
	    "columnDefs": [
	        {
	            "targets": [5],
	            "searchable": false,
	            "defaultContent": "<span class='btn btn-primary fa fa-check' style='height: 30px; width: 50px;' id='approve_request' data-toggle='modal' data-target='#ar-confirmmodal'></span><span class='btn btn-primary fa fa-times' style='height: 30px; width: 50px;' id='delete_request' data-toggle='modal' data-target='#ar-confirmmodal'></span>",
	            "width": '13%'
	        }
	    ]
	});

	var adminaccounts = $('#adminaccounts').DataTable({
	    "ajax": {
	        "url": "php/accountregistry.php",
	        "type": "post",
	        "data": { action: "loaddata" },
	        "dataType": "json",
	        "dataSrc": "adminacc",
	    },
	    "columns": [
	        {data: "Email"},
	        {data: "Passcode"}
	    ],
	    "columnDefs": [
	    	{
	            "targets": [1],
	            "visible": false,
	            "searchable": false
	        },
	        {
	            "targets": [2],
	            "searchable": false,
	            "defaultContent": "<span class='btn btn-primary fa fa-cog' style='height: 30px; width: 50px;' id='btn_updateadmin' data-toggle='modal' data-target='#ar-inputmodal'></span><span class='btn btn-primary fa fa-times' style='height: 30px; width: 50px;' id='btn_deleteadmin' data-toggle='modal' data-target='#ar-confirmmodal'></span>",
	            "width": '13%'
	        }
	    ]
	});

	var payload = {};
	function transfer_data(parentid, payloaddata, modalid, tableid) { //method for ajax requesst
		$.ajax({
			url: "php/accountregistry.php",
			type: "post",
			data: {
				accountaction: $('#' + parentid).data('accountaction'),
				payload: payload
			},
			dataType: "json",
			beforeSend: function() {
				toast({ html: '<img src="resources/load.gif" height="100px"/>', allowOutsideClick: false })
			},
			success: function(data) {
				msg_response(data['indicator'], data['msg']);
				$(modalid).modal('hide');
				tableid.ajax.reload();
			}
		})
	}

	function msg_response(indicator, msg) { //method for response
		if (indicator == 'true') {
			toast({ type: 'success', title: msg, timer: 1800})
		} else {
			toast({ type: 'warning', title: msg, timer: 1800})
		}
	}

	function toast_msg_response(msg) {
		Swal({ toast: true, position: 'top', timer: 1800, showConfirmButton: false, title: msg, type: 'warning' });
	}

	$('#ar-cm-confirm').click(function() { //for approving user accounts and deleting admin accounts
		if($(this).data('accountaction') == 'approve') {
			transfer_data($(this).attr('id'), payload, '#ar-confirmmodal', accounts);
		} else if($(this).data('accountaction') == 'delete') {
			transfer_data($(this).attr('id'), payload, '#ar-confirmmodal', accounts);
		} else if($(this).data('accountaction') == 'deleteadmin') {	
			var currentUser = "<?php echo $currentUser?>";
			if(currentUser == payload['email']) {
				console.log(true);
				msg_response(false, "Admin account is currently in use.");
			} else {
				transfer_data($(this).attr('id'), payload, '#ar-confirmmodal', adminaccounts);
			}
		}
	});

	$('#ar-im-confirm').click(function() { //for adding admin accounts and updating admin accounts
		if ($(this).data('accountaction') == 'addadmin' || $(this).data('accountaction') == 'updateadmin') {
			if ($('#emailadd').val() == '' || $('#password').val() == '') { //checks if the input elements is empty, if true, checks if the email includes '@gmail.com' then proceeds else shows warning
				toast_msg_response('Required fields is empty or not complete.');
				$('#emailadd').focus();
			} else {
				var strEmail = $('#emailadd').val();
				if (strEmail.search('@gmail.com') == -1) { //checks if the value '@gmail.com is found, returns -1'
					toast_msg_response('Please enter a valid email address.');
					$('#emailadd').focus();
				} else {	
					payload['email'] =  $('#emailadd').val();
					payload['password'] = $('#password').val(); 
					transfer_data($(this).attr('id'), payload, '#ar-inputmodal', adminaccounts);
				}
			}
		}
	});

	$('#btn_addadmin').click(function() { //working - data application for adding admin accounts
        $('#emailadd').attr('readonly', false);
        $('#emailadd').val('');
        $('#password').val('');
		$('#ar-im-label').html('Add Admin Account');
		$('#ar-im-confirm').html('Create');
		$('#ar-im-confirm').data('accountaction', 'addadmin');
	});

	$('#accounts tbody').on('click', 'span', function() { //working - data application for approving user accounts
		var id = $(this).attr('id');
		if(id == 'approve_request') {
			// console.log('this is approve request!');
			payload['email'] = accounts.row($(this).closest('tr')).data()['Email']
    		$('#ar-cm-confirm').data('accountaction', 'approve');
		} else if(id == 'delete_request') {
			// console.log('this is delete request!');
			payload['email'] = accounts.row($(this).closest('tr')).data()['Email']
    		$('#ar-cm-confirm').data('accountaction', 'delete');
		}
	});

	$('#adminaccounts tbody').on('click', 'span', function() {
		if ($(this).attr('id') == 'btn_updateadmin') { //for updating admin accounts
            $('#emailadd').attr('readonly', true);
			$('#ar-im-label').html('Update Admin Account');
			$('#ar-im-confirm').html('Update');
			$('#ar-im-confirm').data('accountaction', 'updateadmin');
			$('#emailadd').val(adminaccounts.row($(this).closest('tr')).data()['Email']);
			$('#password').val(adminaccounts.row($(this).closest('tr')).data()['Passcode']);
		} else if ($(this).attr('id') == 'btn_deleteadmin') { //for deleting admin accounts
			payload['email'] = adminaccounts.row($(this).closest('tr')).data()['Email'];
    		$('#ar-cm-confirm').data('accountaction', 'deleteadmin');
		}
	});

	function formatDate(date) {
		var fDate = new Date(date);
		var monthNames = [
			"January", "February", "March",
			"April", "May", "June", "July",
			"August", "September", "October",
			"November", "December"
		];

		var day = fDate.getDate();
		var monthIndex = fDate.getMonth();
		var year = fDate.getFullYear();

		return monthNames[monthIndex] + ' ' + day + ' ' + year;
	}
});