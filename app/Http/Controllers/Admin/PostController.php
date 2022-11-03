<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\AddPostRequest;
use App\Http\Requests\Admin\Post\UpdatePostRequest;
use App\Models\Post;
use App\Services\Admin\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * The post service implementation.
     *
     * @var PostService
     */
    protected $postService;

    /**
     * Create a new service instance.
     *
     * @param  PostService  $postService
     * @return void
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = $this->postService->getPosts($request);
        $categories = $this->postService->getCategories();

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->postService->getCategories();

        return view('admin.posts.form.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Admin\Post\AddPostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $params)
    {
        $validator = Validator::make($params->all(), 
        [
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'required',
            'image' =>  'required|file|mimes:jpeg,png,psd'
        ], 
        [
            'title.required' => 'Please enter title',
            'description.required' => 'Please enter description',
            'content.required' => 'Please enter content',
            'image.required' => 'Please choose image',
            'image.file' => 'Please choose image file',
            'image.mimes' => 'Please choose image (jpeg, png, psd)'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $this->postService->create($params);
            
            return response()->json([
                'status' => 200, 
                'message' => __('messages.post.create_success')
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = $this->postService->getCategories();

        return view('admin.posts.form.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Admin\Post\UpdatePostRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if ($this->postService->update($request, $post)) {
            return redirect()->back()->with('success', __('messages.post.update_post'));
        }

        return redirect()->back()->with('error', __('messages.post.update_fail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Post $post)
    {
        if ($this->postService->changeStatus($post)) {
            return redirect()->back()->with('success', __('messages.post.change_status_success'));
        }

        return redirect()->back()->with('error', __('messages.post.change_status_fail'));
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($this->postService->delete($post)) {
            return redirect()->back()->with('success', __('messages.post.delete_success'));
        }

        return redirect()->back()->with('error', __('messages.post.delete_fail'));
    }

     /**
     * Upload image
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request){
        if ($this->postService->upload($request)) {
            return redirect()->back()->with('success', __('messages.post.upload_image_success'));
        }

        return redirect()->back()->with('error', __('messages.post.upload_image_fail'));
    }
}
