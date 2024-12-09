<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function index() {
        $hero = Hero::first();
        return response()->json($hero, 200);
    }

    public function update(Request $request, $id) {
        $hero = Hero::findOrFail($id);

        $logo = $request->file('logo');
        $logo_path = '';
        if ($logo) {
            $logo_path = $logo->store('pictures', 'public');
        }
        $logo_url = url('storage/', $logo_path);
        if (!$logo) {
            $logo_url = $hero->logo_path;
        }

        $back = $request->file('back');
        $back_path = ''; 
        if ($back) {
            $back_path = $back->store('pictures', 'public');
        }
        $back_url = url('storage/', $back_path);
        if (!$back) {
            $back_url = $hero->bg_path;
        }

        $result = $hero->update([
            'main_title' => $request->main_title,
            'description' => $request->description,
            'logo_path' => $logo_url,
            'bg_path' => $back_url,
        ]);

        return response()->json($result, 200);
    }
}
