<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   protected $fillable = ['title' , 'content'];

   public function category(){
   	return $this->belongsTo('App\Models\category');
   }

   public function tags(){
   	return $this->belongsToMany('App\Models\Tag');
   }
}
