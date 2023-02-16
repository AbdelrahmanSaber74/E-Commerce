<?php

namespace App\Traits ;
use Illuminate\Http\Request;

trait UploadImageTrait {



public function UploadImageSetting(Request $request ,  $nameInput , $foldername )
{
    $image = $request->file($nameInput)->getClientOriginalName();
    $path = $request->file($nameInput)->storeAs($foldername , $image  , 'dashboardSetting') ;
    return $path ;
}

public function UploadImageCategories(Request $request ,  $nameInput , $foldername )
{
    $image = $request->file($nameInput)->getClientOriginalName();
    $path = $request->file($nameInput)->storeAs($foldername , $image  , 'Categories') ;
    return $path ;
}

public function UploadImageProducts(Request $request ,  $nameInput , $foldername )
{
    $image = $request->file($nameInput)->getClientOriginalName();
    $path = $request->file($nameInput)->storeAs($foldername , $image  , 'Products') ;
    return $path ;
}






}


?>
