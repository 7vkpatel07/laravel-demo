@extends('admin.layout.final')
@section('title')
{{translate('Country Management')}}
@endsection
@section('pageTitle')
{{translate('Country Management')}}
@endsection
@section('breadcrumb')
<div class="col-md-7 align-self-center text-right">
    <div class="d-flex justify-content-end align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{backUrl('/')}}">{{translate('Home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{backUrl('country')}}">{{translate('Country Management')}}</a></li>
            <li class="breadcrumb-item active">{{translate('Add Country')}}</li>
        </ol>
        <a href="{{backUrl('country/add')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> {{translate('Create New')}}</a>
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
                                    <label class="control-label">{{translate('Search By Country Name')}}:</label>
                                    <input type="text" class="form-control" id="search_by_country_name" name="search_by_country_name" value="{{isset($request->search_by_country_name)?$request->search_by_country_name:'' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">{{translate('Search By Country Code')}}:</label>
                                    <input type="text" class="form-control" id="search_by_country_code" name="search_by_country_code" value="{{isset($request->search_by_country_code)?$request->search_by_country_code:'' }}">
                                </div>
                            </div>
                            
                        </div>
                       
                        
                        <div class="card-body">
                            <button type="submit" name="search_submit" value="1" class="btn btn-success"> <i class="fa fa-check"></i> {{translate('Search')}}</button>
                            <a href="{{backUrl('country')}}" class="btn btn-dark">{{translate('Reset')}}</a>
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
                            <th>@sortablelink('country_name', translate('Country Name'))</th>
                            <th>@sortablelink('country_name_en', translate('Country Name').' (EN)')</th>
                            <th>@sortablelink('country_code', translate('Country Code'))</th>
                            <th>{{translate('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($listing) && !empty($listing))
                        @php $i=(($listing->currentPage() - 1) * $listing->perPage()+1);@endphp
                        @foreach($listing as $listingVal)
                        <tr>
                            <td class="footable-first-visible">{{$i++}}</td>
                            <td>{{isset($listingVal->country_name)?$listingVal->country_name:'N/A'}}</td>
                            <td>{{isset($listingVal->country_name_en)?$listingVal->country_name_en:'N/A'}}</td>
                            <td>{{isset($listingVal->country_code)?$listingVal->country_code:'N/A'}}</td>
                            <td>
                                <a href="{{backUrl('country/edit/'.$listingVal->id)}}">
                                    <i class="fas fa-edit" data-toggle="tooltip" data-original-title="{{translate('Edit')}}"></i>
                                </a>
                                <a onclick="return confirm('Are you sure want to delete this record?')" href="{{backUrl('country/delete/'.$listingVal->id)}}">
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
@section('jquery')

@toastr_render
@endsection