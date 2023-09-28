<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
class LanguageController extends Controller
{
    public function english(){

        Session::get('language');
        Session::forget('language');
        Session::put('language','english');
        return redirect()->back();

    }

    public function bangla(){
        Session::get('language');
        Session::forget('language');
        Session::put('language','bangla');
        return redirect()->back();



    }
}
