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
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
@if(Session::has('cart'))
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product_cart as $value)
                            <tr>
                                <td class="shoping__cart__item">
                                    <img src="{{asset('images/'.$value['item']['image'])}}" style="width: 100px;"
                                        alt="">
                                    <h5>{{$value['item']['name']}}</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    {{number_format($value['item']['price'])}} VND
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qtys">
                                            <span
                                                onclick="location.href='{{route('delcartone', $value['item']['id'])}}';"
                                                class="dec qtybtn">-</span>
                                            <input type="text" value="{{$value['qty']}}">
                                            <span onclick="location.href='{{route('addCart', $value['item']['id'])}}';"
                                                class="inc qtybtn">+</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    {{number_format($value['qty'] * $value['item']['price'])}} VND
                                </td>
                                <td class="shoping__cart__item__close">
                                    <span onclick="location.href='{{route('delCart', $value['item']['id'])}}'"
                                        class="icon_close"></span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <li>Total Quantity <span>{{Session('cart')->totalQty}} Product</span></li>
                        <li>Total Price <span>{{number_format(Session('cart')->totalPrice)}} VND</span></li>
                    </ul>
                    @if (Auth::check())
                    @if(Auth::user()->user_type === 'user')
                    <a href="{{url('checkout')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    @else
                    <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    @endif
                    @else
                    <a href="{{url('login')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endsection