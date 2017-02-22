@extends('layouts.app')

@section('content')
    <!-- Pageline -->
    <div class="rst-pageline container" style="margin-top: -32px; position: relative; z-index: 0;">
        <div class="row">
            <div class="col-xs-12">
                <div class="rst-pageline-content">
                    <span>Headlines</span>
                    <div class="rst-pageline-slider owl-carousel">
                        @foreach($headlines as $headline)
                            <p>{{ $headline->country }} ({{ $headline->category }}): {{ $headline->title }}</p>
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
                        <div>
                            <div class="rst-postpic">
                                <a href="{{ url('article/'.$main_spotlight->id) }}"><img class="img-border" width=100% src="{{ url(isset($main_spotlight->picture) ? 'images/news/'.$main_spotlight->picture : 'images/no-image-available.png') }}" alt="" /></a>
                                <a class="rst-postpic-cat" href="{{ url('/category/'.strtolower($main_spotlight->category)) }}"><span>{{ $main_spotlight->category }}</span></a>
                            </div>
                            <div class="rst-postinfo" >
                                <h6 class="h6-title"><a href="{{ url('article/'.$main_spotlight->id) }}">{{ $main_spotlight->title }}</a></h6>
                                <time><i class="fa fa-clock-o"></i>{{ $main_spotlight->publish_date }}</time>
                                <p>{{ $main_spotlight->summary.'...' }}</p>
                            </div>
                        </div>
                    @endif

                    <br>

                    <div id="rst-popular">
                        <div class="row">
                            @if(isset($main_latest))
                                @foreach($main_latest as $article)
                                    <article class="col-sm-4 col-xs-6">
                                        <div class="rst-postpic">
                                            <a href="{{ url('article/'.$article->id) }}"><img class="img-border" src="{{ url(isset($article->picture) ? 'images/news/'.$article->picture : 'images/no-image-available.png') }}" alt="" /></a>
                                            <a class="rst-postpic-cat" href="{{ url('category/'.strtolower($article->category)) }}"><span>{{ $article->category }}</span></a>
                                        </div>
                                        <div class="rst-postinfo">
                                            <h6><a href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></h6>
                                            <time><i class="fa fa-clock-o"></i>{{ $article->publish_date }}</time>
                                            <p>{{ $article->summary.'...' }}</p>
                                        </div>
                                    </article>
                                @endforeach
                            @endif

                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="col-md-4 col-xs-12">
                    <div class="" style=" padding-top: 10px">
                        <a style="width: 50%; padding-top: 20px; padding-bottom: 20px" class="btn btn-success" href="{{ url('/exchangerate') }}"><i style="color: white" class="fa fa-money"></i> Exchange Rates</a>
                        <a style="width: 49%; padding-top: 20px; padding-bottom: 20px" class="btn btn-warning" href="#"><i style="color:white" class="fa fa-cubes"></i> Gold Rates</a>
                    </div>
                </div>

                <div class="col-md-4 col-xs-12">
                    <div>
                        <div class="rst-section-title rst-section-title-box">
                            <h4>Opinion</h4>
                        </div>

                        @if(isset($opinions))
                            @foreach($opinions as $opinion)
                                <div class="row">
                                    <div class="media col-md-12 col-sm-6">
                                        <div class="media-left" style="width:100px">
                                            <img class="media-object " src="{{ isset($opinion->user->avatar) ? url('images').$opinion->user->avatar : url('images/account.png') }}" alt="" />
                                        </div>
                                        <div class="media-body">
                                            <a style="color:#474747" href="{{ url('category/column/author/'.$opinion->user->id) }}"><p class="comment-body">{{ $opinion->user->name }}</p></a>
                                            <a href="{{ url('/article/'.$opinion->id) }}" class="media-heading comment-author">{{ $opinion->title }}</a>
                                        </div>
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
                                    <h4>{{ $advertisement->title }}</h4>
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
        <!-- world -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="rst-section-title rst-section-title-box">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>World</h4>
                                    <div class="rst-section-title-short">
                                        <a href="{{ url('/category/world') }}"><span>View all</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if(isset($category_world_spotlight))
                        <article class="col-sm-6 rst-leftpost">
                            <div class="rst-specpost owl-carousel">
                                <a href="{{ url('/article/'.$category_world_spotlight->id) }}"><img class="img-border" src="{{ isset($category_world_spotlight->picture) ? url('images/news/'.$category_world_spotlight->picture) : url('images/no-image-available.png') }}" alt="" /></a>
                            </div>
                            <div class="rst-postinfo">
                                <h6><a href="{{ url('/article/'.$category_world_spotlight->id) }}">{{ $category_world_spotlight->title }}</a></h6>
                                <time><i class="fa fa-clock-o"></i>{{ $category_world_spotlight->publish_date }}</time>
                                <p>{{ $category_world_spotlight->summary.'...' }}</p>
                            </div>
                        </article>
                    @endif

                    <div class="col-sm-6 rst-rightpost">
                        @foreach($category_world as $article)
                            <article>
                                <div class="rst-postpic">
                                    <a href="{{ url('/article/'.$article->id) }}"><img class="img-border" width="150px" src="{{ isset($article->picture) ? url('images/news/'.$article->picture) : url('images/no-image-available.png') }}" alt="" /></a>
                                </div>
                                <div class="rst-postinfo">
                                    <h6><a href="{{ url('/article/'.$article->id) }}">{{ $article->title }}</a></h6>
                                    <time><i class="fa fa-clock-o"></i>{{ $article->publish_date }}</time>
                                    <p>{{ $article->summary.'...' }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Business -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="rst-section-title rst-section-title-box">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>Business</h4>
                                    <div class="rst-section-title-short">
                                        <a href="{{ url('/category/business') }}"><span>View all</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if(isset($category_business_spotlight))
                        <article class="col-sm-6 rst-leftpost">
                            <div class="rst-specpost owl-carousel">
                                <a href="{{ url('/article/'.$category_business_spotlight->id) }}"><img class="img-border" src="{{ isset($category_business_spotlight->picture) ? url('images/news/'.$category_business_spotlight->picture) : url('images/no-image-available.png') }}" alt="" /></a>
                            </div>
                            <div class="rst-postinfo">
                                <h6><a href="{{ url('/article/'.$category_business_spotlight->id) }}">{{ $category_business_spotlight->title }}</a></h6>
                                <time><i class="fa fa-clock-o"></i>{{ $category_business_spotlight->publish_date }}</time>
                                <p>{{ $category_business_spotlight->summary.'...' }}</p>
                            </div>
                        </article>
                    @endif

                    <div class="col-sm-6 rst-rightpost">
                        @foreach($category_business as $article)
                            <article>
                                <div class="rst-postpic">
                                    <a href="{{ url('/article/'.$article->id) }}"><img class="img-border" width="150px" src="{{ isset($article->picture) ? url('images/news/'.$article->picture) : url('images/no-image-available.png') }}" alt="" /></a>
                                </div>
                                <div class="rst-postinfo">
                                    <h6><a href="{{ url('/article/'.$article->id) }}">{{ $article->title }}</a></h6>
                                    <time><i class="fa fa-clock-o"></i>{{ $article->publish_date }}</time>
                                    <p>{{ $article->summary.'...' }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Weather -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="rst-section-title rst-section-title-box">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>Weather</h4>
                                    <div class="rst-section-title-short">
                                        <a href="{{ url('/category/weather') }}"><span>View all</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if(isset($category_weather_spotlight))
                        <article class="col-sm-6 rst-leftpost">
                            <div class="rst-specpost owl-carousel">
                                <a href="{{ url('/article/'.$category_weather_spotlight->id) }}"><img class="img-border" src="{{ isset($category_weather_spotlight->picture) ? url('images/news/'.$category_weather_spotlight->picture) : url('images/no-image-available.png') }}" alt="" /></a>
                            </div>
                            <div class="rst-postinfo">
                                <h6><a href="{{ url('/article/'.$category_weather_spotlight->id) }}">{{ $category_weather_spotlight->title }}</a></h6>
                                <time><i class="fa fa-clock-o"></i>{{ $category_weather_spotlight->publish_date }}</time>
                                <p>{{ $category_weather_spotlight->summary.'...' }}</p>
                            </div>
                        </article>
                    @endif

                    <div class="col-sm-6 rst-rightpost">
                        @foreach($category_weather as $article)
                            <article>
                                <div class="rst-postpic">
                                    <a href="{{ url('/article/'.$article->id) }}"><img class="img-border" width="150px" src="{{ isset($article->picture) ? url('images/news/'.$article->picture) : url('images/no-image-available.png') }}" alt="" /></a>
                                </div>
                                <div class="rst-postinfo">
                                    <h6><a href="{{ url('/article/'.$article->id) }}">{{ $article->title }}</a></h6>
                                    <time><i class="fa fa-clock-o"></i>{{ $article->publish_date }}</time>
                                    <p>{{ $article->summary.'...' }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Sports -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="rst-section-title rst-section-title-box">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>Sports</h4>
                                    <div class="rst-section-title-short">
                                        <a href="{{ url('/category/sports') }}"><span>View all</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if(isset($category_sports_spotlight))
                        <article class="col-sm-6 rst-leftpost">
                            <div class="rst-specpost owl-carousel">
                                <a href="{{ url('/article/'.$category_sports_spotlight->id) }}"><img class="img-border" src="{{ isset($category_sports_spotlight->picture) ? url('images/news/'.$category_sports_spotlight->picture) : url('images/no-image-available.png') }}" alt="" /></a>
                            </div>
                            <div class="rst-postinfo">
                                <h6><a href="{{ url('/article/'.$category_sports_spotlight->id) }}">{{ $category_sports_spotlight->title }}</a></h6>
                                <time><i class="fa fa-clock-o"></i>{{ $category_sports_spotlight->publish_date }}</time>
                                <p>{{ $category_sports_spotlight->summary.'...' }}</p>
                            </div>
                        </article>
                    @endif

                    <div class="col-sm-6 rst-rightpost">
                        @foreach($category_sports as $article)
                            <article>
                                <div class="rst-postpic">
                                    <a href="{{ url('/article/'.$article->id) }}"><img class="img-border" width="150px" src="{{ isset($article->picture) ? url('images/news/'.$article->picture) : url('images/no-image-available.png') }}" alt="" /></a>
                                </div>
                                <div class="rst-postinfo">
                                    <h6><a href="{{ url('/article/'.$article->id) }}">{{ $article->title }}</a></h6>
                                    <time><i class="fa fa-clock-o"></i>{{ $article->publish_date }}</time>
                                    <p>{{ $article->summary.'...' }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Lifestyle -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="rst-section-title rst-section-title-box">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>Lifestyle</h4>
                                    <div class="rst-section-title-short">
                                        <a href="{{ url('/category/lifestyle') }}"><span>View all</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if(isset($category_lifestyle_spotlight))
                        <article class="col-sm-6 rst-leftpost">
                            <div class="rst-specpost owl-carousel">
                                <a href="{{ url('/article/'.$category_lifestyle_spotlight->id) }}"><img class="img-border" src="{{ isset($category_lifestyle_spotlight->picture) ? url('images/news/'.$category_lifestyle_spotlight->picture) : url('images/no-image-available.png') }}" alt="" /></a>
                            </div>
                            <div class="rst-postinfo">
                                <h6><a href="{{ url('/article/'.$category_lifestyle_spotlight->id) }}">{{ $category_lifestyle_spotlight->title }}</a></h6>
                                <time><i class="fa fa-clock-o"></i>{{ $category_lifestyle_spotlight->publish_date }}</time>
                                <p>{{ $category_lifestyle_spotlight->summary.'...' }}</p>
                            </div>
                        </article>
                    @endif

                    <div class="col-sm-6 rst-rightpost">
                        @foreach($category_lifestyle as $article)
                            <article>
                                <div class="rst-postpic">
                                    <a href="{{ url('/article/'.$article->id) }}"><img class="img-border" width="150px" src="{{ isset($article->picture) ? url('images/news/'.$article->picture) : url('images/no-image-available.png') }}" alt="" /></a>
                                </div>
                                <div class="rst-postinfo">
                                    <h6><a href="{{ url('/article/'.$article->id) }}">{{ $article->title }}</a></h6>
                                    <time><i class="fa fa-clock-o"></i>{{ $article->publish_date }}</time>
                                    <p>{{ $article->summary.'...' }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    <br><br>
    <!-- End Category Wise -->
@endsection

@section('js')
    <script type="text/javascript">
        $('#myModal').modal(); 
    </script>
@endsection