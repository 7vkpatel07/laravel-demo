@extends('admin.layout.final')
@section('title')
{{translate('Assign Skill')}}
@endsection
@section('pageTitle')
{{translate('Assign Skill')}}
@endsection
@section('content')

@section('breadcrumb')
<div class="col-md-7 align-self-center text-right">
    <div class="d-flex justify-content-end align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{backUrl('/')}}">{{translate('Home')}}</a></li>
            <li class="breadcrumb-item active">{{translate('Assign Skill')}}</li>
        </ol>
    </div>
</div>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="mb-0 text-white">{{translate('Assign User Skill')}} - ({{$userDetail->email}})</h4>
            </div>
            <form name="countryAddForm" id="countryAddForm" method="post" action="{{backUrl('users-skills/store')}}">
                @csrf
                <input type="hidden" name="userId" id="userId" value="{{$userId}}">
                <div class="form-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{translate('User Skills')}}:</label>
                            <select id="skill_id" name="skill_id[]" class="select2 form-control custom-select" style="width: 100%" multiple="multiple" data-placeholder="Choose">
                                @if(isset($skills) && !empty($skills))
                                @foreach($skills as $skillsVal)
                                <option value="{{$skillsVal->id}}" {{isset($userSkills) && in_array($skillsVal->id,$userSkills)?"selected":""}}>{{(currentLanguage() == 1)?$skillsVal->skill_name:$skillsVal->skill_name_en}}</option>
                                @endforeach
                                @endif        
                            </select>
                        </div>
                        
                    </div>
                    
                    <div class="card-body">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{translate('Assign')}}</button>
                        <a href="{{backUrl('user')}}" class="btn btn-dark">{{translate('Cancel')}}</a>
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
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/node_modules/multiselect/js/jquery.multi-select.js')}}"></script>
{!! isset($jsValidator)?$jsValidator->selector('#countryAddForm'):'' !!}

@toastr_render
@endsection


@section('javascript')
<script type="text/javascript">
    $(".select2").select2();
</script>
@endsection