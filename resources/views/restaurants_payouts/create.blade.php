@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.restaurants_payout_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <?php if ($id != '') { ?>
                    <li class="breadcrumb-item"><a href="{{ route('restaurants.payout', ['id' => $id]) }}">{{trans('lang.restaurants_payout_table')}}</a>
                    </li>
                <?php } ?>
                <li class="breadcrumb-item">{{trans('lang.restaurants_payout_create')}}</li>
            </ol>
        </div>
    </div>

    <div class="card-body">
        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
            {{trans('lang.processing')}}
        </div>
        <div class="error_top"></div>
        <div class="row restaurant_payout_create">
            <div class="restaurant_payout_create-inner">
                <fieldset>
                    <legend>{{trans('lang.restaurants_payout_create')}}</legend>
                    <?php if ($id == '') { ?>
                        <div class="form-group row width-100">
                            <label class="col-3 control-label">{{
                                trans('lang.restaurants_payout_restaurant_id')}}</label>
                            <div class="col-7">
                                <select id="select_restaurant" class="form-control">
                                    <option value="">{{ trans('lang.select_restaurant') }}</option>
                                </select>
                                <div class="form-text text-muted">
                                    {{ trans("lang.restaurants_payout_restaurant_id_help") }}
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group row width-100">
                        <label class="col-3 control-label">{{trans('lang.restaurants_payout_amount')}}</label>
                        <div class="col-7">
                            <input type="number" class="form-control payout_amount">
                            <div class="form-text text-muted">
                                {{ trans("lang.restaurants_payout_amount_placeholder") }}
                            </div>
                        </div>
                    </div>


                    <div class="form-group row width-100">
                        <label class="col-3 control-label">{{ trans('lang.restaurants_payout_note')}}</label>
                        <div class="col-7">
                            <textarea type="text" rows="8" class="form-control payout_note"></textarea>
                        </div>
                    </div>

                </fieldset>
            </div>
        </div>
    </div>

    <div class="form-group col-12 text-center btm-btn">
        <button type="button" class="btn btn-primary save_restaurant_payout_btn"><i class="fa fa-save"></i>
            {{trans('lang.save')}}
        </button>
        <?php if ($id != '') { ?>
            <a href="{{route('restaurants.payout',$id)}}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
        <?php } else { ?>
            <a href="{!! route('restaurantsPayouts') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
        <?php } ?>

        <!-- <a href="{!! route('restaurantsPayouts') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a> -->
    </div>
</div>
</div>
</div>


@endsection

@section('scripts')

<script>

    var database = firebase.firestore();

    async function remainingPriceOLD(vendorID) {
        var paid_price = 0;
        var total_price = 0;
        var remaining = 0;
        var adminCommission = 0;
        var commission = 0;
        await database.collection('payouts').where('vendorID', '==', vendorID).get().then(async function (payoutSnapshots) {
            payoutSnapshots.docs.forEach((payout) => {
                var payoutData = payout.data();
                paid_price = parseFloat(paid_price) + parseFloat(payoutData.amount);
            })

            await database.collection('restaurant_orders').where('vendor.id', '==', vendorID).where("status", "in", ["Order Completed"]).get().then(async function (orderSnapshots) {

                orderSnapshots.docs.forEach((order) => {
                    var orderData = order.data();
                    var productTotalmain = 0;
                    orderData.products.forEach((product) => {
                        if (product.price && product.quantity != 0) {
                            var extras_price = 0;
                            if (product.extras_price != undefined) {
                                extras_price = parseFloat(product.extras_price) * parseInt(product.quantity);
                            }

                            var productTotal = (parseFloat(product.price) * parseFloat(product.quantity)) + parseFloat(extras_price);
                            total_price = parseFloat(total_price) + parseFloat(productTotal);
                            productTotalmain = parseFloat(productTotalmain) + parseFloat(productTotal);
                        }
                    })
                    /*if(orderData.adminCommission!=undefined){
                        total_price = total_price-parseInt(orderData.adminCommission);
                    }*/

                    tax = 0;
                    if (orderData.hasOwnProperty('taxSetting')) {
                        if (orderData.taxSetting.type && orderData.taxSetting.tax) {
                            if (orderData.taxSetting.type == "percent") {
                                tax = (orderData.taxSetting.tax * productTotalmain) / 100;
                            } else {
                                tax = orderData.taxSetting.tax;
                            }
                        }
                    }

                    if (!isNaN(tax)) {
                        productTotalmain = parseFloat(productTotalmain) + parseFloat(tax);
                    }

                    if (orderData.adminCommission != undefined && orderData.adminCommissionType != undefined) {
                        if (orderData.adminCommissionType == "Percent") {
                            commission = (productTotalmain * parseFloat(orderData.adminCommission)) / 100;

                        } else {
                            commission = parseFloat(orderData.adminCommission);
                        }
                    } else if (orderData.adminCommission != undefined) {
                        commission = parseFloat(orderData.adminCommission);
                    }

                })

                if (adminCommission != undefined) {
                    total_price = parseFloat(total_price) - parseFloat(commission);
                }

                remaining = parseFloat(total_price) - parseFloat(paid_price);
            });
        });
        return remaining;
    }

    async function remainingPrice(vendorID) {
        var remaining = 0;

        await database.collection('users').where("vendorID", "==", vendorID).get().then(async function (snapshotss) {
            if (snapshotss.docs.length) {
                userdata = snapshotss.docs[0].data();
                if (isNaN(userdata.wallet_amount) || userdata.wallet_amount == undefined) {
                    remaining = 0;
                } else {
                    remaining = userdata.wallet_amount;
                }

            }
        });
        return remaining;
    }

    $(document).ready(function () {
        $("#data-table_processing").show();
        database.collection('vendors').orderBy('title', 'asc').get().then(async function (snapshots) {

            snapshots.docs.forEach((listval) => {
                var data = listval.data();
                $('#select_restaurant').append($("<option></option>")
                    .attr("value", data.id)
                    .text(data.title));
            })

        });
        $("#data-table_processing").hide();

        var payoutId = "<?php echo uniqid(); ?>";
        $(".save_restaurant_payout_btn").click(async function () {
            <?php if($id == ''){ ?>
            var vendorID = $("#select_restaurant").val();
            <?php }else{?>
            var vendorID = "<?php echo $id; ?>";
            <?php } ?>


            var remaining = await remainingPrice(vendorID);

            if (remaining > 0) {
                var amount = parseFloat($(".payout_amount").val());
                var note = $(".payout_note").val();
                var date = new Date(Date.now());

                if (vendorID != '' && $(".payout_amount").val() != '') {

                    database.collection('payouts').doc(payoutId).set({
                        'vendorID': vendorID,
                        'amount': amount,
                        'adminNote': note,
                        'id': payoutId,
                        'paidDate': date,
                        'paymentStatus': 'Success'
                    }).then(function () {

                        price = remaining - amount;

                        database.collection('users').where("vendorID", "==", vendorID).get().then(function (snapshotss) {
                            if (snapshotss.docs.length) {
                                userdata = snapshotss.docs[0].data();
                                database.collection('users').doc(userdata.id).update({'wallet_amount': price}).then(function (result) {
                                    <?php if($id != ''){ ?>
                                    window.location.href = "{{route('restaurants.payout',$id)}}";
                                    <?php }else{?>
                                    window.location.href = '{{ route("restaurantsPayouts")}}';
                                    <?php } ?>
                                });

                            }
                        });


                    })

                } else {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(window).scrollTop(0);
                    $(".error_top").append("<p>{{trans('lang.please_enter_details')}}</p>");
                    // alert("Please enter details");
                }
            } else {
                //alert("Restaurant don't have sufficient credit for payout.");
                $(".error_top").show();
                $(window).scrollTop(0);
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.restaurant_insufficient_payment_error')}}</p>");
            }


        })

    })


</script>

@endsection