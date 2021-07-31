<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Title -->
    <title>Dashboard | Prime Pages Admin</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">


    <!-- DEMO CHARTS -->
    <link rel="stylesheet" href="{{ asset('demo/chartist.css') }}">
    <link rel="stylesheet" href="{{ asset('demo/chartist-plugin-tooltip.css') }}">

    <!-- Template -->
    <link rel="stylesheet" href="{{ asset('graindashboard/css/graindashboard.css') }}">
    @yield('tinyMce')

</head>

<body class="has-sidebar has-fixed-sidebar-and-header">
<!-- Header -->
<header class="header bg-body">
    <nav class="navbar flex-nowrap p-0">
        <div class="navbar-brand-wrapper d-flex align-items-center col-auto">
            <!-- Logo For Mobile View -->
            <a class="navbar-brand navbar-brand-mobile" href="/">
                <h5></h5>
                <!-- <img class="img-fluid w-100" src="{{ asset('img/logo-mini.png') }}" alt="Graindashboard"> -->
            </a>
            <!-- End Logo For Mobile View -->

            <!-- Logo For Desktop View -->
            <a class="navbar-brand navbar-brand-desktop" href="/">
                <h6 style="color: black;"></h6>
                <!-- <img class="side-nav-show-on-closed" src="{{ asset('img/logo-mini.png') }}" alt="Graindashboard" style="width: auto; height: 33px;">
                <img class="side-nav-hide-on-closed" src="{{ asset('img/logo.png') }}" alt="Graindashboard" style="width: auto; height: 33px;"> -->
            </a>
            <!-- End Logo For Desktop View -->
        </div>

        <div class="header-content col px-md-3">
            <div class="d-flex align-items-center">
                <!-- Side Nav Toggle -->
                <a  class="js-side-nav header-invoker d-flex mr-md-2" href="#"
                    data-close-invoker="#sidebarClose"
                    data-target="#sidebar"
                    data-target-wrapper="body">
                    <i class="gd-align-left"></i>
                </a>
                <!-- End Side Nav Toggle -->

                <!-- User Notifications -->
                <div class="dropdown ml-auto">
                    <a id="notificationsInvoker" class="header-invoker" aria-controls="notifications" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-target="#notifications" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-animation-in="fadeIn" data-unfold-animation-out="fadeOut">
                        <span class="indicator indicator-bordered indicator-top-right indicator-primary rounded-circle"></span>
                        <i class="gd-bell"></i>
                    </a>
                </div>
                <!-- End User Notifications -->
                <!-- User Avatar -->
                <div class="dropdown mx-3 dropdown ml-2">
                    <a id="profileMenuInvoker" class="header-complex-invoker" href="#" aria-controls="profileMenu" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-target="#profileMenu" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-animation-in="fadeIn" data-unfold-animation-out="fadeOut">
                        <!--img class="avatar rounded-circle mr-md-2" src="#" alt="John Doe"-->
                        <span class="mr-md-2 avatar-placeholder">A</span>
                        <span class="d-none d-md-block">Admin</span>
                        <i class="gd-angle-down d-none d-md-block ml-2"></i>
                    </a>

                    <ul id="profileMenu" class="unfold unfold-user unfold-light unfold-top unfold-centered position-absolute pt-2 pb-1 mt-4 unfold-css-animation unfold-hidden fadeOut" aria-labelledby="profileMenuInvoker" style="animation-duration: 300ms;">
                        <li class="unfold-item unfold-item">
                            <a class="unfold-link d-flex align-items-center text-nowrap" href="/admin_logout">
                    <span class="unfold-item-icon mr-3">
                      <i class="gd-power-off"></i>
                    </span>
                                Sign Out
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End User Avatar -->
            </div>
        </div>
    </nav>
</header>
<!-- End Header -->

