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
                <h4 class="mb-0 text-white">{{translate('Add Country')}}</h4>
            </div>
            <form name="countryAddForm" id="countryAddForm" method="post" action="{{backUrl('country/store')}}">
                @csrf
                
                <div class="form-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{translate('Country Name')}}:</label>
                            <input type="text" class="form-control" id="country_name" name="country_name" value="{{old('country_name')}}">
                        </div>
                        <div class="form-group">
                            <label for="name">{{translate('Country Name')}} (EN):</label>
                            <input type="text" class="form-control" id="country_name_en" name="country_name_en" value="{{old('country_name_en')}}">
                        </div>
                        <div class="form-group">
                            <label for="name">{{translate('Country Code')}}:</label>
                            <input type="text" class="form-control" id="country_code" name="country_code" value="{{old('country_code')}}">
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{translate('Save')}}</button>
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
{!! isset($jsValidator)?$jsValidator->selector('#countryAddForm'):'' !!}

@toastr_render
@endsection