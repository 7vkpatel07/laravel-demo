$(document).ready(function () {

    $("#checkAllUsers").click(function () {
        $('.usercheck').not(this).prop('checked', this.checked);
    });
    $(".usercheck").click(function () {
        if (!$(this).is(':checked')) {
            $('#checkAllUsers').prop('checked', false);
        }
    });

    $("input:checkbox").click(function () {
     if($('input:checkbox:checked').length>0){
         $('#action-user-btn').removeClass('d-none');
     }else{
         $('#action-user-btn').addClass('d-none');
     }
 });



    $("#delete-user-btn").click(function () {

        if (confirm("Do you want to delete this record?")) {
            var checked = [];
            $("input:checkbox:checked").each(function (index, vals) {
                if (this.checked) {
                    checked.push(vals.value);
                }
            });
            $.ajaxSetup({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
            $('#ajaxLoader').addClass('d-block');
            jQuery.ajax({
                url: backendUrl + "/user/multiDelete",
                method: 'post',
                data: {
                    user_ids: checked,
                },
                success: function (data) {
                    data = jQuery.parseJSON(JSON.stringify(data));
                    $("#ajaxLoader").removeClass("d-block");
                    if(data.status === true){
                        toastr.success(data.msg);
                        window.location.reload(true);
                    }else{
                        toastr.error(data.msg);
                    }

                }});
        }

    });  



    $("#active-user-btn").click(function () {

        if (confirm("Do you want to active this record?")) {
            var checked = [];
            $("input:checkbox:checked").each(function (index, vals) {
                if (this.checked) {
                    checked.push(vals.value);
                }
            });
            $.ajaxSetup({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
            $('#ajaxLoader').addClass('d-block');
            jQuery.ajax({
                url: backendUrl + "/user/multiActive",
                method: 'post',
                data: {
                    user_ids: checked,
                },
                success: function (data) {
                    data = jQuery.parseJSON(JSON.stringify(data));
                    $("#ajaxLoader").removeClass("d-block");
                    if(data.status === true){
                        toastr.success(data.msg);
                        window.location.reload(true);
                    }else{
                        toastr.error(data.msg);
                    }

                }});
        }

    }); 


    $("#inactive-user-btn").click(function () {

        if (confirm("Do you want to inactive this record?")) {
            var checked = [];
            $("input:checkbox:checked").each(function (index, vals) {
                if (this.checked) {
                    checked.push(vals.value);
                }
            });
            $.ajaxSetup({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
            $('#ajaxLoader').addClass('d-block');
            jQuery.ajax({
                url: backendUrl + "/user/multiInActive",
                method: 'post',
                data: {
                    user_ids: checked,
                },
                success: function (data) {
                    data = jQuery.parseJSON(JSON.stringify(data));
                    $("#ajaxLoader").removeClass("d-block");
                    if(data.status === true){
                        toastr.success(data.msg);
                        window.location.reload(true);
                    }else{
                        toastr.error(data.msg);
                    }

                }});
        }

    });
    


});