$(document).ready(function () {
    $("#field").change(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       // $('#ajaxLoader').addClass('d-block');
        jQuery.ajax({
            url: backendUrl + "/settings/checkSlug",
            method: 'post',
            data: {
                fieldTitle: $(this).val(),
            },
            success: function (data) {
                data = jQuery.parseJSON(JSON.stringify(data));
                //$('#ajaxLoader').removeClass('d-block');
               $('#slug').val(data.slug);


            }});

    });
});