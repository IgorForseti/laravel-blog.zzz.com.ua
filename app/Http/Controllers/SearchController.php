<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request) {
        $request->validate([
            's' => 'required|min:1',
            ]);

        $s = $request->s;
        $articles = Post::where("title", "LIKE", "%{$request->s}%")->orWhere("content", "LIKE", "%{$request->s}%")->simplePaginate(2);
        $recentPosts = Post::orderby('id', 'desc')->limit(3)->get();

        return view('front.search', compact('articles', 'recentPosts'));
    }
}
