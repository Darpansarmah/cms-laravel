<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\posts\CreatePostRequest;
use App\Http\Requests\posts\UpdatePostRequest;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function __construct() {

        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('posts.index', ['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        //
        $image = $request->image->store('posts');

        // if($image = $request->file('image')){
        // $name = $image->getClientOriginalName();
        // $image->move(public_path('storage/posts'), $name);
        // }

        $post = Post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request->content,
            'image'=>$image,
            'published_at'=>$request->published_at,
            'category_id'=>$request->category,
            'user_id'=>auth()->user()->id
        ]);

        if($request->tags) {
            $post->tags()->attach($request->tags);
        }

        session()->flash('success', 'Post Created Successfully');

        return redirect()->route('posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        return view('blog.show', ['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
        $data = $request->only(['title', 'description', 'content', 'published_at', 'category_id']);

        if($request->hasFile('image')){
            $image = $request->image->store('posts');
            $data['image'] = $image; 
        }

        $data['category_id'] = $request->category;
        // if($request->hasFile('image')){
        //     $image = $request->image;
        //     $name = $image->getClientOriginalName();
        //     $image->move(public_path('storage/posts'), $name);
        //     }

        // Storage::delete($post->image);

        $post->deleteImage();

        if($request->tags) {
            $post->tags()->sync($request->tags);
        }
            
        $post->update($data);

        session()->flash('success', 'Post Updated Successfully');

        return redirect()->route('posts.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::withTrashed()->whereId($id)->firstOrFail();

        if($post->trashed()) {

        // File::delete('storage/posts/'.$post->image);   
        // Storage::delete($post->image);
        $post->deleteImage();
        $post->forceDelete();     
        session()->flash('success', 'Post Deleted Permanently');

        } else {

        $post->delete();
        session()->flash('success', 'Post Trashed Successfully'); 
    }

        return back();

    }

    public function trashed() {

        $trashed = Post::onlyTrashed()->get();

        return view('posts.index', ['posts'=>$trashed]);

    }

    public function restore($id) {

        $post = Post::onlyTrashed()->whereId($id)->firstOrFail();

        $post->restore();

        session()->flash('success', 'Post Restored Successfully');

        return back();

    }

    public function category(Category $category) {
        $posts = $category->posts()->searched()->simplePaginate(4);
        $categories = Category::all();
        $tags = Tag::all();
        return view('blog.category', compact('categories', 'category', 'tags', 'posts'));
    }

    public function tag(Tag $tag) {
        $posts = $tag->posts()->searched()->simplePaginate(4);
        $tags = Tag::all();
        $categories = Category::all();
        return view('blog.tag', compact('tags', 'tag', 'categories', 'posts'));
    }
}
