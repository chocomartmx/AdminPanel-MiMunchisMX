<div class="user-profile">

    <!-- User profile image -->

    <!-- <div class="profile-img"> 

        <img src="{{ asset('/images/users/flag.png') }}" alt="user" />
        <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>

    </div> -->


    <!-- User profile text-->

    <div class="profile-text">

        <!-- <h5>Welcome to {{ config('app.name', 'Laravel') }} !</h5> -->
        <h5 id="app_name"></h5>
        <h3>Log Out</h3>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();" class=""
           data-toggle="tooltip" title="Log out"><i class="mdi mdi-power"></i></a>

        <div class="dropdown-menu animated flipInY">

            <!-- text-->

            <a href="#" class="dropdown-item"><i class="ti-user"></i></a>

            <!-- text-->

            <a href="#" class="dropdown-item"><i class="ti-wallet"></i></a>

            <div class="dropdown-divider"></div>

            <!-- text-->

            <a href="{{ route('logout') }}" class="dropdown-item"><i class="fa fa-power-off"></i></a>

            <!-- text-->

        </div>

    </div>

</div>

<nav class="sidebar-nav">

    <ul id="sidebarnav">

        <li class="nav-devider"></li>

        <li class="nav-small-cap">{{ config('app.name', 'Laravel') }}</li>

        <li><a class="has-arrow waves-effect waves-dark" href="{!! url('dashboard') !!}" aria-expanded="false">

                <i class="mdi mdi-home"></i>

                <span class="hide-menu">Home</span>

            </a>

            <ul aria-expanded="false" class="collapse">
                <li><a href="{!! url('dashboard') !!}">Dashboard</a></li>
            </ul>

        </li>

        <li>
            <a class="has-arrow waves-effect waves-dark" href="{!! url('users') !!}" aria-expanded="false">

                <i class="mdi mdi-account-multiple"></i>

                <span class="hide-menu">{{trans('lang.user_plural')}}</span>

            </a>
        </li>

        <li><a class="has-arrow waves-effect waves-dark" href="{!! url('restaurants') !!}" aria-expanded="false">

                <i class="mdi mdi-food-fork-drink"></i>

                <span class="hide-menu">{{trans('lang.restaurant_plural')}}</span>

            </a>

            <ul aria-expanded="false" class="collapse">

                <li><a href="{!! url('restaurants') !!}">{{trans('lang.restaurant_plural')}}</a></li>

                <!-- <li><a href="{!! url('restaurantFilters') !!}">{{trans('lang.restaurant_filter')}}</a></li> -->

            </ul>

        </li>

        <li><a class="has-arrow waves-effect waves-dark" href="{!! url('drivers') !!}" aria-expanded="false">

                <i class="mdi mdi-car"></i>

                <span class="hide-menu">{{trans('lang.driver_plural')}}</span>

            </a>
        </li>


        <li><a class="has-arrow waves-effect waves-dark" href="{!! url('categories') !!}" aria-expanded="false">

                <i class="mdi mdi-clipboard-text"></i>

                <span class="hide-menu">{{trans('lang.category_plural')}}</span>

            </a>
        </li>


        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">

                <i class="mdi mdi-food"></i>

                <span class="hide-menu">{{trans('lang.food_plural')}}</span>

            </a>

            <ul aria-expanded="false" class="collapse">

                <li><a href="{!! url('foods') !!}">{{trans('lang.food_plural')}}</a></li>

            </ul>

        </li>

        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">

                <i class="mdi mdi-library-books"></i>

                <span class="hide-menu">{{trans('lang.order_plural')}}</span>

            </a>

            <ul aria-expanded="false" class="collapse">

                <li><a href="{!! url('orders') !!}">{{trans('lang.order_plural')}}</a></li>

                <li><a href="{!! url('orderReview') !!}">{{trans('lang.order_review')}}</a></li>

            </ul>

        </li>


        <li><a class="has-arrow waves-effect waves-dark" href="{!! url('coupons') !!}" aria-expanded="false">

                <i class="mdi mdi-sale"></i>

                <span class="hide-menu">{{trans('lang.coupon_plural')}}</span>

            </a>
        </li>


        <li><a class="has-arrow waves-effect waves-dark" href="{!! url('notification') !!}" aria-expanded="false">

                <i class="fa fa-table "></i>

                <span class="hide-menu">{{trans('lang.notification')}}</span>

            </a>
        </li>

        <!-- <li><a class="has-arrow waves-effect waves-dark" href="{!! url('booktable') !!}" aria-expanded="false">

              <i class="fa fa-table "></i>

              <span class="hide-menu">{{trans('lang.book_table')}}</span>

          </a>           
      </li> -->

        <!-- <li><a class="has-arrow waves-effect waves-dark" href="{!! url('users') !!}" aria-expanded="false">

                <i class="mdi mdi-settings"></i>

                <span class="hide-menu">{{trans('lang.app_setting')}}</span>

            </a>           
        </li> -->


        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">

                <i class="mdi mdi-bank"></i>

                <span class="hide-menu">{{trans('lang.payment_plural')}}</span>

            </a>

            <ul aria-expanded="false" class="collapse">

                <li><a href="{!! url('payments') !!}">{{trans('lang.payment_plural')}}</a></li>

                <li><a href="{!! url('restaurantsPayouts') !!}">{{trans('lang.restaurants_payout_plural')}}</a></li>

                <li><a href="{!! url('driverpayments') !!}">{{trans('lang.driver_plural')}}
                        {{trans('lang.payment_plural')}}</a></li>

                <li><a href="{!! url('driversPayouts') !!}">{{trans('lang.drivers_payout')}}</a></li>

                <li><a href="{!! url('walletstransaction') !!}">{{trans('lang.wallet_transaction')}}</a></li>

                <li><a href="{!! url('payoutRequests/restaurants') !!}">{{trans('lang.payout_request')}}</a></li>

            </ul>

        </li>
        <li>
            <a class="has-arrow waves-effect waves-dark" href="{!! url('banners') !!}" aria-expanded="false">

                <i class="fa fa-table"></i>

                <span class="hide-menu">{{trans('lang.menu_items')}}</span>

            </a>
        </li>

        <!-- <li> <a class="has-arrow waves-effect waves-dark" href="{!! url('restaurants') !!}" aria-expanded="false">

                <i class="mdi mdi-settings"></i>

                <span class="hide-menu">{{trans('lang.mobile_menu')}}</span>

            </a>

            <ul aria-expanded="false" class="collapse">

                <li><a href="{!! url('settings/mobile/globals') !!}">{{trans('lang.app_setting_globals')}}</a></li>               

            </ul>

        </li> -->


        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">

                <i class="mdi mdi-settings"></i>

                <span class="hide-menu">{{trans('lang.app_setting')}}</span>

            </a>

            <ul aria-expanded="false" class="collapse">

                <li><a href="{!! url('settings/app/globals') !!}">{{trans('lang.app_setting_globals')}}</a></li>

                <!-- <li><a href="{!! url('restaurants') !!}">{{trans('lang.user_plural')}}</a></li> -->

                <li><a href="{!! url('settings/currencies') !!}">{{trans('lang.currency_plural')}}</a></li>

                <li><a href="{!! url('settings/payment/stripe') !!}">{{trans('lang.app_setting_payment')}}</a></li>

                

                <!-- <li><a href="{!! url('settings/app/notifications') !!}">{{trans('lang.app_setting_notifications')}}</a>
                </li> -->

                <li>
                    <a href="{!! url('settings/app/adminCommission') !!}">{{trans('lang.restaurant_admin_commission')}}</a>
                </li>

                <li><a href="{!! url('settings/app/radiusConfiguration') !!}">{{trans('lang.radios_configuration')}}</a>
                </li>

                <li><a href="{!! url('settings/app/bookTable') !!}">{{trans('lang.dine_in_future_setting')}}</a></li>

                <li><a href="{!! url('settings/app/vatSetting') !!}">{{trans('lang.vat_setting')}}</a></li>

                <li><a href="{!! url('settings/app/deliveryCharge') !!}">{{trans('lang.deliveryCharge')}}</a></li>
                <li><a href="{!! url('settings/app/languages') !!}">{{trans('lang.languages')}}</a></li>

                <li><a href="{!! url('settings/app/specialOffer') !!}">{{trans('lang.special_offer')}}</a></li>


                {{--
                <li><a href="{!! url('termsAndConditions') !!}">Terms And Conditions</a></li>
                --}}

            </ul>

        </li>

        <!-- <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">

                <i class="mdi mdi-account-multiple"></i>

                <span class="hide-menu">User of APP</span>

            </a>

            <ul aria-expanded="false" class="collapse">

                <li><a href="list-user.php">Customer</a></li>

                <li><a href="conducteur.php">Driver</a></li>

                <li><a href="notification.php">Notification</a></li>

            </ul>

        </li> -->

    </ul>
