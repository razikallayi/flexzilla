<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     const IMAGE_LOCATION = 'uploads/products';

     protected $fillable = [
	     'name',
	     'code',
	     'slug',
	     'brief',
	     'description',
	     'product_category_id',
	     'attributes',
	     'specifications',
	     'price',
	     'currency',
	     'discount',

	     'name_ar',
          'brief_ar',
	     'description_ar',
          'specifications_ar',

          'is_published',
          'is_best_selling',
	     'is_featured',
	     'listing_order',
     ];

     public function medias(){
     	return $this->hasMany('App\Models\Media','item_id')->where('table_name',$this->getTable())->orderBy('listing_order','desc');
     }
     

     public function category(){
     	return $this->hasone('App\Models\ProductCategory','id','product_category_id');
     }

     
     public function imageUrl($imageName=null){
          if($imageName != null){
              return url(self::IMAGE_LOCATION."/".$imageName);    
          }
          if($this->medias->first()){
               return url(self::IMAGE_LOCATION."/".$this->medias->first()->image);
          }
          return;
     }
     
     public function discountedPrice(){
          if($this->discount){
              return $this->discount;
          }
          
     	return $this->price;
     }


     public function translate($key='', $locale = 'ar')
     {
         $key_locale = $key."_".$locale;
         if (!array_key_exists($key_locale, $this->attributes)) {
             return $this->attributes[$key];
         }
         if($this->attributes[$key_locale] == "" || is_null($this->attributes[$key_locale])){
             return $this->attributes[$key];
         };
         return $this->attributes[$key_locale];
     }


}
         
