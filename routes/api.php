<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/products', [ProductController::class,'index']);
Route::get('/products/{slug}', [ProductController::class,'show']);
Route::post('/products/add', [ProductController::class,'store']);
Route::patch('/products/{id}/edit', [ProductController::class,'update']);
Route::delete('/products/{id}/delete', [ProductController::class,'delete']);

Route::get('/product/categories', [ProductCategoryController::class,'index']);
Route::get('/product/categories/{id}', [ProductCategoryController::class,'show']);
Route::post('/product/categories/add', [ProductCategoryController::class,'store']);
Route::patch('/product/categories/{id}/edit', [ProductCategoryController::class,'update']);
Route::delete('/product/categories/{id}/delete', [ProductCategoryController::class,'delete']);

Route::get('/related-products/{cat}', [ProductController::class, 'related']);
Route::get('/main-page-products', [ProductController::class, 'mainPageProducts']);

Route::get('/hero', [HeroController::class,'index']);
Route::post('/hero/{id}/edit', [HeroController::class,'update']);

Route::get('/features', [FeatureController::class,'index']);
Route::patch('/feature/{id}/edit', [FeatureController::class,'update']);

Route::get('/info', [InfoController::class,'index']);
Route::post('/info/{id}/edit', [InfoController::class,'update']);

Route::get('/posts', [PostController::class,'index']);
Route::get('/posts/{slug}', [PostController::class,'show']);
Route::post('/posts/add', [PostController::class,'store']);
Route::patch('/posts/{id}/edit', [PostController::class,'update']);
Route::delete('/posts/{id}/delete', [PostController::class,'delete']);

Route::get('/post/categories', [PostCategoryController::class,'index']);
Route::get('/post/categories/{id}', [PostCategoryController::class,'show']);
Route::post('/post/categories/add', [PostCategoryController::class,'store']);
Route::patch('/post/categories/{id}/edit', [PostCategoryController::class,'update']);
Route::delete('/post/categories/{id}/delete', [PostCategoryController::class,'delete']);

Route::get('/main-page-posts', [PostController::class, 'mainPagePosts']);

Route::get('/comments', [CommentController::class,'index']);
Route::post('/comments/add', [CommentController::class,'store']);
Route::patch('/comments/{id}/edit', [CommentController::class,'update']);
Route::delete('/comments/{id}/delete', [CommentController::class,'delete']);

Route::get('/orders', [OrderController::class,'index']);
Route::get('/orders/{id}', [OrderController::class,'show']);
Route::post('/orders/add', [OrderController::class,'store']);
Route::delete('/orders/{id}/delete', [OrderController::class,'delete']);

Route::get('/footer', [FooterController::class,'index']);
Route::patch('/footer/{id}/edit', [FooterController::class,'update']);