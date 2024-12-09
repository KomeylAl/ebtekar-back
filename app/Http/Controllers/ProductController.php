<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $products = Products::orderBy('id', 'DESC')->get();
        if (!$products) {
            return response('not found', 404);
        }
        $result = $products->map(function ($product) {
            $images = DB::table('product_images')->where('product_id', $product->id)->first();
            $cat = ProductCategory::find($product->product_categories_id)->first();
            return [
                'id' => $product->id,
                'title' => $product->title,
                'description' => $product->description,
                'slug' => $product->slug,
                'price' => $product->price,
                'images' => $images->img_path,
                'category' => $cat->title
            ];
        });
        return response()->json($result, 200);
    }

    public function store(Request $request){
        $product = Products::create($request->all());
        return response()->json($product, 201);
    }

    public function show($slug){
        $product = Products::query()->where('slug', $slug)->first();
        if (!$product) {
            return response('not found', 404);
        }
        $images = DB::table('product_images')->where('product_id', $product->id)->get();
        $cat = ProductCategory::find($product->product_categories_id)->first();
        $result = [
            'title' => $product->title,
            'description' => $product->description,
            'slug' => $product->slug,
            'price' => $product->price,
            'images' => $images,
            'category' => $cat->title,
            'created_at' => $product->created_at
        ];
        return response()->json($result, 200);
    }

    public function update(Request $request ,$id){
        $product = Products::find($id);
        $product->update($request->all());
        return response()->json($product, 200);
    }

    public function destroy($id){
        $product = Products::find($id);
        $product->delete();
        return response()->json($product, 200);
    }

    public function related($cat) {
        $products = Products::query()->where('product_categories_id', $cat)
            ->take(5)->get();
        
        if (!$products) {
            return response()->json('no product found', 404);
        }

        $result = $products->map(function ($product) {
            $images = DB::table('product_images')->where('product_id', $product->id)->first();
            return [
                'id' => $product->id,
                'title' => $product->title,
                'description' => $product->description,
                'slug' => $product->slug,
                'price' => $product->price,
                'images' => $images->img_path
            ];
        });
        return response()->json($result, 200);
    }

    public function mainPageProducts() {
        $products = Products::take(5)->get();
        
        if (!$products) {
            return response()->json('no product found', 404);
        }

        $result = $products->map(function ($product) {
            $images = DB::table('product_images')->where('product_id', $product->id)->first();
            return [
                'id' => $product->id,
                'title' => $product->title,
                'description' => $product->description,
                'slug' => $product->slug,
                'price' => $product->price,
                'images' => $images->img_path
            ];
        });
        return response()->json($result, 200);
    }
}
