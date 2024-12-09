<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $posts = Post::orderBy('id', 'DESC')->get();
        $result = $posts->map(function ($post) {
            $category = PostCategory::query()->where('id', $post->post_categories_id)->first();
            $product_cat = ProductCategory::query()->where('id', $post->product_categories_id)->first();
            return [
                'id' => $post->id,
                'title' => $post->title,
                'category' => $category->title,
                'product_cat_id' => $product_cat->id,
                'product_cat_title' => $product_cat->title,
                'slug' => $post->slug,
                'body' => $post->body,
                'img_path' => $post->img_path,
                'post_categories_id' => $post->post_categories_id,
                'related_cat' => $post->product_categories_id,
                'created_at' => $post->created_at
            ];
        });
        return response()->json($result, 200);
    }

    public function store(Request $request) {
        $post = Post::create($request->all());
        return response()->json($post,201);
    }

    public function show($slug) {
        $post = Post::query()->where('slug', $slug)->first();
        if (!$post) {
            return response()->json('error', 404);
        }
        $category = PostCategory::query()->where('id', $post->post_categories_id)->first();
        $result = [
            'title' => $post->title,
            'category' => $category->title,
            'slug' => $post->slug,
            'body' => $post->body,
            'img_path' => $post->img_path,
            'post_categories_id' => $post->post_categories_id,
            'related_cat' => $post->product_categories_id,
            'created_at' => $post->created_at
        ];
        return response()->json($result,200);
    }

    public function update(Request $request, $id) {
        $post = Post::find($id);
        $post->update($request->all());
        return response()->json($post,200);
    }

    public function destroy($id) {
        $post = Post::find($id);
        $post->delete();
        return response()->json($post,200);
    }

    public function mainPagePosts() {
        $posts = Post::take(5)->get();
        if (!$posts) {
            return response()->json('no product found', 404);
        }

        return response()->json($posts, 200);
    }
}
