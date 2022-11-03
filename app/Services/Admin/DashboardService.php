<?php

namespace App\Services\Admin;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Enums\UserRole;
use Carbon\Carbon;
use Exception;
use App\Models\Category;

class DashboardService
{
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    /**
     * Count the number of posts.
     *
     * @param App\Models\Post
     * @return count
     */
    public function getCountPosts()
    {
        try {   
            return $this->model->count();;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    /**
     * Count the number of comments.
     *
     * @param App\Models\Comment
     * @return count
     */
    public function getCountComments()
    {
        try {
            return Comment::count();
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    /**
     * Count the number of users.
     *
     * @param App\Models\User
     * @return count
     */
    public function getCountUsers()
    {
        try {
            return User::where('role', '=', UserRole::USER)->count();
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    /**
     * Count the number of new posts.
     *
     * @param App\Models\Post
     * @return count
     */
    public function getNewPosts()
    {
        try {
            $today = Carbon::now()->toDateString();

            return $this->model->where('created_at', 'like', '%' . $today . '%')->count();
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    /**
     * Display a listing of posts.
     *
     * @param \Illuminate\Http\Request $request
     * @return model
     */
    public function listPosts($request)
    {
        $posts = $this->model->query();

        if ($request->titlePost) {
            $posts->where('title', 'like', '%' . $request->titlePost . '%');
        }
    
        if ($request->selectCategory) {
            $posts->where('category_id', $request->selectCategory);
        }
    
        if ($request->fromDate) {
            $posts->whereDate('created_at', '>=', Carbon::parse($request->fromDate)->format('Y-m-d'));
        }
    
        if ($request->toDate) {
            $posts->whereDate('created_at', '<=', Carbon::parse($request->toDate)->format('Y-m-d'));
        }
    
        return $posts->orderByDesc('created_at')->paginate(config('api.pagination.per_page'));
    }

    /**
     * Display a listing of category
     *
     * @return void
     */
    public function getCategories()
    {
        return Category::activeCategory()->whereNull('parent_id')->orderby('order_by', 'asc')->get();
    }
}
