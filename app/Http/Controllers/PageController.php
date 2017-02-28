<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Post;

class PageController extends Controller
{
    public function showSingle($slug){
    	$post = new Post;
    	$post = $post->where('slug' , $slug)->first();
    	

    	return view('posts.single-post')->with(['post' => $post]);
    }
}
