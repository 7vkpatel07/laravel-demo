@extends('admin.layout.final')
@section('title')
Translation Management
@endsection
@section('pageTitle')
Translation Management
@endsection
@section('breadcrumb')
<div class="col-md-7 align-self-center text-right">
    <div class="d-flex justify-content-end align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{backUrl('/')}}">Home</a></li>
            <li class="breadcrumb-item active">Translation Management</li>
            
        </ol>
        <a href="{{backUrl('translation/add')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</a>
    </div>
</div>
@endsection

@section('content')



<div class="row">
    <div class="col-lg-12">
        <div class="card">
           <div class="card-body">
            <!-- <h4 class="card-title">Add Module</h4> -->
            @if(!isset($request->module_id) && $request->module_id=='')
            <div class="col-md-12">
                <form action="" method="GET" role="search">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Search By Module:</label>
                                    <select class="form-control custom-select" name="search_by_module" id="search_by_module" data-placeholder="Choose a Module" >
                                        <option value="">Please Select</option>
                                        @if(isset($modules) && !empty($modules))
                                        @foreach($modules as $modulesVal)
                                        <option value="{{$modulesVal->id}}" {{(isset($request->search_by_module) && ($request->search_by_module == $modulesVal->id))?"selected=selected":""}}>{{$modulesVal->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">{{translate('Search By English Text:')}}</label>
                                    <input type="text" class="form-control" id="search_by_english_text" name="search_by_english_text" value="{{isset($request->search_by_english_text)?$request->search_by_english_text:'' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">{{translate('Search By Translated Text:')}}</label>
                                    <input type="text" class="form-control" id="search_by_translated_text" name="search_by_translated_text" value="{{isset($request->search_by_translated_text)?$request->search_by_translated_text:'' }}">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <button type="submit" name="search_submit" value="1" class="btn btn-success"> <i class="fa fa-check"></i> Search</button>
                            <a href="{{backUrl('translation')}}" class="btn btn-dark">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
            @endif
            <h6 class="card-subtitle"></h6>

            <div class="table-responsive">
                <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list footable footable-5 footable-paging footable-paging-center breakpoint-lg" data-paging="true" data-paging-size="7" style="">
                    <thead>
                        <tr class="footable-header">
                            <th class="footable-first-visible">No</th>
                            <th>@sortablelink('english_text', 'English Text')</th>
                            <th>@sortablelink('translated_text', 'Translated Text')</th>
                            <th>@sortablelink('modules.name', 'Module Name')</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($listing) && !empty($listing))
                        @php $i=(($listing->currentPage() - 1) * $listing->perPage()+1);@endphp
                        @foreach($listing as $listingVal)
                        <tr>
                            <td class="footable-first-visible">{{$i++}}</td>

                            <td>{{isset($listingVal->english_text)?$listingVal->english_text:'N/A'}}</td>
                            <td>{{isset($listingVal->translated_text)?$listingVal->translated_text:'N/A'}}</td>
                            <td>{{isset($listingVal->modules->name)?$listingVal->modules->name:'N/A'}}</td>
                            <td>
                                <a href="{{backUrl('translation/edit/'.$listingVal->id)}}">
                                    <i class="fas fa-edit" data-toggle="tooltip" data-original-title="Edit"></i>
                                </a>
                                <a onclick="return confirm('Are you sure want to delete this record?')" href="{{backUrl('translation/delete/'.$listingVal->id)}}">
                                    <i class="far fa-trash-alt" data-toggle="tooltip" data-original-title="Delete"></i>
                                </a>

                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr class="footable-paging">
                            <td colspan="8">
                                <div class="footable-pagination-wrapper">
                                    <div class="text-right">{!! $listing->appends(\Request::except('page'))->render() !!}</div>
                                    <div class="divider">
                                    </div>
                                    <!-- <span class="label label-primary">1 of 2</span> -->
                                </div>
                            </td>
                        </tr>
                    </tfoot>
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

@section('javascript')
<script type="text/javascript">
    $('#search_by_module').select2({
      selectOnClose: true
  });
</script>
@endsection