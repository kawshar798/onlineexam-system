<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aboutus;
use App\Models\PdfFile;
use Brian2694\Toastr\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AboutusController extends Controller
{
    //

    public  function  index(Request  $request){

        if($request->isMethod('post')){
            DB::beginTransaction();
            try {
                if($request->id){
                    $about_us = Aboutus::find($request->id);
                }else{
                    $about_us = new Aboutus();
                }
                $about_us->title = $request->title;
                $about_us->description = $request->description;

                if ( $request->hasFile( 'image' ) ) {
                    $image = $request->image;
                    $file_name =Str::slug($request->title). "." . $image->getClientOriginalExtension();
                    $path = 'public/assets/admin/uploads/pdf-file/';
                    if ( !file_exists( $path ) ) {
                        mkdir( $path, 0777, true );
                    }
                    $image->move( $path, $file_name );
                    //delete old file
                    if ( $about_us->image ) {
                        unlink( $about_us->image );
                    }
                    $about_us->image = $path.$file_name;
                }

                //update same database image
                if ( $about_us->image ) {
                    $about_us->image = $about_us->image;
                }
                $about_us->ip = $request->ip();
                $about_us->save();
                DB::commit();
            }catch (\Exception $e){
                DB::rollBack();
                return $e->getMessage();
            }

        }



        $about_us = Aboutus::first();
        return view('admin.about-us.index',compact('about_us'));
    }
}
