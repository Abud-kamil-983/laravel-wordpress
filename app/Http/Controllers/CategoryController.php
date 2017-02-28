<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\category;
use Validator;
use Session;
class CategoryController extends Controller
{
    public function getForm(){
    	return view('posts.create-category');
    }
    public function postSave(Request $request){
    	$validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:255'
            
        ]);

        if ($validator->fails()) {

            return redirect('create-category')
                        ->withErrors($validator)
                        ->withInput();
        }
        $input = $request->input();
        $categories = new category;
        $categories->name = $input['name'];
        $categories->save();
        Session::flash('message' , 'Category created successfuly');
        return redirect('create-category');

    }
}
