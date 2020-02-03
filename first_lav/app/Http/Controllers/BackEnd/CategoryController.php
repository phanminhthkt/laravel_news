<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
    	return view('back-end.category.list');
    }

    public function create(){
    	return view('back-end.category.add');
    }

    public function edit(){
    	return view('back-end.category.edit');
    }
}
