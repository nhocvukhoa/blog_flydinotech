<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordWhenForgotRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Services\User\ForgotPasswordService;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class ForgotPasswordController extends Controller
{
    /**
     * The forgot password service implementation.
     *
     * @var [type]
     */
    protected $forgotPasswordService;

    /**
     * Create a new service instance.
     *
     * @param ForgotPasswordService $forgotPasswordService
     */
    public function __construct(ForgotPasswordService $forgotPasswordService)
    {
        $this->forgotPasswordService = $forgotPasswordService;
    }

    /**
     * Show forgot password form
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.auth.ForgotPassword.forgotPassword');
    }

    /**
     * Find email user from forgot password form and send new password to user
     *
     * @param \App\Http\Requests\Auth\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function findEmail(ForgotPasswordRequest $request, $language)
    {
        Session::put('website_language', $language);

        if ($this->forgotPasswordService->findEmail($request)) {
            $this->forgotPasswordService->sendEmail($request);
            Toastr::success(__('messages.forgot_password.send_mail_success'));

            return redirect()->back();
        }

        Toastr::error(__('messages.forgot_password.email_not_found'));

        return redirect()->back();
    }

    /**
     * Show change password form
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $email = $request->email;
        return view('user.auth.ForgotPassword.changeNewPassword', compact('email'));
    }

    /**
     * Change new password for your account
     *
     * @param \App\Http\Requests\Auth\ChangePasswordWhenForgotRequest $request
     * @return \Illuminate\Http\Response
     */
    public function saveNewPassword(ChangePasswordWhenForgotRequest $request, $language)
    {
        Session::put('website_language', $language);
        $user = $this->forgotPasswordService->findEmail($request);
        
        if ($this->forgotPasswordService->updatePassword($request, $user)) {
            Toastr::success(__('messages.forgot_password.change_password_success'));
            
            return redirect()->route('login');
        }

        Toastr::error(__('messages.forgot_password.change_password_fail'));
        
        return redirect()->back();
    }
}
