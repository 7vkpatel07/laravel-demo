@extends('admin.layout.final')
@section('title')
{{translate('User Management')}}
@endsection
@section('pageTitle')
{{translate('User Management')}}
@endsection
@section('breadcrumb')
<div class="col-md-7 align-self-center text-right">
    <div class="d-flex justify-content-end align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{backUrl('/')}}">{{translate('Home')}}</a></<li></li>
            <li class="breadcrumb-item active">{{translate('User Detail')}}</li>
        </ol>
        <a href="{{backUrl('user')}}" class="btn btn-info d-none d-lg-block m-l-15"> {{translate('Back')}}</a>
    </div>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">{{translate('User Detail')}}</h4>
            </div>
         <div class="card-body">
            <!-- <h4 class="card-title">Add Module</h4> -->

            <h6 class="card-subtitle"></h6>
            
            <div class="table-responsive">
                <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list footable footable-5 footable-paging footable-paging-center breakpoint-lg" data-paging="true" data-paging-size="7" style="">
                    
                    <tbody>
                      
                        <tr>
                            <td width="20%"><strong>{{translate('First Name')}}</strong></td>
                            <td>{{isset($data->first_name)?$data->first_name:'N/A'}}</td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>{{translate('Last Name')}}</strong></td>
                            <td>{{isset($data->last_name)?$data->last_name:'N/A'}}</td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>{{translate('First Name')}} (EN)</strong></td>
                            <td>{{isset($data->first_name_en)?$data->first_name_en:'N/A'}}</td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>{{translate('Last Name')}} (EN)</strong></td>
                            <td>{{isset($data->last_name_en)?$data->last_name_en:'N/A'}}</td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>{{translate('Email')}}</strong></td>
                            <td>{{isset($data->email)?$data->email:'N/A'}}</td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>{{translate('Country Code')}}</strong></td>
                            <td>{{isset($data->country->country_code)?$data->country->country_code:'N/A'}}</td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>{{translate('Mobile Number')}}</strong></td>
                            <td>{{isset($data->mobile_phone)?$data->mobile_phone:'N/A'}}</td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>{{translate('Phone Number')}}</strong></td>
                            <td>{{isset($data->phone)?$data->phone:'N/A'}}</td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>{{translate('Date of Birth')}}</strong></td>
                            <td>{{isset($data->birth_date)?convertDate($data->birth_date):'N/A'}}</td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>{{translate('Profile Photo')}}</strong></td>
                            <td>
                                @if(file_exists(storage_path('app\public\users\thumb_'.$data->profile_photo)))
                                <img src="{{ url('storage/users/thumb_'.$data->profile_photo) }}" width="50">
                                @else
                                N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>{{translate('Social Id')}}</strong></td>
                            <td>{{isset($data->social_id_number)?$data->social_id_number:'N/A'}}</td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>{{translate('House Number')}}</strong></td>
                            <td>{{isset($data->address_street_number)?$data->address_street_number:'N/A'}}</td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>{{translate('Street')}}</strong></td>
                            <td>{{isset($data->address_street)?$data->address_street:'N/A'}}</td>
                        </tr>
                         <tr>
                            <td width="20%"><strong>{{translate('City')}}</strong></td>
                            <td>{{isset($data->address_city)?$data->address_city:'N/A'}}</td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>{{translate('City')}} (EN)</strong></td>
                            <td>{{isset($data->address_city_en)?$data->address_city_en:'N/A'}}</td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>{{translate('Country')}}</strong></td>
                            <td>{{isset($data->country->country_name_en)?$data->country->country_name_en:'N/A'}}</td>
                        </tr>
                        

                        <tr>
                            <td width="20%"><strong>{{translate('Zip Code')}}</strong></td>
                            <td>{{isset($data->address_zip)?$data->address_zip:'N/A'}}</td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>{{translate('Fax')}}</strong></td>
                            <td>{{isset($data->fax)?$data->fax:'N/A'}}</td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>{{translate('User Skills')}}</strong></td>
                            <td>
                                @if($data->skills && !empty($data->skills))
                                @foreach($data->skills as $skillsVals)
                                @if(currentLanguage() == 1)
                                {{$skillsVals->skill_name}}<br/>
                                @else
                                {{$skillsVals->skill_name_en}}<br/>
                                @endif
                                @endforeach
                                @endif
                            </td>
                        </tr>

                        
                        
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</div>
</div>
@endsection
@section('jquery')

@toastr_render
@endsection