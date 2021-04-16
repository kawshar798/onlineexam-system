<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    //
    public  function  index(){

        $teams = Team::all();
        return view('admin.team.index',compact('teams'));
    }

    public function  store(Request $request){

        DB::beginTransaction();
        try {
            if($request->id){
                $team = Team::find($request->id);
            }else{
                $request->validate( [
                    'name' => 'required|max:255',
                ] );
                $team = new Team();
            }
            $team->name = $request->name;
            $team->email = $request->email;
            $team->facebook = $request->facebook;
            if ( $request->hasFile( 'image' ) ) {
                $image = $request->image;
                $file_name = time().rand() . "." . $image->getClientOriginalExtension();
                $path = 'public/assets/admin/uploads/image/team/';
                if ( !file_exists( $path ) ) {
                    mkdir( $path, 0777, true );
                }
                $image->move( $path, $file_name );
                //delete old image
                if ( $team->photo ) {
                    unlink( $team->photo );
                }
                $team->photo = $path.$file_name;
            }

            //update same database image
            if ( $team->photo ) {
                $team->photo = $team->photo;
            }
            $team->status = 'Active';
            $team->ip = $request->ip();
            $team->save();
            DB::commit();
            if($request->id){
                $output = ['success' => true,
                    'messege'            => "Team Member  Update success",
                ];
            }else{
                $output = ['success' => true,
                    'messege'            => "Team Member Create success",
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
        $team = Team::find( $id );
        $team->status = 'Active';
        $team->save();
        $output = ['success' => true,
            'messege'            => "Team Member Active success",
        ];
        return $output;
    }

    public function inactive($id){
        $team = Team::find( $id );
        $team->status = 'Inactive';
        $team->save();
        $output = ['success' => true,
            'messege'            => "Team Member InActive success",
        ];
        return $output;
    }

    public function destroy( $id ) {
        $team = Team::find( $id );
        if (file_exists($team->photo)) {
            unlink( $team->photo );
        }
        $team->delete();
        $output = ['success' => true,
            'messege'            => "Team Member Delete success",
        ];
        return $output;
    }
}
