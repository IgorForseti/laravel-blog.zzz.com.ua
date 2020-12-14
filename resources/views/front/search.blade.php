@extends('front.layouts.layout')
@section('content')
    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
    @if(count($articles))
        @foreach($articles as $post)
            <div class="page-wrapper">
                <div class="blog-custom-build">
                    <div class="blog-box wow fadeIn">
                        <div class="post-media">
                            <a href="{{ route("article.single", $post->slug) }}">
                                <img src="{{ asset("storage/$post->thumbnail")}}" alt="" class="img-fluid">
                                <div class="hovereffect">
                                    <span></span>
                                </div>
                                <!-- end hover -->
                            </a>
                        </div>
                        <!-- end media -->
                        <div class="blog-meta big-meta text-center">
                            <div class="post-sharing">
                                <ul class="list-inline">
                                    <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span
                                                    class="down-mobile">Share on Facebook</span></a></li>
                                    <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span
                                                    class="down-mobile">Tweet on Twitter</span></a></li>
                                    <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a>
                                    </li>
                                </ul>
                            </div><!-- end post-sharing -->
                            <h4><a href="{{ route("article.single", $post->slug) }}" title="">{{ $post->title }}</a></h4>
                            <p>{!! $post->description !!}</p>
                            <small>
                                <a href="{{ route("category.single", $post->category->slug) }}" title="">{{ $post->category->title }}</a>
                            </small>
                            <small>24 July, 2017</small>
                            <small>{{ $post->getPostDate() }}</small>
                            <small><i class="fa fa-eye"></i> {{ $post->views }}</small>
                        </div><!-- end meta -->
                    </div><!-- end blog-box -->

                    <hr class="invis">

                </div>
            </div>

            <hr class="invis">
        @endforeach
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="Page navigation">
                    {{ $articles->links() }}
                </nav>
            </div><!-- end col -->
        </div><!-- end row -->
    @else
            <div class="page-wrapper">
                <div class="blog-custom-build">
                    <div class="blog-box wow fadeIn">
                        <div class="post-media">
                            <h2>По вашему запросу не найдено упоминаний</h2>
                        </div>
                    </div>
                </div>
            </div>
    @endif
    </div><!-- end col -->
    @extends('front.layouts.sidebar')
@endsection('content')