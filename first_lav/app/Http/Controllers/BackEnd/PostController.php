<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Posts;
use App\Category;
use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name= "List Post";
        if(Auth::user()->type===1 || Auth::user()->hasRole('Editor')){
            $data = Posts::with(['creator'])->orderBy('id','DESC')->get();
            //Lấy theo role editor
        }else{
            $data = Posts::with(['creator'])->where('created_by',Auth::user()->id)->orderBy('id','DESC')->get();
            //Lấy theo created_by == id user
        }
        return view("back-end.post.list",compact('page_name','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name ="Post Create";
        $data_category = Category::where('status',1)->pluck('name','id');
        return view("back-end.post.add",compact("page_name","data_category"));
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
                'title' => 'required',
                'short_description' => 'required',
                'description' => 'required',
                'category_id' => 'required',
                'img' => 'required',
            ]);
        $post = new Posts();
        $post->title = $request->title;
        $post->slug = str_slug($request->title.'-');
        $post->short_description = $request->short_description;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->status = 1;
        $post->type = 'news';
        $post->hot_news = 0;
        $post->view_count = 0;
        $post->main_image = '';
        $post->thumb_image = '';
        $post->list_image = '';
        $post->created_by = Auth::id();//Lấy id user login
        $post->save();
        /*Add images */
        $file = $request->file('img');
        $extension = $file->getClientOriginalExtension(); //Lấy Đuôi File
        $main_image = 'post_main_'.$post->id.'.'.$extension;
        $thumb_image = 'post_thumb_'.$post->id.'.'.$extension;
        $list_image = 'post_list_'.$post->id.'.'.$extension;
        Image::make($file)->resize(653,569)->save(public_path('/upload/post/'.$main_image));
        Image::make($file)->resize(360,309)->save(public_path('/upload/post/'.$thumb_image));
        Image::make($file)->resize(122,122)->save(public_path('/upload/post/'.$list_image));
        $post->main_image = $main_image;
        $post->thumb_image = $thumb_image;
        $post->list_image = $list_image;
        $post->save();
        return redirect()->action('BackEnd\PostController@index')->with('success','Post Created Successfully');
        // End add images
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
        $page_name = "Edit Post";
        $post = Posts::find($id);
        $data_category = Category::where('status','1')->pluck("name","id");
        return view("back-end.post.edit",compact("page_name","post","data_category"));
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
                'title' => 'required',
                'short_description' => 'required',
                'description' => 'required',
                'category_id' => 'required',
                'img' => 'required',
            ]);
        $post = Posts::find($id);

        if($request->file('img')){ // Check post file img
            @unlink(public_path('/upload/post/'.$post->main_image));
            @unlink(public_path('/upload/post/'.$post->thumb_image));
            @unlink(public_path('/upload/post/'.$post->list_image));

            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension(); //Lấy Đuôi File
            $main_image = 'post_main_'.$post->id.'.'.$extension;
            $thumb_image = 'post_thumb_'.$post->id.'.'.$extension;
            $list_image = 'post_list_'.$post->id.'.'.$extension;
            Image::make($file)->resize(653,569)->save(public_path('/upload/post/'.$main_image));
            Image::make($file)->resize(360,309)->save(public_path('/upload/post/'.$thumb_image));
            Image::make($file)->resize(122,122)->save(public_path('/upload/post/'.$list_image));
            $post->main_image = $main_image;
            $post->thumb_image = $thumb_image;
            $post->list_image = $list_image;
        }

        $post->title = $request->title;
        $post->slug = str_slug($request->title.'-');
        $post->short_description = $request->short_description;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->created_by = Auth::id();//Lấy id user login
        $post->save();
        /*Add images */
        
        $post->save();
        return redirect()->action('BackEnd\PostController@index')->with('success','Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Posts::where('id',$id)->delete();
        return redirect()->action("BackEnd\PostController@index")->with("success","Post Deleted Successfully");
    }
    public function status($id)
    {
        $post = Posts::find($id);
        $post->status = ($post->status === 1) ? 0 : 1;   
        $post->save();
        return redirect()->action('BackEnd\PostController@index')->with("success","Post Status Changed Successfully");
    }
    public function hot_news($id)
    {
        $post = Posts::find($id);
        @unlink(public_path('/upload/post/'.$post->main_image));
        @unlink(public_path('/upload/post/'.$post->thumb_image));
        @unlink(public_path('/upload/post/'.$post->list_image));
        $post->hot_news = ($post->hot_news === 1) ? 0 : 1;   
        $post->save();
        return redirect()->action('BackEnd\PostController@index')->with("success","Post as Hot News Changed Successfully");
    }
}
