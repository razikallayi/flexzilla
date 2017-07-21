<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{

	const IMAGE_LOCATION = 'uploads/news';

	protected $fillable = [
	'title',
	'slug',
	'content',
	'title_ar',
	'content_ar',
	'is_published',
	];

    public function medias(){
        return $this->hasMany('App\Models\Media','item_id')->where('table_name',$this->getTable());
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
