<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\DashboardService;

class DashboardController extends Controller
{
    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $countPosts = $this->dashboardService->getCountPosts();
        $countComments = $this->dashboardService->getCountComments();
        $countUsers = $this->dashboardService->getCountUsers();
        $countNewPosts = $this->dashboardService->getNewPosts();
        $posts = $this->dashboardService->listPosts($request);
        $categories = $this->dashboardService->getCategories();
        
        return view('admin.dashboard.index', compact('countPosts', 'countComments', 'countUsers', 'countNewPosts', 'posts', 'categories'));
    }
}
