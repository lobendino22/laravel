<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hoop Shop - Basketball Apparel</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <style>
        :root {
            --accent: #e95c29;
            --ink: #1c2024;
            --muted: #6b7280;
            --line: #e9ecef;
            --bg: #ffffff;
        }
        body {
            background: var(--bg);
            color: var(--ink);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            letter-spacing: .1px;
        }

        /* ---------- Navbar ---------- */
        .store-navbar {
            background: #fff;
            border-bottom: 1px solid var(--line);
            padding: .65rem 0;
        }
        .store-navbar .navbar-brand {
            font-weight: 800;
            letter-spacing: 2px;
            color: var(--ink);
            font-size: 1.75rem;
            text-transform: uppercase;
        }
        .store-navbar .navbar-brand img {
            height: 48px;
            width: auto;
            margin-right: .5rem;
        }
        .store-navbar .nav-link {
            color: var(--muted) !important;
            font-size: .92rem;
            font-weight: 500;
            letter-spacing: .4px;
            padding: .45rem .9rem !important;
        }
        .store-navbar .nav-link:hover { color: var(--ink) !important; }
        .badge-cart {
            background: var(--accent);
            color: #fff;
            border-radius: 50%;
            font-size: .68rem;
            padding: 2px 6px;
            vertical-align: top;
            margin-left: 2px;
        }
        .btn-outline-dark.btn-sm.nav-cta { border-radius: 30px; padding: .3rem 1.1rem; }

        /* ---------- Buttons ---------- */
        .btn-primary {
            background: var(--ink);
            border-color: var(--ink);
            border-radius: 4px;
            font-weight: 600;
            letter-spacing: .4px;
        }
        .btn-primary:hover, .btn-primary:focus {
            background: var(--accent);
            border-color: var(--accent);
        }
        .btn-outline-dark { border-radius: 4px; font-weight: 500; }

        /* ---------- Content ---------- */
        .store-main { min-height: calc(100vh - 160px); padding: 3rem 0 4rem; }

        /* ---------- Product cards ---------- */
        .product-card {
            border: 1px solid var(--line);
            border-radius: 8px;
            overflow: hidden;
            transition: box-shadow .2s ease, transform .2s ease;
        }
        .product-card:hover {
            box-shadow: 0 8px 24px rgba(28, 32, 36, .08);
            transform: translateY(-3px);
        }
        .product-card img { height: 210px; object-fit: cover; width: 100%; }
        .product-card .card-body { display: flex; flex-direction: column; padding: 1.1rem; }
        .product-card .card-title {
            font-size: .95rem;
            font-weight: 600;
            margin-bottom: .25rem;
            color: var(--ink);
        }
        .product-card .card-text { color: var(--muted); font-size: .82rem; }
        .price-tag { font-size: 1.05rem; font-weight: 700; color: var(--accent); }
        .stock-tag { font-size: .75rem; font-weight: 500; }

        /* ---------- Page headings ---------- */
        .page-head h3 { font-weight: 700; letter-spacing: .3px; }
        .page-head a { color: var(--muted); font-size: .88rem; }
        .page-head a:hover { color: var(--ink); text-decoration: none; }

        /* ---------- Search ---------- */
        .search-box .form-control {
            border-radius: 30px;
            border: 1px solid var(--line);
            padding-left: 1rem;
            font-size: .9rem;
        }
        .search-box .btn { border-radius: 30px; }

        /* ---------- Tables / cards ---------- */
        .min-card {
            border: 1px solid var(--line);
            border-radius: 8px;
            background: #fff;
        }
        .min-card .card-header {
            background: #fff;
            border-bottom: 1px solid var(--line);
            font-weight: 600;
            font-size: .95rem;
            letter-spacing: .3px;
            padding: 1rem 1.25rem;
        }
        .table { color: var(--ink); }
        .table thead th {
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: var(--muted);
            border-bottom: 1px solid var(--line);
        }
        .table td { border-top: 1px solid var(--line); }

        /* ---------- Alerts ---------- */
        .alert { border-radius: 6px; border: 0; font-size: .9rem; }

        /* ---------- Footer ---------- */
        .store-footer {
            border-top: 1px solid var(--line);
            background: #fff;
            color: var(--muted);
            padding: 1.6rem 0;
            font-size: .85rem;
            letter-spacing: .3px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg store-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('hoop-shop') }}">
                <img src="{{ asset('img/HOOP.png') }}" alt="Hoop Shop logo"> HOOP SHOP
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#storeNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="storeNav">
                <ul class="navbar-nav ml-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('hoop-shop') }}">SHOP</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('hoop.cart') }}">
                            <i class="fa fa-shopping-bag"></i> CART
                            @if(session()->has('cart') && count(session('cart')) > 0)
                                <span class="badge-cart">{{ array_sum(session('cart')) }}</span>
                            @endif
                        </a>
                    </li>
                    @auth
                        @if(auth()->user()->role === 'client')
                            <li class="nav-item"><a class="nav-link" href="{{ route('hoop.orders') }}">MY ORDERS</a></li>
                        @endif
                        <li class="nav-item">
                            <form method="POST" action="{{ route('hoop.logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link"><i class="fa fa-sign-out"></i></button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('hoop.login') }}">LOGIN</a></li>
                        <li class="nav-item ml-lg-2">
                            <a class="btn btn-outline-dark btn-sm nav-cta" href="{{ route('hoop.register') }}">SIGN UP</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="store-main">
        <div class="container">
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="store-footer text-center">
        HOOP SHOP &copy; {{ date('Y') }} &middot; Basketball Apparel Store
    </footer>

    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>

</html>