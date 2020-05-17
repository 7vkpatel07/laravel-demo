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
                <form class="form-horizontal form-material" id="loginform" method="post" action="{{backUrl('login')}}">
                    @csrf
                    <h3 class="text-center m-b-20">Sign In</h3>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" name="email" id="email" type="text" placeholder="Email" value="" autocomplete="off"> </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" name="password" id="password" type="password"  placeholder="Password" value=""> </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="d-flex no-block align-items-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input" id="remember" value="1">
                                            <label class="custom-control-label" for="remember">Remember me</label>
                                        </div> 
                                        <div class="ml-auto">
                                            <a href="javascript:void(0)" id="to-recover" class="text-muted"><i class="fas fa-lock m-r-5"></i> Forgot pwd?</a> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <div class="col-xs-12 p-b-20">
                                    <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Log In</button>
                                </div>
                                <div class="ml-auto">
                                    <a href="{{backUrl('login/otp')}}" id="to-otp" class="text-muted"><i class="fas fa-lock m-r-5"></i> Log In With Mobile / OTP</a> 
                                </div>
                                
                            </div>
                            <!-- <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                                    <div class="social">
                                        <button class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fab fa-facebook-f"></i> </button>
                                        <button class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fab fa-google-plus-g"></i> </button>
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-group m-b-0">
                                <div class="col-sm-12 text-center">
                                    Don't have an account? <a href="#" class="text-info m-l-5"><b>Sign Up</b></a>
                                </div>
                            </div>
                        </form>
                        <form class="form-horizontal" id="recoverform" action="index.html">
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <h3>Recover Password</h3>
                                    <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text"  placeholder="Email"> </div>
                                </div>
                                <div class="form-group text-center m-t-20">
                                    <div class="col-xs-12">
                                        <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="javascript:void(0)" id="to-login" class="text-muted"><i class="fas fa-lock m-r-5"></i> Back to Login</a> 
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
            {!! isset($jsValidator)?$jsValidator->selector('#loginform'):'' !!}
            @endsection