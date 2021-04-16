<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OnlineVideoLecture;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoLectureController extends Controller
{
    //
    public  function  index(){

        $videoLectures = OnlineVideoLecture::all();
        return view('admin.video-lecture.index',compact('videoLectures'));
    }

    public function  store(Request $request){

        DB::beginTransaction();
        try {
            if($request->id){
                $videoLecture = OnlineVideoLecture::find($request->id);
            }else{
                $request->validate( [
                    'title' => 'required|max:255',
                    'link' => 'required|max:255',
                ] );
                $videoLecture = new OnlineVideoLecture();
            }
            $videoLecture->title = $request->title;
            $videoLecture->link = $request->link;
            if ( $request->hasFile( 'image' ) ) {
                $image = $request->image;
                $file_name = time().rand() . "." . $image->getClientOriginalExtension();
                $path = 'public/assets/admin/uploads/image/video-lecture/';
                if ( !file_exists( $path ) ) {
                    mkdir( $path, 0777, true );
                }
                $image->move( $path, $file_name );
                //delete old image
                if ( $videoLecture->thumbnail ) {
                    unlink( $videoLecture->thumbnail );
                }
                $videoLecture->thumbnail = $path.$file_name;
            }

            //update same database image
            if ( $videoLecture->thumbnail ) {
                $videoLecture->thumbnail = $videoLecture->thumbnail;
            }
            $videoLecture->status = 'Active';
            $videoLecture->ip = $request->ip();
            $videoLecture->save();
            DB::commit();
            if($request->id){
                $output = ['success' => true,
                    'messege'            => "Video Lecture  Update success",
                ];
            }else{
                $output = ['success' => true,
                    'messege'            => "Video Lecture Create success",
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
        $videoLecture = OnlineVideoLecture::find( $id );
        $videoLecture->status = 'Active';
        $videoLecture->save();
        $output = ['success' => true,
            'messege'            => "Video Lecture Active success",
        ];
        return $output;
    }

    public function inactive($id){
        $videoLecture = OnlineVideoLecture::find( $id );
        $videoLecture->status = 'Inactive';
        $videoLecture->save();
        $output = ['success' => true,
            'messege'            => "Video Lecture InActive success",
        ];
        return $output;
    }

    public function destroy( $id ) {
        $videoLecture = OnlineVideoLecture::find( $id );
        if (file_exists($videoLecture->thumbnail)) {
            unlink( $videoLecture->thumbnail );
        }
        $videoLecture->delete();
        $output = ['success' => true,
            'messege'            => "Video Lecture Delete success",
        ];
        return $output;
    }
}
