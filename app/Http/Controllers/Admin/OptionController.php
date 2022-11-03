<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\OptionService;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\OptionRequest;
use App\Models\Option;

class OptionController extends Controller
{
    public function __construct(OptionService $optionService)
    {
        $this->optionService = $optionService;
    }

    /**
     * Display about us form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aboutUs = $this->optionService->showAbout();
        
        return view('admin.option.about-us', compact('aboutUs'));
    }

    /**
     * Update about us.
     *
     * @param  \App\Http\Requests\Admin\OptionRequest  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(OptionRequest $request, Option $option)
    {
        if($this->optionService->update($request, $option)) {
            return redirect()->back()->with('success', __('messages.about_us.update_success'));
        }

        return redirect()->back()->with('error', __('messages.about_us.update_error'));
    }

     /**
     * Upload image
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request){
        if ($this->optionService->upload($request)) {
            return redirect()->back()->with('success', __('messages.about_us.upload_image_success'));
        }

        return redirect()->back()->with('error', __('messages.about_us.upload_image_fail'));
    }

    /**
     * Display setting form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSetting()
    {
        $setting = $this->optionService->showSetting();
        
        return view('admin.setting.index', compact('setting'));
    }

    /**
     * Update setting.
     *
     * @param  \App\Http\Requests\Admin\OptionRequest  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function updateSetting(OptionRequest $request, Option $option)
    {
        if($this->optionService->updateSetting($request, $option)) {
            return redirect()->back()->with('success', __('messages.setting.update_success'));
        }

        return redirect()->back()->with('error', __('messages.setting.update_error'));
    }
}
