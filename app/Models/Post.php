<?php

namespace App\Models;

//use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title', 'description', 'content', 'category_id', 'thumbnail'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function tags() {
        //withTimestamps() заполняем поля времени создания автоматически
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function uploadImg(Request $request, $img = null)
    {
        //Если редактируем запись и миниатюра есть - удаляем старую
        $img ? self::deleteImg($img) : null;
        //Если миниатюра загружена - сохраняем ее, иначе null
        if ($request->hasFile('thumbnail')) {
            $folder = date('Y-m-d'); //путь с именем текущей даты
            //Формируем путь к картинке и сохраняем в thumbnail
            return $request->file('thumbnail')->store("image/{$folder}");
        }

        return null;
    }

    public static function deleteImg($img) {
        Storage::delete($img);
    }

    public static function noImage() {
        return "image/no-image.png";
    }

    public function getPostDate() {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d F, Y');
    }

    public static  function getPopularPosts() {
        return Self::orderBy('views', 'desc')->limit(3)->get();
    }

    public static function getLastPosts() {
        return Self::with('category')->orderby('id', 'desc')->simplePaginate(1);
    }
}
