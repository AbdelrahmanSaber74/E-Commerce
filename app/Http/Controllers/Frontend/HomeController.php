<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Services\CategoryService;

class HomeController extends Controller
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
        $filters = request()->only(['name', 'category_id', 'min_price', 'max_price']);
        if (!empty($filters)) {
            $products = $this->productService->searchProducts($filters);
        } else {
            $products = $this->productService->getAllProducts(8);
        }
        $categories = $this->categoryService->getAllCategories()['mainCategories'];
        return view('frontend.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        return view('frontend.product_details', compact('product'));
    }
}