</nav>
<?php /*
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sidebar-nav">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto" id="sidebarnav">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                   <?php /* @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif *//* ?>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
*/ ?>


{{--
<ul class="navbar-nav">


    <li class="nav-item">
        <a class="nav-link" href="{!! url('dashboard') !!}">
            <p>{{trans('lang.dashboard')}}</p></a>
    </li>


    <li class="nav-header">{{trans('lang.app_management')}}</li>


    <li class="nav-item">
        <a class="nav-link" href="{!! route('users') !!}">
            <p>{{trans('lang.user_plural')}}</p></a>
    </li>


    <li class="nav-item has-treeview">
        <a href="#" class="nav-link ">
            <p>{{trans('lang.restaurant_plural')}} <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">

            <li class="nav-item">
                <a class="nav-link"
                   href="{!! route('restaurants.index') !!}">{{trans('lang.restaurant_plural')}}</p></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{!! route('restaurantFilters.index') !!}"><p>
                        {{trans('lang.restaurant_filter')}}</p></a>
            </li>

        </ul>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="{!! route('categories.index') !!}">
            <p>{{trans('lang.category_plural')}}</p>
        </a>
    </li>

    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <p>{{trans('lang.food_plural')}}</p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a class="nav-link" href="{!! route('foods.index') !!}">
                    <p>{{trans('lang.food_plural')}}</p></a>
            </li>
        </ul>
    </li>

    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <p>{{trans('lang.order_plural')}}</p>
        </a>
        <ul class="nav nav-treeview">

            <li class="nav-item">
                <a class="nav-link" href="{!! route('orders.index') !!}">
                    <p>{{trans('lang.order_plural')}}</p>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{!! route('orderReview.index') !!}">
                    <p>{{trans('lang.order_review')}}</p>
                </a>
            </li>

        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{!! route('coupons.index') !!}">
            <p>{{trans('lang.coupon_plural')}}</p>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{!! route('drivers.index') !!}">
            <p>{{trans('lang.driver_plural')}} </p>
        </a>
    </li>

    <li class="nav-header">{{trans('lang.app_setting')}}</li>

    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <p>{{trans('lang.payment_plural')}}</p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a class="nav-link" href="{!! route('payments.index') !!}">
                    <p>{{trans('lang.restaurant_plural')}} {{trans('lang.payment_plural')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{!! route('restaurantsPayouts.index') !!}">
                    <p>{{trans('lang.restaurants_payout_plural')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{!! route('driver.driverpayments') !!}">
                    <p>{{trans('lang.driver_plural')}} {{trans('lang.payment_plural')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{!! route('driversPayouts.index') !!}">
                    <p>{{trans('lang.drivers_payout')}}</p>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <p>{{trans('lang.mobile_menu')}}</p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{!! url('settings/mobile/globals') !!}" class="nav-link">
                    <p>{{trans('lang.app_setting_globals')}}</p>
                </a>
            </li>
        </ul>

    </li>
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <p>{{trans('lang.app_setting')}}</p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{!! url('settings/app/globals') !!}" class="nav-link">
                    <p>{{trans('lang.app_setting_globals')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{!! route('users.index') !!}">
                    <p>{{trans('lang.user_plural')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{!! route('currencies.index') !!}"><p>{{trans('lang.currency_plural')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{!! url('settings/payment/payment') !!}" class="nav-link">
                    <p>{{trans('lang.app_setting_payment')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{!! url('settings/app/social') !!}" class="nav-link">
                    <p>{{trans('lang.app_setting_social')}}</p>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a href="{!! url('settings/app/notifications') !!}" class="nav-link">
                    <p>{{trans('lang.app_setting_notifications')}}</p>
                </a>
            </li> -->
            <li class="nav-item">
                <a href="{!! url('settings/promotion') !!}" class="nav-link">
                    <p>Promotion</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{!! url('termsAndConditions') !!}" class="nav-link">
                    <p>Terms And Conditions</p>
                </a>
            </li>
        </ul>
    </li>
</ul>--}}
