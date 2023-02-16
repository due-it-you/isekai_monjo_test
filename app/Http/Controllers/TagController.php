<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tag;

class TagController extends Controller
{
    public function store(Request $request)
    {
        $tag = Tag::firstOrCreate([
            'tag_label' => $request->input('tag_label')
        ]);
        return response()->json($tag);
    }
}
