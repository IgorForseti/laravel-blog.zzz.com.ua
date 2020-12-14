@extends('front/layouts/layout')

@section('content')
                @include('front/layouts/sidebar')

                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-wrapper">
                        <div class="blog-custom-build">
                        @if(count($posts))
                            @foreach($posts as $post)
                            <div class="blog-box wow fadeIn">
                                <div class="post-media">
                                    <a href="marketing-single.html" title="">
                                        <img src="{{ asset("storage/$post->thumbnail") }}" alt="" class="img-fluid">
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
                                            <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                                            <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                                            <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                                        </ul>
                                    </div><!-- end post-sharing -->
                                    <h4><a href="{{ route('article.single', $post->slug) }}" title="">{{ $post->title }}</a></h4>
                                    {!! $post->description !!}
                                </div><!-- end meta -->
                            </div><!-- end blog-box -->
                            <hr class="invis">
                            @endforeach
                        @else
                        <div class="blog-box wow fadeIn">
                            <div class="post-media">
                                <h2>В данной категории еще нет постов</h2>
                            </div>
                        </div>
                        @endif
                        </div>
                    </div>
                    <hr class="invis">
                </div><!-- end col -->

@endsection('content')
