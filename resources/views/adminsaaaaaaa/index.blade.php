@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.user_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.user_table')}}</li>
            </ol>
        </div>
        <div>
        </div>
    </div>

    <div class="container-fluid">
        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">{{trans('lang.processing')}}
                        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i
                                            class="fa fa-list mr-2"></i>Admins Table</a>
                            </li>
                            <li class="nav-item">
                            <button class="btn btn-success" onclick="create()"><i
                                class="glyphicon glyphicon-plus"></i>
                            New User
                        </button>
                                <!-- <a class="nav-link" href="{!! route('admins.create') !!}"><i
                                            class="fa fa-plus mr-2"></i>Create Admins</a> -->
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        

                        <!--<div id="users-table_filter" class="pull-right">
                            <label>{{ trans('lang.search_by')}}
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="first_name">{{ trans('lang.first_name')}}</option>
                                    <option value="last_name">{{ trans('lang.last_name')}}</option>
                                    <option value="email">{{ trans('lang.email')}}</option>
                                </select>
                                <div class="form-group">
                                    <input type="search" id="search" class="search form-control"
                                           placeholder="Search"
                                           aria-controls="users-table">
                                </div>
                            </label>&nbsp;
                            <button onclick="searchtext();"
                                    class="btn btn-warning btn-flat">Search
                            </button>&nbsp;<button onclick="searchclear();"
                                                   class="btn btn-warning btn-flat">Clear
                            </button>
                        </div>-->

                        <div class="table-responsive m-t-10">
                            <table id="userTable"
                                   class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th class="delete-all"><input type="checkbox" id="is_active"><label
                                                class="col-3 control-label" for="is_active"><a id="deleteAll"
                                                                                               class="do_not_delete"
                                                                                               href="javascript:void(0)"><i
                                                        class="fa fa-trash"></i> {{trans('lang.all')}}</a></label></th>

                                    <th>Name</th>
                                    <th>Email</th>
                                   
                                    <th>Actions</th>
                                    <!-- <th >{{trans('lang.role')}}</th> -->

                                    <!-- <th>{{trans('lang.actions')}}</th> -->
                                </tr>
                                </thead>
                                <tbody id="append_list1">
                              
                                        @foreach ($users as $user)
                                        <tr>
                                        <td class="delete-all">
                                            <input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '">
                                            <label class="col-3 control-label"\n' +'for="is_open_' + id + '" >

                                            </label>
                                        </td>
                                            <td>
                                            <p>{{ $user->name }}</p>
                                            </td>
                                            <td>
                                            <p>{{ $user->email }}</p>
                                            </td>
                                            <td class="action-btn">
                                                <a href="' + user_view + '">
                                                    <i class="fa fa-eye"></i></a>
                                                    <a href="{{ route('admin.edit', $user->id) }}">
                                                        <i class="fa fa-edit"></i></a>
                                                <a id="' + val.id + '" class="do_not_delete" name="user-delete" href="javascript:void(0)">
                                                    <i class="fa fa-trash"></i></a></td>
                                            </tr>
                                        @endforeach
                                    
                                </tbody>
                            </table>
                            <!-- <nav aria-label="Page navigation example">
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
                             </nav>-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
        @media screen and (min-width: 768px) {
            #myModal .modal-dialog {
                width: 85%;
                border-radius: 5px;
            }
        }
    </style>
@endsection

