@extends('admin.layout.final')
@section('title')
Module Management
@endsection
@section('pageTitle')
Module Management
@endsection
@section('content')

@section('breadcrumb')
<div class="col-md-7 align-self-center text-right">
    <div class="d-flex justify-content-end align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{backUrl('/')}}">Home</a></li>
            <li class="breadcrumb-item active">Module Management</li>
        </ol>
    </div>
</div>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="mb-0 text-white">Add Module</h4>
            </div>
            <form name="moduleAddForm" id="moduleAddForm" method="post" action="{{backUrl('module/store')}}">
                @csrf
                <!-- <div class="card-body">
                    <h4 class="card-title">Person Info</h4>
                </div>
                <hr> <--></-->
                <div class="form-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Module Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                        </div>
                    </div>
                    <div class="card-body">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                        <a href="{{backUrl('module')}}" class="btn btn-dark">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('jquery')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! isset($jsValidator)?$jsValidator->selector('#moduleAddForm'):'' !!}

@toastr_render
@endsection