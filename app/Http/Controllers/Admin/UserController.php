<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\AddUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Services\Admin\UserService;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->userService->listUsers($request);

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {   
        return view('admin.user.edit', compact('user'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\AddUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        if($this->userService->saveUser($request)) {
            return redirect()->route('admin.user.index')->with('success', __('messages.user.store_success'));
        }

        return redirect()->back()->with('error', __('messages.user.store_error'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if($this->userService->update($request, $user)) {
            return redirect()->route('admin.user.index')->with('success', __('messages.user.update_success'));
        }

        return redirect()->back()->with('error', __('messages.user.update_error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($this->userService->delete($user)) {
            return redirect()->back()->with('success', __('messages.user.delete_success'));
        }

        return redirect()->back()->with('error', __('messages.user.delete_error'));
    }

    /**
     * Block the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function blockUser(User $user)
    {
        if($this->userService->blockUser($user)) {
            return redirect()->back()->with('success', __('messages.user.block_success'));
        }

        return redirect()->back()->with('error', __('messages.user.block_error'));
    }
}
