<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website;
use Brian2694\Toastr\Facades\Toastr;

class websiteController extends Controller
{
    public function index()
    {

        $website = Website::get();
        return view('admin.Website.index', compact('website'));
    }

    public function store(Request $request)
    {

        $website = new Website;
        $website->website_name_bn = $request->website_name_bn;
        $website->website_name_en = $request->website_name_en;
        $website->website_link = $request->website_link;

        $website->save();

        return response()->json([
            'status' => 'success',
        ]);


    }


    public function destroy($id)
    {

        $website = Website::find($id);
        $website->delete();
        Toastr::error('website delete successfully:', 'deleted!');
        return back();

    }


    public function inactive($id)
    {

        Website::where('id', $id)
            ->update(['status' => 0]);
        return response()->json([
            'status' => 'success',
        ]);

    }

    public function active($id)
    {

        Website::where('id', $id)
            ->update(['status' => 1]);
        return response()->json([
            'status' => 'success',
        ]);
    }
}