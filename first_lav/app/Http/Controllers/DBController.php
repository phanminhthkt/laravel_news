<?php

namespace App\Http\Controllers;
use DB;
use App\Employee;

use Illuminate\Http\Request;

class DBController extends Controller
{
    public function index(){
    	// $all = DB::table('employee')->select('name','age')->get();
    	// $all = DB::table('employee')->pluck('name','age');// Result:array('age' => 'name');
    	// $all = DB::table('employee')->select('name','age')->first();
    	$all = DB::table('employee')->orderBy('salary','DESC')->offset(1)->limit(1)->get();
    	//Result: offset(0) 1st maximum salaray, offset(1) 2nd maximum salaray
    	dd($all);
    }
    public function joining(){
    	$result = DB::table('order')
    			->join('user','user.id','=','order.user_id')
    			->select('user.name','order.id','order.amount','order.order_date')
    			->where('order.status',1)
    			->get();
    	dd($result);		
    }
    public function model(){
    	$result = Employee::all();
    	dd($result);		
    }
}
