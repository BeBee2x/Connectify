<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    //upload
    public function uploadComment(Request $request){
        $this->checkData($request);
        $data = $this->uploadCommentToArray($request);
        Comment::create($data);
        return back();
    }

    //edit comment
    public function editComment($id){
        $comment = Comment::where("comments.id",$id)
        ->leftJoin("users","comments.user_id","users.id")
        ->select("comments.*","users.name as user_name")
        ->first();
        return view("Home.edit_comment",compact("comment"));
    }

    //update comment
    public function updateComment(Request $request){
        $this->checkData($request);
        $data = $this->updateCommentToArray($request);
        Comment::where("id",$request->comment_id)->update($data);
        return redirect()->route("Post-Details",$request->post_id);
    }

    //delete comment
    public function deleteComment($id){
        Comment::where("id",$id)->delete();
        return back();
    }

    //change update comment to array
    private function updateCommentToArray(Request $request){
        return [
            'text' => $request->comment
        ];
    }

    //change upload comment to array
    private function uploadCommentToArray(Request $request){
        return [
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
            'text' => $request->comment
        ];
    }

    //comment validation
    private function checkData($request){
        Validator::make($request->all(),[
            'comment' => 'required',
        ])->validate();
    }
}
