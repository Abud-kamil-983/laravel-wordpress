<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\Models\Tag;
use Session;

class TagController extends Controller
{
    Public function getForm(){
    	return view('posts.create-tag');
    }

    public function postSave(Request $request){
    	$validator = Validator::make($request->all(), [
            'name' => 'required|unique:tags|max:255'
            
        ]);

        if ($validator->fails()) {

            return redirect('create-tag')
                        ->withErrors($validator)
                        ->withInput();
        }
        $input = $request->input();
        $tags = new tag;
        $tags->name = $input['name'];
        $tags->save();
        Session::flash('message' , $input['name'].' tag created successfuly');
        return redirect('create-tag');

    }
}
