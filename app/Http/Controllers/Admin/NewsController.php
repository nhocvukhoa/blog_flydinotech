<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\NewsService;
use App\Models\News;
use App\Http\Requests\Admin\News\StoreRequest;
use App\Http\Requests\Admin\News\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    protected $newsService;

    /**
     * Create a new service instance.
     *
     * @param  NewsService  $newsService
     * @return void
     */
    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $news = $this->newsService->listNews($request);

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a news.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\News\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $params)
    {
        $validator = Validator::make(
            $params->all(),
            [
                'title' => 'required|max:255',
                'description' => 'required',
                'content' => 'required',
                'image' => 'required|image',
                'status' => 'required'
            ],
            [
                'title.required' =>  'Please enter title',
                'title.max' => 'Please enter 255 characters or less for the title',
                'description.required' =>  'Please enter description',
                'content.required' =>  'Please enter content',
                'image.required' =>  'Please choose an image',
                'image.image' => 'File is not an image',
                'status.required' =>  'Please choose status',
            ]
        );
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $this->newsService->create($params);

            return response()->json([
                'status' => 200,
                'message' => "Create news success"
            ]);
        }
    }

    /**
     * Change status the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(News $new)
    {
        if ($this->newsService->changeStatus($new)) {
            return redirect()->route('admin.news.index')->with('success', __('messages.news.change_status_success'));
        }

        return redirect()->route('admin.news.index')->with('error', __('messages.news.change_status_fail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\News\UpdateRequest  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, News $news)
    {
        if ($this->newsService->update($request, $news)) {
            return redirect()->back()->with('success', __('messages.news.update_success'));
        }

        return redirect()->back()->with('error', __('messages.news.update_fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        if ($this->newsService->delete($news)) {
            return redirect()->route('admin.news.index')->with('success', __('messages.news.delete_success'));
        }

        return redirect()->route('admin.news.index')->with('error', __('messages.news.delete_fail'));
    }

    /**
     * Upload image CKEditor.
     *
     * @param \App\Models\News $news
     */
    public function upload(Request $request) 
    {
        if ($this->newsService->uploadImage($request)) {
            return redirect()->back()->with('success', __('messages.news.upload_image_success'));
        }

        return redirect()->back()->with('error', __('messages.news.upload_image_fail'));
    }
}
