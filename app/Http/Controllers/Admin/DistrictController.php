<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use Brian2694\Toastr\Facades\Toastr;
use Str;

class DistrictController extends Controller
{
    public function index()
    {
        $district = District::get();
        return view('admin.district.index', compact('district'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'districtname_bn' => 'required|unique:districts|max:150',
                'districtname_en' => 'required|unique:districts|max:150',

            ],
            [
                'districtname_bn.required' => 'District Bangla is Requerd',
                'districtname_bn.unique' => 'This District is Already Exist',
                'districtname_en.required' => 'Category English is Requerd',
                'catname_en.unique' => 'This District is Already Exist '
            ],
        );


        $district = new District;
        $district->districtname_bn = $request->districtname_bn;
        $district->districtname_en = $request->districtname_en;
        $district->districtslug_bn = Str::slug($request->districtname_bn);
        $district->districtslug_en = Str::slug($request->districtname_en);
        $district->save();


        return response()->json([
            'status' => 'success',
        ]);
    }


    public function update(Request $request)
    {


        $validated = $request->validate(
            [
                'up_districtname_bn' => 'required|unique:districts,districtname_bn,' . $request->up_id,
                'up_districtname_en' => 'required|unique:districts,districtname_en,' . $request->up_id,


            ],
            [
                'up_districtname_bn.required' => 'District Bangla is Requerd',
                'up_districtname_bn.unique' => 'This District is Already Exist ',
                'up_districtname_en.required' => 'District English is Requerd',
                'up_districtname_en.unique' => 'This District is Already Exist '
            ],
        );


        District::where('id', $request->up_id)->update([

            'districtname_bn' => $request->up_districtname_bn,
            'districtname_en' => $request->up_districtname_en,

        ]);

        return response()->json([
            'status' => 'success',
        ]);



    }

    public function destroy($id)
    {
        $district = District::find($id);
        $district->delete();
        Toastr::error('district delete successfully:', 'deleted!');
        return back();

    }


}