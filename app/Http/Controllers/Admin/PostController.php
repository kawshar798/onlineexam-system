<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    //
    public  function  index(){

        $posts = Post::all();
        $categories = Category::where('status','Active')->get();
        return view('admin.blog.Post',compact('categories','posts'));
    }

    public function  store(Request $request){

        DB::beginTransaction();
        try {
            if($request->id){
                $post = Post::find($request->id);
            }else{
                $request->validate( [
                    'title' => 'required|unique:posts|max:255',
                ] );

                $post = new Post();
            }

            $post->title = $request->title;
            $post->slug = Str::slug($request->title);
            $post->category_id = $request->category_id;
            $post->description = $request->description;
            if ( $request->hasFile( 'image' ) ) {
                $image = $request->image;
                $file_name = $post->slug . "." . $image->getClientOriginalExtension();
                $path = 'public/assets/admin/uploads/image/post/';
                if ( !file_exists( $path ) ) {
                    mkdir( $path, 0777, true );
                }
                $image->move( $path, $file_name );
                //delete old image
                if ( $post->image ) {
                    unlink( $post->image );
                }
                $post->image = $path.$file_name;
            }

            //update same database image
            if ( $post->image ) {
                $post->image = $post->image;
            }
            $post->status = 'Active';
            $post->ip = $request->ip();
            $post->save();
            DB::commit();
            if($request->id){
                $output = ['success' => true,
                    'messege'            => "Post Update success",
                ];
            }else{
                $output = ['success' => true,
                    'messege'            => "Post Create success",
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
        $post = Post::find( $id );
        $post->status = 'Active';
        $post->save();
        $output = ['success' => true,
            'messege'            => "Post Active success",
        ];
        return $output;
    }

    public function inactive($id){
        $post = Post::find( $id );
        $post->status = 'Inactive';
        $post->save();
        $output = ['success' => true,
            'messege'            => "Post InActive success",
        ];
        return $output;
    }

    public function destroy( $id ) {
        $post = Post::find( $id );
        if (file_exists($post->image)) {
            unlink( $post->image );
        }
        $post->delete();
        $output = ['success' => true,
            'messege'            => "Post Delete success",
        ];
        return $output;
    }
}
