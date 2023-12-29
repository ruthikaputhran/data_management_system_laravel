<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Mail\WelcomeMailer;
use App\Models\User;

class UserController extends Controller
{
    public function createUser()
    {
        return view('create_user',['isEdit'=> 0,'data'=>[]]);
    }

    public function addUser(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:250',
                'email' => 'required|email|max:250|unique:users',
                'password' => 'required|min:8|confirmed'
            ]);
            if ($validator->fails()) {
                return back()->with('error', ['errorMessage' => $validator->errors()]);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'user_type' => $request->userType,
                'last_name' => $request->last_name,
                'password' => Hash::make($request->password)
            ]);
            $lastInsertId = $user->id;
            $user = User::find($lastInsertId);

            // Assign the role to the user
            if ($request->userType == "user_admin") {
                $user->assignRole('user_admin');
            } else {
                $user->assignRole('sales_team');
            }

            Mail::to('ruthikaputhran@gmail.com')->send(new WelcomeMailer($request->name, $request->email, $request->password));
            return back()->with('message', 'Successffully created the user!');
        } catch (\Exception $e) {
            // Handle the exception
            return back()->with('error', ['errorMessage' => $e->getMessage()]);
        }
    }

    public function viewUser()
    {
        $data = array();

       // $query = User::query();
        $data = User::orderBy('created_at', 'desc')->get();
        //$data = $query->orderBy('created_at', 'desc')->get();

        return view('view_user', ['data' => $data]);
    }

    public function deleteUser($id)
    {
        $record = User::find($id);

        if ($record) {
            $record->delete();
            return redirect()->back()->with('success', 'Record deleted successfully');
        }

        return redirect()->back()->with('error', 'Record not found');
    }

    public function editUser($id) {
        if($id!=null){
            $data = User::where('id',$id)
            ->first(); 

            $dataObj = array(
                'name'=>$data->name,
                'email'=> $data->email,
                'userType' => $data->userType,
                'last_name' => $data->last_name,
                'id'=>$data->id
              );
    
        }
        return view('create_user',['isEdit'=>1, 'data'=>$dataObj]);        
    }

    public function updateUser(Request $request) {
        try {
            $user = User::findOrFail($request->id);

            $request->validate([
                'name' => 'required|string|max:250',
            ]);
    
            $user->name = $request->input('name');
           // $user->email = $request->input('email');
            $user->user_type = $request->input('userType');
            $user->last_name = $request->input('last_name');
          //  $user->password = Hash::make($request->input('password'));
    
            $user->update();
    
            return back()->with('message', 'Successffully updated the user!');
        } catch (ModelNotFoundException $e) {
            return back()->with('error', ['errorMessage' => $e->getMessage()]);
        } catch (ValidationException $e) {
            return back()->with('error', ['errorMessage' => $e->getMessage()]);
        } catch (\Exception $e) {
            return back()->with('error', ['errorMessage' => $e->getMessage()]);
        }
    }
}
