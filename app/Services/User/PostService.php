<?php

namespace App\Services\User;

use App\Enums\CommentStatus;
use App\Models\Post;
use App\Enums\PostStatus;
use App\Enums\UserStatus;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;

class PostService extends BaseService
{
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new post.
     *
     * @param \Illuminate\Http\PostRequest  $request
     * @return boolean
     */
    public function create($request)
    {
        try {
            $this->model->create([
                'user_id' => Auth::guard('user')->id(),
                'category_id' => $request->category,
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'status' => PostStatus::UNACTIVE,
                'image' => $request->file('image')->store('posts', 'public'),
            ]);

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    /**
     * Display a listing of category
     *
     * @return void
     */
    public function getCategories()
    {
        return Category::whereNull('parent_id')->orderBy('title', 'asc')->get();
    }

    /**
     * Display a listing of comment
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function getComments($post)
    {
        return Comment::where([
                ['status', CommentStatus::ACTIVE],
                ['post_id', $post->id]
            ])
            ->orderByDesc('id')
            ->get();
    }

    /**
     * Show a list of specific posts
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function getPosts($post)
    {
        return $this->model->where([
                ['status', PostStatus::ACTIVE],
                ['user_id', $post->user_id]
            ])
            ->get();
    }

    /**
     * Show a list of specific user
     *
     * @return void
     */
    public function getUsers()
    {
        return User::where('status', UserStatus::ACTIVE)->get();
    }

    /**
     * Show a list of specific user's posts
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function getPostUser($post)
    {
        return $this->model->where([
                ['status', PostStatus::ACTIVE],
                ['user_id', $post->user_id]
            ])
            ->whereNotIn('id', [$post->id])
            ->orderByDesc('viewed')
            ->get();
    }

    /**
     * Show a list of specific category's posts
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function getPostCategory($post)
    {
        return $this->model->where([
                ['status', PostStatus::ACTIVE],
                ['category_id', $post->category_id]
            ])
            ->whereNotIn('id', [$post->id])
            ->orderByDesc('id')
            ->get();
    }

    /**
     * Display of latest post
     *
     * @return void
     */
    public function getPostLatest($categoryId)
    {
        return $this->model->activePost()
            ->where('category_id', $categoryId)
            ->orderByDesc('published_at')
            ->take(1)
            ->get();
    }

    /**
     * Display a listing of latest older posts
     *
     * @return void
     */
    public function getPostsOlder($categoryId)
    {
        return $this->model->activePost()
            ->where('category_id', $categoryId)
            ->orderByDesc('published_at')
            ->skip(1)
            ->take(3)
            ->get();
    }

    /**
     * Display a listing of post
     *
     * @return void
     */
    public function getPost($categoryId)
    {
        return $this->model->activePost()
            ->where('category_id', $categoryId)
            ->orderByDesc('published_at')
            ->paginate(12);
    }

    /**
     * Display a listing of most viewed posts
     *
     * @return void
     */
    public function getPostView($categoryId)
    {
        return $this->model->orderByDesc('viewed')
            ->where([
                ['status', PostStatus::ACTIVE],
                ['category_id', $categoryId]
            ])
            ->take(5)
            ->get();
    }

    /**
     * Show list of searched articles
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function searchPost($request)
    {
        return $this->model->where('title', 'like', '%'.$request->keyword.'%')->orderbyDesc('id')->paginate(8);
    }

    /**
     * Upload image
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload($request)
    {
        if ($request->hasFile('upload')) {
            $response = $this->uploadImage($request);
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
            exit;
        }
    }

    /**
     * Fetch post
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function fetchPost($post)
    {
        return $this->model->where('id', $post->id)
            ->with('comment.user.userProfile')
            ->with('comment.replies.user.userProfile')
            ->orderByDesc('id');
    }
}
