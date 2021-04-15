<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogCategoryController extends Controller
{
    //
    public  function  index(){

        $categories = Category::all();
        return view('admin.blog.category',compact('categories'));
    }

    public function  store(Request $request){

        DB::beginTransaction();
        try {
            if($request->id){
                $category = Category::find($request->id);
            }else{
                $request->validate( [
                    'name' => 'required|unique:categories|max:255',
                ] );

                $category = new Category();
            }

            $category->name = $request->name;
            $category->status = 'Active';
            $category->ip = $request->ip();
            $category->save();
            DB::commit();
            if($request->id){
                $output = ['success' => true,
                    'messege'            => "Category Update success",
                ];
            }else{
                $output = ['success' => true,
                    'messege'            => "Category Create success",
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
        $category = Category::find( $id );
        $category->status = 'Active';
        $category->save();
        $output = ['success' => true,
            'messege'            => "Category Active success",
        ];
        return $output;
    }

    public function inactive($id){
        $category = Category::find( $id );
        $category->status = 'Inactive';
        $category->save();
        $output = ['success' => true,
            'messege'            => "Category InActive success",
        ];
        return $output;
    }

    public function destroy( $id ) {
        $category = Category::find( $id );
        $category->delete();
        $output = ['success' => true,
            'messege'            => "Category Delete success",
        ];
        return $output;
    }
}
