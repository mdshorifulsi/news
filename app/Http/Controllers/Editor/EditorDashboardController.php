<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class EditorDashboardController extends Controller
{
    public function index()
    {
        $post=Auth::user()->posts();
        return view('editor.dashboard',compact('post'));
    }
}