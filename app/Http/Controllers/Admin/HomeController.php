<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    //Admin Dashboard
    public function Dashboard(){
        return view('admin.food.index');
    }



}
