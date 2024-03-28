<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest; 

class PostsController
{
    /**
     * Display a listing of all posts.
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    /**
     * Display a single post 
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => 'Post not found'
            ], 404);
        }

        return response()->json($post);
    }

    /**
     * Create a new post.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(PostRequest $request)
    {
        $validatedData = $request->validated(); 

        $post = Post::create($validatedData);

        return response()->json([
            'message' => 'Post created successfully',
            'post' => $post
        ], 201);
    }

    /**
     * Update an existing post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(PostRequest $request, $id)
    {
        $validatedData = $request->validated(); 

        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => 'Post not found'
            ], 404);
        }

        $post->update($validatedData);

        return response()->json([
            'message' => 'Post updated successfully',
            'post' => $post
        ], 200); // '200 OK' status
    }

    /**
     * Delete a post.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => 'Post not found'
            ], 404);
        }

        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully'
        ], 200);
    }
}
