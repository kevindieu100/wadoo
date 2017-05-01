<?php

namespace App\Http\Controllers;

use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;

class LoginController extends Controller
{
  //displays the home page with login
  public function index()
  {
    return view('index');
  }//end of index

  //function for logging in
  public function login()
  {
    $loginWasSuccessful = Auth::attempt([
      'email' => request('email'),
      'password' => request('password')
    ]);

    if ($loginWasSuccessful) {
      	return redirect('/main');
    } else {
       $errors = new MessageBag(['password' => ['Email and/or password invalid.']]);
        return redirect('/')
          ->withInput()
          ->withErrors($errors);
    }
  }//end of login
}
