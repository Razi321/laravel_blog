<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use\Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Nullable;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(6);

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request ,[
            'title' => 'required' ,
            'body' => 'required' ,
            'cover_image' =>'image|Nullable|max:1999'
        ]);

        //handle file upload
        if($request->hasFile('cover_image')){
            //get filename with the extension
            $fileNameWithExt=$request->file('cover_image')->getClientOriginalName();
            //get just filename
            $filename=pathinfo($fileNameWithExt , PATHINFO_FILENAME);

            //get just extension
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //upload image
            $path=$request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        } else {
            $fileNameToStore ='noimage.png';
        }
        //create post
        $post = new post;
        $post ->title =$request->input('title');
        $post ->body =$request->input('body');
        $post ->user_id = auth()->user()->id;
        $post->cover_image =$fileNameToStore;
        $post->save();
        return redirect('/Posts')->with('success','post created');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        //check the correct user

        if(auth()->user()->id !==$post->user_id){
            return redirect('/Posts')->with('error','unauthorized page');

        }
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this -> validate($request ,[
            'title' => 'required' ,
            'body' => 'required'
        ]);

        if($request->hasFile('cover_image')){
            //get filename with the extension
            $fileNameWithExt=$request->file('cover_image')->getClientOriginalName();
            //get just filename
            $filename=pathinfo($fileNameWithExt , PATHINFO_FILENAME);

            //get just extension
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //upload image
            $path=$request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        }

        //create post
        $post = Post::find($id);
        $post ->title =$request->input('title');
        $post ->body =$request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image= $fileNameToStore;
        }
        $post->save();
        return redirect('/Posts')->with('success','post updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !==$post->user_id){
            return redirect('/Posts')->with('error','unauthorized page');

        }

        if($post->cover_image !=='noimage.jpg'){
            Storage::delete('public/cover_images/'.$post->cover_image);

        }
        $post->delete();
        return redirect('/Posts')->with('success','post removed');
    }
}
