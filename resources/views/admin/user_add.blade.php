@extends('admin.layout.final')
@section('title')
{{translate('User Management')}}
@endsection
@section('pageTitle')
{{translate('User Management')}}
@endsection
@section('content')

@section('breadcrumb')
<div class="col-md-7 align-self-center text-right">
    <div class="d-flex justify-content-end align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{backUrl('/')}}">{{translate('Home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{backUrl('user')}}">{{translate('User Management')}}</a></li>
            <li class="breadcrumb-item active">{{translate('Add User')}}</li>
        </ol>
    </div>
</div>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">{{translate('Add User')}}</h4>
            </div>
            <div class="card-body">
                <form action="{{backUrl('user/store')}}" name="userAddForm" id="userAddForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <h3 class="card-title">{{translate('Person Info')}}</h3>
                        <hr>
                        <div class="row p-t-20">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{translate('First Name')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="" value="{{old('first_name')}}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{translate('Last Name')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="" value="{{old('last_name')}}">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{translate('First Name')}} (EN) <span class="text-danger">*</span></label>
                                    <input type="text" id="first_name_en" name="first_name_en" class="form-control" placeholder="" value="{{old('first_name_en')}}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{translate('Last Name')}} (EN) <span class="text-danger">*</span></label>
                                    <input type="text" id="last_name_en" name="last_name_en" class="form-control" placeholder="" value="{{old('last_name_en')}}">
                                </div>
                            </div>
                            <!--/span-->
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{translate('Email')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="" value="{{old('email')}}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{translate('Phone Number')}}</label>
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="" value="{{old('phone')}}">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">

                            <!--/span-->
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{translate('Profile Photo')}}</label>
                                    <input type="file" id="profile_photo" name="profile_photo" class="form-control" placeholder="" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{translate('Social Id')}}</label>
                                    <input type="text" id="social_id_number" name="social_id_number" class="form-control" placeholder="" value="{{old('social_id_number')}}">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->

                        <!--/row-->
                        <div class="row">

                            <!--/span-->
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{translate('Date of Birth')}} ({{settingParam("date-format")}}) <span class="text-danger">*</span></label>
                                    <input type="text" id="birth_date" name="birth_date" class="form-control" placeholder="" value="{{old('birth_date')}}" readonly="">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->

                        <h3 class="box-title m-t-40">{{translate('Password')}}</h3>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Password')}} <span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Confirm Password')}} <span class="text-danger">*</span></label>
                                    <input type="password" name="confirmed" id="confirmed" class="form-control">
                                </div>
                            </div>
                        </div>

                        <h3 class="box-title m-t-40">{{translate('Address')}}</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('House Number')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="address_street_number" id="address_street_number" class="form-control" value="{{old('address_street_number')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Street')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="address_street" id="address_street" class="form-control" value="{{old('address_street')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('City')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="address_city" id="address_city" class="form-control" value="{{old('address_city')}}">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('City')}} (EN) <span class="text-danger">*</span></label>
                                    <input type="text" name="address_city_en" id="address_city_en" class="form-control" value="{{old('address_city_en')}}">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Country')}} <span class="text-danger">*</span></label>
                                    <select class="form-control custom-select" name="country_id" id="country_id" data-placeholder="Choose a Country" >
                                        <option value="">Please Select</option>
                                        @if(isset($countryList) && !empty($countryList))
                                        @foreach($countryList as $countryListVal)
                                        <option value="{{$countryListVal->id}}">{{(currentLanguage()==1)?$countryListVal->country_name:$countryListVal->country_name_en}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{translate('Mobile Number')}} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-append w-25">
                                            <input type="text" id="country_code" name="country_code" class="input-group-text" value="" readonly="">
                                        </div>
                                        <input type="text" id="mobile_phone" name="mobile_phone" class="form-control" placeholder="" value="{{old('mobile_phone')}}">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Zip Code')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="address_zip" id="address_zip" class="form-control" value="{{old('address_zip')}}">
                                </div>
                            </div>

                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Fax')}}</label>
                                    <input type="text" name="fax" id="fax" class="form-control" value="{{old('fax')}}">
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Passport Id')}} </label>
                                    <input type="text" name="passport_id" id="passport_id" class="form-control" value="{{old('passport_id')}}">
                                </div>
                            </div>

                        </div>

                        <h3 class="box-title m-t-40">{{translate('Assign Role')}}</h3>
                        <hr>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('User Role')}} <span class="text-danger">*</span></label>
                                    <select class="form-control custom-select" name="role_id" id="role_id" data-placeholder="Choose a Role" >
                                        <option value="">Please Select</option>
                                        @if(isset($roles) && !empty($roles))
                                        @foreach($roles as $rolesVal)
                                        <option value="{{$rolesVal->id}}">{{(currentLanguage()==1)?$rolesVal->role_name:$rolesVal->role_name_en}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                        </div>

                        <h3 class="box-title m-t-40">{{translate('Skills')}}</h3>
                        <hr>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{translate('User Skills')}} </label>
                                    <select id="skill_id" name="skill_id[]" class="select2 form-control custom-select" style="width: 100%" multiple="multiple" data-placeholder="Choose">
                                        @if(isset($skills) && !empty($skills))
                                        @foreach($skills as $skillsVal)
                                        <option value="{{$skillsVal->id}}">{{(currentLanguage() == 1)?$skillsVal->skill_name:$skillsVal->skill_name_en}}</option>
                                        @endforeach
                                        @endif        
                                    </select>
                                </div>
                            </div>

                        </div>


                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{translate('Save')}}</button>
                        <a href="{{backUrl('user')}}" class="btn btn-dark">{{translate('Cancel')}}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" rel="stylesheet">
<link href="{{ asset('assets/node_modules/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('jquery')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
<script src="{{ asset('assets/node_modules/inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{ asset('js/pages/mask.init.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/node_modules/multiselect/js/jquery.multi-select.js')}}"></script>
<script src="{{ asset('js/admin/user_add_edit.js')}}"></script>


{!! isset($jsValidator)?$jsValidator->selector('#userAddForm'):'' !!}

@toastr_render
@endsection

@section('javascript')
<script type="text/javascript">
    $(function () {
        $('#birth_date').datetimepicker({
            timepicker:false,
            maxDate: '0',
            format: '{{settingParam("date-format")}}',
            
        });
    });

    $(".select2").select2();
</script>
@endsection