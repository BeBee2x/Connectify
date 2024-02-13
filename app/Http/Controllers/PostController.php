<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //home
    public function homePage(){
        $posts = Post::leftJoin("users","posts.user_id","users.id")
        ->select("posts.*","users.name as user_name")
        ->orderBy("posts.id","desc")
        ->get();
        $comments = Comment::get();
        return view("Home.home",compact("posts","comments"));
    }

    //upload
    public function upload(Request $request){
        $this->checkData($request);
        $data = $this->uploadDataToArray($request);
        Post::create($data);
        return back()->with(['create_status'=> 'Your post has been uploaded!']);
    }

    //details page
    public function postDetails($id){
        $post = Post::where("posts.id",$id)
        ->leftJoin("users","posts.user_id","users.id")
        ->select("posts.*","users.name as user_name")
        ->first();
        $comments = Comment::where("post_id",$id)
        ->leftJoin("users","comments.user_id","users.id")
        ->select("comments.*","users.name as user_name")
        ->orderBy("comments.id","desc")
        ->get();
        return view("Home.post_details",compact("post",'comments'));
    }

    //post edit page
    public function editPost($id){
        $post = Post::where("posts.id",$id)
        ->leftJoin("users","posts.user_id","users.id")
        ->select("posts.*","users.name as user_name")
        ->first();
        return view("Home.edit_post",compact("post"));
    }

    //update post
    public function updatePost(Request $request){
        $this->checkData($request);
        $data = $this->updateDataToArray($request);
        Post::where("id",$request->post_id)->update($data);
        return redirect()->route("Auth-HomePage")->with(["update_status"=>"Your post has been updated!"]);
    }

    //delete post
    public function deletePost($id){
        Post::where("id",$id)->delete();
        return redirect()->route("Auth-HomePage")->with(["delete_status"=> "Your post has been deleted!"]);
    }

    //change updata to array
    private function updateDataToArray($request){
        return [
            'title' => $request->title,
            'description' => $request->description
        ];
    }

    //upload data validation
    private function checkData($request){
        Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
        ])->validate();
    }

    //change upload data to array
    private function uploadDataToArray($request){

        return [
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description'=> $request->description
        ];

    }
}
