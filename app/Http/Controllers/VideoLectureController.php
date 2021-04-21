<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoLectureController extends Controller
{
    //
    public function index(){
        return view('front-end.video-lecture');
    }
}
