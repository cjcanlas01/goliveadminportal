$(document).ready(function() {
	$('#index-confirm').click(function(e) {
		e.preventDefault();
		login_action();
	});

	$('#index-confirm').submit(function(e) {
		e.preventDefault();
		login_action();
	});

	function login_action() {
		$.ajax({
			url: "php/login.php",
			type: "post",
			data: {
				UserName: $('#UserName').val(),
				Passcode: $('#Passcode').val()
			},
			dataType: "json",
			beforeSend: function() {
				Swal({ position: 'top', html: '<img src="resources/load.gif" height="100px"/>', showConfirmButton: false})
			},
			success: function(data) {
				if (data['indicator'] == true) {
					Swal({ 
						position: 'center',
						type: 'success', 
						title: data['msg'],
						showConfirmButton: true
					}).then(function(isConfirm) {
						if (isConfirm) {
							$("#login").trigger('reset'); 
							window.location.href = 'index-dashboard.php';
						}
					});
				} else {
					Swal({
						toast: true,
						position: 'top',
						timer: 1800, 
						showConfirmButton: false,
						title: data['msg'], 
						type: 'warning', 
					});
					$("#login").trigger('reset'); 
				}
			}
		})
	}
});