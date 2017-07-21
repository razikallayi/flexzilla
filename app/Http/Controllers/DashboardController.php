<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Illuminate\Validation\Rule;
use Hash;

class DashboardController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function myAccount()
    {
    	$user= auth()->user();
        return view('admin.my-account',compact('user'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAccount(Request $request)
    {
		$this->middleware('auth');
    	if(auth()->guest()){return;}

    	$validator = Validator::make($request->all(), [
    	    'name' => 'required|max:255',
    	    'username' => ['required','max:255',Rule::unique('users')->ignore($request->user()->id)],
    	    'email' => 'required|email|max:255',
    	    'current_password' => 'required|max:255',
    	    'new_password' => 'required|min:6|confirmed',
    	]);

    	$validator->after(function($validator) use($request){
    	    if (!Hash::check($request->current_password, $request->user()->password)) {
    	        $validator->errors()->add('current_password', 'Current password is invalid.');
    	    }
    	});

   		$validator->validate();

   		$user = auth()->user();
   		$user->name= $request->name;
   		$user->username= $request->username;
   		$user->email= $request->email;
   		$user->password= Hash::make($request->new_password);
   		$user->save();
   		return view('admin.my-account',compact('user'));
    }
}
