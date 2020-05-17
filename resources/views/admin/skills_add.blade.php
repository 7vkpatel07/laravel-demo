@extends('admin.layout.final')
@section('title')
{{translate('Skill Management')}}
@endsection
@section('pageTitle')
{{translate('Skill Management')}}
@endsection
@section('content')

@section('breadcrumb')
<div class="col-md-7 align-self-center text-right">
    <div class="d-flex justify-content-end align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{backUrl('/')}}">{{translate('Home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{backUrl('skills')}}">{{translate('Skill Management')}}</a></li>
            <li class="breadcrumb-item active">{{translate('Add Skill')}}</li>
        </ol>
    </div>
</div>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="mb-0 text-white">{{translate('Add Skill')}}</h4>
            </div>
            <form name="skillsAddForm" id="skillsAddForm" method="post" action="{{backUrl('skills/store')}}">
                @csrf
                
                <div class="form-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{translate('Skill Name')}}:</label>
                            <input type="text" class="form-control" id="skill_name" name="skill_name" value="{{old('skill_name')}}">
                        </div>
                        <div class="form-group">
                            <label for="name">{{translate('Skill Name')}} (EN):</label>
                            <input type="text" class="form-control" id="skill_name_en" name="skill_name_en" value="{{old('skill_name_en')}}">
                        </div>
                        <div class="form-group">
                            <label for="name">{{translate('Skill Access Level')}}:</label>
                            <input type="number" class="form-control" id="skill_access_level" name="skill_access_level" value="{{old('skill_access_level')}}">
                        </div>
                        <div class="form-group">
                            <label for="name">{{translate('Skill Status')}}:</label>
                            <select class="form-control custom-select" name="skill_status" id="skill_status" data-placeholder="Choose a Status" >
                                <option value="">{{translate('Please Select')}}</option>
                                <option value="1">{{translate('Active')}}</option>
                                <option value="0">{{translate('Inactive')}}</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{translate('Save')}}</button>
                        <a href="{{backUrl('skills')}}" class="btn btn-dark">{{translate('Cancel')}}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('jquery')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! isset($jsValidator)?$jsValidator->selector('#skillsAddForm'):'' !!}

@toastr_render
@endsection