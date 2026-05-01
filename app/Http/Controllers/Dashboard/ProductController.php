<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Services\ProductService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts(10);
        return view('dashboard.products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAllCategories()['mainCategories'];
        return view('dashboard.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $productDTO = ProductDTO::fromRequest(
                $request->validated(), 
                $request->file('image')
            );

            $this->productService->storeProduct($productDTO);

            return redirect()->route('Products.index')->with('success', __('admin.product_added'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(int|string $id)
    {
        $product = $this->productService->getProductById($id);
        $categories = $this->categoryService->getAllCategories()['mainCategories'];
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    public function update(StoreProductRequest $request, int|string $id)
    {
        try {
            $productDTO = ProductDTO::fromRequest(
                $request->validated(), 
                $request->file('image')
            );

            $this->productService->updateProduct($id, $productDTO);

            return redirect()->route('Products.index')->with('success', __('admin.product_updated'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->productService->deleteProduct($id);
            return redirect()->back()->with('success', __('admin.product_deleted'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
