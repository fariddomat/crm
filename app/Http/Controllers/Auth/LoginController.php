<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        if (auth()->user()->hasRole(['admin'])) {
            return RouteServiceProvider::ADMIN;
        }
        elseif(auth()->user()->hasRole(['supervisor'])) {
            return RouteServiceProvider::SUPERVISOR;
        }
        elseif(auth()->user()->hasRole(['back_office'])) {
            return RouteServiceProvider::BACK_OFFICE;
        }
        return RouteServiceProvider::agent;
    }

    // protected function credentials(Request $request)
    // {
    //     $credentials =  $request->only($this->username(), 'password');
    //     $credentials['active'] = 1;
    //     return $credentials;
    // }

    protected function authenticated(Request $request, $user)
    {
        if ($user->active == "0") {
            Auth::logout();
            return Redirect::back()->withErrors(['email'=>'Looks Like Your account is Banned']);
        }
    }
}
