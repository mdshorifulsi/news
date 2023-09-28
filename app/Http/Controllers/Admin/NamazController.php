<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Namaz;
use Brian2694\Toastr\Facades\Toastr;
use Str;
use DB;

class NamazController extends Controller
{
    public function index()
    {
        // $category=Category::first();

        $namaj = DB::table('namazs')->first();
        return view('admin.namaz.index', compact('namaj'));
    }

    public function update(Request $request, $id)
    {

        $namaz = Namaz::find($id);
        $namaz->fojor = $request->fojor;
        $namaz->johor = $request->johor;
        $namaz->asor = $request->asor;
        $namaz->magrib = $request->magrib;
        $namaz->esha = $request->esha;
        $namaz->jummah = $request->jummah;

        $namaz->save();
        return redirect()->route('admin.namaz.index');

    }
}