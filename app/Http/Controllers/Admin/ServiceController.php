<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OnlineVideoLecture;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    //

    public  function  index(){

        $services = Service::all();
        return view('admin.service.index',compact('services'));
    }

    public function  store(Request $request){

        DB::beginTransaction();
        try {
            if($request->id){
                $service = Service::find($request->id);
            }else{
                $request->validate( [
                    'title' => 'required|max:255',
                    'link' => 'required|max:255',
                ] );
                $service = new Service();
            }
            $service->title = $request->title;
            $service->link = $request->link;
            $service->status = 'Active';
            $service->ip = $request->ip();
            $service->save();
            DB::commit();
            if($request->id){
                $output = ['success' => true,
                    'messege'            => "Service  Update success",
                ];
            }else{
                $output = ['success' => true,
                    'messege'            => "Service Create success",
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
        $service = Service::find( $id );
        $service->status = 'Active';
        $service->save();
        $output = ['success' => true,
            'messege'            => "Service  Active success",
        ];
        return $output;
    }

    public function inactive($id){
        $service = Service::find( $id );
        $service->status = 'Inactive';
        $service->save();
        $output = ['success' => true,
            'messege'            => "Service InActive success",
        ];
        return $output;
    }

    public function destroy( $id ) {
        $service = Service::find( $id );

        $service->delete();
        $output = ['success' => true,
            'messege'            => "Service Delete success",
        ];
        return $output;
    }
}
