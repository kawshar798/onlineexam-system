<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PdfFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class PdfFileController extends Controller
{
    //
    public  function  index(){

        $videoLectures = PdfFile::all();
        return view('admin.pdf-file.index',compact('videoLectures'));
    }

    public function  store(Request $request){

        DB::beginTransaction();
        try {
            if($request->id){
                $pdffile = PdfFile::find($request->id);
            }else{
                $request->validate( [
                    'file_name' => 'required|max:255',
                    'file' => 'required',
                ] );
                $pdffile = new PdfFile();
            }
            $pdffile->file_name = $request->file_name;

            if ( $request->hasFile( 'file' ) ) {
                $image = $request->file;
                $file_name =Str::slug($request->file_name). "." . $image->getClientOriginalExtension();
                $path = 'public/assets/admin/uploads/pdf-file/';
                if ( !file_exists( $path ) ) {
                    mkdir( $path, 0777, true );
                }
                $image->move( $path, $file_name );
                //delete old file
                if ( $pdffile->file ) {
                    unlink( $pdffile->file );
                }
                $pdffile->file = $path.$file_name;
            }

            //update same database image
            if ( $pdffile->file ) {
                $pdffile->file = $pdffile->file;
            }
            $pdffile->status = 'Active';
            $pdffile->ip = $request->ip();
            $pdffile->save();
            DB::commit();
            if($request->id){
                $output = ['success' => true,
                    'messege'            => "PDF file  Update success",
                ];
            }else{
                $output = ['success' => true,
                    'messege'            => "PDF file Create success",
                ];
            }

            return $output;
        } catch ( Exception $e ) {
            DB::rollBack();
            $output = ['alert-type' => 'error',
                'messege'            => "Something Wrong",
            ];
            return $output;
        }
    }



    public function active($id){
        $pdffile = PdfFile::find( $id );
        $pdffile->status = 'Active';
        $pdffile->save();
        $output = ['success' => true,
            'messege'            => "PDF file Active success",
        ];
        return $output;
    }

    public function inactive($id){
        $pdffile = PdfFile::find( $id );
        $pdffile->status = 'Inactive';
        $pdffile->save();
        $output = ['success' => true,
            'messege'            => "PDF file InActive success",
        ];
        return $output;
    }

    public function destroy( $id ) {
        $pdffile = PdfFile::find( $id );
        if (file_exists($pdffile->file)) {
            unlink( $pdffile->file );
        }
        $pdffile->delete();
        $output = ['success' => true,
            'messege'            => "PDF file Delete success",
        ];
        return $output;
    }
}
