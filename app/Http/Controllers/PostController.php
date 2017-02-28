<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Post;
use Validator;
use Session;
use App\Models\category;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = new Post;
        $postsList = $posts->paginate(5);
        return view('posts.posts-list')->with(['posts' => $postsList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = category::pluck('name', 'id');
        $tags = Tag::pluck('name', 'id');

        return view('posts.create-post')->with(['categories' => $categories , 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
            'category_id' => 'required'
        ]);

        if ($validator->fails()) {

            return redirect('post/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $input = $request->input();
        // print_r($input);
        // die;
        $slug = '';
        $posts = new Post;
        $title = strtolower($input['title']);
        $titleArray = explode(' ', $title);
        if (count($titleArray)>1) {
            $slug = implode('-', $titleArray);
        }
        else{
            $slug = $title;
        }
        $posts->title = $input['title'];
        $posts->category_id = $input['category_id'];
        $posts->slug = $slug;
        $posts->content = $input['content'];
        $posts->save();
        $posts->tags()->sync($input['tag_id']);
        Session::flash('message', 'Post successfuly created!');
        return redirect('post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //    $post = Post::where('id' , $id)->first();
    //    return view('posts.single-post')->with(['post' => $post]);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = new Post;
        $categories = category::pluck('name', 'id');
        $tags = Tag::pluck('name', 'id');
        $postdata = $posts->where('id' , $id)->first();
         return view('posts.create-post')->with(['post' => $postdata , 'categories' => $categories , 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $input = $request->input();
       $posts = new Post;
       $post = $posts->where('id' , $id)->first();
       $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect('post/'.$post->id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        } 
       
       $post->title = $input['title'];
       $post->content = $input['content'];
       $post->save();
       Session::flash('message' , 'Updated successfuly!');
       return redirect('post');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $posts = new Post;
       $post = $posts->where('id' , $id)->delete();
       
       Session::flash('message' , 'Delete successfuly!');
       return redirect('post');

    }
}
