<?php 
namespace App\Repository\Products ;
use Illuminate\Http\Request;

interface ProductsServiceInterface {


public function index();
public function create();
public function store(Request $request);

}
?>
