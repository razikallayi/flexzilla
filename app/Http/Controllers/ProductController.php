<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Media;
use App\Helpers\Helper;

class ProductController extends Controller
{
    public function index()
    {
    	$products=Product::orderBy('listing_order','desc')->get();
    	return view('admin.product.manage-product',compact('products'));
    }

    public function create($id=null)
    {
        $product=null;
        if($id!=null){
            $product = Product::findOrFail($id);
        }
        return view('admin.product.create',compact('product'));
    }

    public function saveImage(Request $request){
        $this->validate($request, [
                        'image' => 'required',
                        ]);

        $uploadImage=$request->image;
        $location=Product::IMAGE_LOCATION;

        return Helper::uploadImage($uploadImage, $location);
    }

    public function store(Request $request)
    {
        $validator = $this->validate($request, [
             'product_category_id'    => 'required',
             'name'    => 'required|max:191|unique:products',
             'price'    => 'numeric|nullable',
             'discount'    => 'numeric|nullable|max:'.$request["price"],
        ]);

        $request['slug'] = str_slug($request->name);
        $request['currency'] = 'QAR';
        $product = Product::create($request->all());

        if($product !=null){
        	if($request->has('image')){
        		foreach($request->image as $image) 
        		{  
        			$media = new Media;
        			$media->image = $image;
        			$media->table_name = $product->getTable();
        			$media->item_id = $product->id;
        			$media->save();
        		}
        	}
        }

        if($product){
             session()->flash('status','alert-success');
             session()->flash('message','Successfully Added <b>'.$product->name.'</b>!');
         }else{
             session()->flash('status','alert-danger');
             session()->flash('message', 'Adding Failed!');
         }
        return back();
    }


    public function update($id,Request $request)
    {
        // dd($request->all());
        $product = Product::findOrFail($id);
       
        $validator = $this->validate($request, [
             'product_category_id'    => 'required',
             'name'    => 'required|max:191|unique:products,name,'.$product->id,
             'price'    => 'numeric|nullable',
             'discount'    => 'numeric|nullable|max:'.$request["price"],
        ]);

        $product->name                = $request->name;
        $product->code                = $request->code;
        $product->slug                = str_slug($request->name);
        $product->brief               = $request->brief;
        $product->description         = $request->description;
        $product->product_category_id = $request->product_category_id;
        // $product->attributes          = $request->attributes;
        $product->specifications      = $request->specifications;
        $product->price               = $request->price;
        $product->currency            = 'QAR';
        $product->discount            = $request->discount;

        $product->name_ar             = $request->name_ar;
        $product->brief_ar            = $request->brief_ar;
        $product->description_ar      = $request->description_ar;
        $product->specifications_ar      = $request->specifications_ar;

        $product->is_published        = $request->is_published?true:false;
        $product->is_best_selling     = $request->is_best_selling?true:false;
        $product->is_featured         = $request->is_featured?true:false;
        $product->save();

        if($product !=null){
            if($request->has('image')){
                foreach($request->image as $image) 
                {  
                    $media = new Media;
                    $media->image = $image;
                    $media->table_name = $product->getTable();
                    $media->item_id = $product->id;
                    $media->save();
                }
            }
        }

        if($product){
             session()->flash('status','alert-success');
             session()->flash('message','Successfully Updated <b>'.$product->name.'</b>!');
         }else{
             session()->flash('status','alert-danger');
             session()->flash('message', 'Updating Failed!');
         }
        return back();
    }

}
