<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use function Couchbase\defaultDecoder;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::simplePaginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Получаем массив категорий+id с pluck вида [id => title]
        $categories = Category::pluck('title', 'id')->all();
        //Аналогично для Tags
        $tags = Tag::pluck('title', 'id')->all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'thumbnail' => 'nullable|image',
        ]);

        $data = $request->all();
        $data['thumbnail'] = Post::uploadImg($request);
        $post = Post::create($data); //
        //Сохраняем массив тегов в связанную таблицу $post->tags()
        $post->tags()->sync($request->tags); // // tags - массив тегов при create
        return redirect()->route('posts.index')->with('success', 'Статья добавлена');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = Post::find($id);
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();

        $post['thumbnail'] = $post['thumbnail'] == null ? Post::noImage() : $post['thumbnail'];
        //dd($post['thumbnail']);
        return view('admin.posts.edit', compact('post', 'categories', 'tags') );
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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'thumbnail' => 'nullable|image',
        ]);
        $post = Post::find($id);
        $data = $request->all();
        //Если выбрали новое изображение - заменяем картинку
        if(array_key_exists('thumbnail', $data)) {
            $data['thumbnail'] = Post::uploadImg($request, $post->thumbnail);
        }

        $post->update($data); //
        //Сохраняем массив тегов в связанную таблицу $post->tags()
        $post->tags()->sync($request->tags); // // tags - массив тегов при create

        return redirect()->route('posts.index')->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->sync([]); // Удаляем теги из связующей таблицы
        Post::deleteImg($post->thumbnail); //Удаляем миниатюру
        $post->delete(); // Удаляем пост

        return redirect()->route('posts.index')->with('success', 'Статья удалена');
    }
}
