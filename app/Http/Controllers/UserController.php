<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Hash;
//
class UserController extends Controller
{
    //displays the create an account page
    public function signUpPage()
    {
      return view('createAccount');
    }//end of getCreateAccount

    //creates a new user
    public function createUser(Request $request)
    {
      //makes sure that user includes valid code
      $validation = Validator::make( $request->all(),
  		[
        'first_name' => 'required',
        'last_name' => 'required',
  			'email' => ['required', 'email', 'unique:users'],
        'password' => ['required', 'min:8'],
        'repassword'=> ['required', 'same:password']
  		]);

  		if($validation->passes()){
        //creates a new user
        $user = new User;
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $user->save();

        //reaches here if successfully login
  			return redirect('/')
  				->with('successStatus', 'Tweet successfully created!');
  		}else{
    			//code if the validation fails
    			return redirect('/signup')
            ->withInput()
    				->withErrors($validation);
  		}
    }//end of createUser

    //updates a user given the parameters
    public function updateUser($id)
    {
      $user = User::where('id', $id)->update([
        'first_name' => request('first_name'),
        'last_name' => request('last_name'),
        'email' => request('email')
      ]);

      return redirect()->back()
        ->with('successStatus','Successfully updated user!');
    }//end of udpateUser
}
