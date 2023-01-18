 <!DOCTYPE html>
 <html lang="IR-fa" dir="rtl">

 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>@yield('title')</title>
     <!-- Icons -->
     <link href="{{ asset('dashboard/css/font-awesome.min.css') }}" rel="stylesheet">
     <link href="{{ asset('dashboard/css/simple-line-icons.css') }}" rel="stylesheet">
     <!-- Main styles for this application -->
     <link href="{{ asset('dashboard/dest/style.css') }}" rel="stylesheet">

     <link rel="stylesheet" href="{{ asset('noty/noty.css') }}">
     <script src="{{ asset('noty/noty.min.js') }}" defer></script>

     @yield('styles')
 </head>

 <body class="navbar-fixed sidebar-nav fixed-nav">
     <header class="navbar">
         <div class="container-fluid">
             <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">&#9776;</button>
             <a class="navbar-brand" href="#"></a>
             <ul class="nav navbar-nav hidden-md-down">
                 <li class="nav-item">
                     <a class="nav-link navbar-toggler layout-toggler" href="#">&#9776;</a>
                 </li>

             </ul>
             <ul class="nav navbar-nav pull-left hidden-md-down">
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button"
                         aria-haspopup="true" aria-expanded="false">
                         <span class="hidden-md-down">{{ Auth::user()->name }}</span>
                         <span>{{ Auth::user()->email }}</span>
                     </a>
                     <div class="dropdown-menu dropdown-menu-right">
                         <div class="dropdown-header text-xs-center">
                             <strong>Account</strong>
                         </div>
                         <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> الملف الشخصي<span
                                 class="tag tag-info">42</span></a>
                         <div class="dropdown-header text-xs-center">
                             <strong>Settings</strong>
                         </div><a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                             <i class="fa fa-lock"></i>تسجيل خروج
                         </a>

                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                             @csrf
                         </form>
                     </div>
                 </li>
                 <li class="nav-item">
                 </li>

             </ul>
         </div>
     </header>
     <div class="sidebar">
         <nav class="sidebar-nav">
             <ul class="nav">
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('admin.home') }}"><i class="icon-speedometer"></i> لوحة التحكم </a>
                 </li>

                 <li class="nav-title">
                     الأدوات
                 </li>
                 <li class="nav-item nav-dropdown">
                     <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i> التذاكر</a>
                     <ul class="nav-dropdown-items">
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('admin.tickets.index') }}"><i class="icon-puzzle"></i>
                                 تحتاج مراجعة</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('admin.tickets.index') }}?filter=all"><i
                                     class="icon-puzzle"></i> كل التذاكر</a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('admin.profiles.index') }}"><i class="icon-user"></i> ملفات
                         الزبائن </a>
                 </li>

                 <li class="nav-item nav-dropdown">
                     <a class="nav-link" href="{{ route('admin.users.index') }}"><i class="icon-user"></i>
                         المستخدمين</a>

                 </li>

                 <li class="nav-item">
                     <a class="nav-link" href="#"><i class="icon-settings"></i> الأعدادات </a>
                 </li>
                 <li class="nav-title">
                     Extras
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('admin.myProfile') }}"><i class="icon-lock"></i> الملف الشخصي
                     </a>
                 </li>
             </ul>
         </nav>
     </div>
     <!-- Main content -->
     @yield('content')



     <footer class="footer">
         <span class="text-left">CRM &copy; 2023 .
         </span>
     </footer>
     <!-- Bootstrap and necessary plugins -->
     <script src="{{ asset('dashboard/js/libs/jquery.min.js') }}"></script>
     <script src="{{ asset('dashboard/js/libs/tether.min.js') }}"></script>
     <script src="{{ asset('dashboard/js/libs/bootstrap.min.js') }}"></script>
     <script src="{{ asset('dashboard/js/libs/pace.min.js') }}"></script>

     <!-- Plugins and scripts required by all views -->
     <script src="{{ asset('dashboard/js/libs/Chart.min.js') }}"></script>

     <!-- CoreUI main scripts -->

     <script src="{{ asset('dashboard/js/app.js') }}"></script>

     <!-- Plugins and scripts required by this views -->
     <!-- Custom scripts required by this view -->
     {{-- <script src="{{ asset('dashboard/js/views/main.js') }}"></script> --}}
     {{-- <script src="{{ asset('dashboard/js/views/charts.js') }}"></script> --}}

     @extends('layouts._noty')
     {{-- @yield('scripts') --}}
     @stack('scripts')
 </body>

 </html>
