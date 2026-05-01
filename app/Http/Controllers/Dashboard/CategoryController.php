<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoriesRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $data = $this->categoryService->getAllCategories(10);
        return view('dashboard.categories.index', [
            'categories' => $data['categories'],
            'mainCategories' => $data['mainCategories']
        ]);
    }

    public function store(StoreCategoriesRequest $request)
    {
        try {
            $categoryDTO = CategoryDTO::fromRequest(
                $request->validated(), 
                $request->file('image')
            );
            
            $this->categoryService->storeCategory($categoryDTO);
            return redirect()->back()->with('success', __('admin.category_added'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(StoreCategoriesRequest $request, int|string $id)
    {
        try {
            $categoryDTO = CategoryDTO::fromRequest(
                $request->validated(), 
                $request->file('image')
            );

            $this->categoryService->updateCategory($id, $categoryDTO);
            return redirect()->back()->with('success', __('admin.category_updated'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $this->categoryService->deleteCategory((int)$request->id);
            return redirect()->back()->with('success', __('admin.category_deleted'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
