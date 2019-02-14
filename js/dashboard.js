$(document).ready(function() {
	const toast = Swal.mixin({ //for popup
	  position: 'center',
	  showConfirmButton: false,
	});

	$(document).ajaxStop(function() {
    	toast.close();
	});

	$(document).ajaxStart(function() {
		toast({ html: '<img src="resources/load.gif" height="100px"/>', allowOutsideClick: false })
	});
	
	$.ajax({
		url: "php/dashboard.php",
		type: "post",
		data: {
			action: 'data_count'
		},
		dataType: "json",
		success: function(data) {
			$('#usercount').html(data['uc']['uc_id']);
			$('#packagecount').html(data['pc']['pc_pc']);
			$('#videosaved').html(data['vsc']['vsc_e']);
			$('#requests').html(data['rc']['rc_id']);
			toast.close();
		}
	})

	$.ajax({
		url: "php/dashboard.php",
		type: "post",
		data: {
			action: 'line_chart'
		},
		dataType: "json",
		success: function(data) {
			new Morris.Line({
			  element: 'testChart',
			  data: [
			    { year: data['year'] + " Q1", value: data[0] },
			    { year: data['year'] + " Q2", value: data[1] },
			    { year: data['year'] + " Q3", value: data[2] },
			    { year: data['year'] + " Q4", value: data[3] }
			  ],
			  xkey: 'year',
			  ykeys: ['value'],
			  labels: ['Value'],
			  parseTime: false,
			  resize: true
			});
		}
	})
});