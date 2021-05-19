<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('banned');
    }

    /**
     * Funkcija vraca pogled sa formom za izmenu korisnickog passworda
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getChangeUserPassword() {
        return view('user.changePassword');
    }

    public function submitChangeUserPassword(Request $request) {
        $this->validate($request,
            [
                'old_password' => 'required',
                'new_password' => 'required|min:6|confirmed',
            ]
        );

        $user = Auth::user();

        if(Hash::check($request->old_password, $user->password)){
            $user->password = bcrypt($request->new_password);
            $user->save();

            Session::flash('alert-success', 'Your have changed your password.');
            return back();
        }

        Session::flash('alert-danger', 'Your old password is incorrect.');
        return back();
    }
}
