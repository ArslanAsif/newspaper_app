<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <li>.</li>
            <li><a href="{{ url('/admin/dashboard/') }}"><i class="fa fa-home"></i> Dashboard</a></li>

            <li><a><i class="fa fa-edit"></i> News & Articles <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ url('/admin/news/add') }}">Add News</a></li>
                    <li><a href="{{ url('/admin/news/usersubmission') }}">Users Submissions</a></li>
                    <li><a href="{{ url('/admin/news/') }}">Manage News</a></li>

                </ul>
            </li>

            <!-- <li><a><i class="fa fa-list"></i> Categories <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ url('/admin/news/category/add') }}">Add Category</a></li>
                    <li><a href="{{ url('/admin/news/category/') }}">Manage Categories</a></li>
                </ul>
            </li> -->

            <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ url('/admin/user/') }}">Manage Users</a></li>
                    <li><a href="{{ url('/admin/subscriber') }}">Subscribers</a></li>
                </ul>
            </li>

            <li><a href="{{ url('admin/about/links/Saudi Arabia') }}"><i class="fa fa-file"></i> Links </a></li>

            <li><a><i class="fa fa-file"></i> About <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ url('admin/about/aboutus') }}">About Us</a></li>
                    <li><a href="{{ url('admin/about/contact') }}">Contact Info</a></li>
                    <li><a href="{{ url('admin/about/terms') }}">Terms and Conditions</a></li>
                </ul>
            </li>

            <li><a><i class="fa fa-tv"></i> Advertisement <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ url('admin/advertisement/add') }}">Add Advertisement</a></li>
                    <li><a href="{{ url('admin/advertisement/') }}">Manage Advertisement</a></li>
                </ul>
            </li>

        </ul>
    </div>

</div>
<!-- /sidebar menu -->