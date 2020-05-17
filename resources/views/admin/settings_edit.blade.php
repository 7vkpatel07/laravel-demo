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
            <li class="breadcrumb-item active">Edit Field</li>
        </ol>
        
    </div>
</div>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="mb-0 text-white">Edit Field</h4>
            </div>
            <form name="settingsEditForm" id="settingsEditForm" method="post" action="{{backUrl('settings/update')}}">
                <input type="hidden" name="id" value="{{$data->id}}">
                @csrf
                <!-- <div class="card-body">
                    <h4 class="card-title">Person Info</h4>
                </div>
                <hr> <--></-->
                <div class="form-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Field Name:</label>
                            <input type="text" class="form-control" id="field" name="field" value="{{$data->field}}">
                        </div>
                        <div class="form-group">
                            <label for="name">Slug:</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{$data->slug}}" readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label for="name">Value:</label>
                            @if($data->slug == 'date-format')
                            @php
                            $dateFormate = ['Y/m/d','d/m/Y','d-m-Y','d/m/Y',]
                            @endphp
                            <select class="form-control custom-select" name="value" id="value" data-placeholder="Choose a Status" >
                                @foreach($dateFormate as $dateFormateVal)
                                <option value="{{$dateFormateVal}}" {{(isset($data->value) && ($data->value == $dateFormateVal))?"selected=selected":""}}>{{$dateFormateVal}}</option>
                                @endforeach
                            </select>
                            @else
                            <input type="text" class="form-control" id="value" name="value" value="{{$data->value}}">
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
                        <a href="{{backUrl('settings')}}" class="btn btn-dark">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('css')
<link href="{{ asset('assets/node_modules/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('jquery')
<script type="text/javascript" src="{{ asset('assets/node_modules/multiselect/js/jquery.multi-select.js')}}"></script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! isset($jsValidator)?$jsValidator->selector('#settingsEditForm'):'' !!}

@toastr_render
@endsection

@section('javascript')
<script type="text/javascript">
    $('#value').select2({
      selectOnClose: true
  });
</script>
@endsection