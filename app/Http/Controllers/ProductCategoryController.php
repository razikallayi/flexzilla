<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Helpers\Helper;

class ProductCategoryController extends Controller
{

    public function index($id=null)
    {
        $page='Create';
        $categoty=null;
        if($id){
            $page='Edit';
            $categoty = ProductCategory::findOrFail($id);
        }

        $productCategories=ProductCategory::orderBy('listing_order','desc')->get();
        return view('admin.product.manage-productCategory',compact('productCategories','categoty','page'));
    }


    public function saveImage(Request $request){
        $this->validate($request, [
                        'image' => 'required',
                        ]);

        $uploadImage=$request->image;
        $location=ProductCategory::IMAGE_LOCATION;

        return Helper::uploadImage($uploadImage, $location);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                                     'name'    => 'required|max:191|unique:product_categories',
                                     'image'   => 'required'
                                     ])->validate();

        $request->slug        = str_slug($request->name);
        $ProductCategory = ProductCategory::create($request->all());
        if($ProductCategory){
            session()->flash('status','alert-success');
            session()->flash('message','Successfully Added <b>'.$ProductCategory->name.'</b>!');
        }else{
            session()->flash('status','alert-danger');
            session()->flash('message', 'Adding Failed!');
        }
        return back();
    }


    public function update($id,Request $request)
    {
           $validator = Validator::make($request->all(), [
             'name'            => 'required',
             'name_ar'          => '',
             // 'image'            => 'required',
             // 'is_published'     => '',
             ])->validate();
        

          $category=ProductCategory::findOrFail($id);
          
          $category->name        = $request->name;
          $category->slug        = str_slug($request->name);
          $category->name_ar     = $request->name_ar;
          $category->image       = $request->image;
          $category->is_published = $request->is_published?true:false;
          $category->save();

          if($category){
               session()->flash('status','alert-success');
               session()->flash('message','Successfully Updated <b>'.$category->name.'</b>!');
           }else{
               session()->flash('status','alert-danger');
               session()->flash('message', 'Upadating Failed!');
           }
          return back();
      }

    public function destroy($id=null){
        if($id!=null){
            $count = Product::where('product_category_id',$id)->count();
          if($count > 0){


                $deleteButton ='<a class="btn btn-danger" onclick="if(!confirm(\'Are you sure want to delete. All products under this category will be removed?\')) return false;event.preventDefault();
                document.getElementById(\'f-delete-form-'.$id.'\').submit();">
                <form id="f-delete-form-'.$id.'" action="'.url('admin/products/category/delete/'. $id).'" method="post" style="display: none;">
                  '. csrf_field() . method_field("DELETE") .'
                </form><i class="material-icons">delete</i> Force Delete</a>';

                $product = ' products';
                $arbiterry = ' are ';
                if($count==1){$product = ' product';$arbiterry=' is ';}
                session()->flash('status','alert-warning');
                session()->flash('message','There '.$arbiterry.$count.$product.'  in this category. Please remove the '.$product.' before category. '.$deleteButton);
                return back();
            }

            $ProductCategory = ProductCategory::findOrFail($id);
            $isDeleted =  $ProductCategory->delete();
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

    public function forceDestroy($id=null){
        if($id!=null){
            $productCategory = ProductCategory::findOrFail($id);
            $products = Product::where("product_category_id",$productCategory->id)->delete();
            $isDeleted =  $productCategory->delete();
            if($isDeleted){
                session()->flash('status','alert-success');
                session()->flash('message','Successfully Removed all products and the category!');
            }else{
                session()->flash('status','alert-danger');
                session()->flash('message', 'Deleting Failed!');
            }
        }
        return back();
      }


    public function sort(Request $request)
    {
      $this->validate($request, [
        'sort' => 'required|array',
        ]);
      $counter = ProductCategory::count();
      foreach ($request->sort as $id) {
        ProductCategory::where('id', $id)
          ->update(['listing_order' => $counter--]);
      }
      return;
    }
}
