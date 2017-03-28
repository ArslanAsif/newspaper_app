@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="rst-section-title rst-section-title-box">
                    <h4>{{ ucfirst($category) }}</h4>
                    <div class="rst-shortmenu">
                        <form action="#">
                            @if(isset($authors))
                            <select name="rst-catshortselect" id="rst-catshortselect" onchange="location = this.value;">
                                <option value="{{ url('category/column') }}">All</option>
                                @foreach($authors as $author)
                                    <option {{ isset($user) ? $user->id == $author->user_id ? 'selected' : '' : '' }} value="{{ url('category/column/author/'.$author->user_id) }}">{{ $author->user->name }}</option>
                            </select>
                            @endforeach

                            @else
                                <!-- <div style="">
                                    <input type="text" class="form-control" placeholder="Search for..."><span>
                                    <a class="btn btn-primary" type="button">Go!</a></span>
                                </div> -->
                            @endif
                        </form>
                    </div>
                </div>

                @if($category == "weather")
                    <div class="" style="margin-top: -35px">
                        <div class="col-xs-12" id="weather">
                          <div class="loading-image">
                            <br><br><h1 style="text-align: center; color: white"  >Loading weather data...</h1><br><br>
                          </div>
                        </div>
                    </div>
                @endif

                

                <div id="rst-popular">
                    <?php $count = 0; ?>
                    @if(isset($articles))
                        @foreach($articles as $article)
                            @if($count % 3 == 0)
                                <div class='row category-row'>
                                <?php $count1 = 0; ?>
                            @endif
                            <article class="col-sm-4 col-xs-12">
                                <div class="rst-postpic">
                                    <a href="{{ url('/article/'.$article->id) }}"><img class="img-border" src="{{ url(isset($article->picture) ? 'images/news/'.$article->picture : 'images/no-image-available.png') }}" alt="" /></a>

                                </div>
                                <div class="rst-postinfo">
                                    <h6><a href="{{ url('/article/'.$article->id) }}">{{ $article->title }}</a></h6>
                                    <time><i class="fa fa-clock-o"></i>{{ $article->publish_date }}</time>
                                    <p>{{ $article->summary }}</p>
                                </div>
                            </article>
                            <?php $count1++; if($count1 % 3 == 0) echo "</div>"; $count++;?>

                        @endforeach
                        <div class="col-xs-12">
                            <nav class="wp-pagenavi">
                                {{ $articles->links() }}
                            </nav>
                        <div class="clear"></div>
                    @endif
                </div>
            </div>

            <!-- <div class="row">
                <div class="col-xs-12"><br>
                    <nav class="wp-pagenavi">
                        <a class="page-numbers current" href="#">1</a>
                        <a class="page-numbers" href="#">2</a>
                        <a class="page-numbers" href="#">3</a>
                        <a class="page-numbers" href="#">4</a>
                        <a class="page-numbers" href="#">5</a>
                    </nav>
                    <div class="clear"></div>
                </div>
            </div> -->
            <br>
        </div>
    </div>
@endsection

@if($category == 'weather')
@section('css')
<style>

#weather {
    font: 13px 'Open Sans', "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
    text-transform: uppercase;
    background-color: #0091C2;
    color: white;
    margin-bottom: 20px;
}

#weather-image {
  position: absolute;
  margin-top: -40px;
  margin-left: -120px;
}

#weather h5 {
  padding: 10px;
  color: white;
  font-size: 24px;
  font-weight: 300;
  text-align: center;
  text-shadow: 0px 1px 3px rgba(0, 0, 0, 0.15);
}

#weather h4 {
  padding: 10px;
  color: white;
  font-size: 36px;
  font-weight: 300;
  text-align: center;
  text-shadow: 0px 1px 3px rgba(0, 0, 0, 0.15);
}

#weather h3 {
  padding: 10px;
  color: white;
  font-size: 100px;
  font-weight: 300;
  text-align: center;
  text-shadow: 0px 1px 3px rgba(0, 0, 0, 0.15);
}

#weather p {
    text-align: center;
    font-size: 15px;
}

#forecast-table {
    padding-top: 20px;
}

#forecast-table td {
    padding: 10px;
    font-size: 20px;
}

</style>
@endsection


@section('js')
<!-- Weather Js -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.simpleWeather/3.1.0/jquery.simpleWeather.min.js"></script>

<script>
    // v3.1.0
    //Docs at http://simpleweatherjs.com
    $(document).ready(function() {  
      getWeather(); //Get the initial weather.
      setInterval(getWeather, 300000); //Update the weather every 10 minutes.
    });

    function getWeather() {
      $.simpleWeather({
        location: '{{Cache::get('city')}}',
        woeid: '',
        unit: 'c',
        success: function(weather) {
          html = '<div class="col-md-6"><h4>'+weather.city+', '+weather.region+'</h4>';
          html += '<h3><img id="weather-image" src="'+weather.image+'">'+weather.temp+'&deg;'+weather.units.temp+'</h3>';
          html += '<h5><span class="fa fa-arrow-down"> '+weather.forecast[0].low+'&deg;'+weather.units.temp+' <span class="fa fa-arrow-up"> '+weather.forecast[0].high+'&deg;'+weather.units.temp+'</h5>';
          html += '<p> <span class="fa fa-exchange"></span> '+weather.wind.direction+' '+weather.wind.speed+' '+weather.units.speed+'</p>';
          html += '<p><span class="fa fa-sun-o"></span> '+weather.sunrise+' | <span class="fa fa-moon-o"></span>  '+weather.sunset+'</p></div>';

          html += '<div class="col-md-6"><table id="forecast-table" class="table table-default">';
          for($i=1; $i<5; $i++)
          {
            html += '<tr><td>'+weather.forecast[$i].day+'</td><td><img style="margin-top: 0px" src="'+weather.forecast[$i].thumbnail+'"></td><td><span class="fa fa-arrow-down"> '+weather.forecast[$i].low+'&deg;'+weather.units.temp+'</td><td><span class="fa fa-arrow-up"> '+weather.forecast[$i].high+'&deg;'+weather.units.temp+'</td></tr>';
          }
          html += '</table></div>';
      
          $("#weather").html(html);
        },
        error: function(error) {
          $("#weather").html('<p>'+error+'</p>');
        }
      });
    }
</script>

@endsection

@endif

