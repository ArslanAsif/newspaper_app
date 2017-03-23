<style>
    .img-of-nav {
        width: 40px;
        height: 25px;
    }

    .navbar.navbar-default{
        margin-bottom: 0px;
        background-color: white;
        border: none;
    }

    .nav-flag {
        border: 1px solid silver;
    }

    .nav-flag img {
        border: 1px solid grey;
    }

    .nav-flag li:hover {
        background-color: #39E6AC;
    }

    .nav.navbar-nav .nav-flag-active a{
        background-color: #39E6AC;
        color: white;
    }


    .nav.navbar-nav.navbar-right li a:hover {
        color: white;
    }

    

    @media(min-width: 800px) {
        .navbar-nav {
            float:none;
            display: block;
            text-align: center;
        }

        .navbar-nav > li {
            display: inline-block;
            padding: 0 0px;
            float:none;
        }
    }

    @media(min-width: 1140px) {
        .navbar-nav {
            float:none;
            display: block;
            text-align: center;
        }

        .navbar-nav > li {
            display: inline-block;
            padding: 0 12px;
            float:none;
        }
    }

    .mynavbar-icon {
        float:none;
        text-align: center;
    }

    .sign-in-btn {
        float: right;
        margin-top: -100px;
        text-align: right;
    }

    #js-date {
        padding-top: 10px;
        font-size: 12px;
    }

    .dropdown-menu {
        right: 0;
        left: auto;
    }

</style>

<!--- Header -->
<header>
    <!-- Menu bar -->
    <nav class="navbar navbar-default col-xs-6 col-sm-12" style="z-index: 3">
        <div class="container">
            <div class="navbar-header mynavbar-icon">
                <a href="{{url('/')}}">
                    <img style="margin-top: -15px" width="150px" src="{{ url('images/gccc.png') }}" alt="" />
                </a>
            </div>
            <div class="sign-in-btn login-btn hidden-xs">
                @if(Auth::guest())
                    <a href="{{ url('/login') }}"><span class="fa fa-user-circle"></span> Login</a>
                @else
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">{{ Auth::user()->name }}
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    @if(Auth::user()->type == 'admin')
                    <li><a href="{{ url('/admin/dashboard') }}">Admin Panel</button></a></li>
                    @endif

                    @if(!Auth::guest() ? Auth::user()->type == 'user' ? 1 : 0 : 0)
                        <li><a href="{{ url('/user/submission') }}">User Submission</button></li>
                    @endif

                    <li>
                        <a href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out pull-right"></i> Logout
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                  </ul>
                </div>
                @endif

                <p id="js-date"></p>
            </div>
        </div>
            
    </nav>

    <div class="col-xs-6 col-sm-12">
        <nav class="navbar navbar-default" style="z-index: 2">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#countryNavbar">
                <span>{{$country}}</span>                       
              </button>
            </div>
            <div class="collapse navbar-collapse nav-flag" id="countryNavbar">
              <ul class="nav navbar-nav">
                <li class="{{ ($country == 'Saudi Arabia') ? 'nav-flag-active' : '' }}"><a href="{{ url('/ver/sa') }}"><img class="img-of-nav" src="{{ url('/images/countries_flags/sa.png') }}"> Saudi Arabia</a></li>
                    
                <li class="{{ ($country == 'UAE') ? 'nav-flag-active' : '' }}"><a href="{{ url('/ver/ae') }}"><img class="img-of-nav" src="{{ url('/images/countries_flags/ae.png') }}"> UAE</a></li>
                
                <li class="{{ ($country == 'Qatar') ? 'nav-flag-active' : '' }}"><a href="{{ url('/ver/qa') }}"><img class="img-of-nav" src="{{ url('/images/countries_flags/qa.png') }}"> Qatar</a></li>
                
                <li class="{{ ($country == 'Kuwait') ? 'nav-flag-active' : '' }}"><a href="{{ url('/ver/kw') }}"><img class="img-of-nav" src="{{ url('/images/countries_flags/kw.png') }}"> Kuwait</a></li>

                <li class="{{ ($country == 'Bahrain') ? 'nav-flag-active' : '' }}"><a href="{{ url('/ver/bh') }}"><img class="img-of-nav" src="{{ url('/images/countries_flags/bh.png') }}"> Bahrain</a></li>
                
                <li class="{{ ($country == 'Oman') ? 'nav-flag-active' : '' }}"><a href="{{ url('/ver/om') }}"><img class="img-of-nav" src="{{ url('/images/countries_flags/om.png') }}"> Oman</a></li>
              </ul>
            </div>
          </div>
        </nav>

        <nav class="navbar navbar-default " style="z-index: 2">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#categoryNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
              </button>
            </div>
            <div class="collapse navbar-collapse nav-flag" id="categoryNavbar">
              <ul class="nav navbar-nav">
                <li><a href="{{ url('/category/gcc') }}">GCC</a></li>
                <li class="divider-vertical"></li>
                <li><a href="{{ url('/category/world') }}">World</a></li>
                <li class="divider-vertical"></li>
                <li><a href="{{ url('/category/business') }}">Business</a></li>
                <li class="divider-vertical"></li>
                <li><a href="{{ url('/category/weather') }}">Weather</a></li>
                <li class="divider-vertical"></li>
                <li><a href="{{ url('/category/sports') }}">Sports</a></li>
                <li class="divider-vertical"></li>
                <li><a href="{{ url('/category/lifestyle') }}">Lifestyle</a></li>
                <li class="divider-vertical"></li>
                <li><a href="{{ url('/category/opinion') }}">Opinion</a></li>
                <li class="divider-vertical"></li>
                <li><a href="{{ url('/links') }}">Important Links</a></li>
                <li class="divider-vertical"></li>

                <li class="login-btn hidden-sm hidden-md hidden-lg">
                    @if(Auth::guest())
                        <a href="{{ url('/login') }}"><span class="fa fa-user-circle"></span> Login</a>
                    @else
                    <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">{{ Auth::user()->name }}
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        @if(Auth::user()->type == 'admin')
                        <li><button class="btn btn-default form-control" onclick="window.location.href = '{{ url('/admin/dashboard') }}'">Admin Panel</button></li>
                        @endif

                        @if(!Auth::guest() ? Auth::user()->type == 'user' ? 1 : 0 : 0)
                            <li><button class="btn btn-default form-control" onclick="window.location.href = '{{ url('/user/submission') }}'">User Submission</button></li>
                        @endif

                        <li><form action="{{ url('/logout') }}" method="post" >{{ csrf_field() }}<button class="btn btn-danger form-control" type="submit">Logout</button></form></li>
                      </ul>
                    </div>
                    @endif
                </li>
              </ul>
            </div>
          </div>
        </nav>

        <nav class="navbar navbar-default navbar-fixed-top" style="z-index: 1">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#categoryNavbar2">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
              </button>
            </div>
          <div class="container">
            <div class="collapse navbar-collapse nav-flag" id="categoryNavbar2">
              <ul class="nav navbar-nav">
                <li><a href="{{ url('/category/gcc') }}">GCC</a></li>
                <li class="divider-vertical"></li>
                <li><a href="{{ url('/category/world') }}">World</a></li>
                <li class="divider-vertical"></li>
                <li><a href="{{ url('/category/business') }}">Business</a></li>
                <li class="divider-vertical"></li>
                <li><a href="{{ url('/category/weather') }}">Weather</a></li>
                <li class="divider-vertical"></li>
                <li><a href="{{ url('/category/sports') }}">Sports</a></li>
                <li class="divider-vertical"></li>
                <li><a href="{{ url('/category/lifestyle') }}">Lifestyle</a></li>
                <li class="divider-vertical"></li>
                <li><a href="{{ url('/category/opinion') }}">Opinion</a></li>
                <li class="divider-vertical"></li>
                <li><a href="{{ url('/links') }}">Important Links</a></li>
                <li class="divider-vertical"></li>

                <li class="login-btn hidden-sm hidden-md hidden-lg">
                    @if(Auth::guest())
                        <a href="{{ url('/login') }}"><span class="fa fa-user-circle"></span> Login</a>
                    @else
                    <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">{{ Auth::user()->name }}
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        @if(Auth::user()->type == 'admin')
                        <li><button class="btn btn-default form-control" onclick="window.location.href = '{{ url('/admin/dashboard') }}'">Admin Panel</button></li>
                        @endif

                        @if(!Auth::guest() ? Auth::user()->type == 'user' ? 1 : 0 : 0)
                            <li><button class="btn btn-default form-control" onclick="window.location.href = '{{ url('/user/submission') }}'">User Submission</button></li>
                        @endif

                        <li><form action="{{ url('/logout') }}" method="post" >{{ csrf_field() }}<button class="btn btn-danger form-control" type="submit">Logout</button></form></li>
                      </ul>
                    </div>
                    @endif
                </li>
              </ul>
            </div>
          </div>
        </nav>
    </div>

