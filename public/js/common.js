$(document).ready(function () {
	$("#language_id").change(function(){

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$('#ajaxLoader').addClass('d-block');
		jQuery.ajax({
			url: backendUrl + "/changeLanguage",
			method: 'post',
			data: {
				language_id: $(this).val(),
			},
			success: function (data) {
				data = jQuery.parseJSON(JSON.stringify(data));
				$('#ajaxLoader').removeClass('d-block');
				if (data.status == true) {	
					/*$.toast({
						heading: 'Success',
						text: data.msg,
						position: 'top-right',
						showHideTransition: 'fade',
						icon: 'success'
					})*/
					window.location.reload(true);
				} else {
					toastr.error(data.msg);
				}


			}});

	});
});