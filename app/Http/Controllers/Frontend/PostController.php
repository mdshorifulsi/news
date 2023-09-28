<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    public function post_details($id){
         $details=Post::find($id);
        return view('frontpages.post_details',compact('details'));

    }

     public function categorypost($id){

        $categorypost=Post::where('category_id',$id)->simplePaginate(3);
        return view('frontpages.categorypost',compact('categorypost'));

    }
}
