<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index() {
        $footer = Footer::first();
        if (!$footer) {
            return response()->json('no footer found', 404);
        }
        return response()->json($footer, 200);
    }

    public function update(Request $request, $id) {
        $footer = Footer::find($id);
        $footer->update($request->all());
        return response()->json($footer,200);
    }
}
