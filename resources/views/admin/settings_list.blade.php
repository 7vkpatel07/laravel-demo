@extends('admin.layout.final')
@section('title')
Settting Management
@endsection
@section('pageTitle')
Settting Management
@endsection
@section('breadcrumb')
<div class="col-md-7 align-self-center text-right">
    <div class="d-flex justify-content-end align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{backUrl('/')}}">Home</a></li>
            <li class="breadcrumb-item active">Settting Management</li>
        </ol>
        <a href="{{backUrl('settings/add')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</a>
    </div>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
         <div class="card-body">
            <!-- <h4 class="card-title">Add Module</h4> -->

            <div class="col-md-6">
                <form action="" method="GET" role="search">
                    <div class="form-body">
                        <div class="card-body">

                            <div class="form-group">
                                <label class="control-label">Search By Field Name:</label>
                                <input type="text" class="form-control" id="search_by_field" name="search_by_field" value="{{isset($request->search_by_field)?$request->search_by_field:'' }}">
                            </div>

                        </div>
                        <div class="card-body">
                            <button type="submit" name="search_submit" value="1" class="btn btn-success"> <i class="fa fa-check"></i> Search</button>
                            <a href="{{backUrl('settings')}}" class="btn btn-dark">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
            <h6 class="card-subtitle"></h6>
            
            <div class="table-responsive">
                <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list footable footable-5 footable-paging footable-paging-center breakpoint-lg" data-paging="true" data-paging-size="7" style="">
                    <thead>
                        <tr class="footable-header">
                            <th class="footable-first-visible">No</th>
                            <th>@sortablelink('field', 'Field Name')</th>
                            <th>@sortablelink('slug', 'Slug')</th>
                            <th>@sortablelink('value', 'Value')</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($listing) && !empty($listing))
                        @php $i=(($listing->currentPage() - 1) * $listing->perPage()+1);@endphp
                        @foreach($listing as $listingVal)
                        <tr>
                            <td class="footable-first-visible">{{$i++}}</td>
                            <td>{{isset($listingVal->field)?$listingVal->field:'N/A'}}</td>
                            <td>{{isset($listingVal->slug)?$listingVal->slug:'N/A'}}</td>
                            <td>{{isset($listingVal->value)?$listingVal->value:'N/A'}}</td>
                            <td>
                                <a href="{{backUrl('settings/edit/'.$listingVal->id)}}">
                                    <i class="fas fa-edit" data-toggle="tooltip" data-original-title="Edit"></i>
                                </a>
                                <!-- <a onclick="return confirm('Are you sure want to delete this record?')" href="{{backUrl('settings/delete/'.$listingVal->id)}}">
                                    <i class="far fa-trash-alt" data-toggle="tooltip" data-original-title="Delete"></i>
                                </a> -->
                                
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