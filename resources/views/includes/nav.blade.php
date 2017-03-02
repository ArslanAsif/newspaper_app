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

    .nav.navbar-nav.navbar-right .nav-flag-active a{
        background-color: #39E6AC;
        color: white;
    }

    .rst-header-logo {
        margin-top: 10px;
        position: absolute;
    }

    .nav.navbar-nav.navbar-right li a:hover {
        color: white;
    }

</style>

<!--- Header -->
<header>
    <!-- Menu bar -->
    <div class="rst-header-menu">
        <div class="container" >
            <div class="row">

                <span class="rst-header-logo" href="{{ url('/') }}">
                    <a href="{{ url('/') }}">
                        <img style="padding-left:0px; margin-top: -18px" width="165px" src="{{ url('images/gccc.png') }}" alt="" />
                    </a>
                    <span style="font-size: 24px;">
                        <a href="{{ url('/') }}" style="color: #2F3E42;"></a>
                    </span>
                </span>
                <div class="col-md-10 col-sm-10 pull-right" >
                    <div class="navbar navbar-default">
                        <div class="navbar-header" style="margin-right: -15px">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                Country: {{ $country }}
                            </button>
                            <div class="navbar-brand logo"></div>
                        </div>
                        <div class="navbar-collapse collapse">
                            <ul class="nav navbar-nav navbar-left">
                                <li class="divider-vertical"></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right nav-flag">
                                <li class="{{ ($country == 'Saudi Arabia') ? 'nav-flag-active' : '' }}"><a href="{{ url('/ver/sa') }}"><img class="img-of-nav" src="{{ url('/images/countries_flags/sa.png') }}"> Saudi Arabia</a></li>
                                
                                <li class="divider-vertical"></li>
                                <li class="{{ ($country == 'UAE') ? 'nav-flag-active' : '' }}"><a href="{{ url('/ver/ae') }}"><img class="img-of-nav" src="{{ url('/images/countries_flags/ae.png') }}"> UAE</a></li>
                                
                                <li class="divider-vertical"></li>
                                <li class="{{ ($country == 'Qatar') ? 'nav-flag-active' : '' }}"><a href="{{ url('/ver/qa') }}"><img class="img-of-nav" src="{{ url('/images/countries_flags/qa.png') }}"> Qatar</a></li>
                                
                                <li class="divider-vertical"></li>
                                <li class="{{ ($country == 'Kuwait') ? 'nav-flag-active' : '' }}"><a href="{{ url('/ver/kw') }}"><img class="img-of-nav" src="{{ url('/images/countries_flags/kw.png') }}"> Kuwait</a></li>

                                <li class="divider-vertical"></li>
                                <li class="{{ ($country == 'Bahrain') ? 'nav-flag-active' : '' }}"><a href="{{ url('/ver/bh') }}"><img class="img-of-nav" src="{{ url('/images/countries_flags/bh.png') }}"> Bahrain</a></li>
                                
                                <li class="divider-vertical"></li>
                                <li class="{{ ($country == 'Oman') ? 'nav-flag-active' : '' }}"><a href="{{ url('/ver/om') }}"><img class="img-of-nav" src="{{ url('/images/countries_flags/om.png') }}"> Oman</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="rst-header-menu-content" style="padding-right: 0px; position: relative; z-index: 1">
                        
                        <button class="rst-menu-trigger">
                            <span>Toggle navigation</span>
                        </button>
                        <ul>
                            <li><a href="{{ url('/category/world') }}">World</a></li>
                            <li><a href="{{ url('/category/business') }}">Business</a></li>
                            <li><a href="{{ url('/category/weather') }}">Weather</a></li>
                            <li><a href="{{ url('/category/sports') }}">Sports</a></li>
                            <li><a href="{{ url('/category/lifestyle') }}">Lifestyle</a></li>
                            <li><a href="{{ url('/category/opinion') }}">Opinion</a></li>
                            <li><a href="{{ url('/links') }}">Important Links</a></li>
                            
                            <li class="login-btn">
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
                        <div class="clear"></div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

</header>
<!--- End Header -->