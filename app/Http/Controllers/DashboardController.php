<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function dashboard(){
        $categoryCount = Category::count();
        $productCount = Product::count();
        $userCount = User::count();

        
        $finalArr = array(
            'categoryCount' =>$categoryCount,
            'productCount' =>$productCount,
            'userCount' => $userCount

        );
        return view('dashboardHome')->with(['data' => $finalArr]);
    }
}
