<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Models\Privacy;

class PrivacyController extends Controller
{

	public function index()
	{
		$privacies=Privacy::orderBy('serial_number')->get();
		return view('admin.privacy.manage-privacy',compact('privacies'));
	}

    public function create()
    {
        return view('admin.privacy.add-privacy');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'serial_number'    => 'required',
           'title'            => 'required',
           'content'          => '',
           'title_ar'         => '',
           'content_ar'       => '',
           // 'is_published'  => '',
           ])->validate();
        
        $request['is_published'] = $request->is_published?true:false;
        $privacy=Privacy::create($request->all());

        if($privacy){
             session()->flash('status','alert-success');
             session()->flash('message','Successfully Added <b>'.$privacy->title.'</b>!');
         }else{
             session()->flash('status','alert-danger');
             session()->flash('message', 'Adding Failed!');
         }
        return back();
    }


    public function edit($id)
    {
        $privacy = Privacy::findOrFail($id);
      return view('admin.privacy.edit-privacy',compact('privacy'));
    }

  public function update($id,Request $request)
  {
         $validator = Validator::make($request->all(), [
           'serial_number'    => 'required',
           'title'            => 'required',
           'content'          => '',
           'title_ar'       => '',
           'content_ar'       => '',
           // 'is_published'     => '',
           ])->validate();
      

        $privacy=Privacy::findOrFail($id);
        
        $privacy->serial_number= $request->serial_number;
        $privacy->title        = $request->title;
        $privacy->content      = $request->content;
        $privacy->title_ar     = $request->title_ar;
        $privacy->content_ar   = $request->content_ar;
        $privacy->is_published = $request->is_published?true:false;
        $privacy->save();

        if($privacy){
             session()->flash('status','alert-success');
             session()->flash('message','Successfully Updated <b>'.$privacy->title.'</b>!');
         }else{
             session()->flash('status','alert-danger');
             session()->flash('message', 'Upadating Failed!');
         }
        return back();
    }



    public function destroy($id=null){
      if($id!=null){
        $isDeleted = Privacy::destroy($id);
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
