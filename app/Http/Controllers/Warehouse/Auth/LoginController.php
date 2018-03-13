<?php

namespace App\Http\Controllers\Warehouse\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;

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
    protected $redirectTo = '/warehouse';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:warehouse', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('warehouse.auth.login');
    }

    public function username()
    {
        return 'username';
    }

    protected function guard()
    {
        return Auth::guard('warehouse');
    }

    // public function login(Request $r)
    // {
    //     // dd($r->all());
    //     $this->validate($r, [
    //         $this->username()   => 'required',
    //         'password' => 'required|min:6'
    //         ]);
    //     if (Auth::guard('warehouse')->attempt([$this->username() => $r->$this->username(), 'password' => $r->password], $r->has('remember'))) {
    //         return redirect()->intended(route('admin.dashboard'));
    //     }
    //     return redirect()->back()->withInput($r->only('username', 'remember'));
    // }
}
