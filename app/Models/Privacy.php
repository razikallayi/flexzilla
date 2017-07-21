<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privacy extends Model
{
    
	protected $fillable = [
	'serial_number',
	'title',
	'content',
	'title_ar',
	'content_ar',
	'is_published',
	];


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
