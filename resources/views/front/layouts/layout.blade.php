<!DOCTYPE html>
<html lang="en">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Site Metas -->
<title>Markedia - Marketing Blog Template</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<!-- Site Icons -->
<link rel="shortcut icon" href="{{ asset('/assets/front/images/favicon.ico') }}" type="image/x-icon" />
<link rel="apple-touch-icon" href="{{ asset('/assets/front/images/apple-touch-icon.png') }}">

<!-- Design fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/assets/front/css/front.css') }}">
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>

<div id="wrapper">
    <header class="market-header header">
        <div class="container-fluid">
            <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('/assets/front/images/version/market-logo.png') }}" alt=""></a>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                    @foreach($cats as $cat)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('category.single', $cat->slug) }}">{{ $cat->title }}</a>
                        </li>
                    @endforeach
                    @if (Auth::check() && Auth::user()->is_admin)
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.index')}}">Админка</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('logout')}}"><span>Выйти</span></a></li>                               
                    @elseif (Auth::check() && !Auth::user()->is_admin)
                        <li class="nav-item"><a class="nav-link" href="{{route('logout')}}"><span>Выйти</span></a></li>
                    @else                               
                        <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('user.create')}}"><span>Регистрация</span></a></li>                               
                    @endif
                    </ul>
                    <form class="form-inline" method="get" action="{{ route('search') }}">
                        <input class="form-control mr-sm-2 @error ('s') is-invalid
                           @enderror" name="s" type="text" placeholder="How may I help?">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </nav>
        </div><!-- end container-fluid -->
    </header><!-- end market-header -->

    @yield('banner')
    <section class="section lb @if(!Request::is('/')) m3rem @endif">
        <div class="container">
            <div class="row">
                {{--content--}}
                @yield('content')
                {{--end content--}}
                @yield('sidebar')
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="widget">
                        <h2 class="widget-title">Recent Posts</h2>
                        <div class="blog-list-widget">
                            <div class="list-group">
                                <div class="list-group">
                                    @foreach($last_posts as $post)
                                        <a href="{{ route('article.single', ['slug' => $post->slug]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between">
                                                <img src="{{ asset("storage/$post->thumbnail") }}" alt="" class="img-fluid float-left">
                                                <h5 class="mb-1">{{ $post->title }}</h5>
                                                <small>{{ $post->getPostDate() }}</small>
                                                <small><i class="fa fa-eye"></i>{{ $post->views }}</small>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div><!-- end blog-list -->
                    </div><!-- end widget -->
                </div><!-- end col -->

                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
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
                </div><!-- end col -->

                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
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
                </div><!-- end col -->
            </div><!-- end row -->
            <div class="row">
                <div class="col-md-12 text-center">
                    <br>
                    <br>
                    <div class="copyright">&copy; Markedia. Design: <a href="http://html.design">HTML Design</a>.</div>
                </div>
            </div>
        </div><!-- end container -->
    </footer><!-- end footer -->

    <div class="dmtop">Scroll to Top</div>

</div><!-- end wrapper -->

<!-- Core JavaScript
================================================== -->
<script src="{{ asset('assets/front/js/front.js') }}"></script>

</body>
</html>								