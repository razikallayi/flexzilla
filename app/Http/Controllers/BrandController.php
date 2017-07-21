<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Models\Brand;
use App\Models\Media;
use App\Helpers\Helper;

class BrandController extends Controller
{

	public function index()
	{
		$brands=Brand::orderBy('listing_order','desc')->get();
		return view('admin.brand.manage-brand',compact('brands'));
	}

    public function create()
    {
        return view('admin.brand.add-brand');
    }

    public function saveImage(Request $request){
        $this->validate($request, [
                        'image' => 'required',
                        ]);

        $uploadImage=$request->image;
        $location=Brand::IMAGE_LOCATION;

        return Helper::uploadImage($uploadImage, $location);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'name'            => 'required',
           'image'            => 'required',
           // 'is_published'     => '',
           ])->validate();


        $request['slug'] = str_slug($request->name);
        $request['is_published'] = $request->is_published?true:false;
        $brand=Brand::create($request->all());

        if(is_array($request->image)){
          $image= $request->image[0];
          $media = new Media;
          $media->image = $image;
          $media->table_name = $brand->getTable();
          $media->item_id = $brand->id;
          $media->save();
        }

        if($brand){
             session()->flash('status','alert-success');
             session()->flash('message','Successfully Added <b>'.$brand->name.'</b>!');
         }else{
             session()->flash('status','alert-danger');
             session()->flash('message', 'Adding Failed!');
         }
        return back();
    }


    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
      return view('admin.brand.edit-brand',compact('brand'));
  }

  public function update($id,Request $request)
  {
         $validator = Validator::make($request->all(), [
           'name'            => 'required',
           // 'image'            => 'required',
           // 'is_published'     => '',
           ])->validate();
      

        $brand=Brand::findOrFail($id);
        
        $brand->name        = $request->name;
        $brand->name_ar        = $request->name_ar;
        $brand->slug         = str_slug($request->name);
        $brand->is_published = $request->is_published?true:false;
        $brand->save();

        if(is_array($request->image)){
          $image= $request->image[0];
          $oldMedias = Media::where('table_name',$brand->getTable())
          ->where('item_id',$brand->id)
          ->get();
          $location = str_finish(Brand::IMAGE_LOCATION, '/');
          foreach ($oldMedias as $oldMedia) {
            $filename = $oldMedia->image;
            if($filename!=null){
              if(file_exists($location.$filename)){
                unlink($location.$filename);
              }
            }
            $oldMedia->delete();
          }

          $media = new Media;
          $media->image = $image;
          $media->table_name = $brand->getTable();
          $media->item_id = $brand->id;
          $media->save();
        }

        if($brand){
             session()->flash('status','alert-success');
             session()->flash('message','Successfully Updated <b>'.$brand->name.'</b>!');
         }else{
             session()->flash('status','alert-danger');
             session()->flash('message', 'Upadating Failed!');
         }
        return back();
    }



    public function destroy($id=null){
      if($id!=null){
        $brand = Brand::findOrFail($id);
        $location = str_finish(Brand::IMAGE_LOCATION, '/');
        foreach ($brand->medias as $media) {
            $filename = $media->image;
            if($filename!=null){
              if(file_exists($location.$filename)){
                unlink($location.$filename);
              }
            }
            $media->delete();
        }
        $isDeleted = $brand->delete();
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


    // public function deleteImage(Request $request)
    // {
    //   $this->validate($request, [
    //                   'filename' => 'required'
    //                   ]);
    //   $location = str_finish(Brand::IMAGE_LOCATION, '/');
    //   $filename = $request->filename;

    //   $imageid = Media::where('image',$filename)->first(['id']);
    //   if($imageid !=null){
    //     $imageid->delete();
    //   }
    //   if(file_exists($location.$filename)){
    //     unlink($location.$filename);
    //   }
    //   return response()->json(['status'=>'success']);

    // }

    public function sort(Request $request)
    {
      $this->validate($request, [
        'sort' => 'required|array',
        ]);
      $counter = Brand::count();
      foreach ($request->sort as $id) {
        Brand::where('id', $id)
          ->update(['listing_order' => $counter--]);
      }
      return;
    }

}
