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
                    @if(isset($main_spotlight->id))
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
                                        </div>
                                    </article>
                                @endforeach
                            @endif

                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <br>
                <div class="col-md-4 col-xs-12 hidden-xs hidden-sm">
                    <div class="row">
                        <div class="col-md-7 col-sm-6 col-xs-6">
                            <a hidden="hidden" id="exchangerate-btn" href="{{ url('/exchangerate') }}" class="btn btn-sm btn-success" style="position: absolute; margin-top: 5px; margin-left: 160px; font-size: 12px; "><i class="fa fa-money"></i></a>
                            <div id="currency_widget_holder"></div>
                        </div>

                        <div class="col-md-5 col-sm-6 col-xs-6">
                            <a href="{{ url('/category/weather') }}">
                                <div id="weather" style="padding-top: 1px; padding-bottom: 1px;">
                                  <div class="loading-image">
                                    <br><br><p style="text-align: center; color: white"  >Loading weather data...</p><br><br>
                                  </div>
                                </div>
                            </a>
                        </div>
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
                            <a href="{{ url('category/opinion') }}"><span>View all</span></a>
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
        <!-- GCC -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="rst-section-title rst-section-title-box">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>GCC</h4>
                                    <div class="rst-section-title-short">
                                        <a href="{{ url('/category/gcc') }}"><span>View all</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if(isset($category_gcc_spotlight->id))
                        <article class="col-sm-6 rst-leftpost">
                            <div class="rst-specpost owl-carousel">
                                <a href="{{ url('/article/'.$category_gcc_spotlight->id) }}"><img class="img-border" src="{{ isset($category_gcc_spotlight->picture) ? url('images/news/'.$category_gcc_spotlight->picture) : url('images/no-image-available.png') }}" alt="" /></a>
                            </div>
                            <div class="rst-postinfo">
                                <h6><a href="{{ url('/article/'.$category_gcc_spotlight->id) }}">{{ $category_world_spotlight->title }}</a></h6>
                                <time><i class="fa fa-clock-o"></i>{{ $category_gcc_spotlight->publish_date }}</time>
                                <p>{{ $category_gcc_spotlight->summary.'...' }}</p>
                            </div>
                        </article>
                    @endif

                    <div class="col-sm-6 rst-rightpost">
                        @foreach($category_gcc as $article)
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
                    
                    @if(isset($category_world_spotlight->id))
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
                    
                    @if(isset($category_business_spotlight->id))
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
                    
                    @if(isset($category_weather_spotlight->id))
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
                    
                    @if(isset($category_sports_spotlight->id))
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
                    
                    @if(isset($category_lifestyle_spotlight->id))
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

@section('css')
<link rel="stylesheet" type="text/css" href="{{ url('currency_widget/css/ui-lightness/jquery-ui-1.8.2.custom.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('currency_widget/css/currency_widget.css') }}" />
<style>

#weather {
    font: 13px 'Open Sans', "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
    text-transform: uppercase;
    background-color: #0091C2;
    color: white;
    margin-bottom: 20px;
}

#weather-image {
  margin-top: -10px;
  margin-left: 25px;
  margin-bottom: -10px;
}

#weather h5 {
  padding: 2px;
  color: white;
  font-size: 15px;
  font-weight: 300;
  text-align: center;
  text-shadow: 0px 1px 3px rgba(0, 0, 0, 0.15);
}

#weather h4 {
  padding: 2px;
  color: white;
  font-size: 20px;
  font-weight: 300;
  text-align: center;
  text-shadow: 0px 1px 3px rgba(0, 0, 0, 0.15);
}

#weather h3 {
  padding: 2px;
  color: white;
  font-size: 40px;
  font-weight: 300;
  text-align: center;
  text-shadow: 0px 1px 3px rgba(0, 0, 0, 0.15);
}

#weather p {
    text-align: center;
    font-size: 12px;
}

    



</style>

@endsection

@section('js')
    <script type="text/javascript">
        $('#myModal').modal(); 
    </script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.simpleWeather/3.1.0/jquery.simpleWeather.min.js"></script>
    <script type="text/javascript" src="{{ url('currency_widget/js/jquery.currency_widget.js') }}"></script>

<script>
    // v3.1.0
    //Docs at http://simpleweatherjs.com
    $(document).ready(function() {  
      getWeather(); //Get the initial weather.
      setInterval(getWeather, 300000); //Update the weather every 10 minutes.
      
      $('#currency_widget_holder').currency_widget({ 
            url: '{{url("/api/currencyconverter")}}',
            source_currencies: { 'BHD': 'Bahraini Dinar', 'KWD': 'Kuwaiti Dinar', 'OMR':'Omani Riyal', 'QAR':'Qatari Riyal', 'SAR':'Saudi Riyal', 'AED':'UAE Dirham', 'USD':'US Dollar', 'EUR':'Euro' },
            target_currencies: { 'BHD': 'Bahraini Dinar', 'KWD': 'Kuwaiti Dinar', 'OMR':'Omani Riyal', 'QAR':'Qatari Riyal', 'SAR':'Saudi Riyal', 'AED':'UAE Dirham', 'USD':'US Dollar', 'EUR':'Euro' }
        }); // set the available currencies
    });

    function getWeather() {
      $.simpleWeather({
        location: '{{Cache::get('city')}}',
        woeid: '',
        unit: 'c',
        success: function(weather) {
          html = '<h4>'+weather.city+', '+weather.region+'</h4>';
          html += '<h3><img id="weather-image" src="'+weather.image+'">'+weather.temp+'&deg;'+weather.units.temp+'</h3>';
          html += '<h5><span class="fa fa-arrow-down"> '+weather.forecast[0].low+'&deg;'+weather.units.temp+' <span class="fa fa-arrow-up"> '+weather.forecast[0].high+'&deg;'+weather.units.temp+'</h5>';
          html += '<p> <span class="fa fa-exchange"></span></p><p style="margin-top: -10px;"> '+weather.wind.direction+' '+weather.wind.speed+' '+weather.units.speed+'</p>';
          html += '<p><span class="fa fa-sun-o"></span> '+weather.sunrise+'</p><p><span class="fa fa-moon-o"></span>  '+weather.sunset+'</p></div>';
          html += '</div>';
      
          $("#weather").html(html);
        },
        error: function(error) {
          $("#weather").html('<p>'+error+'</p>');
        }
      });
    }
</script>

@endsection