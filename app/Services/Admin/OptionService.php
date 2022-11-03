<?php

namespace App\Services\Admin;

use App\Enums\OptionType;
use App\Models\Option;
use Exception;
use Illuminate\Support\Facades\Log;

class OptionService extends BaseService
{
    public function __construct(Option $model)
    {
        $this->model = $model;
    }

    /**
     * Display about us.
     *
     * @param Option $model
     * @return $model
     */
    public function showAbout()
    {
        return $this->model->where('type', OptionType::ABOUT_US)->first();
    }

    /**
     * Update the specified resource
     *
     * @param \App\Http\Requests\Admin\Post\OptionRequest $request
     * @param \App\Models\Option $option
     * @return boolean
     */
    public function update($request, $option)
    {
        try {
            $data['title'] = $request->title;
            $data['content'] = $request->content;
            $data['status'] = $request->status;

            $option->update($data);

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    /**
     * Upload file image
     *
     * @param \App\Models\Option $option
     * @return boolean
     */
    public function upload($request)
    {
        if ($request->hasFile('upload')) {
            $response = $this->uploadImageCKEditor($request);
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
            exit;
        }
    }

    /**
     * Display setting.
     *
     * @param Option $model
     * @return $model
     */
    public function showSetting()
    {
       return $this->model->where('type', OptionType::SETTING)->first();  
    }

     /**
     * Update setting
     *
     * @param \App\Http\Requests\Admin\Post\OptionRequest $request
     * @param \App\Models\Option $option
     * @return boolean
     */
    public function updateSetting($request, $option)
    {
        try {
            $data['title'] = $request->title;
            $data['content'] = $request->content;
            $data['status'] = $request->status;

            $option->update($data);

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }
}
