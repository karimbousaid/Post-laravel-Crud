<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    protected $fillable=['title','content','slug','active'];
    use SoftDeletes;
	
     public function comments()
    {
        return $this->hasMany('App\Comment');
    }

     public static function boot()
    {
        parent::boot();

        static::deleting(function (Post $post) {
            $post->comments()->forceDelete();
        });

        static::restoring(function (Post $post) {
            $post->comments()->restore();
        });
    }
}
