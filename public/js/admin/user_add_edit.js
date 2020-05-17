$(document).ready(function () {

    $('#country_id').on("change",function() {

        $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
        $('#ajaxLoader').addClass('d-block');
        jQuery.ajax({
            url: backendUrl + "/user/getCountryCode",
            method: 'post',
            data: {
                country_id: $('#country_id').val(),
            },
            success: function (data) {
                data = jQuery.parseJSON(JSON.stringify(data));
                $("#ajaxLoader").removeClass("d-block");
                if(data.status === true){
                    $("#country_code").val(data.country_code)
                }else{
                    toastr.error(data.msg);
                }

            }});
        
    });  


});