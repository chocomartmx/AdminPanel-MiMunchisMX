<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" <?php if(str_replace('_', '-', app()->getLocale())=='ar' || @$_COOKIE['is_rtl']=='true'){ ?> dir="rtl"  <?php } ?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>    
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo-light-icon.png') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <?php if(str_replace('_', '-', app()->getLocale())=='ar' || @$_COOKIE['is_rtl']=='true'){ ?>
        <link href="{{asset('assets/plugins/bootstrap/css/bootstrap-rtl.min.css')}}" rel="stylesheet">
    <?php } ?>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <?php if(str_replace('_', '-', app()->getLocale())=='ar' || @$_COOKIE['is_rtl']=='true'){ ?>
        <link href="{{asset('css/style_rtl.css')}}" rel="stylesheet">
    <?php } ?>
    <link href="{{ asset('css/icons/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    <link href="{{ asset('css/colors/blue.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body>
    <?php error_reporting(E_ALL ^ E_NOTICE); ?>
    <div id="app" class="fix-header fix-sidebar card-no-border">
            <div id="main-wrapper">

                <header class="topbar">

                <nav class="navbar top-navbar navbar-expand-md navbar-light">
                    @include('layouts.header')
                </nav>

                </header>

                <aside class="left-sidebar">

                    <!-- Sidebar scroll-->

                    <div class="scroll-sidebar">

                        @include('layouts.menu')

                    </div>

                    <!-- End Sidebar scroll-->

                </aside>

            </div>


        

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('js/waves.js') }}"></script>
    <script src="{{ asset('js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(window).scroll(function() {    
            var scroll = jQuery(window).scrollTop();    
            if (scroll <= 60) {
                jQuery("body").removeClass("sticky");
            }else{
                jQuery("body").addClass("sticky");
            }
        });
    </script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script>    
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-storage.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-database.js"></script>
    <script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>
    <script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>
    <script type="text/javascript">@include('vendor.notifications.init_firebase')</script>
    <script type="text/javascript">
        var database = firebase.firestore();
        var geoFirestore = new GeoFirestore(database);
        var createdAtman=firebase.firestore.Timestamp.fromDate(new Date());
        var createdAt={_nanoseconds: createdAtman.nanoseconds,_seconds: createdAtman.seconds};

        var ref = database.collection('settings').doc("globalSettings");
         ref.get().then( async function(snapshots){
            try{
                var globalSettings = snapshots.data();            
                $("#app_name").html(globalSettings.applicationName);
                $("#logo_web").attr('src',globalSettings.appLogo);
            }catch(error){

            }
            
            
        });
    var langcount=0;
        var languages_list = database.collection('settings').doc('languages');
        languages_list.get().then( async function(snapshotslang){  
            snapshotslang=snapshotslang.data();
            if(snapshotslang!=undefined){
                  snapshotslang=snapshotslang.list;
                  languages_list_main=snapshotslang;
                  snapshotslang.forEach((data) => {
                        if(data.isActive==true){
                            langcount++;
                            $('#language_dropdown').append($("<option></option>").attr("value", data.slug).text(data.title));
                        }
                  });
                  if(langcount>1){
                    $("#language_dropdown_box").css('visibility', 'visible');
                  }
                  <?php if(session()->get('locale')){ ?>
                            $("#language_dropdown").val("<?php echo session()->get('locale'); ?>");
                   <?php } ?>
                  
            }
         });

            var url = "{{ route('changeLang') }}";
            
            $(".changeLang").change(function(){
                var slug=$(this).val();
                languages_list_main.forEach((data) => {
                    if(slug==data.slug){
                        if(data.is_rtl==undefined){
                            setCookie('is_rtl','false', 365);
                        }else{
                            setCookie('is_rtl',data.is_rtl.toString(), 365);
                        }
                        window.location.href = url + "?lang="+slug;
                    }
                });
            });

            function setCookie(cname, cvalue, exdays) {
                const d = new Date();
                d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                let expires = "expires=" + d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }

            
            /*date = new Date();
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;

            var  next = new Date(date.getTime());
            next.setDate(date.getDate() + 1);

            var dd = String(next.getDate()).padStart(2, '0');
            var mm = String(next.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = next.getFullYear();
            next = yyyy + '-' + mm + '-' + dd;

            let start = new Date(today);
            let end = new Date(next);
            
            database.collection("restaurant_orders")
                //.where('status', 'in', ["Order Accepted","Driver Rejected"])
                .where('status', '==', 'Order Accepted')
                .where('createdAt', '>', start)
                .where('createdAt', '<', end)
                .get().then(function(snapshotorder){
                    remaining_orders=snapshotorder.docs;
                    remaining_orders.forEach((order) => {
                        order=order.data();
                        database.collection('restaurant_orders').doc(order.id).set({'trigger_delevery':new Date()}).then( async function (result){ 
                            console.log(order);
                            console.log("order");        
                        });
                        
                    });
            });

            database.collection("restaurant_orders")
            //.where('status', 'in', ["Order Accepted","Driver Rejected"])
            .where('status', '==', 'Driver Rejected')
            .where('createdAt', '>', start)
            .where('createdAt', '<', end)
            .get().then(function(snapshotorder){
                remaining_orders=snapshotorder.docs;
                remaining_orders.forEach((order) => {
                    order=order.data();
                    database.collection('restaurant_orders').doc(order.id).set({'trigger_delevery':new Date()}).then( async function (result){ 
                        console.log(order);
                        console.log("order");        
                    });
                    
                });
            });*/
           
            
    </script>
        @yield('scripts')
</body>
</html>
