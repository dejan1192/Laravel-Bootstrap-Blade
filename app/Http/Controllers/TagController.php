<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    
    public function __construct(){

        $this->middleware('auth');
    }

    public function index(){

        $tagList = Tag::all();

        return view('tags.index', compact('tagList'));
    }

    
    public function create(){

        $availableTags = Tag::all();

        return view('tags.create', compact('availableTags'));
    }

    public function store(Request $request){

       

        $tag = Tag::create([
            'name' => $request->input('tag_name')
        ]);

        return back();
    }
}
