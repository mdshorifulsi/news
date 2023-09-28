<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Breakingnews;
use Brian2694\Toastr\Facades\Toastr;
use Str;

class BreakingNewsController extends Controller
{
    public function index()
    {
        $breakingnews = Breakingnews::get();
        return view('admin.breakingnews.index', compact('breakingnews'));

    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'breakingnews_bn' => 'required|unique:breakingnews|max:100',
                'breakingnews_en' => 'required|unique:breakingnews|max:100',

            ],
            [
                'breakingnews_bn.required' => 'breakingnews Bangla is Requerd',
                'breakingnews_en.required' => 'breakingnews English is Requerd',

            ],
        );

        $breakingnews = new Breakingnews;
        $breakingnews->breakingnews_bn = $request->breakingnews_bn;
        $breakingnews->breakingnews_en = $request->breakingnews_en;

        $breakingnews->save();

        return response()->json([
            'status' => 'success',
        ]);

    }


    public function update(Request $request)
    {
        $validated = $request->validate(
            [
                'up_breakingnews_bn' => 'required|unique:breakingnews,breakingnews_bn,' . $request->up_id,
                'up_breakingnews_en' => 'required|unique:breakingnews,breakingnews_en,' . $request->up_id,


            ],
            [
                'up_breakingnews_bn.required' => 'Braking Bangla is Requerd',
                'up_breakingnews_bn.unique' => 'This Braking is Already Exist ',
                'up_breakingnews_en.required' => 'Braking English is Requerd',
                'up_breakingnews_en.unique' => 'This Braking is Already Exist '
            ],
        );


        Breakingnews::where('id', $request->up_id)->update([

            'breakingnews_bn' => $request->up_breakingnews_bn,
            'breakingnews_en' => $request->up_breakingnews_en,


        ]);

        return response()->json([
            'status' => 'success',
        ]);

    }

    public function destroy($id)
    {

        $breakingnews = Breakingnews::find($id);
        $breakingnews->delete();
        Toastr::error('breakingnews delete successfully:', 'deleted!');
        return back();

    }

}