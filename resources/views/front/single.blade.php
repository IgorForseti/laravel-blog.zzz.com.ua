@extends('front.layouts.layout')

@section('content')
    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
        <div class="page-wrapper">
            <div class="blog-title-area">
                <ol class="breadcrumb hidden-xs-down">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('category.single', $article->category->title) }}">{{ $article->category->title }}</a></li>
                    <li class="breadcrumb-item active">{{ $article->title }}</li>
                </ol>

                <span class="color-yellow"><a href="marketing-category.html" title="">{{ $article->category->title }}</a></span>

                <h3>{{ $article->title }}</h3>

                <div class="blog-meta big-meta">
                    <small>{{ $article->getPostDate() }}</small>
                    <small><i class="fa fa-eye"></i>{{ $article->views}}</small>
                </div><!-- end meta -->

                <div class="post-sharing">
                    <ul class="list-inline">
                        <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span
                                        class="down-mobile">Share on Facebook</span></a></li>
                        <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span
                                        class="down-mobile">Tweet on Twitter</span></a></li>
                        <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div><!-- end post-sharing -->
            </div><!-- end title -->

            <div class="single-post-media">
                <img src="{{ asset("storage/$article->thumbnail") }}" alt="" class="img-fluid">
            </div><!-- end media -->

            <div class="blog-content">

                <div class="pp">
                    {!!  $article->content  !!}
                </div><!-- end pp -->

            </div><!-- end content -->

            <div class="blog-title-area">
            @if($article->tags->count())
                <div class="tag-cloud-single">
                    <span>Tags</span>
                    @foreach($article->tags as $key => $tag)
                        <small><a href="{{route('tag.single', $tag->slug)}}" title="">{{$tag->title }}</a></small>
                    @endforeach
                </div><!-- end meta -->
            @endif
                <div class="post-sharing">
                    <ul class="list-inline">
                        <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span
                                        class="down-mobile">Share on Facebook</span></a></li>
                        <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span
                                        class="down-mobile">Tweet on Twitter</span></a></li>
                        <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div><!-- end post-sharing -->
            </div><!-- end title -->
        </div><!-- end page-wrapper -->
    </div><!-- end col -->

    @include('front.layouts.sidebar')
@endsection('content')