<main class="main">
    <!-- Sidebar Nav -->
    <aside id="sidebar" class="js-custom-scroll side-nav">
        <ul id="sideNav" class="side-nav-menu side-nav-menu-top-level mb-0">
            <!-- Title -->
            <li class="sidebar-heading h6">Dashboard</li>
            <!-- End Title -->

            @if(auth()->user()->role == "mismo")
            <!-- Posts -->
            <li class="side-nav-menu-item side-nav-has-menu @yield('add-blog') @yield('posts')">
                <a class="side-nav-menu-link media align-items-center" href="#"
                   data-target="#subUsers">
                  <span class="side-nav-menu-icon d-flex mr-3">
                    <i class="gd-comment"></i>
                  </span>
                    <span class="side-nav-fadeout-on-closed media-body">Blogs</span>
                    <span class="side-nav-control-icon d-flex">
                <i class="gd-angle-right side-nav-fadeout-on-closed"></i>
              </span>
                    <span class="side-nav__indicator side-nav-fadeout-on-closed"></span>
                </a>

                <!-- Posts: subPosts -->
                <ul id="subUsers" class="side-nav-menu side-nav-menu-second-level mb-0">
                    <li class="side-nav-menu-item @yield('posts')">
                        <a class="side-nav-menu-link" href="/admin/allposts">All Blogs</a>
                    </li>
                    <li class="side-nav-menu-item @yield('add-blog')">
                        <a class="side-nav-menu-link " href="/admin/add-blog">Add Blog</a>
                    </li>
                </ul>
                <!-- End Posts: subPosts -->
            </li>
            <!-- End Posts -->
            @endif

             <!-- Comments -->
             <li class="side-nav-menu-item @yield('comments')">
                <a class="side-nav-menu-link media align-items-center" href="/admin/comments">
              <span class="side-nav-menu-icon d-flex mr-3">
                <i class="gd-comments"></i>
              </span>
                    <span class="side-nav-fadeout-on-closed media-body">Comments</span>
                </a>
            </li>
            <!-- End Comments -->


            <!-- Users -->
            <li class="side-nav-menu-item @yield('add-admin')">
                <a class="side-nav-menu-link media align-items-center" href="/admin/create">
              <span class="side-nav-menu-icon d-flex mr-3">
                <i class="gd-user"></i>
              </span>
                    <span class="side-nav-fadeout-on-closed media-body">Create Admin</span>
                </a>
            </li>
            <!-- End Users -->

            <!-- Logout -->
            <li class="side-nav-menu-item">
                <a class="side-nav-menu-link media align-items-center" href="/admin_logout">
              <span class="side-nav-menu-icon d-flex mr-3">
                <i class="gd-power-off"></i>
              </span>
                    <span class="side-nav-fadeout-on-closed media-body">Sign Out</span>
                </a>
            </li>
            <!-- End Logout -->

        </ul>
    </aside>
    <!-- End Sidebar Nav -->

    @yield('content')


    <!-- Footer -->
    <footer class="small p-3 px-md-4 mt-auto">
            <div class="row justify-content-between">
                <div class="col-lg text-center text-lg-left mb-3 mb-lg-0">
                    <!-- <ul class="list-dot list-inline mb-0">
                        <li class="list-dot-item list-dot-item-not list-inline-item mr-lg-2"><a class="link-dark" href="#">FAQ</a></li>
                        <li class="list-dot-item list-inline-item mr-lg-2"><a class="link-dark" href="#">Support</a></li>
                        <li class="list-dot-item list-inline-item mr-lg-2"><a class="link-dark" href="#">Contact us</a></li>
                    </ul> -->
                </div>

                <div class="col-lg text-center mb-3 mb-lg-0">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item mx-2"><a class="link-muted" href="#"><i class="gd-twitter-alt"></i></a></li>
                        <li class="list-inline-item mx-2"><a class="link-muted" href="#"><i class="gd-facebook"></i></a></li>
                        <li class="list-inline-item mx-2"><a class="link-muted" href="#"><i class="gd-github"></i></a></li>
                    </ul>
                </div>

                <div class="col-lg text-center text-lg-right">
                    &copy; 2020 Mismo Solutions. All Rights Reserved.
                </div>
            </div>
        </footer>
        <!-- End Footer -->
    </div>
</main>


<script src="{{ asset('graindashboard/js/graindashboard.js') }}"></script>
<script src="{{ asset('graindashboard/js/graindashboard.vendor.js') }}"></script>

<!-- DEMO CHARTS -->
<script src="{{ asset('demo/resizeSensor.js') }}"></script>
<script src="{{ asset('demo/chartist.js') }}"></script>
<script src="{{ asset('demo/chartist-plugin-tooltip.js') }}"></script>
<script src="{{ asset('demo/gd.chartist-area.js') }}"></script>
<script src="{{ asset('demo/gd.chartist-bar.js') }}"></script>
<script src="{{ asset('demo/gd.chartist-donut.js') }}"></script>
<script>
    $.GDCore.components.GDChartistArea.init('.js-area-chart');
    $.GDCore.components.GDChartistBar.init('.js-bar-chart');
    $.GDCore.components.GDChartistDonut.init('.js-donut-chart');
</script>
</body>
</html>