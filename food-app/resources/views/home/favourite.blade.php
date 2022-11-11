@extends('home.master')
@section('content')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shopping Cart</h2>
                    <div class="breadcrumb__option">
                        <a href="{{url('index')}}">Home</a>
                        <span>Favourite</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allWishlist as $value)
                            <tr>
                                <td class="shoping__cart__item"
                                    onclick="location.href='{{url('shop-details')}}?product_id={{$value->id}}';"
                                    style="cursor: pointer;">
                                    <img src="{{asset('images/'.$value->image)}}" style="width: 100px;" alt="">
                                    <h5>{{$value->name}}</h5>
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qtys">
                                            <input type="text" value="1" readonly="true">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__price">{{number_format($value->price)}} VND</td>
                                <td class="shoping__cart__item__close">
                                    <span onclick="location.href='';" data-product_id="{{$value->id}}"
                                        class="update_wishlist icon_close"></span>
                                    @if(Auth::check())
                                    <input type="hidden" value="{{Auth::user()->id}}" id="user_id">
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$allWishlist->links('paginate.paginate')}}
            </div>
        </div>
    </div>
</section>
@endsection