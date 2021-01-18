<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Dream Catcher</span>
                    </div>
                    <ul  style="overflow-y: auto; max-height: 500px;">
                        @foreach($sub_dc->sub_categories as $dc)
                            <li><a href="content/{{ $dc->id }}">{{ $dc->sub_category_name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="hero__categories_2">
                    <div class="hero__categories__all_2">
                        <i class="fa fa-bars"></i>
                        <span>Resin & Mold</span>
                    </div>
                    <ul  style="overflow-y: auto; max-height: 500px;">
                        @foreach($sub_rs->sub_categories as $rs)
                            <li><a href="content/{{ $rs->id }}">{{ $rs->sub_category_name }}</a></li>
                        @endforeach    
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <!-- <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div> -->
                            <input type="text" placeholder="Item ID">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5 class="pt-3"> 09964982910</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->