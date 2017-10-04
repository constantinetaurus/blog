<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	/*
	 * one post belongs to only one Category relationship
	 */
    public function category() 
    {
    	return $this->belongsTo('App\Category');
    }

    /*
	 * one post belongs to many Tags relationship
	 */
    public function tags()
    {
    	return $this->belongsToMany('App\Tag');
    }

    /*
     * One post has many Comments relationship
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
