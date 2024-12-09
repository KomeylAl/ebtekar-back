<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index() {
        $features = Feature::all();
        return response()->json($features, 200);
    }

    public function update(Request $request, $id) {
        $feature = Feature::find($id);
        $feature->update($request->all());
        return response()->json($feature,200);
    }
}
