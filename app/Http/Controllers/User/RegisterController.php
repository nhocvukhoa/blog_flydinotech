<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Services\User\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    /**
     * The service implementation.
     *
     * @var RegisterService
     */
    protected $registerService;

    /**
     * Create a new service instance.
     *
     * @param \App\Services\User\RegisterService $registerService
     */
    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    /**
     * Show registration form
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\User\RegisterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $params, $language)
    {
        Session::put('website_language', $language);

        $validator = Validator::make($params->all(), 
        [
            'first_name' => 'required|max:50',
            'email' => 'required|email|unique:users|min:10|max:255',
            'password' => 'required|min:5|max:50',
            'confirm_password' => 'required|same:password',
            'agree_terms' => 'required'
        ], 
        [
            'first_name.required' => 'Nhập tên của bạn',
            'email.required' => 'Nhập địa chỉ email của bạn',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'email.unique' => 'Email này đã tồn tại',
            'password.required' => 'Nhập mật khẩu',
            'password.min' => 'Mật khẩu có ít nhất 5 ký tự',
            'confirm_password.required' => 'Nhập lại mật khẩu',
            'confirm_password.same' => 'Mật khẩu nhập lại không đúng',
            'agree_terms.required' => 'Hãy đồng ý với các điều khoản dịch vụ của chúng tôi'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $this->registerService->save($params);
            
            return response()->json([
                'status' => 200, 
                'message' => __('messages.register.success')
            ]);
        }
    }
}
