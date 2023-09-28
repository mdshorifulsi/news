<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\District;
use App\Models\Category;
use App\Models\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Str;
use Auth;
use File;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $total_pending=Post::where('status',0)->count();
        $total_post=Post::count();
        $total_cat=Category::count();
        $total_tag=Tag::count();
        return view('admin.dashboard',compact('total_pending','total_post','total_cat','total_tag'));
    }
}