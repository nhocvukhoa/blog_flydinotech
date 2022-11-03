<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\ProfileService;
use App\Http\Requests\User\UpdateProfileRequest;

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
     * @param \App\Services\User\ProfileService $profileService
     */

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Show user profile page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->profileService->getUserProfile();
        $posts = $this->profileService->listPost();
        $postViewed = $this->profileService->postViewed();
       
        return view('user.profile.form.post', compact('user', 'posts', 'postViewed'));
    }

    /**
     * Show user profile infor
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserProfile()
    {
        $user = $this->profileService->getUserProfile();
        $postViewed = $this->profileService->postViewed();

        return view('user.profile.form.edit', compact('user', 'postViewed'));
    }

    /**
     * Update user profile
     *
     * @return \Illuminate\Http\Response
     */
     public function updateUserProfile(UpdateProfileRequest $request) 
     {
        if ($this->profileService->saveUserProfile($request)) {
            return redirect()->back()->with('success', __('messages.user_profile.update_success'));
        }

        return redirect()->back()->with('error', __('messages.user_profile.update_error'));
     }
  
    /**
     * Post user viewed
     *
     * @return \Illuminate\Http\Response
     */
    public function postUserViewed()
    {    
        $user = $this->profileService->getUserProfile();
        $posts = $this->profileService->listPost();
        $postViewed = $this->profileService->postViewed();

        return view('user.profile.form.postViewed', compact('user', 'posts', 'postViewed'));
    }
}
