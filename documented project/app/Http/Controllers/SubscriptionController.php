<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('banned');
    }

    public function getSubscription(){
        return view('sub.form');
    }

    public function createSubscription(Request $request){
        Auth::user()->newSubscription('main', 'main')->create($request->stripeToken);
        return redirect('subscription');
    }

    public function cancelSubscription(){
        Auth::user()->subscription('main')->cancel();
        return redirect()->back();
    }

    public function resumeSubscription(){
        Auth::user()->subscription('main')->resume();
        return redirect()->back();
    }
}
