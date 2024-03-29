<?php

namespace App\Http\Controllers\Auth;
use Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function username()
    {
        return 'user_name';
    }
    protected function authenticated($request, $user)
    {
       if ($user->isActive()) {
            $request->session()->flash('status', 'TEST Vulco');
            $request->session()->flash('statusCode', -1);
            return redirect()->intended($this->redirectPath());
        } else {

            Auth::logout();
            $request->session()->flash('status', 'Sorry, your account is inactive. ');
            $request->session()->flash('statusCode', -1);
            return view('auth.login');
        }
    }
}
