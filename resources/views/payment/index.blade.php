@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                @if($id ?? ''=='')
                    <h3 class="text-themecolor">Make Payment</h3>
                @else
                    <h3 class="text-themecolor">list payment</h3>
                @endif

            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a
                                href="{{ url('dynamic-notification') }}">{{trans('lang.dynamic_notification')}}</a></li>

                    @if($id ?? ''=='')
                        <li class="breadcrumb-item active">{{trans('lang.create_notification')}}</li>
                    @else
                        <li class="breadcrumb-item active">{{trans('lang.edit_notification')}}</li>
                    @endif


                </ol>
            </div>

        </div>
        <div>
        <h3>Buy Movie Tickets N500.00</h3>
            <form method="POST" action="{{ route('pay') }}" id="paymentForm">
            {{ csrf_field() }}
            <div class="card-body">

                <div id="data-table_processing" class="dataTables_processing panel panel-default"
                     style="display: none;">
                    {{trans('lang.processing')}}
                </div>

                <div class="error_top" style="display:none"></div>
                
                <div class="row vendor_payout_create">

                    <div class="vendor_payout_create-inner">

                        <fieldset>
                      
 
                            
                            <div class="form-group row width-100">
                                <label class="col-3 control-label">Name</label>
                                <div class="col-7">
                                <input name="name" placeholder="Name" />
                                </div>
                            </div>
                            <div class="form-group row width-100">
                                <label class="col-3 control-label">Email</label>
                                <div class="col-7">
                                <input name="email" type="email" placeholder="Your Email" />
                                </div>
                            </div>
                            <div class="form-group row width-100">
                                <label class="col-3 control-label">Phone Number</label>
                                <div class="col-7">
                                <input name="phone" type="tel" placeholder="Phone number" />
                                </div>
                            </div>


                          

                        </fieldset>
                    </div>

                </div>

            </div>
            <div class="form-group col-12 text-center btm-btn">
                <button type="submit" class="btn btn-primary send_message"><i class="fa fa-save"></i> {{
                trans('lang.save')}}
                </button>
               
            </div>
            </form>
        </div>

        @endsection

       