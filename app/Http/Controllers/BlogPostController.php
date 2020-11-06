<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\BlogPost;
use Illuminate\Database\Query\Builder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{

    public function __construct()
    {
         $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $following = User::with('followers')->find(Auth::id())->followees;

      
        $allUsers = User::where('id','!=', Auth::id())->take(6)->get();
    
       $notFollowed = $allUsers->diff($following);
    
       $peopleYouMightKnow = $notFollowed->all();
  
     
        $posts = BlogPost::with('tags')
        ->latest()
        ->withCount('comments')
        ->whereIn('user_id', [Auth::id(), ...$following->pluck('id')->toArray()])
        ->get();
    
       
        $recentPosts = BlogPost::with('user')->latest()->take(3)->get();
        

        return view('welcome', compact('posts','recentPosts', 'peopleYouMightKnow'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPost $request)
    {
        
        $validatedData = $request->validated();
       if($request->hasfile('image'))
        {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
         
            $extension = $request->file('image')->extension();
          
            $newFileName = $filename .time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/post-images', $newFileName);
        }else{
            $newFileName = 'noimage.jpg';
        }

    
        $post = new BlogPost();
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->user_id = Auth::id();
        $post->image = $newFileName;
        $post->save();

        return redirect()->route('index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = BlogPost::with(['tags', 'comments', 'user'])->findOrFail($id);

        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($postId)
    {
        //
        $post = BlogPost::findOrFail($postId);
        Gate::authorize('delete-post', $post);
        $post->delete();

        return redirect()->route('index');
    }
}
