@extends('admin.layout.final')
@section('title')
{{translate('User Management')}}
@endsection
@section('pageTitle')
{{translate('User Management')}}
@endsection
@section('breadcrumb')
<div class="col-md-7 align-self-center text-right">
    <div class="d-flex justify-content-end align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{backUrl('/')}}">{{translate('Home')}}</a></li>
            <li class="breadcrumb-item active">{{translate('User Management')}}</li>
        </ol>
        <a href="{{backUrl('user/add')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> {{translate('Create New')}}</a>
    </div>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
         <div class="card-body">
            <!-- <h4 class="card-title">Add Module</h4> -->

            <div class="col-md-12">
                <form action="" method="GET" role="search">

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">{{translate('Search By First Name:')}}</label>
                                    <input type="text" class="form-control" id="search_by_first" name="search_by_first" value="{{isset($request->search_by_first)?$request->search_by_first:'' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">{{translate('Search By Last Name:')}}</label>
                                    <input type="text" class="form-control" id="search_by_last" name="search_by_last" value="{{isset($request->search_by_last)?$request->search_by_last:'' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">{{translate('Search By Email:')}}</label>
                                    <input type="text" class="form-control" id="search_by_email" name="search_by_email" value="{{isset($request->search_by_email)?$request->search_by_email:'' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">{{translate('Search By Mobile Number:')}}</label>
                                    <input type="text" class="form-control" id="search_by_mobile" name="search_by_mobile" value="{{isset($request->search_by_mobile)?$request->search_by_mobile:'' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">{{translate('Search By City:')}}</label>
                                    <input type="text" class="form-control" id="search_by_city" name="search_by_city" value="{{isset($request->search_by_city)?$request->search_by_city:'' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">{{translate('Search By Status:')}}</label>
                                    <select class="form-control custom-select" name="search_by_status" id="search_by_status" data-placeholder="Choose a Status" >
                                        <option value="">Please Select</option>
                                        <option value="1" {{(isset($request->search_by_status) && ($request->search_by_status == 1))?"selected=selected":""}}>{{translate('Active')}}</option>
                                        <option value="0" {{(isset($request->search_by_status) && ($request->search_by_status == 0))?"selected=selected":""}}>{{translate('Inactive')}}</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="control-label">{{translate('Search By Skills:')}}</label>
                                    <select id="search_by_skills" name="search_by_skills[]" class="select2 form-control custom-select" style="width: 100%" multiple="multiple" data-placeholder="Choose">
                                        @if(isset($skills) && !empty($skills))
                                        @foreach($skills as $skillsVal)
                                        <option value="{{$skillsVal->id}}" {{isset($request->search_by_skills) && in_array($skillsVal->id,$request->search_by_skills)?"selected":""}}>{{(currentLanguage() == 1)?$skillsVal->skill_name:$skillsVal->skill_name_en}}</option>
                                        @endforeach
                                        @endif        
                                    </select>
                                </div>
                            </div>
                        </div>

                        
                        <div class="card-body">
                            <button type="submit" name="search_submit" value="1" class="btn btn-success"> <i class="fa fa-check"></i> {{translate('Search')}}</button>
                            <a href="{{backUrl('user')}}" class="btn btn-dark">{{translate('Reset')}}</a>
                        </div>
                    </div>
                </form>
            </div>

            <h6 class="card-subtitle"></h6>
            
            <div class="table-responsive">
                <div class="d-none1" id="action-user-btn">          
                    <a href="javascript:void(0)" id="delete-user-btn" class="btn btn-danger"><i class="far fa-trash-alt" data-toggle="tooltip" data-original-title="{{translate('Delete')}}"></i> </a>
                    <a href="javascript:void(0)" id="active-user-btn" class="btn btn-success">{{translate('Active')}}</a>
                    <a href="javascript:void(0)" id="inactive-user-btn" class="btn btn-danger">{{translate('Inactive')}}</a>

                    <a href="{{backUrl('exportUsers')}}" id="export-user-btn" class="btn btn-outline-secondary btn-rounded float-right">Excel <i class="mdi mdi-file-excel"></i></a>
                </div>

                <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list footable footable-5 footable-paging footable-paging-center breakpoint-lg" data-paging="true" data-paging-size="7" style="">
                    <thead>
                        <tr class="footable-header">
                            <th><input type="checkbox" class="control-input" name="checkAllUsers" id="checkAllUsers" value="all"></th>
                            <th class="footable-first-visible">No.</th>
                            <th>@sortablelink('first_name_en', translate('First Name'))</th>
                            <th>@sortablelink('last_name_en', translate('Last Name'))</th>
                            <th>@sortablelink('email', translate('Email'))</th>
                            <th>{{translate('Country Code')}}</th>
                            <th>@sortablelink('mobile_phone', translate('Mobile'))</th>
                            <th>@sortablelink('status', translate('Status'))</th>
                            <th>{{translate('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($listing) && !empty($listing))
                        @php $i=(($listing->currentPage() - 1) * $listing->perPage()+1);@endphp
                        @foreach($listing as $listingVal)
                        <tr>
                            <td>
                                <input type="checkbox" class="control-input usercheck" name="userCheck[]" id="userCheck{{$listingVal->id}}" value="{{$listingVal->id}}">
                            </td>
                            <td class="footable-first-visible">{{$i++}}</td>
                            @if(currentLanguage()==1)
                            <td>{{isset($listingVal->first_name)?$listingVal->first_name:'N/A'}}</td>
                            <td>{{isset($listingVal->last_name)?$listingVal->last_name:'N/A'}}</td>
                            @else
                            <td>{{isset($listingVal->first_name_en)?$listingVal->first_name_en:'N/A'}}</td>
                            <td>{{isset($listingVal->last_name_en)?$listingVal->last_name_en:'N/A'}}</td>
                            @endif
                            <td>{{isset($listingVal->email)?$listingVal->email:'N/A'}}</td>

                            <td>{{isset($listingVal->country->country_code)?$listingVal->country->country_code:'N/A'}}</td>
                            <td>{{isset($listingVal->mobile_phone)?$listingVal->mobile_phone:'N/A'}}</td>
                            <td>{{($listingVal->status == 1)?translate('Active'):translate('Inactive')}}</td>
                            <td>
                                <a href="{{backUrl('user/edit/'.$listingVal->id)}}">
                                    <i class="fas fa-edit" data-toggle="tooltip" data-original-title="Edit"></i>
                                </a>
                                <a href="{{backUrl('user/detail/'.$listingVal->id)}}">
                                    <i class="fas fa-eye" data-toggle="tooltip" data-original-title="{{translate('User Detail')}}"></i>
                                </a>
                                <a href="{{backUrl('users-skills/assign/'.$listingVal->id)}}">
                                    <i class="fas fa-tasks" data-toggle="tooltip" data-original-title="{{translate('Assign Skills')}}"></i>
                                </a>
                                <a onclick="return confirm('Are you sure want to delete this record?')" href="{{backUrl('user/delete/'.$listingVal->id)}}">
                                    <i class="far fa-trash-alt" data-toggle="tooltip" data-original-title="{{translate('Delete')}}"></i>
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

@section('css')
<link href="{{ asset('assets/node_modules/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('jquery')
<script type="text/javascript" src="{{ asset('assets/node_modules/multiselect/js/jquery.multi-select.js')}}"></script>
<script src="{{ asset('js/admin/user.js')}}"></script>
@toastr_render
@endsection

@section('javascript')
<script type="text/javascript">
    $(".select2").select2();
    $('#search_by_status').select2({
      selectOnClose: true
  });
</script>
@endsection
