<!DOCTYPE html>
<html lang="en">
<head>
	@include('admin.layouts.head')
	@yield('head-content')
</head>
<body class="fix-header card-no-border logo-center">
	@include('admin.layouts.header')
    @yield('header-content')
    @include('admin.layouts.menu')
	@yield('menu-content')
    
    @include('admin.layouts.footer')
    @yield('footer-content')	
</body>
</html>