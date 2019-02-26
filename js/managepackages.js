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

$(document).ready(function() {

    const toast = Swal.mixin({ //for popup
      position: 'center', 
      showConfirmButton: false
    });

    var requests = $('#requests').DataTable({ //datatable component for top up requests
        "ajax": {
            "url": "php/managepackages.php",
            "type": "post",
            "data": {
                action: "loaddata"
            },
            "dataType": "json",
            "dataSrc": "requests",
        },
        "columns": [
            { data: "Email" },
            { data: "BusinessName" },
            { data: "PackageName" },
            { data: "Duration",
              render: function(data, type, full) {
                return data / 60;
              } },
            { data: "Price",
              render: function(data, type, full) {
                return maskColumnNum(data);
              } },
            { data: "Id" }
        ],
        "columnDefs": [
            {
                "targets": [2],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [3],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [4],
                "visible": false,
                "searchable": false
            }
            ,{
                "targets": [5],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [6],
                "searchable": false,
                "defaultContent": "<span class='btn btn-primary fa fa-check confirm' style='height: 30px; width: 50px;' id='approve_request' data-toggle='modal' data-target='#mp-package-details'></span><span class='btn btn-primary fa fa-times' style='height: 30px; width: 50px;' id='delete_request' data-toggle='modal' data-target='#mp-confirmmodal'></span>"
            }
        ]
    });

    var packages = $('#packages').DataTable({
        "ajax": {
            "url": "php/managepackages.php",
            "type": "post",
            "data": { action: "loaddata" },
            "dataType": "json",
            "dataSrc": "packages",
        },
        "columns": [
            { data: "PackageName" },
            { data: "Duration",
              render: function(data, type, full) {
                return data / 60; //converts data for seconds to minutes
              } },
            { data: "Price",
              render: function(data, type, full) {
                return maskColumnNum(data); //formats number to proper currency
              } }
        ],
        "columnDefs": [{
            "targets": [3],
            "searchable": false,
            "defaultContent": "<span class='btn btn-primary fa fa-cog' style='height: 30px; width: 50px;' id='btn_updatepackage' data-toggle='modal' data-target='#mp-inputmodal'></span><span class='btn btn-primary fa fa-times del' style='height: 30px; width: 50px;' id='btn_deletepackage' data-toggle='modal' data-target='#mp-confirmmodal'></span>"
        }]
    });

    var payload = {};
    function transfer_data(parentid, payloaddata, modalid, tableid) { //method for ajax requesst
        $.ajax({
            url: "php/managepackages.php",
            type: "post",
            data: {
                packageaction: $('#' + parentid).data('action'),
                payload: payload
            },
            dataType: "json",
            beforeSend: function() {
                toast({ html: '<img src="resources/load.gif" height="100px"/>'})
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

    $('#mp-cm-confirm').click(function() { //for package deletion and approval of requests
        if($(this).data('action') == 'approve') {
            if($('#or-no').val() != '') {
                transfer_data($(this).attr('id'), payload, '#mp-confirmmodal', requests);
                $('.modal').modal('hide');
            } else {
                msg_response('false', 'Please enter an O.R. number!');
            }
        } else if($(this).data('action') == 'delete') {
            transfer_data($(this).attr('id'), payload, '#mp-confirmmodal', requests);
        } else if($(this).data('action') == 'deletepackage') {
            transfer_data($(this).attr('id'), payload, '#mp-confirmmodal', packages);
        }
    });

    $('#mp-im-confirm').click(function() { //for package addition and update
        if ($(this).data('action') == 'addpackage' || $(this).data('action') == 'updatepackage') {
            if ($('#name').val() == '' || $('#duration').val() == '' || $('#price').val() == '') {
                toast_msg_response('Required fields is empty or not complete.');
                $('#name').focus();
            } else {
                payload['name'] =  $('#name').val();
                var minToSec = parseInt($('#duration').val()) * 60;
                payload['duration'] = minToSec;
                payload['price'] = $('#price').val(); 
                transfer_data($(this).attr('id'), payload, '#mp-inputmodal', packages);
            }
        }
    });

    $('#btn_addpackage').click(function() { //working - data application for adding package
        $('#name').attr('readonly', false);
        $('#name').val('');
        $('#duration').val('');
        $('#price').val('');
        $('#mp-im-label').html('Add Package');
        $('#mp-im-confirm').html('Create');
        $('#mp-im-confirm').data('action', 'addpackage');
    });

    $('#requests tbody').on('click', 'span', function() { //working - data application for approving requests
        var id = $(this).attr('id');
        if(id == 'approve_request') {
            $('#busi-name').html('');
            $('#package-type').html('');
            $('#duration-min').html('');
            $('#price-details').html('');
            $('#or-no').val('');
            $('#busi-name').html(requests.row($(this).closest('tr')).data()['BusinessName']);
            $('#package-type').html(requests.row($(this).closest('tr')).data()['PackageName']);
            $('#duration-min').html(requests.row($(this).closest('tr')).data()['Duration']);
            $('#price-details').html(requests.row($(this).closest('tr')).data()['Price']);
            $(this).data('id', requests.row($(this).closest('tr')).data()['Id']);
            $(this).data('email', requests.row($(this).closest('tr')).data()['Email']);
        } else if(id == 'delete_request') {
            payload['id'] = requests.row($(this).closest('tr')).data()['Id'];
            $('#mp-cm-confirm').data('action', 'delete');
        }
    });

    $('#packages tbody').on('click', 'span', function() { //working
        if ($(this).attr('id') == 'btn_updatepackage') { //for updating package
            $('#name').attr('readonly', true);
            $('#mp-im-label').html('Update Package');
            $('#mp-im-confirm').html('Update');
            $('#mp-im-confirm').data('action', 'updatepackage');
            $('#name').val(packages.row($(this).closest('tr')).data()['PackageName']);
            var showMinutes = parseInt(packages.row($(this).closest('tr')).data()['Duration']) / 60;
            $('#duration').val(showMinutes);
            $('#price').val(packages.row($(this).closest('tr')).data()['Price']);
        } else if ($(this).attr('id') == 'btn_deletepackage') { //for deleting package
            payload['name'] = packages.row($(this).closest('tr')).data()['PackageName'];
            $('#mp-cm-confirm').data('action', 'deletepackage');
        }
    });

    $('#mp-pd-confirm').click(function() {
        payload['id'] = $('#approve_request').data('id');
        payload['email'] = $('#approve_request').data('email');
        payload['or-no'] = $('#or-no').val();
        $('#mp-cm-confirm').data('action', 'approve');
    });

    function maskColumnNum(value){
      return "PHP " + accounting.formatNumber(value, 2);
    }

    $(document).on('show.bs.modal', '.modal', function () {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    })

});