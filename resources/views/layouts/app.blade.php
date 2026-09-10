<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoop Zone - Basketball Apparel</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img 
    src="{{ asset('img/LL.png') }}" 
    alt="image" 
    class="rounded-circle img-responsive"
    style="max-width: 100%; height: auto; width: 50px; object-fit: cover;"
>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold">Rodel & Jaby</span>
                                <span class="text-muted text-xs block">BSIT 4B <b class="caret"></b></span>
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
                            <li><a href="{{ route('dashboard') }}">Dashboard v.1</a></li>
                            <li class="{{ request()->routeIs('page1') ? 'active' : '' }}"><a href="{{ route('page1', ['artist' => 'default']) }}">Page 1</a></li>
                            <li class="{{ request()->routeIs('page2') ? 'active' : '' }}"><a href="{{ route('page2') }}">Page 2</a></li>
                            <li class="{{ request()->routeIs('page3') ? 'active' : '' }}"><a href="{{ route('page3') }}">Page 3</a></li>
                            <li class="{{ request()->routeIs('movie') ? 'active' : '' }}"><a href="{{ route('movie', ['title' => 'default']) }}">Movie</a></li>
                            <li class="{{ request()->routeIs('book') ? 'active' : '' }}"><a href="{{ route('book', ['title' => 'default']) }}">Book</a></li>
                            <li class="{{ (request()->routeIs('hoop-shop') || request()->routeIs('hoop.*')) ? 'active' : '' }}"><a href="{{ route('hoop-shop') }}">Hoop Shop</a></li>
                        </ul>
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

            <!-- Hoop Shop Auth Links -->
            <div class="top-auth-links" style="padding: 10px 24px; background: #201d19; border-bottom: 1px solid #3a352e; display: flex; align-items: center; flex-wrap: wrap; gap: 10px;">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('hoop.admin.dashboard') }}" class="btn btn-default btn-sm"><i class="fa fa-cog"></i> Admin</a>
                    @endif
                    <a href="{{ route('hoop.cart') }}" class="cart-btn">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="cart-label">Cart</span>
                        @if(session('cart'))
                            <span class="cart-count">{{ array_sum(session('cart')) }}</span>
                        @endif
                    </a>
                    <div class="user-dropdown" style="position: relative; display: inline-flex; align-items: center;">
                        <button id="userDropdownBtn" type="button" style="background: #26231f; border: 1px solid #3a352e; border-radius: 8px; padding: 6px 12px; cursor: pointer; font-size: 0.9rem; font-weight: 500; color: #f2ede3; display: inline-flex; align-items: center; gap: 8px;">
                            <span style="display: inline-flex; align-items: center; gap: 8px;">
                                <span id="userAvatarPlace" style="width: 26px; height: 26px; border-radius: 50%; background: #e2611d; color: #fff; display: inline-flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: 700; overflow: hidden;">
                                    {{ mb_strimwidth(auth()->user()->name ?? '', 0, 2, '') }}
                                </span>
                                <span id="userNameDisplay" style="font-size: 0.9rem; white-space: nowrap;">{{ auth()->user()->name ?? 'User' }}</span>
                            </span>
                            <i id="userCaret" class="fa fa-chevron-down" style="font-size: 0.7rem; color: #9a9186; transition: transform 0.2s;"></i>
                        </button>
                        <div id="userDropdownMenu" class="user-dropdown-menu" style="display: none; position: absolute; top: 100%; right: 0; margin-top: 6px; background: #26231f; border: 1px solid #3a352e; border-radius: 10px; box-shadow: 0 8px 20px rgba(0,0,0,0.5); min-width: 220px; z-index: 2000; overflow: hidden;">
                            <div style="padding: 14px 16px; border-bottom: 1px solid #3a352e; background: #201d19;">
                                <div style="font-weight: 700; font-size: 1rem; color: #f2ede3;">{{ auth()->user()->name ?? 'User' }}</div>
                                <div style="font-size: 0.82rem; color: #9a9186; margin-top: 2px;">{{ auth()->user()->email ?? '' }}</div>
                            </div>
                            <a href="{{ route('hoop.profile') }}" style="display: flex; align-items: center; gap: 10px; padding: 12px 16px; color: #f2ede3; text-decoration: none; font-size: 0.9rem; transition: background 0.2s;" onmouseover="this.style.background='#2e2a25'" onmouseout="this.style.background='#26231f'">
                                <i class="fa fa-user-edit" style="color: #e2611d; font-size: 0.95rem;"></i> Edit Profile
                            </a>
                            @if(auth()->user()->role === 'client')
                                <a href="{{ route('hoop.orders') }}" style="display: flex; align-items: center; gap: 10px; padding: 12px 16px; color: #f2ede3; text-decoration: none; font-size: 0.9rem; transition: background 0.2s;" onmouseover="this.style.background='#2e2a25'" onmouseout="this.style.background='#26231f'">
                                    <i class="fa fa-truck" style="color: #e2611d; font-size: 0.95rem;"></i> My Orders
                                </a>
                            @else
                                <a href="{{ route('hoop.admin.dashboard') }}" style="display: flex; align-items: center; gap: 10px; padding: 12px 16px; color: #f2ede3; text-decoration: none; font-size: 0.9rem; transition: background 0.2s;" onmouseover="this.style.background='#2e2a25'" onmouseout="this.style.background='#26231f'">
                                    <i class="fa fa-cog" style="color: #e2611d; font-size: 0.95rem;"></i> Admin Dashboard
                                </a>
                            @endif
                            <div style="border-top: 1px solid #3a352e;">
                                <form method="POST" action="{{ auth()->user()->role === 'admin' ? route('hoop.admin.logout') : route('hoop.logout') }}" style="display: block;">
                                    @csrf
                                    <button type="submit" style="width: 100%; padding: 12px 16px; background: none; border: none; color: #9a9186; text-decoration: none; font-size: 0.9rem; cursor: pointer; text-align: left; transition: color 0.2s; display: flex; align-items: center; gap: 10px;" onmouseover="this.style.color='#c96a54'" onmouseout="this.style.color='#9a9186'">
                                        <i class="fa fa-sign-out" style="font-size: 0.95rem;"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                        (function() {
                            var btn = document.getElementById('userDropdownBtn');
                            var menu = document.getElementById('userDropdownMenu');
                            var caret = document.getElementById('userCaret');

                            function openMenu() {
                                menu.style.display = 'block';
                                if (caret) caret.style.transform = 'rotate(180deg)';
                                var rect = menu.getBoundingClientRect();
                                if (rect.right > window.innerWidth) {
                                    menu.style.left = '0';
                                    menu.style.right = 'auto';
                                } else {
                                    menu.style.left = 'auto';
                                    menu.style.right = '0';
                                }
                            }

                            function closeMenu() {
                                menu.style.display = 'none';
                                if (caret) caret.style.transform = 'rotate(0deg)';
                            }

                            btn.addEventListener('click', function(e) {
                                e.stopPropagation();
                                if (menu.style.display === 'block') {
                                    closeMenu();
                                } else {
                                    openMenu();
                                }
                            });

                            document.addEventListener('click', function(e) {
                                if (menu.style.display === 'block' && !btn.contains(e.target) && !menu.contains(e.target)) {
                                    closeMenu();
                                }
                            });

                            document.addEventListener('keydown', function(e) {
                                if (e.key === 'Escape' && menu.style.display === 'block') {
                                    closeMenu();
                                }
                            });
                        })();
                    </script>
                @else
                    <a href="{{ route('hoop.login') }}" class="btn-auth btn-auth-ghost">
                        <i class="fa fa-sign-in"></i>
                        <span>Login</span>
                    </a>
                    <a href="{{ route('hoop.register') }}" class="btn-auth btn-auth-primary">
                        <i class="fa fa-user-plus"></i>
                        <span>Sign Up</span>
                    </a>
                @endauth
            </div>

            @yield('content')

            <!-- Footer -->
            <footer class="site-footer">
                <div class="footer-grid">
                    <div class="footer-brand">
                        <a href="{{ route('hoop-shop') }}" class="nav-brand">
                            <img src="{{ asset('img/hoopzone.png') }}" alt="HoopZone">
                            <span>HOOP ZONE</span>
                        </a>
                        <p>Your destination for premium basketball apparel and gear. Quality products, fast delivery, great prices.</p>
                        <div class="footer-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                    <div class="footer-column">
                        <h4>Shop</h4>
                        <ul>
                            <li><a href="{{ route('hoop-shop') }}">All Products</a></li>
                            <li><a href="#">Jerseys</a></li>
                            <li><a href="#">Shorts</a></li>
                            <li><a href="#">Shoes</a></li>
                            <li><a href="#">Accessories</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4>Support</h4>
                        <ul>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">FAQs</a></li>
                            <li><a href="#">Shipping</a></li>
                            <li><a href="#">Returns</a></li>
                            <li><a href="#">Size Guide</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4>Account</h4>
                        <ul>
                            <li><a href="{{ route('hoop.login') }}">Login</a></li>
                            <li><a href="{{ route('hoop.register') }}">Register</a></li>
                            <li><a href="{{ route('hoop.orders') }}">My Orders</a></li>
                            <li><a href="#">Wishlist</a></li>
                            <li><a href="#">Profile</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-bottom">
                    <span>&copy; {{ date('Y') }} Hoop Zone. All rights reserved.</span>
                    <div class="footer-payments">
                        <span>VISA</span>
                        <span>MC</span>
                        <span>PayPal</span>
                        <span>GCash</span>
                    </div>
                </div>
            </footer>
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
