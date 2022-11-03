<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\AddCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\Admin\CategoryService;

class CategoryController extends Controller
{
    /**
     * The category service implementation.
     *
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * Create a new service instance.
     *
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listCategories = $this->categoryService->getCategories($request);
        $categories = $this->categoryService->listCategory();

        return view('admin.categories.index', compact('listCategories', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Admin\Category\AddCategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddCategoryRequest $request)
    {
        if ($this->categoryService->create($request)) {
            return redirect()->back()->with('success', __('messages.category.create_success'));
        }

        return redirect()->back()->with('error', __('messages.category.create_fail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = $this->categoryService->listCategory();
        $categoriesOrderBy = $this->categoryService->listCategoryOrderBy();

        return view('admin.categories.form.edit', compact('category', 'categories', 'categoriesOrderBy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Admin\Category\UpdateCategoryRequest $request
     * @param \App\Models\Category $category
     * @return void
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if ($this->categoryService->update($request, $category)) {
            return redirect()->back()->with('success', __('messages.category.update_success'));
        }

        return redirect()->back()->with('error', __('messages.category.update_fail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Category $category)
    {
        if ($this->categoryService->changeStatus($category)) {
            return redirect()->back()->with('success', __('messages.category.change_status_success'));
        }

        return redirect()->back()->with('error', __('messages.category.change_status_fail'));
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (count($category->children) > 0 || count($category->post) > 0) {
            return redirect()->back()->with('error', __('messages.category.delete_parent_fail'));
        } else {
            if ($this->categoryService->delete($category)) {
                return redirect()->back()->with('success', __('messages.category.delete_success'));
            }
    
            return redirect()->back()->with('error', __('messages.category.delete_fail'));
        }
    }
}
