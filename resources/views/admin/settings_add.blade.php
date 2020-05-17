@extends('admin.layout.final')
@section('title')
Setting Management
@endsection
@section('pageTitle')
Setting Management
@endsection
@section('content')

@section('breadcrumb')
<div class="col-md-7 align-self-center text-right">
    <div class="d-flex justify-content-end align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{backUrl('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{backUrl('settings')}}">Setting Management</a></li>
            <li class="breadcrumb-item active">Add Field</li>
        </ol>
    </div>
</div>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="mb-0 text-white">Add Field</h4>
            </div>
            <form name="settingsAddForm" id="settingsAddForm" method="post" action="{{backUrl('settings/store')}}">
                @csrf
                <!-- <div class="card-body">
                    <h4 class="card-title">Person Info</h4>
                </div>
                <hr> <--></-->
                <div class="form-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Field Name:</label>
                            <input type="text" class="form-control" id="field" name="field" value="{{old('field')}}">
                        </div>
                        <div class="form-group">
                            <label for="name">Slug:</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug')}}" readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label for="name">Value:</label>
                            <input type="text" class="form-control" id="value" name="value" value="{{old('value')}}">
                        </div>
                    </div>
                    <div class="card-body">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                        <a href="{{backUrl('settings')}}" class="btn btn-dark">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('jquery')
<script type="text/javascript" src="{{ asset('js/admin/settings.js')}}"></script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! isset($jsValidator)?$jsValidator->selector('#settingsAddForm'):'' !!}

@toastr_render
@endsection