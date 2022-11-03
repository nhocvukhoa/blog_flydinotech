<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Services\Admin\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * The service implementation.
     *
     * @var ProfileService
     */
    protected $profileService;

    /**
     * Create a new service instance.
     *
     * @param \App\Services\Admin\ProfileService $profileService
     */
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Show info admin
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infoAdmin = $this->profileService->getAdmin();

        return view('admin.profile.index', compact('infoAdmin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $params)
    {
        if (Auth::guard('admin')->user()->id) {
            $id = Auth::guard('admin')->user()->id;
        }

        $validator = Validator::make($params->all(), 
        [
            'avatar' => 'file|mimes:jpeg,png,psd',
            'email' => "required|unique:users,email,{$id},id|email|min:10|max:255",
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'address' => 'required|max:100',
            'phone' => 'required|digits:10',
            'gender' => 'required',
            'province' => 'required|max:50',
        ], 
        [
            'avatar.file' => 'Please choose image file',
            'avatar.mimes' => 'Please choose image (jpeg, png, psd)',
            'address.required' => 'Please enter address',
            'email.required' => 'Please enter email',
            'email.email' => 'Invalid email',
            'email.unique' => 'This email already exists',
            'email.min' => 'Email with at least 10 characters',
            'first_name.required' => 'Please enter first name',
            'last_name.required' => 'Please enter last name',    
            'phone.required' => 'Please enter phone',
            'phone.digits' => 'Please enter a 10-digit phone number',
            'gender.required' => 'Please choose your gender',
            'province.required' => 'Please enter content',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $this->profileService->update($params);

            return response()->json([
                'status' => 200, 
                'message' => __('messages.user.update_success')
            ]);
        }
    }
}
