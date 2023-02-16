<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Products\StoreProductRequest;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Repositorties\CategoryRepository;
use App\Repositorties\ProductRepository;
use App\Repository\Products\ProductsServiceInterface;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;

class ProductController extends Controller
{
    public $Product ;

    public function __construct(ProductsServiceInterface $Product)
    {
        $this->Product = $Product;
    }

    public function index()
    {
        return $this->Product->index();
    }

    public function getall(Request $request)
    {
    //    return $this->productService->datatable();
    }

    
    public function create()
    {
        return $this->Product->create() ;
    }

   
    public function store(Request $request)
    {

       return $this->Product->store($request) ;
     }


    


   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
    //     $categories = $this->categoryService->getAll();
    //     $product = $this->productService->getById($id);
    //    return view('dashboard.products.edit' , compact('categories', 'product'));
    }

   
    public function update(Request $request, $id)
    {
    //    $this->productService->update($id,$request->all());
    //    return redirect()->route('dashboard.products.index');
    }

    
    public function destroy($id)
    {
        //
    }


} 

