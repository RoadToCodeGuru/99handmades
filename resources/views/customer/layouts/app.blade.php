<!DOCTYPE html>
<html lang="en">
<head>
	@include('customer.layouts.head')
	@yield('head-content')
</head>
<body class="fix-header card-no-border logo-center">
    @include('customer.layouts.upper_header')
    @yield('upper_header-content')
    <div class="container">
	@include('customer.layouts.header')
    @yield('header-content')
    @include('customer.layouts.menu')
	@yield('menu-content')
    </div>   
    @include('customer.layouts.footer')
    @yield('footer-content')	
</body>
</html>