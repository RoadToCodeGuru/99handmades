<!DOCTYPE html>
<html lang="en">
<head>
	@include('customer.layouts.head')
	@yield('head-content')
</head>
<body>
    @include('customer.layouts.upper_header')
    @yield('upper_header-content')

	@include('customer.layouts.header')
    @yield('header-content')
    @include('customer.layouts.menu')
	@yield('menu-content')
   
    @include('customer.layouts.footer')
    @yield('footer-content')	
</body>
</html>