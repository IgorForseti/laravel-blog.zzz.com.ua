<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $posts = Post::getLastPosts();
        //$categories = Category::with('post')->get();

        return view('home', compact('posts'));
    }

    public function show($slug) {
        $article = Post::where('slug', $slug)->firstOrFail();
        $article->views += 1;
        $article->update();
        $categories = Category::with('post')->get();
        $posts = Post::with('category')->orderby('id', 'desc')->limit(2);

        return view('front.single', compact( 'posts','categories' , 'article'));
    }
}
