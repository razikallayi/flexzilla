<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Media;
use App\Models\Terms;
use App\Models\Privacy;
use App\Models\Subscriber;
use App\Helpers\Helper;
use Validator;
use App\Mail\ContactMail;
use Mail;
use Session;
use Redirect;
use Cart;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Mail\OrderCheckout;

class MasterController extends Controller
{
    public function index()
    {
        if(app()->isLocale('ar')){//only for arabic
            return view('project/ar.index');
        }
        return view('project.index');
    }

    public function products($slug,Request $request)
    {
        $view='project.products';
        if(app()->isLocale('ar')){//only for arabic
            $view='project/ar.products';
        }
        $category = ProductCategory::where('slug',$slug)->first();
        if($category !=null) {
            $products =  Product::where('product_category_id',$category->id)->where('is_published',1);
            if($request->has('type')){
                if($request->type == 'new'){
                    $products =  $products->orderBy('updated_at','desc')->get();
                    return view($view,compact('products'));
                }
                else if($request->type == 'best-selling'){
                    $products =  $products->where('is_best_selling',1)->get();

                    return view($view,compact('products'));
                }
                else if($request->type == 'best'){
                    $products =  $products
                    ->orWhere(function ($query) {
                        $query->where('is_best_selling',1)
                        ->where('is_featured',1);
                    })
                    ->get();
                    return view($view,compact('products'));

                }
            }else{

            }
            $products = $products->get();
            return view($view,compact('products'));
        }
        return view($view,compact('products'));
    }


    public function productDetail($slug)
    {
        $product = Product::where('slug',$slug)->first();
        if(!$product){
            abort(404);
        }
        if(app()->isLocale('ar')){
           return view('project/ar.product-details',compact('product'));
       }
        return view('project.product-details',compact('product'));
    }


    public function about()
    {
       if(app()->isLocale('ar')){
         return view('project/ar.about');
     }
     return view('project.about');
    }


    public function cart(){
        $cart= Cart::getContent();
        $cartTotalPrice = Cart::getTotal();
        if(app()->isLocale('ar')){
            return view('project/ar.cart',compact('cart','cartTotalPrice'));
        }
        return view('project.cart',compact('cart','cartTotalPrice'));
      }




    public function brands()
    {
        $brands=Brand::where('is_published',true)
                     ->orderBy('listing_order','desc')
                     ->get();
         if(app()->isLocale('ar')){
             return view('project.ar.brands',compact('brands'));
         }
        return view('project.brands',compact('brands'));
    }

    public function privacy()
    {
        $privacies = Privacy::orderBy('serial_number')->get();
        if(app()->isLocale('ar')){
             return view('project.ar.privacy',compact('privacies'));
        }
        return view('project.privacy',compact('privacies'));
    }

    public function terms()
    {
        $terms = Terms::orderBy('serial_number')->get();
        if(app()->isLocale('ar')){
             return view('project.ar.terms',compact('terms'));
        }
        return view('project.terms',compact('terms'));
    }


    public function contact()
    {
        if(app()->isLocale('ar')){
            return view('project.ar.contact');
        }
        return view('project.contact');
    }


    public function contactMail(Request $request)
    {
        Mail::to(ContactMail::DESTINATION_EMAIL)->send(new ContactMail($request));
        if( count(Mail::failures()) > 0 ) {
            Session::flash('mail_status','Sorry!An error occured!'.Mail::failures()[0]);
        } else {
            Session::flash('mail_status','Thank You! We will contact you soon!!');
        }
        return back();
    }


    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
             'email'    => 'required|email|max:191|unique:subscribers',
             ])->validate();

        $subscriber=Subscriber::create($request->all());
        if( $subscriber ) {
            return response()->json(["status"=>"success"]);
        } else {
            return response()->json(["status"=>"danger"]);
        }
    }

    public function addToCart(Request $request){


        $this->validate($request, [
                        'id' => 'required|numeric',
                        ]);
        $product = Product::find($request->id);
        $quantity = $request->quantity?$request->quantity:1;
        // $comments = $request->comments?$request->comments:"";
// // array format
// Cart::add(array(
//     'id' => 456,
//     'name' => 'Sample Item',
//     'price' => 67.99,
//     'quantity' => 4,
//     'attributes' => array()
// ));
        Cart::add(['id'=>$product->id,
                  'name'=>$product->name,
                  'price'=>$product->discountedPrice(),
                  'quantity'=>$quantity,
                  'attributes'=>[
                      'image'=> $product->imageUrl(),
                      'actual_price'=>$product->price,
                      'currency'=>$product->currency,
                    ]
                  ]);
        return response()->json(["status"=>"success",
                                'cartTotalPrice'=>Cart::getTotal(),
                                'cartCount' => Cart::getContent()->count()]);
    }

    public function updateCart(Request $request){
        $this->validate($request, [
                        'id' => 'required|numeric',
                        ]);
        $product = Product::find($request->id);
        $quantity = $request->quantity?$request->quantity:1;
        // if ($request->comments) {
        //     $comments = $request->comments;
        // } else if(Cart::has($request->id)){
        //     $comments = Cart::get($request->id)->attributes->comments;
        // } else{
        //     $comments = "";
        // }

// // Example array format
// Cart::add(array(
//     'id' => 456,
//     'name' => 'Sample Item',
//     'price' => 67.99,
//     'quantity' => 4,
//     'attributes' => array()
// ));
        Cart::remove($product->id);
        Cart::add(['id'=>$product->id,
                  'name'=>$product->name,
                  'price'=>$product->discountedPrice(),
                  'quantity'=>$quantity,
                  'attributes'=>[
                      'image'=> $product->imageUrl(),
                      'actual_price'=>$product->price,
                      'currency'=>$product->currency,
                      ]
                  ]);
        return response()->json(["status"=>"success",
                                'cartTotalPrice'=>Cart::getTotal(),
                                'cartCount' => Cart::getContent()->count()]);
    }



    public function removeFromCart(Request $request){
        $this->validate($request, [
                        'id' => 'required|numeric',
                        ]);
        Cart::remove($request->id);
        return response()->json(["status"=>"success",
                                'cartTotalPrice'=>Cart::getTotal(),
                                'cartCount' => Cart::getContent()->count()]);
    }

    /**
    * Send checkout email for the given order.
    *
    * @param  Request  $request
    * @param  int  $orderId
    * @return Response
    */
    public function checkout(Request $request)
    {
        Mail::to(OrderCheckout::DESTINATION_EMAIL)
        ->send(new OrderCheckout($request));

    return view('emails.order-checkout')->with(['request'=> $request]);
        if( count(Mail::failures()) > 0 ) {
            return response()->json(["status"=>"failed"]);
        } else {
    //TODO Send thanks email to customer
            Cart::clear();
            return response()->json(["status"=>"success"]);
        }

    }

}
