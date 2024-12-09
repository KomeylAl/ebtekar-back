<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index() {
        $comments = Comment::take(4)->get();
        if (!$comments) {
            return response()->json('no comment found', 404);
        }
        return response()->json($comments, 200);
    }

    public function store(Request $request) {
        $comment = Comment::create($request->all());
        return response()->json($comment,201);
    }

    public function update(Request $request, $id) {
        $comment = Comment::findOrFail($id);
        $comment->update($request->all());
        return response()->json($comment,200);
    }

    public function destroy($id) {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return response()->json($comment,200);
    }
}
