<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;

class CategoryController extends Controller
{
    public function createCategory()
    {


        return view('create_category',['isEdit'=>0, 'data'=>[]]);
    }

    public function addCategory(Request $request)
    {
        try {
            // Validate the request data if needed

            $request->validate([
                'name' => 'required|string|max:250',
                'description' => 'required|max:250|',

            ]);

             Category::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return back()->with('message', 'Successffully created the category!');
        } catch (\Exception $e) {
            // Handle the exception
            return back()->with('error', ['errorMessage' => $e->getMessage()]);
        }
    }


    public function viewCategory()
    {
        $data = array();

        $query = Category::query();
        $data = $query->orderBy('created_at', 'asc')->get();

        return view('view_category', ['data' => $data]);
    }

    public function deleteCategory($id)
    {
        $record = Category::find($id);

        if ($record) {
            $record->delete();
            return redirect()->back()->with('success', 'Record deleted successfully');
        }

        return redirect()->back()->with('error', 'Record not found');
    }

    public function editCategory($id) {
        if($id!=null){
            $data = Category::where('id',$id)
            ->first(); 

            $dataObj = array(
                'name'=>$data->name,
                'description'=> $data->description,
                'id' =>$data->id,
              );
    
        }
        return view('create_category',['isEdit'=>1, 'data'=>$dataObj]);        
    }

    public function updateCategory(Request $request) {
        try {
            $category = Category::findOrFail($request->id);

            $request->validate([
                'name' => 'required|string|max:250',
            ]);
    
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            $category->update();
    
            return back()->with('message', 'Successffully updated the category!');
   
        } catch (\Exception $e) {
            return back()->with('error', ['errorMessage' => $e->getMessage()]);
        }
    }

}
