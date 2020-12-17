<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class PostTagController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }


    public function index($tag){

        

        $tag = Tag::findOrFail($tag);

        return view('welcome', [
            'posts' => $tag->blogPosts()
                ->withRelations()
                ->latest()
                ->get(),
        ]);

    }
}
