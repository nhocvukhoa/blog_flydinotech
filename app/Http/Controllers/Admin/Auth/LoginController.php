<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;
    
    public function __construct()
    {
        $this->middleware('guest:admin')->except(['logout', 'login']);
    }

    protected function guard()
    {
        return Auth::guard('admin'); 
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(UserRequest $request)  
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', __('messages.login.email_not_exist'));
        } 

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', __('messages.login.password_wrong'));
        }

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) { 
            return redirect('/admin/dashboard')->with('success', __('messages.login.success'));
        } else {
            return redirect()->back()->with('error', __('messages.login.error'));  
        } 
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login_page');
    }
}
