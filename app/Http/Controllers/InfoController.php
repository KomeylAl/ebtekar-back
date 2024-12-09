<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index() {
        $info = Info::first();
        if (!$info) {
            return response()->json('error', 500);
        }
        return response()->json($info, 200);
    }

    public function update(Request $request, $id) {
        $info = Info::find($id);
        
        // $imagePath = '';
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('uploads', 'public');
        // }

        $file = $request->file('image');
        $filePath = '';
        if ($file) {
            $filePath = $file->store('pictures', 'public');
        }
        $fileUrl = url('storage/', $filePath);
        if (!$file) {
            $fileUrl = $info->logo_path;
        }

        $info->update([
            'company_name' => $request->company_name,
            'description' => $request->description,
            'address' => $request->address,
            'phone_numbers' => $request->phone_numbers,
            'email' => $request->email,
            'logo_path' => $fileUrl,
        ]);

        return response()->json($info,200);
    }
}
