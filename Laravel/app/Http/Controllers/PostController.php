<?php

namespace App\Http\Controllers;


use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function getDashboard(){
        
        $posts=Post::orderby('created_at','desc')->get();
        return view('dashboard',['posts'=>$posts]);
    }
    public function postCreatePost(Request $request){
        $this->validate($request,['title'=>'required|max:100','body'=>'required|max:1000','image' => 'image|nullable|max:2048']);
        
        $post=new Post();
        $post->title=$request['title'];
        $post->body=$request['body'];
        $path="";
        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName ();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename To store
            $imageName = $filename. '_'. time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/image', $imageName);
            $request->image->move(public_path('images'), $imageName);
            }
            // Else add a dummy image
        else {
            $imageName = 'noimage.jpg';
        }
        
        $post->name = $imageName;
        $post->path = $path;

        if($request->user()->posts()->save($post)){
            $message='Post added';
        }
        return redirect()->route('dashboard')->with(['message'=>$message]);
    }
    public function index()
    {
        return view('image');
    }
    public function getDeletePost($post_id){
        $post=Post::where('id',$post_id)->first();
        $post->delete();
        return redirect()->route('dashboard')->with(['message'=>'Successfully deleted!']);
    }
}