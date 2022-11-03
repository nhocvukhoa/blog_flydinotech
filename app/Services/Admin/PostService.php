<?php

namespace App\Services\Admin;

use App\Enums\CategoryStatus;
use App\Enums\PostStatus;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostService
{
    /**
     * Create a new model instance.
     *
     * @param Post $model
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of post
     *
     * @param \Illuminate\Http\Request  $request
     * @return void
     */
    public function getPosts($request)
    {
        $post = $this->model->query();
        $limit = config('api.pagination.per_page');

        if ($request->title) {
            $post->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->user) {
            $post->whereHas('user', function ($query) use ($request) {
                $query->whereHas('userProfile', function ($query) use ($request) {
                    $query->where('first_name', 'like', '%' . $request->user . '%')
                        ->orWhere('last_name', 'like', '%' . $request->user . '%')
                        ->orWhereRaw("concat(first_name, ' ', last_name) like '%" . $request->user . "%'");
                });
            });
        }

        if ($request->category) {
            $post->where('category_id', $request->category);
        }

        if ($request->createDate) {
            $post->whereDate('created_at', Carbon::parse($request->createDate)->format('Y-m-d'));
        }

        if ($request->status) {
            $post->where('status', $request->status);
        }

        return $post->orderByDesc('id')->paginate($limit);
    }

    /**
     * Display a listing of category
     *
     * @return void
     */
    public function getCategories()
    {
        return Category::where('status', CategoryStatus::ACTIVE)->pluck('title', 'id');
    }

    /**
     * Store a newly created resource
     *
     * @param \App\Http\Requests\Admin\Post\AddPostRequest $request
     * @return boolean
     */
    public function create($request)
    {
        try {
            $post['user_id'] = Auth::guard('admin')->user()->id;
            $post['category_id'] = $request->category_id;
            $post['title'] = $request->title;
            $post['description'] = $request->description;
            $post['content'] = $request->content;
            $post['status'] = $request->status;
            $post['image'] = $request->file('image')->store('posts', 'public');
            $post['published_at'] = Carbon::now();

            $this->model->create($post);

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    /**
     * Update the specified resource
     *
     * @param \App\Models\Post $post
     * @return boolean
     */
    public function changeStatus($post)
    {
        try {
            $post['status'] == PostStatus::ACTIVE ? $data = ['status' => PostStatus::UNACTIVE] : $data = ['status' => PostStatus::ACTIVE];
            $post['published_at'] = Carbon::now();
            $post->update($data);

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    /**
     * Update the specified resource
     *
     * @param \App\Http\Requests\Admin\Post\UpdatePostRequest $request
     * @param \App\Models\Post $post
     * @return boolean
     */
    public function update($request, $post)
    {
        try {
            $data['category_id'] = $request->category_id;
            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $data['content'] = $request->content;
            $data['status'] = $request->status;

            if ($request->hasFile('image') != null) {
                Storage::disk('public')->delete($post->image);
                $data['image'] = $request->file('image')->store('posts', 'public');
            } else {
                $data['image'] = $post->image;
            }

            $post->update($data);

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param \App\Models\Post $post
     * @return boolean
     */
    public function delete($post)
    {
        try {
            $post->delete();

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    public function upload($request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;      
            $request->file('upload')->storeAs('public/posts', $fileName);;
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/posts/'. $fileName);        
            $msg = 'Uploaded image success';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
            exit;
        }
    }
}