</header>
<!--- End Header -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/javascript" src="{{ url('js/jquery-1.11.3.js') }}"></script>

<script>

$(document).ready(function() {  
  datetime();
  setInterval(datetime, 60000); //Update every 1 minute
});

function datetime()
{
    var d = new Date();
    var year = d.getFullYear();
    var month = d.getMonth();
    var date = d.getDate();
    var day = d.getDay();
    var hour = d.getHours();
    var min = d.getMinutes();
    var unit = null;
    
    if(hour >= 0 && hour < 12)
    {
        unit = "am";
    }
    else
    {
        unit = "pm";
    }

    switch(hour)
    {
        case 0: 
        case 12: hour = 12; break;
        default: hour = hour % 12;
    }


    switch(month)
    {
        case 0: month = "January"; break;
        case 1: month = "Febuary"; break;
        case 2: month = "March"; break;
        case 3: month = "April"; break;
        case 4: month = "May"; break;
        case 5: month = "June"; break;
        case 6: month = "July"; break;
        case 7: month = "August"; break;
        case 8: month = "September"; break;
        case 9: month = "October"; break;
        case 10: month = "November"; break;
        case 11: month = "December"; break;
    }

    switch(day)
    {
        case 0: day = "Sunday"; break;
        case 1: day = "Monday"; break;
        case 2: day = "Tuesday"; break;
        case 3: day = "Wednesday"; break;
        case 4: day = "Thursday"; break;
        case 5: day = "Friday"; break;
        case 6: day = "Saturday"; break;
    }


    document.getElementById("js-date").innerHTML = day+" "+date+" "+month+" "+year+"<br>"+hour+":"+min+" "+unit;
}

</script>