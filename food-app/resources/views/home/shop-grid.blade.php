@extends('home.master')
@section('content')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Organi Shop</h2>
                    <div class="breadcrumb__option">
                        <a href="{{url('index')}}">Home</a>
                        <a href="#">Shop</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>All Catagory</h4>
                        <ul>
                            @foreach($allCategory as $value)
                            <li><a href="{{url('shop-grid')}}?category_id={{$value->id}}">{{$value->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar__item">
                        <h4>Price</h4>
                        <div class="price-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="10" data-max="540">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6><span>{{$countAllProduct}}</span> Products found</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($allProduct as $value)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{asset('images/'.$value->image)}}">
                                <!-- <div class="product__item__pic set-bg" data-setbg="{{asset('images/'.$value->image)}}"
                                onclick="location.href='{{url('shop-details')}}?product_id={{$value->id}}';"
                                style="cursor: pointer;"> -->
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <!-- <h6><a href="#">{{$value->name}}</a> -->
                                <h6><a href="{{url('shop-details')}}?product_id={{$value->id}}">{{$value->name}}</a>
                                </h6>
                                <h5>{{number_format($value->price)}} VND</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                {{$allProduct->links('paginate.paginate')}}
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

@endsection