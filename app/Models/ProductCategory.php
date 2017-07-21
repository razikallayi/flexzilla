<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
	const IMAGE_LOCATION = 'uploads/productCategory';

	protected $fillable = [
	'name',
	'slug',
	'image',
	'parent_id',
	'name_ar',
	'is_published',
	'listing_order'];


	public function products(){
		return $this->hasmany(Product::class);
	}
	
	public function imageurl(){
		return url(self::IMAGE_LOCATION."/".$this->image);
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
