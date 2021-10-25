<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at', 'published_at'];

    protected $guarded = [];

    public function getImageAttribute($value) {

        if(strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
            return asset('storage/' . $value);
        }

        public function deleteImage() {

            Storage::delete($this->image);

        }

        public function category() {
            return $this->belongsTo('App\Category');
        }

        public function tags() {
            return $this->belongsToMany('App\Tag');
        }

        public function user() {
            return $this->belongsTo('App\User');
        }

        public function scopePublished($query) {
            return $query->where('published_at', '<=', now());
        }

        public function scopeSearched($query) {
            $serach = request()->query('search');

            if(!$serach) {
                return $query->published();
            }
                return  $query->published()->where('title', 'LIKE', "%{$serach}%");
        }

}
