@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('lang.sos')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                <li class="breadcrumb-item active">{{trans('lang.sos')}}</li>

            </ol>

        </div>

        <div>

        </div>

    </div>



    <div class="container-fluid">
       <div id="data-table_processing" class="dataTables_processing panel panel-default"
                            style="display: none;">{{trans('lang.processing')}}</div>
        <div class="row">

            <div class="col-12">

                <div class="card">

                    {{-- <div class="card-header">
                                <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                                    <li class="nav-item">
                                      <a class="nav-link active" href="{!! route('settings.carModel') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.car_model')}}</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" href="{!! route('settings.carModel.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.add_car_model')}}</a>
                                    </li>                                    
                                </ul>
                            </div> --}}

                    <div class="card-body">

                        

                        {{-- <div id="users-table_filter" class="pull-right"><label>{{ trans('lang.search_by')}}
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="status">{{ trans('lang.status')}}</option>

                                </select>
                                <div class="form-group">
                                    <input type="search" id="search" class="search form-control" placeholder="Search"
                                        aria-controls="users-table">
                            </label>&nbsp;<button onclick="searchtext();"
                                class="btn btn-warning btn-flat">Search</button>&nbsp;<button onclick="searchclear();"
                                class="btn btn-warning btn-flat">Clear</button>
                        </div>
                    </div> --}}

                    <div class="table-responsive m-t-10">

                        <table id="example24"
                            class="display nowrap table table-hover table-striped table-bordered table table-striped"
                            cellspacing="0" width="100%">

                            <thead>

                                <tr>
                                    <th>{{trans('lang.sos_id')}}</th> 
                                    <th>{{trans('lang.order_user_id')}}</th>
                                    <th class="driverClass">{{trans('lang.driver_plural')}}</th>
                                    <th>{{trans('lang.address')}}</th>
                                    <th>{{trans('lang.status')}}</th>
                                    <th>{{trans('lang.actions')}}</th>

                                </tr>

                            </thead>

                            <tbody id="append_list1">

                            </tbody>

                        </table>

                       {{-- <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item ">
                                    <a class="page-link" href="javascript:void(0);" id="users_table_previous_btn"
                                        onclick="prev()" data-dt-idx="0" tabindex="0">{{trans('lang.previous')}}</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);" id="users_table_next_btn"
                                        onclick="next()" data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>
                                </li>
                            </ul>
                        </nav>--}}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</div>

</div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">

var database = firebase.firestore();

var offest = 1;
var pagesize = 10;
var end = null;
var endarray = [];
var start = null;
var user_number = [];
var ref = database.collection('SOS');
var placeholderImage = '';
var append_list = '';

$(document).ready(function () {

    var inx = parseInt(offest) * parseInt(pagesize);
    jQuery("#data-table_processing").show();


    append_list = document.getElementById('append_list1');
    append_list.innerHTML = '';
    ref.get().then(async function (snapshots) {
        html = '';

        html =  await buildHTML(snapshots);
        jQuery("#data-table_processing").hide();
        if (html != '') {
            append_list.innerHTML = html;
            start = snapshots.docs[snapshots.docs.length - 1];
            endarray.push(snapshots.docs[0]);
            if (snapshots.docs.length < pagesize) {
                jQuery("#data-table_paginate").hide();
            }
        }
        $('#example24').DataTable({
                
                order: [],
                columnDefs: [
                    {orderable: false, targets: [4]},
                ],
                "language": {
                    "zeroRecords": "{{trans("lang.no_record_found")}}",
                    "emptyTable": "{{trans("lang.no_record_found")}}"
                },
                responsive: true,
            });
        
    });

});


async function buildHTML(snapshots) {
    var html = '';
 
await Promise.all(snapshots.docs.map(async (listval) => {
    var val = listval.data();
    var getData = await getListData(val);
    
    html += getData;
}));
return html;
}
async function getListData(val) {
    var html = '';
    var count = 0;

    if(val.orderId) {

        const rideData = await rideDetails(val.orderId);
        
        if(rideData){

            html = html + '<tr>';
            newdate = '';
            var id = val.id;
            var route1 = '{{route("sos.edit",":id")}}';
            route1 = route1.replace(':id', id);

            var trroute1 = '{{route("rides.edit",":id")}}';
            trroute1 = trroute1.replace(':id', val.orderId);

            html = html + '<td><a href="' + route1 + '">' + val.id + '</a></td>';
            html = html + '<td>'+ rideData.author.firstName +'</td>';
            html = html + '<td>'+ rideData.driver.firstName +'</td>';
            html = html + '<td>'+ rideData.destinationLocationName +'</td>';
            
            if (val.status == "Completed") {
                html = html + '<td><span class="badge badge-success">' + val.status + '</span></td>';
            } else if (val.status == "Processing") {
                html = html + '<td><span class="badge badge-info">' + val.status + '</span></td>';
            } else {
                html = html + '<td><span class="badge badge-primary">' + val.status + '</span></td>';
            }

            html = html + '<td class="action-btn"><a href="' + route1 + '"><i class="fa fa-edit"></i></a><a id="' + val.id + '" name="carModel-delete" class="do_not_delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';
            html = html + '</tr>';
            count = count + 1;
            
        }
    }

    return html;
}

async function rideDetails(ride) {

    var rideDetails = await database.collection('rides').doc(ride).get();
    if (rideDetails.data()) {
        return rideDetails.data();
    } else {
        return '';
    }
}

$(document.body).on('click', '.redirecttopage', function () {
    var url = $(this).attr('data-url');
    window.location.href = url;
});

$(document).on("click", "a[name='carModel-delete']", function (e) {
    var id = this.id;
    database.collection('SOS').doc(id).delete().then(function () {
        window.location.reload();
    });
});

function searchclear() {
    jQuery("#search").val('');
    searchtext();
}

</script>

@endsection