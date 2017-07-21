<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Models\News;
use App\Models\Media;
use App\Helpers\Helper;
use App\Events\NewsPublished;

class NewsController extends Controller
{

	public function index()
	{
		$allNews=News::orderBy('id','desc')->get();
		return view('admin.news.manage-news',compact('allNews'));
	}

    public function create()
    {
        return view('admin.news.add-news');
    }

    public function saveImage(Request $request){
        $this->validate($request, [
                        'image' => 'required',
                        ]);

        $uploadImage=$request->image;
        $location=News::IMAGE_LOCATION;

        return Helper::uploadImage($uploadImage, $location);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'title'            => 'required',
           'content'          => '',
           'title_ar'       => '',
           'content_ar'       => '',
           'image'            => 'required',
           // 'is_published'     => '',
           ])->validate();


        $request['slug'] = str_slug($request->title);
        $request['is_published'] = $request->is_published?true:false;
        $news=News::create($request->all());

        if(is_array($request->image)){
          $image= $request->image[0];

          $media = new Media;
          $media->image = $image;
          $media->table_name = $news->getTable();
          $media->item_id = $news->id;
          $media->save();
        }
        
        if($request->is_published){
          event(new NewsPublished($news));
        }

        if($news){
             session()->flash('status','alert-success');
             session()->flash('message','Successfully Added <b>'.$news->title.'</b>!');
         }else{
             session()->flash('status','alert-danger');
             session()->flash('message', 'Adding Failed!');
         }
        return back();
    }


    public function edit($id)
    {
        $news = News::findOrFail($id);
      return view('admin.news.edit-news',compact('news'));
  }

  public function update($id,Request $request)
  {
         $validator = Validator::make($request->all(), [
           'title'            => 'required',
           'content'          => '',
           'title_ar'       => '',
           'content_ar'       => '',
           // 'image'            => 'required',
           // 'is_published'     => '',
           ])->validate();
      

        $news=News::findOrFail($id);
        
        $news->title        = $request->title;
        $news->slug         = str_slug($request->title);
        $news->content      = $request->content;
        $news->title_ar     = $request->title_ar;
        $news->content_ar   = $request->content_ar;
        $news->is_published = $request->is_published?true:false;
        $news->save();

        if(is_array($request->image)){
          $image= $request->image[0];
          $oldMedias = Media::where('table_name',$news->getTable())
          ->where('item_id',$news->id)
          ->get();
          $location = str_finish(News::IMAGE_LOCATION, '/');
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
          $media->table_name = $news->getTable();
          $media->item_id = $news->id;
          $media->save();
        }

        if($news){
             session()->flash('status','alert-success');
             session()->flash('message','Successfully Updated <b>'.$news->title.'</b>!');
         }else{
             session()->flash('status','alert-danger');
             session()->flash('message', 'Upadating Failed!');
         }
        return back();
    }



    public function destroy($id=null){
      if($id!=null){
        $news = News::findOrFail($id);
        $location = str_finish(News::IMAGE_LOCATION, '/');
        foreach ($news->medias as $media) {
            $filename = $media->image;
            if($filename!=null){
              if(file_exists($location.$filename)){
                unlink($location.$filename);
              }
            }
            $media->delete();
        }
        $isDeleted = $news->delete();
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
    //   $location = str_finish(News::IMAGE_LOCATION, '/');
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

}
