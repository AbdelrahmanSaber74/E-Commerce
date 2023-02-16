<?php 
namespace App\Repository\Products ;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductSize;

use App\Traits\UploadImageTrait;

class ProductsService implements ProductsServiceInterface{ 

use UploadImageTrait;

public function index () {
    $Products = Product::get();
    return view('dashboard.products.index' , compact('Products')) ;
}

public function create () {
    $categories = Category::get();
    return view('dashboard.products.create' , compact('categories'));
}

public function store(Request $request)
{
    try {

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'category_id' => $request->category_id,
            'discount_price' => $request->discount_price,
        ]);

        $Product_id = Product::latest()->first()->id;


        if($request->has('image')){
            $path =  $this->UploadImageProducts($request ,'image','Images');
            $id = $Product_id;
            $Product = Product::find($id);
            $Product->update([
            'image' => $path,
            ]);
        }



        $colors = $request->colors ;
        foreach ($colors as $color) {
            $Colors = new  ProductColor();
            $Colors->product_id = $Product_id;
            $Colors->color = $color;
            $Colors->save();
        }


        $sizes = $request->sizes ;
        foreach ($sizes as $size) {
            $sizes = new  ProductSize();
            $sizes->product_id = $Product_id;
            $sizes->size = $size;
            $sizes->save();
        }


        if($request->has('images') ){
            $images = $request->images ;

            foreach ($images as $image) {

            $name_image = $image->getClientOriginalName();
            $path = $image->storeAs('Images' , $name_image , 'Products');
            ProductImage::create([
                'product_id' => $Product_id ,
                'image' => $path ,
            ]);
        }
            
        }

        return redirect()->back()->with('success', 'تم اضافة المنتج بنجاح');
        
    }

    
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }



}



?>
