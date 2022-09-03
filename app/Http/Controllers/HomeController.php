<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Posts;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Image;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
         $this->middleware(function($request,$next) {
          if(Auth::user()->role!='admin' and Auth::user()->role!='editor') {
            return redirect('/');
          }
          return $next($request);              
        });
    }
    

   


    public function create(Request $request)
    {
  
    }



   public function delete($id)
   {
    $post=Posts::find($id);
    $photo= $post->photo;
    $post->delete();
    Storage::delete("public/images/".$photo);
    return redirect("/userposts");
   }

   public function edit($id)
   {
    $post=Posts::find($id);
    return View('users.postedit',compact('post')); 
   }

   public function update(Request $request)
   {
    $id=$request->postid;
    $post=Posts::find($id);
    $post->title=$request->title;
    $post->body=$request->body;
    $hasFile=$request->hasFile('image');
    if ($hasFile)
    {
      $filename = 'postphoto-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
      $path=$request->file('image')->storeAs('public/images/posts',$filename);
      $post->photo= "posts/".$filename;
      $oldphoto=$request->oldphoto;
      Storage::delete("public/images/".$oldphoto);
    }
    $post->save();
    return redirect('/userposts');
   }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   
   
    public function userposts()
    {
      if(Auth::user()->role=='admin') $posts=Posts::orderBy('created_at','desc')->get();
      else $posts=Posts::where('author_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('users.posts',compact('posts'));
    }
   


    public function postscreate()
    {
        return view('users.postscreate');
    }



    public function poststore(Request $request)
    { 
     $posts=new Posts;
      $posts->title=$request->title;
      $posts->body=$request->body;
      $slug=Str::slug($request->title,'-','tr');
      $posts->slug=$slug;
     // $name=$request->file('image')->getClientOriginalName();
     $hasFile=$request->hasFile('image');
    if ($hasFile)
    {
        
        $filename = 'postphoto-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
        $path=$request->file('image')->storeAs('public/images/posts',$filename);
        $filename2 = 'postphotosmall-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
        $image=Image::make($request->file('image')->getRealPath());
        $image->resize(100, null, function ($constraint) {
          $constraint->aspectRatio();
        })->save('storage/images/posts/'.$filename2);
        
        $posts->photo= "posts/".$filename;
    }

    else $posts->photo="posts/728x300.png";
      $posts->author_id=Auth::user()->id;
      $posts->save();
     $icerik="<p> YENİ HABER EKLENDİ</p>";
     $link=Url($slug);
     $icerik.="<a href='$link'> $link </a>";
     PostController::mailgonder('ogretmendemo@gmail.com',$icerik);

      return redirect()->route('userposts')->with('status','Haber Kaydedildi!');

        
    }
   



    public function ckeditorupload(Request $request)
  {
     if($request->hasFile('upload'))
     {
        $orjname=$request->file('upload')->getClientOriginalName();
        $fileName=pathinfo($orjname,PATHINFO_FILENAME);
        $extension=$request->file('upload')->getClientOriginalExtension();
        $fileName=$fileName.'_'.time().'.'.$extension;
       $request->file('upload')->storeAs("public/images/posts", $fileName);
       $ckeditorfunc=$request->input('CKEditorFuncNum');
       $url=asset('storage/images/posts/'. $fileName);
       $msj='Fotoğraf Yüklendi!';
       $response="<script>window.parent.CKEDITOR.tools.callFunction($ckeditorfunc,'$url','$msj')</script>";
       echo  $response;
     }

  }
   
}