<!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets/node_modules/jquery/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets/node_modules/popper/popper.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    @toastr_js
    <script>var backendUrl ='{{url(config('constant.backend'))}}';</script>
    @yield('jquery')
    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
        $('#to-login').on("click", function() {
            $("#recoverform").slideUp();
            $("#loginform").fadeIn();
        });
        /*$('#to-otp').on("click", function() {
            $("#loginform").slideUp();
            $("#otpForm").fadeIn();
        });*/
         /*$('#to-loginForm').on("click", function() {
            $("#otpForm").slideUp();
            $("#loginform").fadeIn();
        });*/
    </script>