<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(){
        return view('profile.show');
    }
    public function update(User $user,Request $request){
      $user->update($request->all());
      
      toastr()->success('Updated');
      return redirect()->back();
    }
}
