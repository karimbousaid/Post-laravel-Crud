<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    protected $fillable=['content'];
    use SoftDeletes;

    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
