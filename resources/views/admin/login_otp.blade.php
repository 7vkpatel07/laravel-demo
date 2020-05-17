@extends('admin.layout.login-register.final')
@section('title')
Login
@endsection

@section('content')
<section id="wrapper">
    <div class="login-register" style="background-image:url({{asset('assets/images/background/login-register.jpg')}});">
        <div class="login-box card">
            <div class="card-body">
                @if(Session::get('message'))
                <div class="alert {{Session::get('msg-class')}} alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ Session::get('message') }}</strong>
                </div>
                @endif

                <form class="form-horizontal form-material" id="mobileForm" method="post" action="">
                    <h3 class="text-center m-b-20">Sign In</h3>
                    <!-- <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" name="mobile_phone" id="mobile_phone" type="text" placeholder="Mobile" value="" autocomplete="off"> 
                        </div>
                    </div> -->
                    <div class="form-group ">
                    <div class="input-group my-group"> 
                        <select id="country_code" id="country_code" class="selectpicker form-control" data-live-search="true" title="Please select Country Code">
                            @foreach($countries as $countriesVal)
                            <option value="{{$countriesVal->country_code}}">{{$countriesVal->country_code}}</option>
                            @endforeach
                        </select> 
                        <input type="text" class="form-control w-50" name="mobile_phone" id="mobile_phone" placeholder="Mobile" autocomplete="off"/>
                        
                    </div>
                    </div>
                    <div class="form-group text-center">
                        <div class="col-xs-12 p-b-20">
                            <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Generate OTP</button>
                        </div>
                        <!-- <div class="ml-auto">
                            <a href="{{backUrl('login')}}" id="to-loginForm" class="text-muted"><i class="fas fa-lock m-r-5"></i> Log In With Email / Password</a> 
                        </div> -->

                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            Don't have an account? <a href="#" class="text-info m-l-5"><b>Sign Up</b></a>
                        </div>
                    </div>
                </form>

                <form class="form-horizontal form-material" id="otpForm" method="post" action="">
                    <h3 class="text-center m-b-20">Sign In</h3>
                    <div class="form-group ">

                       <div class="form-group">
                           <div class="col-xs-12">
                               <input class="form-control" name="otp" id="otp" type="number"  placeholder="OTP" value=""> </div>
                           </div>

                           <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Submit</button>
                            </div>
                            <!-- <div class="ml-auto">
                                <a href="{{backUrl('login')}}" id="to-loginForm" class="text-muted"><i class="fas fa-lock m-r-5"></i> Log In With Email / Password</a> 
                            </div> -->

                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                Don't have an account? <a href="#" class="text-info m-l-5"><b>Sign Up</b></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @endsection

    @section('jquery')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    <script src="{{ asset('assets/node_modules/inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{ asset('js/pages/mask.init.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/login.js')}}"></script>
    @endsection
