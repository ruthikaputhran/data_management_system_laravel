<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{

    public function createProduct() {
      
        $categoryArr = Category::all();
        //$categoryArr = $users->toArray();
        return view('create_product',['category'=>$categoryArr,'isEdit'=>0,'data'=>[]]);

    }

    public function addProduct(Request $request)
    {
        try {
            // Validate the request data if needed
    
        $request->validate([
            'name' => 'required|string|max:250',
            'description' => 'required|max:250|',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        if($request->image!=null){
            try {
                $featuredImageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('storage'), $featuredImageName);

            } catch (\Exception $e) {
                // Log the error or handle it as needed
                return back()
                    ->withErrors(['error' => 'Error uploading the image.'])
                    ->withInput();
            }
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => 'http://127.0.0.1:8000/storage/'.$featuredImageName,
            'price' => $request->price,
            'category_id' => $request->category,

        ]);
   
        return back()->with('message', 'Successffully created the Product!');

    } catch (\Exception $e) {
        // Handle the exception
        return back()->with('error', ['errorMessage' => $e->getMessage()]);
        
    }


    }

    public function viewProduct() {
        $data = Product::orderBy('created_at', 'desc')->get();
        return view('view_product', ['data' => $data]);

    }

    public function deleteProduct($id)
    {
        $record = Product::find($id);

        if ($record) {
            $record->delete();
            return redirect()->back()->with('success', 'Record deleted successfully');
        }

        return redirect()->back()->with('error', 'Record not found');
    }
    public function editProduct($id) {
        $categoryArr = Category::all();

        if($id!=null){
            $data = Product::where('id',$id)
            ->first(); 

            $dataObj = array(
                'name'=>$data->name,
                'description'=> $data->description,
                'price' =>$data->price,
                'id' =>$data->id,

              );
    
        }
        return view('create_product',['category'=>$categoryArr,'isEdit'=>1, 'data'=>$dataObj]);        
    }

    public function updateProduct(Request $request) {
        try {
            $product = Product::findOrFail($request->id);

            $request->validate([
                'name' => 'required|string|max:250',
                'description' => 'required|max:250|',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    
            ]);
    
            if($request->image!=null){
                try {
                    $featuredImageName = time().'.'.$request->image->extension();
                    $request->image->move(public_path('storage'), $featuredImageName);
    
                } catch (\Exception $e) {
                    // Log the error or handle it as needed
                    return back()
                        ->withErrors(['error' => 'Error uploading the image.'])
                        ->withInput();
                }
            }
    
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'image' => 'http://127.0.0.1:8000/storage/'.$featuredImageName,
                'price' => $request->price,
                'category_id' => $request->category,
    
            ]);
    
            return back()->with('message', 'Successffully updated the category!');
   
        } catch (\Exception $e) {
            return back()->with('error', ['errorMessage' => $e->getMessage()]);
        }
    }

}
