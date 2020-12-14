<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($title) {
        $category_id = Category::where('slug',$title)->firstOrFail();
        $posts = Post::where('category_id','=', $category_id->id)->simplePaginate(10);

        return view('front.category',compact('posts'));
    }
}
