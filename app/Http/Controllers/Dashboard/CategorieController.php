<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoriesRequest;
use App\Models\Category;
use App\Models\MainCategories;
use App\Repository\CategoryRepository;
use Illuminate\Http\Request;
use DataTables ;
use App\Traits\UploadImageTrait;
use App\Repository\Categories\CategoriesService;
use App\Repository\Categories\CategoriesServiceInterface;

class CategorieController extends Controller
{

    private $CategoriesService ;
    public function __construct(CategoriesServiceInterface $CategoriesService)
    {
        $this->CategoriesService = $CategoriesService ;
        
    }

    public function index()
    {
        
        return $this->CategoriesService->index();

    }

    public function getCategories()
    {

    }

    

    public function create()
    {
        //
    }


    public function store(StoreCategoriesRequest $request)
    {
        return $this->CategoriesService->Store($request);
    }

   
    public function show($id)
    {
        //
    }

 
    public function edit($id)
    {
        //
    }

  
    public function update(StoreCategoriesRequest $request, $id)
    {
         return $this->CategoriesService->Update($request);
    }


    public function destroy(Request $request)
    {
        return $this->CategoriesService->destroy($request);
    }
}
