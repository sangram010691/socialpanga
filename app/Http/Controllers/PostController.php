<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function posts(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->post = $request->post;
        $post->user_id = Auth::user()->id;
        $post->save();

        return back()->with('msg', "successfully create a new post");
    }

    public function view_posts()
    {
        $user_id = Auth::user()->id;
        $posts = Post::where('user_id', $user_id)->get();
        $i= 1;

        return view('view_posts')->with('post', $posts)->with('i', $i);
    }

    public function update_post(Request $request)
    {
        $id = $request->id;
        $post = Post::find($id);
        $post->title = $request->title;
        $post->post= $request->post;
        $post->save();

        return back()->with('msg', 'successfully updated');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $post = Post::find($id);
        $post->delete();

        return back()->with('msg', 'successfully deleted');
    }

    public function index()
    {
        $posts = auth()->user()->posts;

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }

    public function show($id)
    {
        $post = auth()->user()->posts()->find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found '
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $post->toArray()
        ], 400);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;

        if (auth()->user()->posts()->save($post))
            return response()->json([
                'success' => true,
                'data' => $post->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Post not added'
            ], 500);
    }

    public function update(Request $request, $id)
    {
        $post = auth()->user()->posts()->find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 400);
        }

        $updated = $post->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Post can not be updated'
            ], 500);
    }

    public function destroy($id)
    {
        $post = auth()->user()->posts()->find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 400);
        }

        if ($post->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post can not be deleted'
            ], 500);
        }
    }
}
