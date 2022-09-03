<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;
// admin editor , user rolüne sahip kullanıcılar

class UserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('users.home');
    }

    public function yorumsil($id)
    {
       $yorumlar=Comments::find($id);
       if(Auth::user()->id==$yorumlar->from_user or Auth::user()->role=='admin') 
       {
          $yorumlar->delete();
       }
        return redirect()->back();
    }


    public function postcomments(Request $request)
    {
       $comment=new Comments();
       $comment->on_post=$request->postid;
       $comment->from_user=Auth::user()->id;
       $comment->body=$request->comment;
       $comment->save();
       return redirect()->back();
    }

}
