<?php 

namespace App\Repository\Categories ;

use App\Models\Category;
use App\Models\MainCategories;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoriesRequest;

class CategoriesService implements CategoriesServiceInterface{

    use UploadImageTrait ;

    public function index()
    {
        $MainCategories = MainCategories::get();
        $Categories = Category::paginate(2);        
        return view('dashboard\categories\index' , compact('MainCategories' , 'Categories'));

    }

    public function Store (StoreCategoriesRequest $request) {

        

        try {

            $validated = $request->validated();

           
           Category::create([
                'name' => $request->name ,
                'parent_id' => $request->parent_id , 
            ]);


            // Upload Photo And Insert In Table
            if($request->has('photo')){
                $path =  $this->UploadImageCategories($request ,'photo','Images');
                $Category_id = Category::latest()->first()->id;
                $Category = Category::find($Category_id);
                $Category->update([
                'image' => $path,
                ]);
            }
        
        
            return redirect()->back()->with('success', 'تم اضافة القسم بنجاح');

        }

            catch (\Exception $e){
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }


        }       
        
    

        public function Update (StoreCategoriesRequest $request) {
            try {
    
                $validated = $request->validated();
                $Category = Category::find($request->id);

                $Category->update([
                    'name' => $request->name ,
                    'parent_id' => $request->parent_id , 

                ]);
               
    
                // Upload Photo And Update In Table
                if($request->has('photo')){
                   $path =  $this->UploadImageCategories($request ,'photo','Images');
                    $Category->update([
                    'image' => $path,
                    ]);
                }
            
            
                return redirect()->back()->with('success', 'تم تعديل القسم بنجاح');
    
            }
    
                catch (\Exception $e){
                    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
                }
    
    
            }       
            
                
        public function destroy(Request $request)
        {
            Category::find($request->id)->delete();
            return redirect()->back()->with('success', 'تم حذف القسم بنجاح');
        }

          
        
}


