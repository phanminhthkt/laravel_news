<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = "List Author";
        $data = User::all();
        // $data = User::where('type',2)->get();
        return view('back-end.author.list',compact('page_name','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name="Create Author";
        $data_roles = Role::pluck('name','id');
        return view('back-end.author.add',compact('page_name','data_roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'roles.*' => 'required',
        ],[
            'name.required' => " Name field is required",
            'email.required' => " Name field is required",
            'email.unique' => " User,Email Already Exist",
            'password.min' => " Password Must Be 6 Characters or More",
        ]); 
        $author = new User();
        $author->name = $request->name;
        $author->email = $request->email;
        $author->type = 2;
        $author->password = Hash::make($request->password);
        $author->save();

        foreach($request->roles as $value){
            $author->attachRole($value);
            // Lấy id author vừa tạo và list id roles lưu vào bảng phụ của 2 bảng
        }
         return redirect()->action('BackEnd\AuthorController@index')->with("success","Author Created Successfully");
    }

   /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_name = "Edit Author";
        $data = User::find($id);
        $data_roles = Role::pluck('name','id');
        $selected_role = DB::table('role_user')->where('role_user.user_id',$id)->pluck('role_id')->toArray();
        return view('back-end.author.edit',compact('page_name','data','data_roles','selected_role'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request,[
         'name' => 'required',
         'email' => 'required|email|unique:users,email,'.$id,//Check email user tồn tại
         'password' => 'required|min:6',
         'roles.*' => 'required',   

        ],[
           'name.required' => "Name field is required",
           'email.email' => "Invalid Email Format ",
           'email.unique' => "User Email Already Exist",
           'password.min' => "Password Must Be 6 Characeters or More",

        ]);
        $author = User::find($id);
        $author->name = $request->name;
        $author->email = $request->email;
        $author->type = 2;
        $author->password = Hash::make($request->password);
        $author->save();
        DB::table('role_user')->where('role_user.user_id',$id)->delete();
        foreach($request->roles as $value){
            $author->attachRole($value);
            // Lấy id author vừa tạo và list id roles lưu vào bảng phụ của 2 bảng
        }
         return redirect()->action('BackEnd\AuthorController@index')->with("success","Author Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id',$id)->delete();
        return redirect()->action('BackEnd\AuthorController@index')->with('success','Author Deleted Successfully');
    }
}
