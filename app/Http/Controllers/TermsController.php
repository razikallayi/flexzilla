<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Models\Terms;

class TermsController extends Controller
{

	public function index()
	{
		$terms=Terms::orderBy('serial_number')->get();
		return view('admin.terms.manage-terms',compact('terms'));
	}

    public function create()
    {
        return view('admin.terms.add-terms');
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
        $terms=Terms::create($request->all());

        if($terms){
             session()->flash('status','alert-success');
             session()->flash('message','Successfully Added <b>'.$terms->title.'</b>!');
         }else{
             session()->flash('status','alert-danger');
             session()->flash('message', 'Adding Failed!');
         }
        return back();
    }


    public function edit($id)
    {
        $terms = Terms::findOrFail($id);
      return view('admin.terms.edit-terms',compact('terms'));
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
      

        $terms=Terms::findOrFail($id);
        
        $terms->serial_number= $request->serial_number;
        $terms->title        = $request->title;
        $terms->content      = $request->content;
        $terms->title_ar     = $request->title_ar;
        $terms->content_ar   = $request->content_ar;
        $terms->is_published = $request->is_published?true:false;
        $terms->save();

        if($terms){
             session()->flash('status','alert-success');
             session()->flash('message','Successfully Updated <b>'.$terms->title.'</b>!');
         }else{
             session()->flash('status','alert-danger');
             session()->flash('message', 'Upadating Failed!');
         }
        return back();
    }



    public function destroy($id=null){
      if($id!=null){
        $isDeleted = Terms::destroy($id);
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
