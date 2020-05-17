@include('admin.layout.header')
<body class="skin-blue fixed-layout">

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
    <div id="main-wrapper">
        @include('admin.layout.topbar')
        @include('admin.layout.sidebar')
        @include('admin.layout.page-wrapper')
    </div>
    
    @include('admin.layout.footer')        
</body>
</html> 