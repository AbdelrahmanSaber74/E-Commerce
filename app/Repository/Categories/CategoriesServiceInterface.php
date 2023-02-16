<?php 

namespace App\Repository\Categories ;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoriesRequest;



interface CategoriesServiceInterface {

    public function index ();

    public function Store (StoreCategoriesRequest $request);

    public function destroy(Request $request);

    public function Update (StoreCategoriesRequest $request);


}


