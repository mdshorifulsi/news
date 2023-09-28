<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Brian2694\Toastr\Facades\Toastr;
use DB;
class SettingController extends Controller
{
    public function index()
    {
        // $category=Category::first();

        $setting = DB::table('settings')->first();
        return view('admin.setting.index', compact('setting'));
    }

    public function update(Request $request, $id)
    {

        $setting = Setting::find($id);
        $setting->project_name = $request->project_name;
        $setting->email = $request->email;
        
        if ($request->hasFile('project_logo')) {
            $file = $request->file('project_logo');
            $name = rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
            $setting->project_logo = $request->file('project_logo')->move("images/setting", $name);
        }

        $setting->save();
        Toastr::success('Setting successfully updated:', 'update!');
        return redirect()->route('admin.setting.index');

    }
}
