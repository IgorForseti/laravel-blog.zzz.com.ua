@extends('admin.layouts.layout')


@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Статьи</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Редактирование статью</h3>
                            </div>
                            <!-- /.form -->
                            <form role="form" method="post" action="{{ route('posts.update',$post->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Заголовок</label>
                                        <input type="text" name="title" class="form-control" id="title" value="{{ $post->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Цитата</label>
                                        <textarea class="form-control " name="description" id="description"
                                                  rows="5">{{ $post->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Содержание</label>
                                        <textarea class="form-control" name="content" id="content"
                                                  rows="5">{{ $post->content }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id">Категория</label>
                                        <select class="form-control" name="category_id" id="category_id">
                                            @foreach($categories as $key => $category)
                                                <option value="{{ $key }}" @if($key == $post->category_id) selected
                                                        @endif>{{ $category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tags">Теги</label>
                                        <select name="tags[]" id="tags" class="select2" multiple="multiple"
                                                data-placeholder="Выбор тегов" style="width: 100%;">
                                            @foreach($tags as $key => $tag)
                                                <option value="{{ $key }}" @if(in_array($key, $post->tags->pluck('id')->all()))
                                                                                selected @endif>{{ $tag }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="thumbnail">Изображение</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                                                <label class="custom-file-label" for="thumbnail">Выберите картинку</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2"><img src="{{ asset("storage/$post->thumbnail") }}"></div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Создать</button>
                                </div>
                            </form>
                            <!-- /.form -->
                        </div>
                    </div>
                        <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
@endsection