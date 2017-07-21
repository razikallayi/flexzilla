<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;

class SubscribersController extends Controller
{
	public function index()
	{
		$subscribers=Subscriber::orderBy('email')->get();
		return view('admin.subscribers.manage-subscribers',compact('subscribers'));
	}

	public function destroy($id=null){
	  if($id!=null){
	    $isDeleted = Subscriber::destroy($id);
	    if($isDeleted){
	         session()->flash('status','alert-success');
	         session()->flash('message','Successfully Removed!');
	     }else{
	         session()->flash('status','alert-danger');
	         session()->flash('message', 'Deleting Failed!');
	     }
	  }
	  return back();
	}
}
