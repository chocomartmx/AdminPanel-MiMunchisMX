@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.app_setting_global')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.app_setting_global')}}</li>
                </ol>
            </div>
        </div>

        <div class="card-body">
            <div id="data-table_processing" class="dataTables_processing panel panel-default"
                 style="display: none;">{{trans('lang.processing')}}</div>
            <div class="row restaurant_payout_create">
                <div class="restaurant_payout_create-inner">
                    <fieldset>
                        <legend><i class="mr-3 fa fa-facebook"></i>{{trans('lang.app_setting_global')}}</legend>

                        <div class="form-group row width-100">
                            <label class="col-5 control-label">{{trans('lang.app_setting_app_name')}}</label>
                            <div class="col-7">
                                <input type="text" class="form-control application_name">
                                <div class="form-text text-muted">
                                    {{ trans("lang.app_setting_app_name_help") }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-3 control-label">{{trans('lang.upload_app_logo')}}</label>
                            <input type="file" class="col-7" onChange="handleFileSelect(event)">
                            <div id="uploding_image"></div>
                            <div class="logo_img_thumb"></div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.menu_placeholder_image')}}</label>
                            <input type="file" class="col-7" onChange="handleFileSelectplaceholder(event)">
                            <div id="uploading_placeholder"></div>
                            <div class="placeholder_img_thumb">
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.website_color_settings')}}</label>
                            <input type="color" class="ml-3" name="website_color" id="website_color">
                        </div>

                    </fieldset>

                    <fieldset>
                        <legend><i class="mr-3 fa fa-solid fa-address-book"></i>{{trans('lang.contact_us')}}</legend>

                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.contact_us_address')}}</label>
                            <div class="col-7">
                                <textarea class="form-control contact_us_address" rows="3"></textarea>
                                <div class="form-text text-muted">
                                    {{ trans("lang.contact_us_address_help") }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.contact_us_email')}}</label>
                            <div class="col-7">
                                <input type="text" class="form-control contact_us_email">
                                <div class="form-text text-muted">
                                    {{ trans("lang.contact_us_email_help") }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.contact_us_phone')}}</label>
                            <div class="col-7">
                                <input type="number" class="form-control contact_us_phone">
                                <div class="form-text text-muted">
                                    {{ trans("lang.contact_us_phone_help") }}
                                </div>
                            </div>
                        </div>

                    </fieldset>

                </div>
            </div>
        </div>

        <div class="form-group col-12 text-center btm-btn">
            <button type="button" class="btn btn-primary save_global_settings_btn"><i
                        class="fa fa-save"></i> {{trans('lang.save')}}</button>
            <a href="{{url('/dashboard')}}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}
            </a>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
    <script>

        var database = firebase.firestore();
        var ref = database.collection('settings').doc("globalSettings");
        var refPlaceholderImage = database.collection('settings').doc("placeHolderImage");
        var contactUs = database.collection('settings').doc("ContactUs");

        var photo = "";
        var placeholderphoto = '';
        $(document).ready(function () {
            jQuery("#data-table_processing").show();
            ref.get().then(async function (snapshots) {
                var globalSettings = snapshots.data();

                if (globalSettings == undefined) {
                    database.collection('settings').doc('globalSettings').set({});
                }

                try {
                    $(".application_name").val(globalSettings.applicationName);
                    $("#website_color").val(globalSettings.website_color);

                    photo = globalSettings.appLogo;
                    $(".logo_img_thumb").append('<img class="rounded" style="width:50px" src="' + photo + '" alt="image">');
                } catch (error) {

                }
                jQuery("#data-table_processing").hide();

            })

            refPlaceholderImage.get().then(async function (snapshots) {
                var placeholderImage = snapshots.data();
                jQuery("#data-table_processing").hide();
                placeholderphoto = placeholderImage.image;
                $(".placeholder_img_thumb").append('<img class="rounded" style="width:50px" src="' + placeholderphoto + '" alt="image">');
            })

            contactUs.get().then(async function (snapshots) {
                var contactUsData = snapshots.data();

                if (contactUsData == undefined) {
                    database.collection('settings').doc('ContactUs').set({});
                }

                try {
                    $('.contact_us_address').val(contactUsData.Address);
                    $('.contact_us_email').val(contactUsData.Email);
                    $('.contact_us_phone').val(contactUsData.Phone);

                } catch (error) {

                }
            })

            $(".save_global_settings_btn").click(function () {

                var is_disable_delete = "<?php echo env('IS_DISABLE_DELETE', 0); ?>";
                if (is_disable_delete == 1) {
                    alert("Do not alllow to change in demo content !");
                    return false;
                }
                var website_color = $("#website_color").val();
                var contact_us_address =  $('.contact_us_address').val();
                var contact_us_email = $('.contact_us_email').val();
                var contact_us_phone = $('.contact_us_phone').val();


                var applicationName = $(".application_name").val();
                if (applicationName == '') {
                    alert("Please enter application name");
                } else {
                    database.collection('settings').doc("globalSettings").update({
                        'website_color': website_color,
                        'applicationName': applicationName,
                        'appLogo': photo
                    }).then(function (result) {

                        database.collection('settings').doc('placeHolderImage').update({'image': placeholderphoto}).then(function (result) {
                            window.location.href = '{{ url("settings/app/globals")}}';
                        })
                        database.collection('settings').doc("ContactUs").update({
                            'Address': contact_us_address,
                            'Email': contact_us_email,
                            'Phone': contact_us_phone
                        }).then(function (result) {
                            window.location.href = '{{ url("settings/app/globals")}}';
                        })

                    });
                }

            })
        })


        var storageRef = firebase.storage().ref('images');

        function handleFileSelect(evt) {

            var is_disable_delete = "<?php echo env('IS_DISABLE_DELETE', 0); ?>";
            if (is_disable_delete == 1) {
                alert("Do not alllow to change in demo content !");
                return false;
            }


            var f = evt.target.files[0];
            var reader = new FileReader();

            reader.onload = (function (theFile) {
                return function (e) {

                    var filePayload = e.target.result;
                    var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
                    var val = f.name;
                    var ext = val.split('.')[1];
                    var docName = val.split('fakepath')[1];
                    var filename = (f.name).replace(/C:\\fakepath\\/i, '')

                    var timestamp = Number(new Date());
                    var uploadTask = storageRef.child(filename).put(theFile);
                    uploadTask.on('state_changed', function (snapshot) {
                        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                        jQuery("#uploding_image").text("Image is uploading...");

                    }, function (error) {

                    }, function () {
                        uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
                            jQuery("#uploding_image").text("Upload is completed");
                            photo = downloadURL;

                        });
                    });

                };
            })(f);
            reader.readAsDataURL(f);
        }


        function handleFileSelectplaceholder(evt) {

            var is_disable_delete = "<?php echo env('IS_DISABLE_DELETE', 0); ?>";
            if (is_disable_delete == 1) {
                alert("Do not alllow to change in demo content !");
                return false;
            }

            var f = evt.target.files[0];
            var reader = new FileReader();

            reader.onload = (function (theFile) {
                return function (e) {

                    var filePayload = e.target.result;
                    var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
                    var val = f.name;
                    var ext = val.split('.')[1];
                    var docName = val.split('fakepath')[1];
                    var filename = (f.name).replace(/C:\\fakepath\\/i, '')

                    var timestamp = Number(new Date());
                    var uploadTask = storageRef.child(filename).put(theFile);
                    console.log(uploadTask);
                    uploadTask.on('state_changed', function (snapshot) {
                        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                        console.log('Upload is ' + progress + '% done');
                        jQuery("#uploading_placeholder").text("Image is uploading...");

                    }, function (error) {

                    }, function () {
                        uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
                            jQuery("#uploading_placeholder").text("Upload is completed");
                            placeholderphoto = downloadURL;

                        });
                    });

                };
            })(f);
            reader.readAsDataURL(f);
        }
    </script>

@endsection