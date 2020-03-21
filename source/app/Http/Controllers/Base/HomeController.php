<?php
namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        return view('dashboard');
    }
}
