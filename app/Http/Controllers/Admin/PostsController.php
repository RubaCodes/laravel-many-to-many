<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $request->validate([
            "title" => "string|required|max:255",
            "content" => "string|required|max:65535",
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            "published" => "sometimes|accepted"
        ]);
        //store
        $data = $request->all();
        $newPost = new Post();
        $newPost->title = $data['title'];
        $newPost->content = $data['content'];
        $newPost->published = isset($data['published']);
        $newPost->category_id = $data['category_id'];
        $newPost->slug = Str::of($data['title'])->slug('-');
        $newPost->save();

        //sync su pivot
        if(isset($data['tags'])){
            $newPost->tags()->sync($data['tags']);
        }
        //return
        return redirect()->route('admin.posts.show', $newPost->id);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        return view('admin.posts.show ', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        //gestione dei tag per l'old
        $tags = Tag::all();
        //cast da collection to array 
        $postTags = $post->tags->map(function ($item) {
            return $item->id;
        })->toArray();

        return view('admin.posts.edit' , compact('post','categories','tags','postTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //validate
        $request->validate([
            "title" => "string|required|max:255",
            "content" => "string|required|max:65535",
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            "published" => "sometimes|accepted"
            
        ]);

        $data = $request->all();
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->published = isset($data['published']);
        $post->category_id = $data['category_id'];
        $post->slug = Str::of($data['title'])->slug('-');
        $post->save();

        //sync su pivot
        //se viene passato l'array allora vale l'array stesso altrimenti vuoto e sync
        $tags = isset($data['tags']) ? $data['tags'] : [];
        $post->tags()->sync($tags);
        
        return redirect()->route('admin.posts.show', $post->id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
