@extends('admin.layout.final')
@section('title')
{{translate('Country Management')}}
@endsection
@section('pageTitle')
{{translate('Country Management')}}
@endsection
@section('content')

@section('breadcrumb')
<div class="col-md-7 align-self-center text-right">
    <div class="d-flex justify-content-end align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{backUrl('/')}}">{{translate('Home')}}</a></li>
            <li class="breadcrumb-item active">{{translate('Country Management')}}</li>
        </ol>
    </div>
</div>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="mb-0 text-white">{{translate('Edit Country')}}</h4>
            </div>
            <form name="countryEditForm" id="countryEditForm" method="post" action="{{backUrl('country/update')}}">
                <input type="hidden" name="id" id="id" value="{{$data->id}}">
                @csrf
                <!-- <div class="card-body">
                    <h4 class="card-title">Person Info</h4>
                </div>
                <hr> <--></-->
                <div class="form-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{translate('Country Name')}}:</label>
                            <input type="text" class="form-control" id="country_name" name="country_name" value="{{($data->country_name)?$data->country_name:old('country_name')}}">
                        </div>
                        <div class="form-group">
                            <label for="name">{{translate('Country Name')}} (EN):</label>
                            <input type="text" class="form-control" id="country_name_en" name="country_name_en" value="{{($data->country_name_en)?$data->country_name_en:old('country_name_en')}}">
                        </div>
                        <div class="form-group">
                            <label for="name">{{translate('Country Code')}}:</label>
                            <input type="text" class="form-control" id="country_code" name="country_code" value="{{($data->country_code)?$data->country_code:old('country_code')}}">
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{translate('Update')}}</button>
                        <a href="{{backUrl('country')}}" class="btn btn-dark">{{translate('Cancel')}}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('jquery')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! isset($jsValidator)?$jsValidator->selector('#countryEditForm'):'' !!}

@toastr_render
@endsection