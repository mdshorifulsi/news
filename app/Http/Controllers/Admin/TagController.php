<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Str;

class TagController extends Controller
{
    public function index()
    {
        $tag = Tag::latest()->get();
        return view('admin.tag.index', compact('tag'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'tagname_bn' => 'required|unique:tags|max:100',
                'tagname_en' => 'required|unique:tags|max:100',

            ],
            [
                'tagname_bn.required' => 'Tag name Bangla is Requerd',
                'tagname_bn.unique' => 'This Tag is Allready Exit ',
                'tagname_en.required' => 'Tag name English is Requerd',
                'tagname_en.unique' => 'this Tag is Allready Exit '
            ],
        );


        $tag = new Tag;
        $tag->tagname_bn = $request->tagname_bn;
        $tag->tagname_en = $request->tagname_en;
        $tag->tagslug_bn = Str::slug($request->tagname_bn);
        $tag->tagslug_en = Str::slug($request->tagname_en);
        $tag->save();

        return response()->json([
            'status' => 'success',
        ]);

    }

    public function update(Request $request)
    {
        $validated = $request->validate(
            [
                'up_tagname_bn' => 'required|unique:tags,tagname_bn,' . $request->up_id,
                'up_tagname_en' => 'required|unique:tags,tagname_en,' . $request->up_id,


            ],
            [
                'up_tagname_bn.required' => 'Tag Bangla is Requerd',
                'up_tagname_bn.unique' => 'This Tag is Already Exist ',
                'up_tagname_en.required' => 'Tag English is Requerd',
                'up_tagname_en.unique' => 'This Tag is Already Exist '
            ],
        );


        Tag::where('id', $request->up_id)->update([

            'tagname_bn' => $request->up_tagname_bn,
            'tagname_en' => $request->up_tagname_en,


        ]);

        return response()->json([
            'status' => 'success',
        ]);

    }


    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        Toastr::error('Tag delete successfully:', 'Deleted!');
        return back();


    }


    public function inactive($id)
    {

        Tag::where('id', $id)
            ->update(['status' => 0]);
        return response()->json([
            'status' => 'success',
        ]);

    }

    public function active($id)
    {

        Tag::where('id', $id)
            ->update(['status' => 1]);
        return response()->json([
            'status' => 'success',
        ]);
    }
}