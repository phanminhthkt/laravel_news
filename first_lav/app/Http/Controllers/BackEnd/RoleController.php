<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Role;
use DB;
use App\Permission;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = "Roles";
        $data = Role::all();
        return view('back-end.role.list',compact('page_name','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = "Create Role";
        $data_permission = Permission::pluck('name','id');
        return view('back-end.role.add',compact('page_name','data_permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,
            [
                'name' => 'required',
                'permission' => 'required|array',
                'permission.*' => 'required|string'
            ],
            [
                'name.required' => 'Name Field is Required',
                'permission.required' => 'You must select Permissions',
                'permission.*' => 'Permission is a Array',
            ]
        );
        $role = new Role();
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();
        foreach($request->permission as $v){
            $role->attachPermission($v); // Lấy id roles vừa tạo và list id permission lưu vào bảng phụ của 2 bảng
        }
        return redirect()->action('BackEnd\RoleController@index')->with("success","Role Created Successfully");
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
        $page_name = "Edit Role";
        $role = Role::find($id);
        $data_permission = Permission::pluck('name','id');
        $selected_permission = DB::table('permission_role')->where('permission_role.role_id',$id)->pluck('permission_id')->toArray();
        return view("back-end.role.edit",compact('page_name','data_permission','role','selected_permission'));
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
        //
        $this->validate($request,
            [
                'name' => 'required',
                'permission' => 'required|array',
                'permission.*' => 'required|string'
            ],
            [
                'name.required' => 'Name Field is Required',
                'permission.required' => 'You must select Permissions',
                'permission.*' => 'Permission is a Array',
            ]
        );
        $role = Role::find($id);
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();
        DB::table('permission_role')->where('role_id',$id)->delete();
        foreach($request->permission as $value){
            $role->attachPermission($value);
        }
        return redirect()->action('BackEnd\RoleController@index')->with('success','Role Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::where('id',$id)->delete();
        return redirect()->action('BackEnd\RoleController@index')->with('success','Role Deleted Successfully');
    }
}
