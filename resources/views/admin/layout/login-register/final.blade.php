@include('admin.layout.login-register.header')
<body class="skin-default card-no-border">
    
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Elite admin</p>
        </div>
    </div>
    <div class="preloader d-none " id="ajaxLoader" style="opacity: 0.3;">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Elite admin</p>
        </div>
    </div>
    @yield('content')
    
    @include('admin.layout.login-register.footer')        
</body>
</html> 