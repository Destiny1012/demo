<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Tricker">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', '后台管理系统') - by Tricker</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> @yield('style')

</head>

<body>

    <div id="wrapper">
        <!-- navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <!-- navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle btn btn-outline-secondary" data-toggle="collapse" data-target="#side-bar" aria-expanded="false"
                    aria-controls="side-bar">
                    <i class="fas fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">后台管理</a>
            </div>

            <!-- navbar-top-links -->
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right"></ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-tasks"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right"></ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right"></ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-item disabled">
                            <a href="#">
                                <i class="fas fa-user fa-fw"></i>
                                {{ Auth::user()->name }}
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="#">
                                <i class="fas fa-cog fa-fw"></i>
                                用户设置
                            </a>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-item">
                            <a href="#">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="btn btn-link" type="submit">
                                        <i class="fas fa-sign-out-alt fa-fw"></i>
                                        退出登录
                                    </button>
                                </form>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>

            <!-- sidebar -->
            <div class="navbar-default sidebar">
                <div class="sidebar-nav navbar-collapse collapse" id="side-bar">
                    <ul class="nav in accordion" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group input-group-sm custom-search-form">
                                <input class="form-control input-group-propend" type="text" placeholder="搜索…">
                                <span class="input-group-btn input-group-append">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </li>
                        <li>
                            <a class="active" href="{{ route('home') }}">
                                <i class="fas fa-tachometer-alt fa-fw"></i>
                                控制面板
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-chart-area fa-fw"></i>
                                业务详情
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-table fa-fw"></i>
                                商品列表
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-edit fa-fw"></i>
                                表单
                            </a>
                        </li>
                        <li>
                            <a href="#" id="goods-btn" data-toggle="collapse" data-target="#goods-dropdown" aria-expanded="false" aria-controls="goods-dropdown">
                                <i class="fas fa-list-alt fa-fw"></i>
                                商品管理
                                <i class="right fas fa-caret-left"></i>
                            </a>
                            <ul id="goods-dropdown" class="nav nav-second-level collapse" aria-labelledby="goods-btn" data-parent="#side-bar">
                                <li><a href="{{ route('goods.index') }}">商品列表</a></li>
                                <li><a href="{{ route('goods.create') }}">添加商品</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-cogs fa-fw"></i>
                                系统设置
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>

        <div id="page-wrapper" style="background-color: white;">
            <div class="row">
                <div class="col">
                    <h2 class="page-header">
                        @yield('page', '控制面板')
                    </h2>
    @include('shared.messages')
                </div>
            </div>

            @yield('container')

        </div>

        <footer class="footer">
            <p>Copyright © 2017 Tricker Pan</p>
        </footer>
    </div>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('script')

</body>

</html>