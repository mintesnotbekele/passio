@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{ trans('lang.deliveryCharge')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{ trans('lang.deliveryCharge')}}</li>
                </ol>
            </div>
        </div>

        <div class="card-body">
            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
            {{trans('lang.processing')}}
            </div>
            <div class="row vendor_payout_create">
                <div class="vendor_payout_create-inner">
                    <fieldset>
                        <legend>{{trans('lang.deliveryCharge')}}</legend>

                        <div class="form-check width-100">
                            <input type="checkbox" class="form-check-inline" id="vendor_can_modify">
                            <label class="col-5 control-label"
                                   for="vendor_can_modify">{{ trans('lang.vendor_can_modify')}}</label>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-4 control-label">{{ trans('lang.delivery_charges_per_km')}}</label>
                            <div class="col-7">
                                <input type="number" class="form-control" id="delivery_charges_per_km">
                            </div>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-4 control-label">{{ trans('lang.minimum_delivery_charges')}}</label>
                            <div class="col-7">
                                <input type="number" class="form-control" id="minimum_delivery_charges">
                            </div>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-4 control-label">{{ trans('lang.minimum_delivery_charges_within_km')}}</label>
                            <div class="col-7">
                                <input type="number" class="form-control" id="minimum_delivery_charges_within_km">
                            </div>
                        </div>
                        <div class="form-check width-100">
                            <input type="checkbox" class="form-check-inline" id="enable_discount">
                            <label class="col-5 control-label"
                                   for="enable_discount">Enable Discount</label>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-4 control-label">Discounted Price from KM</label>
                            <div class="col-7">
                                <input type="number" class="form-control" id="discount_from_km">
                            </div>
                        </div>
                        <div class="form-group row width-100">
                            <label class="col-4 control-label">Discounted Percentage</label>
                            <div class="col-7">
                                <input type="number" class="form-control" id="new_discount_price">
                            </div>
                        </div>
                        <div class="form-check width-100">
                            <input type="checkbox" class="form-check-inline" id="enable_discount2">
                            <label class="col-5 control-label"
                                   for="enable_discount">Enable Second Discount</label>
                        </div>
                        <div class="form-group row width-100">
                            <label class="col-4 control-label">Second Discounted Price from KM</label>
                            <div class="col-7">
                                <input type="number" class="form-control" id="discount_from_km2">
                            </div>
                        </div>
                        <div class="form-group row width-100">
                            <label class="col-4 control-label">Second Discounted Percentage</label>
                            <div class="col-7">
                                <input type="number" class="form-control" id="new_discount_price2">
                            </div>
                        </div>

                    </fieldset>
                </div>
            </div>

            <div class="form-group col-12 text-center">
                <button type="button" class="btn btn-primary save_admin_settings"><i
                            class="fa fa-save"></i> {{trans('lang.save')}}</button>
                <a href="{{url('/dashboard')}}" class="btn btn-default"><i
                            class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
            </div>
        </div>


@endsection

@section('scripts')

<script type="text/javascript">

    var database = firebase.firestore();
    var ref_deliverycharge = database.collection('settings').doc("DeliveryCharge");
    $(document).ready(function () {
        jQuery("#data-table_processing").show();
        ref_deliverycharge.get().then(async function (snapshots_charge) {
            var deliveryChargeSettings = snapshots_charge.data();
            if (deliveryChargeSettings == undefined) {
                database.collection('settings').doc('DeliveryCharge').set({
                    'vendor_can_modify': '',
                    'enable_discount': '',
                    'discount_from_km': '',
                    'new_discount_price': '',
                    'delivery_charges_per_km': '',
                    'minimum_delivery_charges': '',
                    'minimum_delivery_charges_within_km': ''
                });
            }
            jQuery("#data-table_processing").hide();
            try {
                if (deliveryChargeSettings.vendor_can_modify) {
                    $("#vendor_can_modify").prop('checked', true);
                }
                if (deliveryChargeSettings.enable_discount) {
                    $("#enable_discount").prop('checked', true);
                }
               
                $("#discount_from_km").val(deliveryChargeSettings.discount_from_km);
                $("#new_discount_price").val(deliveryChargeSettings.new_discount_price);
                $("#delivery_charges_per_km").val(deliveryChargeSettings.delivery_charges_per_km);
                $("#minimum_delivery_charges").val(deliveryChargeSettings.minimum_delivery_charges);
                $("#minimum_delivery_charges_within_km").val(deliveryChargeSettings.minimum_delivery_charges_within_km);
            } catch (error) {

            }
        });

        $(".save_admin_settings").click(function () {

            var checkboxValue = $("#vendor_can_modify").is(":checked");
            var discountCheckbox = $("#enable_discount").is(":checked");
            var delivery_charges_per_km = parseInt($("#delivery_charges_per_km").val());
            var minimum_delivery_charges = parseInt($("#minimum_delivery_charges").val());
            var minimum_delivery_charges_within_km = parseInt($("#minimum_delivery_charges_within_km").val());
            var discount_from_km = parseInt($("#discount_from_km").val());
            var new_discount_price = parseInt($("#new_discount_price").val());
            database.collection('settings').doc("DeliveryCharge").update({
                'vendor_can_modify': checkboxValue,
                'delivery_charges_per_km': delivery_charges_per_km,
                'minimum_delivery_charges': minimum_delivery_charges,
                'minimum_delivery_charges_within_km': minimum_delivery_charges_within_km,
                'enable_discount': discountCheckbox,
                'discount_from_km':discount_from_km,
                'new_discount_price': new_discount_price,
            }).then(function (result) {
                window.location.href = '{{ url("settings/app/deliveryCharge")}}';
            });


        })
    })
    
</script>

@endsection