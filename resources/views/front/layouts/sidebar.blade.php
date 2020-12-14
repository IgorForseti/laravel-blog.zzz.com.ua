@section('sidebar')
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
        <div class="sidebar">
            <div class="widget">
                <h2 class="widget-title">Popular Posts</h2>
                <div class="blog-list-widget">
                    <div class="list-group">
                        @foreach($popular_posts as $post)
                        <a href="{{ route('article.single', $post->slug) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="w-100 justify-content-between">
                                <img src="{{ asset("storage/$post->thumbnail") }}" alt="" class="img-fluid float-left">
                                <h5 class="mb-1">{{ $post->title }}</h5>
                                <small>{{ $post->getPostDate() }}</small>
                                <small><i class="fa fa-eye"></i>{{ $post->views }}</small>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div><!-- end blog-list -->
            </div><!-- end widget -->

            <div class="widget">
                <h2 class="widget-title">Popular Categories</h2>
                <div class="link-widget">
                    <ul>
                        @foreach($cats as $category)
                            <li><a href="{{route('category.single', $category->slug)}}">{{ $category->title}}
                                    {{--Выводим количество постов через связь категорий и постов в модели--}}
                                    <span>{{ $category->post->count() }}</span></a>
                            </li>
                        @endforeach
                    </ul>
                </div><!-- end link-widget -->
            </div><!-- end widget -->
        </div><!-- end sidebar -->
    </div><!-- end col -->
@endsection('sidebar')