<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Comment;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $page_name = 'List Comment';
        $comment = Comment::with(['post'])->where('post_id',$id)->orderBy('id','DESC')->get();
        return view("back-end.comment.list",compact('page_name','comment','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $page_name = "Create Comment";
        return view('back-end.comment.add',compact('page_name','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function status($id)
    {
        $comment = Comment::find($id);
        $comment->status = ($comment->status === 1) ? 0 : 1;   
        $comment->save();
        return redirect()->action('BackEnd\CommentController@index',['id' => $comment->post_id])->with("success","Comment Status Changed Successfully");
    }
    public function reply($id)
    {
        $page_name = 'Comment Reply';
        return view('back-end.comment.reply',compact('page_name','id'));
    }
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request,[
            'post_id' => 'required',
            'comment' => 'required',
        ]);
        $comment = new Comment();
        $comment->name = Auth::user()->name;
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->status = 0;
        $comment->save();    
        return redirect()->route('CommentList',['id' => $request->post_id] )->with("success","Comment Replied Successfully");
        
    }
}
