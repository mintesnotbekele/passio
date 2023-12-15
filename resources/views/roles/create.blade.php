@extends('layouts.app')

@section('content')

<div class="page-wrapper">

	<div class="row page-titles">

		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Roles</h3>
		</div>

		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
				<li class="breadcrumb-item"><a href="{!! route('admins') !!}">roles</a></li>
				<li class="breadcrumb-item active">create roles</li>
			</ol>
		</div>
		
		

		<div>
		<form action="{{ route('role.store') }}" method="post">
		@csrf
			<div class="card-body">

				<div id="data-table_processing" class="dataTables_processing panel panel-default"
					style="display: none;">{{trans('lang.processing')}}</div>
				<div class="error_top"></div>
				
				<div class="row vendor_payout_create">
					<div class="vendor_payout_create-inner">

						<fieldset>
							<legend>Role details</legend>

							<div class="form-group row width-50">
								<label class="col-3 control-label">Role Name</label>
								<div class="col-7">
									<input type="text" name="name" class="form-control user_first_name">
									<div class="form-text text-muted">
										insert role name
									</div>
								</div>
							</div>

							
							<div class="col-xs-12 mb-3">
							<div class="form-group">
								<strong>Permissions</strong>
							
								<select class="form-control multiple" multiple name="permissions[]">
									@foreach ($permissions as $permission)
										<option value="{{ $permission->name}}">{{ $permission->name }}</option>
									@endforeach
								</select>
							
							</div>
						</div>
						
						</fieldset>

						
					</div>
				</div>
			</div>

			<div class="form-group col-12 text-center btm-btn">
				<button type="submit" class="btn btn-primary  create_user_btn"><i class="fa fa-save"></i> {{
					trans('lang.save')}}</button>
				<a href="{!! route('users') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{
					trans('lang.cancel')}}</a>
			</div>
				</form>
		</div>

	</div>

</div>

@endsection
