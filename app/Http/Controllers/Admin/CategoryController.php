<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Str;


class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::get();
        return view('admin.category.index', compact('category'));

    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'catname_bn' => 'required|unique:categories|max:100',
                'catname_en' => 'required|unique:categories|max:100',

            ],
            [
                'catname_bn.required' => 'Category Bangla is Requerd',
                'catname_bn.unique' => 'This Category is Already Exist ',
                'catname_en.required' => 'Category English is Requerd',
                'catname_en.unique' => 'This Category is Already Exist '
            ],
        );

        $category = new Category;
        $category->catname_bn = $request->catname_bn;
        $category->catname_en = $request->catname_en;
        $category->catslug_bn = Str::slug($request->catname_bn);
        $category->catslug_en = Str::slug($request->catname_en);
        $category->save();

        return response()->json([
            'status' => 'success',
        ]);



    }

    public function update(Request $request)
    {
        $validated = $request->validate(
            [
                'up_catname_bn' => 'required|unique:categories,catname_bn,' . $request->up_id,
                'up_catname_en' => 'required|unique:categories,catname_en,' . $request->up_id,


            ],
            [
                'up_catname_bn.required' => 'Category Bangla is Requerd',
                'up_catname_bn.unique' => 'This Category is Already Exist ',
                'up_catname_en.required' => 'Category English is Requerd',
                'up_catname_en.unique' => 'This Category is Already Exist '
            ],
        );


        Category::where('id', $request->up_id)->update([

            'catname_bn' => $request->up_catname_bn,
            'catname_en' => $request->up_catname_en,


        ]);

        return response()->json([
            'status' => 'success',
        ]);

    }


    public function destroy($id)
    {

        $category = Category::find($id);
        $category->delete();
        Toastr::error('category delete successfully:', 'deleted!');
        return back();

    }


    public function inactive($id)
    {

        Category::where('id', $id)
            ->update(['status' => 0]);
        return response()->json([
            'status' => 'success',
        ]);

    }

    public function active($id)
    {

        Category::where('id', $id)
            ->update(['status' => 1]);
        return response()->json([
            'status' => 'success',
        ]);
    }
}