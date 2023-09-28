<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhotoGallery;
use Brian2694\Toastr\Facades\Toastr;
use File;

class PhotoGallaryController extends Controller
{
    public function index()
    {
        $photo_gallery = PhotoGallery::get();
        return view('admin.photo_gallery.index', compact('photo_gallery'));

    }

    public function store(Request $request)
    {

        $photoGallery = new PhotoGallery;
        $photoGallery->photo_name_en = $request->photo_name_en;
        $photoGallery->photo_name_bn = $request->photo_name_bn;
        $photoGallery->photo_credit = $request->photo_credit;


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
            $photoGallery->photo = $request->file('photo')->move("images/photo_gallery", $name);
        }

        $photoGallery->save();
        return response()->json([
            'status' => 'success',
        ]);


    }


    public function destroy($id)
    {

        $photoGallery = PhotoGallery::find($id);
        if (File::exists($photoGallery->photo)) {
            File::delete($photoGallery->photo);
        }
        $photoGallery->delete();
        Toastr::error('photoGallery delete successfully:', 'deleted!');
        return back();

    }



    public function inactive($id)
    {

        PhotoGallery::where('id', $id)
            ->update(['status' => 0]);
        return response()->json([
            'status' => 'success',
        ]);

    }

    public function active($id)
    {

        PhotoGallery::where('id', $id)
            ->update(['status' => 1]);
        return response()->json([
            'status' => 'success',
        ]);
    }

}