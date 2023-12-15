@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Admins</h3>
        </div>
        
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{!! route('admins') !!}">admins</a></li>
                <li class="breadcrumb-item active">edit admin</li>
            </ol>
        </div>

    </div>
    
    <div>
    <form action="{{ route('admin.update', $admins->id) }}" method="post">
		@csrf
        @method('PUT')
        <div class="card-body">

            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
                {{trans('lang.processing')}}
            </div>
         


            <div class="error_top"></div>
            <div class="row vendor_payout_create">
                <div class="vendor_payout_create-inner">
                
                    <fieldset>
                        <legend>Edit Admin</legend>
                        <div class="form-group row width-50">
                            <label class="col-3 control-label">Name</label>
                            <div class="col-7">
                                <input type="text" name="name" value="{{$admins->name}}" class="form-control user_first_name">
                                <div class="form-text text-muted">
                                        insert Your Name
                                </div>
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.email')}}</label>
                            <div class="col-7">
                                <input type="text" name="email" value="{{$admins->email}}" class="form-control user_email">
                                <div class="form-text text-muted">
                                    {{ trans("lang.user_email_help") }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.password')}}</label>
                            <div class="col-7">
                                <input type="password" name="password" class="form-control user_password">
                                <div class="form-text text-muted">
                                    {{ trans("lang.user_password_help") }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
								<strong>Role:</strong>
								<select class="form-control multiple" multiple name="roles[]">
                                    
									@foreach ($roles as $role)
										<option value="{{ $role->id}}">{{ $role->name }}</option>
									@endforeach
								</select>
							</div>
                
                      
                    </fieldset>



                </div>
            </div>
        </div>
        <div class="form-group col-12 text-center btm-btn">
            <button type="submit" class="btn btn-primary  save_user_btn"><i class="fa fa-save"></i> {{
                trans('lang.save')}}
            </button>
            <!-- <a href="{!! route('users') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{
                trans('lang.cancel')}}</a> -->
        </div>
            </div>
    </div>
</div>

@endsection

