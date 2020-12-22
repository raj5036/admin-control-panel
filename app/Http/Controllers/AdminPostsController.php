<?php

namespace App\Http\Controllers;
use App\Http\Requests\PostsCreateRequest;

use App\Post;
use App\Photo;
use App\Category;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::paginate(2);
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::lists('name','id')->all();
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        $input=$request->all();
        $user=Auth::user();

        if($file=$request->file('photo_id')){
            $name=time().$file->getClientOriginalName();
            $file->move('images',$name);
            $photo=Photo::create(['file'=>$name]);
            $input['photo_id']=$photo->id;
        }
        $post=new Post($input);
        $post->user_id=$user->id;
      
        $post->save();

        return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::findOrFail($id);
        $categories=Category::lists('name','id')->all();
        return view('admin.posts.edit',compact('post','categories'));
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
        $input=$request->all();

        if($file=$request->file('photo_id')){
            $name=time().$file->getClientOriginalName();
            $file->move('images',$name);
            $photo=Photo::create(['file'=>$name]);
            $input['photo_id']=$photo->id;
        }

        $photo_id=$input['photo_id'] ?? null;
        //DB::table('posts')->where('id',$id)->update($input);
        if($photo_id){
            DB::update('UPDATE posts SET category_id=?,photo_id=?,title=?,body=? WHERE id=?',[
                    $input['category_id'],
                    $input['photo_id'],
                    $input['title'],
                    $input['body'],
                    $id
                ]);
        }else{
            DB::update('UPDATE posts SET category_id=?,title=?,body=? WHERE id=?',[
                $input['category_id'],
                $input['title'],
                $input['body'],
                $id
            ]);
        }

        return redirect('admin/posts');

        return $input;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::findOrFail($id);

        unlink(public_path().$post->photo->file);

        $post->delete();

        Session::flash('deleted_user','The user has been deleted');

        return redirect('/admin/posts'); 
    }

    public function post($id){
        $post=Post::findOrFail($id);
        $comments=$post->comments()->whereIsActive(1)->get();
        return view('post',compact('post','comments')); 
    }
}
