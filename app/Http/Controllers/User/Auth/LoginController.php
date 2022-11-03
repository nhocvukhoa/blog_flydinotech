<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\UserRequest;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:user')->except(['logout', 'login']);
    }

    protected function guard()
    {
        return Auth::guard('user');
    }

    /**
     * Show login form
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (strpos(url()->previous(), 'register') > 0 || strpos(url()->previous(), 'forgot-password') > 0) {
            Redirect::setIntendedUrl(route('dashboard'));

        } else {
            Redirect::setIntendedUrl(url()->previous());
        }
        
        return view('user.auth.login');
    }

    /**
     * Log in to account
     *
     * @param \App\Http\Requests\Auth\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(UserRequest $request, $language)
    {
        $user = User::where('email', $request->email)->first();
        Session::put('website_language', $language);

        if (!$user) {
            Toastr::error(__('messages.login.email_not_exist'));
            
            return redirect()->back();
        }

        if(!Hash::check($request->password, $user->password)) {
            Toastr::error(__('messages.login.password_wrong'));

            return redirect()->back();
        }

        if ($this->guard()->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (!($this->guard()->user()->role == UserRole::USER)) {
                $this->guard()->logout();
                Toastr::error(__('messages.login.unauthorized'));
                
                return redirect()->route('login');
            } elseif (!($this->guard()->user()->status == UserStatus::ACTIVE)) {
                $this->guard()->logout();
                Toastr::error(__('messages.login.account_locked'));

                return redirect()->route('login');
            } else {
                Toastr::success(__('messages.login.success'));

                return redirect()->intended(RouteServiceProvider::HOME);
            }
        } else {
            Toastr::error(__('messages.login.error'));

            return redirect()->back();
        }
    }

    /**
     * Sign out of account
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        $this->guard()->logout();
        Redirect::setIntendedUrl(url()->previous());
        Toastr::success(__('messages.logout'));
        
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
