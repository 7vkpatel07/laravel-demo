<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer">
	© 2019 Eliteadmin by themedesigner.in
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{ asset('assets/node_modules/jquery/jquery-3.2.1.min.js') }}"></script>
<!-- Bootstrap popper Core JavaScript -->
<script src="{{ asset('assets/node_modules/popper/popper.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('js/custom.min.js') }}"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!--morris JavaScript -->
<script src="{{ asset('assets/node_modules/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('assets/node_modules/morrisjs/morris.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<!-- Popup message jquery -->
<script src="{{ asset('assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>
<!-- Chart JS -->
<!-- <script src="{{ asset('js/dashboard1.js') }}"></script> -->
<script src="{{ asset('assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>



@toastr_js

<script>var backendUrl ='{{url(config('constant.backend'))}}';</script>

<script src="{{ asset('js/common.js') }}"></script>

@yield('jquery')

@yield('javascript')