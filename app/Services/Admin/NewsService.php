<?php 

namespace App\Services\Admin;

use App\Models\News;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\NewsStatus;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Services\Admin\BaseService;

class NewsService extends BaseService
{
    /**
     * Create a new model instance.
     *
     * @param News $model
     */
    public function __construct(News $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of news
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function listNews($request)
    {
        $news = $this->model->query();

        if ($request->title) {
            $news->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->status) {
            $news->where('status', $request->status);
        }

        return $news->orderByDesc('created_at')->paginate(config('api.pagination.per_page')); 
    }

    /**
     * Store a newly created resource
     *
     * @param \App\Http\Requests\Admin\News\StoreRequest $request
     * @return boolean
     */
    public function create($request)
    {
        try {
            $data['user_id'] = UserRole::ADMIN;
            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $data['content'] = $request->content;
            $data['status'] = $request->status;
            $data['image'] = $request->file('image')->store('news', 'public');          
            $this->model->create($data);

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }  
    }

    /**
     * Update the specified resource
     *
     * @param \App\Http\Requests\Admin\News\UpdateRequest $request
     * @param \App\Models\News $news
     * @return boolean
     */
    public function update($request, $news)
    {
        try {
            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $data['content'] = $request->content;
            $data['status'] = $request->status;
            $data['updated_at'] = Carbon::now();

            if ($request->hasFile('image') != null) {
                Storage::disk('public')->delete($news->image);
                $data['image'] = $request->file('image')->store('news', 'public');
            } else {
                $data['image'] = $news->image;
            }

            $news->update($data);

            return true;
        } catch(Exception $e) {
            Log::error($e);

            return false;
        }
    }
    
    /**
     * Delete the specified resource in storage.
     *
     * @param \App\Models\News $news
     * @return boolean
     */
    public function delete($news)
    {
        try {
            $news->delete();

            return true;         
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    /**
     * Update the specified resource.
     *
     * @param \App\Models\News $news
     * @return boolean
     */
    public function changeStatus($news) 
    {
        try {
            $news['status'] == NewsStatus::ACTIVE ? $data = ['status' => NewsStatus::NOT_ACTIVE] : $data = ['status' => NewsStatus::ACTIVE];
            $news->update($data);

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }     
    }

    /**
     * Upload image CKEditor.
     *
     * @param \App\Models\News $news
     * @return boolean
     */
    public function uploadImage($request) 
    {
        if ($request->hasFile('upload')) {
            $response = $this->uploadImageCKEditor($request);

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
            exit;
        }
    }
}
