<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPRMIS v3</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body class="">

    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img alt="image" class="rounded-circle" src="{{ asset('img/profile_small.jpg') }}"/>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold">David Williams</span>
                                <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                                <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                                <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="login.html">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                           
                        </ul>
                    </li>
                    <li class="{{ request()->routeIs('page1') ? 'active' : '' }}">
                        <a href="{{ route('page1', ['artist' => 'default']) }}"><i class="fa fa-diamond"></i> <span class="nav-label">Page 1</span></a>
                    </li>
                    <li class="{{ request()->routeIs('page2') ? 'active' : '' }}">
                        <a href="{{ route('page2') }}"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Page 2</span></a>
                    </li>
                    <li class="{{ request()->routeIs('page3') ? 'active' : '' }}">
                        <a href="{{ route('page3') }}"><i class="fa fa-pie-chart"></i> <span class="nav-label">Page 3</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-diamond"></i> <span class="nav-label">Layouts</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Graphs</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="#">Flot Charts</a></li>
                            <li><a href="#">Morris.js Charts</a></li>
                            <li><a href="#">Rickshaw Charts</a></li>
                            <li><a href="#">Chart.js</a></li>
                            <li><a href="#">Chartist</a></li>
                            <li><a href="#">c3 charts</a></li>
                            <li><a href="#">Peity Charts</a></li>
                            <li><a href="#">Sparkline Charts</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-envelope"></i> <span class="nav-label">Mailbox</span> <span class="label label-warning float-right">16/24</span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="#">Inbox</a></li>
                            <li><a href="#">Email view</a></li>
                            <li><a href="#">Compose email</a></li>
                            <li><a href="#">Email templates</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-pie-chart"></i> <span class="nav-label">Metrics</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-flask"></i> <span class="nav-label">Widgets</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Forms</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="#">Basic form</a></li>
                            <li><a href="#">Advanced Plugins</a></li>
                            <li><a href="#">Wizard</a></li>
                            <li><a href="#">File Upload</a></li>
                            <li><a href="#">Text Editor</a></li>
                            <li><a href="#">Autocomplete</a></li>
                            <li><a href="#">Markdown</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">App Views</span> <span class="float-right label label-primary">SPECIAL</span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="#">Contacts</a></li>
                            <li><a href="#">Profile</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Calendar</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Timeline</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Other Pages</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="#">Search results</a></li>
                            <li><a href="#">Lockscreen</a></li>
                            <li><a href="#">Invoice</a></li>
                            <li><a href="#">Login</a></li>
                            <li><a href="#">Forget password</a></li>
                            <li><a href="#">Register</a></li>
                            <li><a href="#">404 Page</a></li>
                            <li><a href="#">500 Page</a></li>
                            <li><a href="#">Empty page</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-globe"></i> <span class="nav-label">Miscellaneous</span><span class="label label-info float-right">NEW</span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="#">Notification</a></li>
                            <li><a href="#">Nestable list</a></li>
                            <li><a href="#">Agile board</a></li>
                            <li><a href="#">Timeline v.2</a></li>
                            <li><a href="#">Sweet alert</a></li>
                            <li><a href="#">Google maps</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-flask"></i> <span class="nav-label">UI Elements</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="#">Typography</a></li>
                            <li><a href="#">Icons</a></li>
                            <li><a href="#">Buttons</a></li>
                            <li><a href="#">Panels</a></li>
                            <li><a href="#">Tabs</a></li>
                            <li><a href="#">Notifications & Tooltips</a></li>
                            <li><a href="#">Badges, Labels, Progress</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-laptop"></i> <span class="nav-label">Grid options</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Tables</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="#">Static Tables</a></li>
                            <li><a href="#">Data Tables</a></li>
                            <li><a href="#">Foo Tables</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">E-commerce</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="#">Products grid</a></li>
                            <li><a href="#">Products list</a></li>
                            <li><a href="#">Product edit</a></li>
                            <li><a href="#">Product detail</a></li>
                            <li><a href="#">Cart</a></li>
                            <li><a href="#">Orders</a></li>
                            <li><a href="#">Credit Card form</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-picture-o"></i> <span class="nav-label">Gallery</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="#">Lightbox Gallery</a></li>
                            <li><a href="#">Slick Carousel</a></li>
                            <li><a href="#">Bootstrap Carousel</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Menu Levels</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li>
                                <a href="#">Third Level <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li><a href="#">Third Level Item</a></li>
                                    <li><a href="#">Third Level Item</a></li>
                                    <li><a href="#">Third Level Item</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Second Level Item</a></li>
                            <li><a href="#">Second Level Item</a></li>
                            <li><a href="#">Second Level Item</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-magic"></i> <span class="nav-label">CSS Animations</span> <span class="label label-info float-right">62</span></a>
                    </li>
                    <li class="landing_link">
                        <a target="_blank" href="#"><i class="fa fa-star"></i> <span class="nav-label">Landing Page</span> <span class="label label-warning float-right">NEW</span></a>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#"><i class="fa fa-bars"></i></a>
                        <form role="search" class="navbar-form-custom" action="search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Welcome to INSPINIA+ Admin Theme.</span>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a class="dropdown-item float-left" href="profile.html">
                                            <img alt="image" class="rounded-circle" src="{{ asset('img/a7.jpg') }}">
                                        </a>
                                        <div class="media-body">
                                            <small class="float-right">46h ago</small>
                                            <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                            <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a class="dropdown-item float-left" href="profile.html">
                                            <img alt="image" class="rounded-circle" src="{{ asset('img/a4.jpg') }}">
                                        </a>
                                        <div class="media-body">
                                            <small class="float-right text-navy">5h ago</small>
                                            <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                            <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a class="dropdown-item float-left" href="profile.html">
                                            <img alt="image" class="rounded-circle" src="{{ asset('img/profile.jpg') }}">
                                        </a>
                                        <div class="media-body">
                                            <small class="float-right">23h ago</small>
                                            <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                            <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a href="mailbox.html" class="dropdown-item">
                                            <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li>
                                    <a href="mailbox.html" class="dropdown-item">
                                        <div>
                                            <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                            <span class="float-right text-muted small">4 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <a href="profile.html" class="dropdown-item">
                                        <div>
                                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                            <span class="float-right text-muted small">12 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <a href="grid_options.html" class="dropdown-item">
                                        <div>
                                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                            <span class="float-right text-muted small">4 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a href="notifications.html" class="dropdown-item">
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="login.html">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            @yield('content')

            <div class="footer">
                <div class="float-right">
                    10GB of <strong>250GB</strong> Free.
                </div>
                <div>
                    <strong>Copyright</strong> Example Company &copy; 2014-2018
                </div>
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>
</body>

</html>
