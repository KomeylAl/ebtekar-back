<?php

namespace App\Http\Controllers;

use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    public function index() {
        $categories = PostCategory::all();
        if (!$categories) {
            return response()->json('error', 300);
        }
        return response()->json($categories, 200);
    }

    public function show($id) {
        $category = PostCategory::query()->where('id', $id)->first();
        if (!$category) {
            return response()->json('error', 300);
        }
        return response()->json($category, 200);
    }
}
