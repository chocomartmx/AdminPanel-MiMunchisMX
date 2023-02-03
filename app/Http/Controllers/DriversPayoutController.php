<?php

namespace App\Http\Controllers;


class DriversPayoutController extends Controller
{

   public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {

       return view("drivers_payouts.index");
    }

    public function create()
    {
        
       return view("drivers_payouts.create");
    }

}
