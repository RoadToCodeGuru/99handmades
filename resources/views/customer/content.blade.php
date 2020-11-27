@extends('customer.layouts.app')

@section('head-content')
@endsection

@section('upper_header-content')
@endsection

@section('header-content')
@endsection

@section('menu-content')
<!-- 
Body Section 
-->
<div class="row">
    <div id="sidebar" class="span3">
            <div class="well well-small">
                <ul class="nav nav-list">
                    <li><a href="products.html"><span class="icon-chevron-right"></span>Fashion</a></li>
                    <li><a href="products.html"><span class="icon-chevron-right"></span>Watches</a></li>
                    <li style="border:0"> &nbsp;</li>
                    <li> <a class="totalInCart" href="cart.html"><strong>Total Amount  <span class="badge badge-warning pull-right" style="line-height:18px;">$448.42</span></strong></a></li>
                </ul>
            </div>

    </div>
    <div class="span9">
        <div class="well well-small">
            <div class="row-fluid">	  
                <div class="span2">
                    <img src="{{asset('customer/assets/img/a.jpg')}}" alt="">
                </div>
                <div class="span6">
                    <h5>Product Name </h5>
                    <p>
                    Nowadays the lingerie industry is one of the most successful business spheres.
                    We always stay in touch with the latest fashion tendencies - 
                    that is why our goods are so popular..
                    </p>
                </div>
                <div class="span4 alignR">
                <form class="form-horizontal qtyFrm">
                <h3> $140.00</h3>
                <!-- <label class="checkbox">
                    <input type="checkbox">  Adds product to compair
                </label><br> -->
                <div class="btn-group">
                <a href="product_details.html" class="defaultBtn"><span class=" icon-shopping-cart"></span> Add to cart</a>
                <!-- <a href="product_details.html" class="shopBtn">VIEW</a> -->
                </div>
                    </form>
                </div>
            </div>
            <hr class="soften">
        </div>
    </div>
</div>
@endsection

@section('footer-content')
@endsection