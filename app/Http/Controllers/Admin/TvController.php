<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TV;
use Brian2694\Toastr\Facades\Toastr;
use Str;
use DB;

class TvController extends Controller
{
    public function index()
    {
        // $category=Category::first();

        $tv = DB::table('t_v_s')->first();
        return view('admin.tv.index', compact('tv'));
    }

    public function update(Request $request, $id)
    {

        $tv = TV::find($id);
        $tv->tv_name = $request->tv_name;
        $tv->embade_code = $request->embade_code;
        $tv->save();
        return redirect()->route('admin.tv.index');

    }
}