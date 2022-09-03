<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\Comments;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Mail;

/*  herkes işlem yapabilir */


class PostController extends Controller
{
   public function index()
   {
    $posts= Posts::orderBy('created_at','desc')->get();

    return View("home",compact('posts'));
   }


   public function show($slug)
   {
      $post=Posts::where('slug',$slug)->get()->first();
      //$comments=Comments::where('on_post',$post->id)->get();
      return View("show",compact('post'));
   }

   
   public function logout(Request $request)
   {
       Auth::logout();
       $request->session()->invalidate();
       $request->session()->regenerateToken();
       return Redirect('/');
   }

      public static function mailgonder($toMail,$body)
      {
         Mail::to($toMail)->send(new TestMail($body));
         //return Redirect('/userposts');
      }

}
