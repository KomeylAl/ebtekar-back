<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index() {
        $categories = ProductCategory::all();
        if (!$categories) {
            return response()->json('error', 300);
        }
        return response()->json($categories, 200);
    }

    public function show($id) {
        $category = ProductCategory::query()->where('id', $id)->first();
        if (!$category) {
            return response()->json('error', 300);
        }
        return response()->json($category, 200);
    }
}
