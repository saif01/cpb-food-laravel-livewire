<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForntendController extends Controller
{
    public function Index(){

        $productData = '';
        $postData = '';
        $slider = '';

        return view('user.food.index', compact('productData', 'postData', 'slider'));
    }
}
