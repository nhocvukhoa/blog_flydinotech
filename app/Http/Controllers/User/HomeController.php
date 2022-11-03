<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * Show user dashboard
     *
     * @return void
     */
    public function index(Request $request)
    {
        $lastedPosts = $this->homeService->getLastedPost();
        $nextPosts = $this->homeService->getNextPost();
        $twoNextPosts = $this->homeService->getTwoNextPost();
        $newPosts = $this->homeService->listNewPost();
        $getParentCategories = $this->homeService->getParentCategory();
        
        return view('user.dashboard.index', compact('lastedPosts', 'nextPosts', 'twoNextPosts', 'newPosts', 'getParentCategories'));
    }
}
