@extends('admin.layout.final')
@section('title')
Translation Management
@endsection
@section('pageTitle')
Translation Management
@endsection
@section('content')

@section('breadcrumb')
<div class="col-md-7 align-self-center text-right">
    <div class="d-flex justify-content-end align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{backUrl('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{backUrl('translation')}}">Translation Management</a></li>
            <li class="breadcrumb-item active">Add Translation</li>
            
        </ol>
    </div>
</div>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="mb-0 text-white">Add Translation - {{$moduleName}} Module</h4>
            </div>
            <form name="translationModuleAddForm" id="translationModuleAddForm" method="post" action="{{backUrl('translation/module/store')}}">
                <input type="hidden" name="module_id" value="{{$request->module_id}}">
                @csrf
                <!-- <div class="card-body">
                    <h4 class="card-title">Person Info</h4>
                </div>
                <hr> -->
                <div class="form-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label">Language:</label>
                            <select class="form-control custom-select" name="lang_id" id="lang_id" data-placeholder="Choose a Language" tabindex="1">
                                <option value="">Please Select</option>
                                @if(isset($languages) && !empty($languages))
                                @foreach($languages as $languagesVal)
                                <option value="{{$languagesVal->id}}">{{$languagesVal->language_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="comment">English String:</label>
                            <textarea class="form-control" rows="5" id="english_text" name="english_text">{{old('english_text')}}</textarea>
                        </div>
                        <div class="form-group">
                          <label for="comment">Translated String:</label>
                          <textarea class="form-control" rows="5" id="translated_text" name="translated_text">{{old('translated_text')}}</textarea>
                      </div>
                  </div>
                  <div class="card-body">
                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                    <a href="{{backUrl('translation/module/'.$request->module_id)}}" class="btn btn-dark">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
@section('jquery')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! isset($jsValidator)?$jsValidator->selector('#translationModuleAddForm'):'' !!}

@toastr_render
@endsection