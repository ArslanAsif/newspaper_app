<!--- Header -->
<header>
    <!-- Menu bar -->
    <div class="rst-header-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="rst-header-menu-content">
                        <a class="rst-header-logo" style="margin-left: -15px; margin-top: 20px; margin-bottom: 0px;" href="{{ url('/') }}"><img style="" width="100px" src="{{ url('images/header-logo.jpg') }}" alt="" /><span style="color: #2F3E42; font-size: 24px;"><b>GCC</b> Connect</span></a>
                        <button class="rst-menu-trigger">
                            <span>Toggle navigation</span>
                        </button>
                        <ul>
                            @foreach($navs as $nav)
                                <li><a href="{{ url('/category/news/'.$nav->id) }}">{{ $nav->name }}</a></li>
                            @endforeach
                            <li><a href="{{ url('/category/column') }}">Opinion</a></li>
                            <li><a href="{{ url('/category/media') }}">Media</a></li>
                            
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