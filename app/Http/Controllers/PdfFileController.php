<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfFileController extends Controller
{
    //
    public function index(){
        return view('front-end.pdfile');
    }
}
