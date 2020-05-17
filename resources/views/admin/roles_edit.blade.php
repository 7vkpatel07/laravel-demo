@extends('admin.layout.final')
@section('title')
{{translate('Role Management')}}
@endsection
@section('pageTitle')
{{translate('Role Management')}}
@endsection
@section('content')

@section('breadcrumb')
<div class="col-md-7 align-self-center text-right">
    <div class="d-flex justify-content-end align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{backUrl('/')}}">{{translate('Home')}}</a></li>
            <li class="breadcrumb-item active">{{translate('Role Management')}}</li>
        </ol>
    </div>
</div>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="mb-0 text-white">{{translate('Edit Role')}}</h4>
            </div>
            <form name="roleEditForm" id="roleEditForm" method="post" action="{{backUrl('roles/update')}}">
                <input type="hidden" name="id" id="id" value="{{$data->id}}">
                @csrf
                <!-- <div class="card-body">
                    <h4 class="card-title">Person Info</h4>
                </div>
                <hr> <-->
                <div class="form-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{translate('Role Name')}}:</label>
                            <input type="text" class="form-control" id="role_name" name="role_name" value="{{(isset($data->role_name) && $data->role_name!='')?$data->role_name:old('role_name')}}">
                        </div>
                        
                    </div>
                    
                    <div class="card-body">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{translate('Save')}}</button>
                        <a href="{{backUrl('roles')}}" class="btn btn-dark">{{translate('Cancel')}}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('jquery')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! isset($jsValidator)?$jsValidator->selector('#roleAddForm'):'' !!}

@toastr_render
@endsection