$(document).ready(function () {

    $("#mobileForm").validate({
        rules: {
            mobile_phone: {
                required: true
            },
            country_code: {
                required: true
            },
        },
        messages: {
            mobile_phone: 'Please enter your registered mobile number.',
        },
        submitHandler: function (form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#ajaxLoader').addClass('d-block');
            jQuery.ajax({
                url: backendUrl + "/sendOTP",
                method: 'post',
                data: {
                    mobile_phone: $('#mobile_phone').val(),
                    country_code: $('#country_code').val(),
                },
                success: function (data) {
                    data = jQuery.parseJSON(JSON.stringify(data));
                    $('#ajaxLoader').removeClass('d-block');
                    if(data.success == true){
                        toastr.success(data.msg);
                        $("#mobileForm").slideUp();
                        $("#otpForm").fadeIn();
                    }else{
                        //$("#mobileForm").slideUp();
                       // $("#otpForm").fadeIn();
                        toastr.error(data.msg);
                    }


                }});
        }
    });




    $("#otpForm").validate({
        rules: {
            otp: {
                required: true
            },
            
        },
        messages: {
            otp: 'Please enter recieved OTP',
        },
        submitHandler: function (form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#ajaxLoader').addClass('d-block');
            jQuery.ajax({
                url: backendUrl + "/otpLogin",
                method: 'post',
                data: {
                    mobile_phone: $('#mobile_phone').val(),
                    otp: $('#otp').val(),
                },
                success: function (data) {
                    data = jQuery.parseJSON(JSON.stringify(data));
                    if(data.success == true){
                        toastr.success(data.msg);
                        window.location.reload(true);
                    }else{
                        toastr.error(data.msg);
                    }


                }});
        }
    });


});