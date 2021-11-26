<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();
        return $posts;
    }

    public function create(Request $request){
        $request-> validate([
            "title"=>"required",
            "text"=>"required"
        ]);

        Post::create([
            "title"=>$request->input("title"),
            "text"=>$request->input("text"),
        ]);

        $arr = array("status"=>true, "message"=>"Post Created Successfully!","api"=>"");
        return $arr;
    }

    public function show($id){
       $post =  Post::find($id);
       return $post;
    }


    public function update(Request $request,$id){

        $request->validate([
            "title"=>"required",
            "text"=>"required",
        ]);

        Post::find($id)->update([
            "title"=>$request->input('title'),
            "text"=>$request->input('text')
        ]);

        $result = array("status"=>true, "message"=>"Post Updated Successfully","api"=>"");
        return $result;
    }


    public function destroy($id){
        Post::destroy($id);
        $result = array('status'=>true, "message"=>"Post Delete Successfully!", "api"=>"");
        return $result;
    }
}
