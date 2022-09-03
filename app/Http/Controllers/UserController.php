<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreForm;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;

// admin işlem yapabilir

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware(function($request,$next) {
        //   if(Auth::user()->role!='admin') {
        //     return redirect()->back();
        //   }
        //   return $next($request);              
        // });

    }
    

    public function show()
    {
       
         $users=User::all();
          return View("users.show",compact('users'));
      
    }

    public function delete($id)
    {
     $user=User::find($id);
     //$photo= $post->photo;
     $user->delete();
    // Storage::delete("public/images/".$photo);
     return redirect("/users");
    }

    public function edit($id)
    {
     $user=User::find($id);
     return View('users.edit',compact('user'));
    }

    public function create()
    {
      return View('users.create');
    }

    public function update(Request $request)
    {
      $user=User::find($request->userid);
      $user->name=$request->name;
      $user->email=$request->email;
      $user->gender=$request->gender;
      $user->role=$request->role;
      $hasFile=$request->hasFile('photo');
      if ($hasFile)
      {
          $filename = 'userphoto-' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
          $path=$request->file('photo')->storeAs('public/images/users',$filename);
          $user->photo= "users/".$filename;
      }
      $user->save();
      return redirect("/users")->with('status','Kullanıcı Güncellendi!');
    }


    public function store(UserStoreForm $request)
    {
        // $validated = $request->validate([
        //     'name' => 'required|max:30',
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:3'],
        // ]);
    //return dd($request->all());
    // User::create($request->all());
      $user=new User;
      $user->name=$request->name;
      $user->email=$request->email;
      $user->password=Hash::make($request->password);
      $user->gender=$request->gender;
      $user->role=$request->role;
      $hasFile=$request->hasFile('photo');
      if ($hasFile)
      {
          $filename = 'userphoto-' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
          $path=$request->file('photo')->storeAs('public/images/users',$filename);
          $user->photo= "users/".$filename;
      }
    //   $user->save();
      return redirect("/users")->with('status','Kullanıcı Eklendi!');
    }

    
}
