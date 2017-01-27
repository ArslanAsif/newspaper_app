@extends('layouts.app')

@section('content')
    <!-- Pageline -->
    <div class="rst-pageline container" style="margin-top: -32px">
        <div class="row">
            <div class="col-xs-12">
                <div class="rst-pageline-content">
                    <span>Headlines</span>
                    <div class="rst-pageline-slider owl-carousel">
                        @foreach($headlines as $headline)
                            @if($headline->category->active == 1 && $headline->category->latest == 1)
                                <p>{{ $headline->category->name }}: {{ $headline->title }}</p>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end pageline -->

    <!-- Home page Main Slider -->
    <section id="rst-home-mainslider">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-xs-12">
                    @if(isset($main_spotlight))
                    @if($main_spotlight->type == 'news')
                        <div>
                            <div class="rst-postpic">
                                <a href="{{ url('article/'.$main_spotlight->id) }}"><img class="img-border" width=100% src="{{ isset($main_spotlight->picture) ? url('images/news/'.$main_spotlight->picture) : url('images/slider/category/li01.jpg') }}" alt="" /></a>
                                <a class="rst-postpic-cat" href="{{ url('/category/news/'.$main_spotlight->category->id) }}"><span>{{ $main_spotlight->category->name }}</span></a>
                            </div>
                            <div class="rst-postinfo" >
                                <h6 class="h6-title"><a href="{{ url('article/'.$main_spotlight->id) }}">{{ $main_spotlight->title }}</a></h6>
                                <time><i class="fa fa-clock-o"></i>{{ $main_spotlight->publish_date }}</time>
                                <p>{{ $main_spotlight->summary.'...' }}</p>
                            </div>
                        </div>
                    @endif
                    @endif

                    <br>

                    <div id="rst-popular">
                        <div class="row">
                            @if(isset($main_latest))
                                @foreach($main_latest as $article)
                                @if($article->type == 'news' )
                                    <article class="col-sm-4 col-xs-6">
                                        <div class="rst-postpic">
                                            <a href="{{ url('article/'.$article->id) }}"><img class="img-border" src="{{ isset($article->picture) ? url('images/news/'.$article->picture) : 'images/slider/category/po01.jpg' }}" alt="" /></a>
                                            <a class="rst-postpic-cat" href="{{ url('category/news/'.$article->category->id) }}"><span>{{ $article->category->name }}</span></a>
                                        </div>
                                        <div class="rst-postinfo">
                                            <h6><a href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></h6>
                                            <time><i class="fa fa-clock-o"></i>{{ $article->publish_date }}</time>
                                            <p>{{ $article->summary.'...' }}</p>
                                        </div>
                                    </article>
                                @endif
                                @endforeach
                            @endif

                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="col-md-4 col-xs-12">
                    <div>
                        <div class="rst-section-title rst-section-title-box">
                            <h4>Opinion</h4>
                        </div>

                        @if(isset($opinions))
                            @foreach($opinions as $opinion)
                                <div class="media col-md-12 col-sm-6">
                                    <div class="media-left">
                                        <img width="100px" class="media-object " src="{{ isset($opinion->user->avatar) ? url('images').$opinion->user->avatar : url('admin/images/img.jpg') }}" alt="" />
                                    </div>
                                    <div class="media-body">

                                        <a style="color:#474747" href="{{ url('category/column/author/'.$opinion->user->id) }}"><p class="comment-body">{{ $opinion->user->name }}</p></a>
                                        <a href="{{ url('/article/'.$opinion->id) }}" class="media-heading comment-author">{{ $opinion->title }}</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <br>
                        <div class="rst-section-title-short">
                            <a href="{{ url('category/column') }}"><span>View all</span></a>
                        </div>

                        <div class="clear"></div>
                    </div>
                    <div>
                        <aside class="widget widget_adv">
                            <h3>Advertisement</h3>
                            <div class="rst-hotnews owl-carousel">
                                @foreach($advertisements as $advertisement)
                                <a href="{{ url($advertisement->url) }}">
                                    <img width="100%" src="{{ url('images/advertisement/'.$advertisement->image) }}" alt="" />
                                </a>
                                @endforeach
                            </div>
                            <!-- <a href="#"><img src="{{ url('images/ad01.png') }}" alt="" /></a>
                            <div class="clear"></div> -->
                        </aside>
                        <!-- end widget adv -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Main Slider -->
    <br>



    <!-- Category Wise News -->
    @if(isset($category_wise))
        @foreach($category_wise as $category)
        <section>
            <div class="container">
                <div class="row">
                    <div class="rst-section-title rst-section-title-box">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>{{ $category->name }}</h4>
                                    <div class="rst-section-title-short">
                                        <a href="{{ url('/category/news/'.$category->id) }}"><span>View all</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if($category->news()->first() != null)
                    @foreach($category->news as $news)
                        @if($news->type == 'news' && $news->publish_date && $news->homepage)
                            @if($news->spotlight == 1)
                                <article class="col-sm-6 rst-leftpost">
                                    <div class="rst-specpost owl-carousel">
                                        <a href="{{ url('/article/'.$news->id) }}"><img class="img-border" src="{{ isset($news->picture) ? url('images/news/'.$news->picture) : url('images/slider/category/li01.jpg') }}" alt="" /></a>
                                    </div>
                                    <div class="rst-postinfo">
                                        <h6><a href="{{ url('/article/'.$news->id) }}">{{ $news->title }}</a></h6>
                                        <time><i class="fa fa-clock-o"></i>{{ $news->publish_date }}</time>
                                        <p>{{ $news->summary.'...' }}</p>
                                    </div>
                                </article>
                            @else

                            @endif
                        @endif
                    @endforeach

                    <div class="col-sm-6 rst-rightpost">
                        <?php $i = 0; $count = 0; ?>
                        @foreach($category->news as $article)
                            <?php if(++$i == 5) break ?>
                            @if($article->type == 'news' && $article->publish_date && $article->spotlight != 1 && $article->homepage)
                                <article>
                                    <div class="rst-postpic">
                                        <a href="{{ url('/article/'.$article->id) }}"><img class="img-border" width="150px" src="{{ isset($article->picture) ? url('images/news/'.$article->picture) : url('images/slider/category/li02.jpg') }}" alt="" /></a>
                                    </div>
                                    <div class="rst-postinfo">
                                        <h6><a href="{{ url('/article/'.$article->id) }}">{{ $article->title }}</a></h6>
                                        <time><i class="fa fa-clock-o"></i>{{ $article->publish_date }}</time>
                                        <p>{{ $article->summary.'...' }}</p>
                                    </div>
                                </article>
                            @endif
                        @endforeach
                    </div>

                    @endif
                </div>
            </div>
        </section>
        @endforeach
    @endif
    <br><br>
    <!-- End Category Wise -->
@endsection