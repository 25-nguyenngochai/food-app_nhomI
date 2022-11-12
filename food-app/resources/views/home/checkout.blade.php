@extends('home.master')
@section('content')
<?php
function OnSelectionChange()
{
    echo ("OK IT WORKS");
}
?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Checkout</h2>
                    <div class="breadcrumb__option">
                        <a href="{{url('index')}}">Home</a>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Billing Details</h4>
            <form action="{{route('checkcart')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        @if (Auth::check())
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Full Name<span>*</span></p>
                                    <input type="text" value="{{Auth::user()->name}}" disabled>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input type="text" value="{{Auth::user()->phone}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input type="text" placeholder="Street Address" value="{{Auth::user()->address}}" class="checkout__input__add">
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" value="{{Auth::user()->email}}" disabled>
                                </div>
                            </div>
                        </div>
                        @endif
                        <p>PayMents<span>*</span></p>
                        <div class="form-group">
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select name="pay" id="selectBox" class="form-control">
                                    @foreach($Payments as $Payment_name)
                                    <option value="{{$Payment_name->id}}">{{$Payment_name->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6">
                        <div class="checkout__order">
                            <h4>Your Order</h4>
                            <div class="checkout__order__products"></div>
                            @if(Session::has('cart'))
                            @foreach($product_cart as $product)
                            <ul>
                                <li><img src="{{asset('images/'.$product['item']['image'])}}" style="width: 100px;" alt="">&nbsp;&nbsp;&nbsp;{{$product['qty']}} x {{$product['item']['name']}}</li>
                                <li style="margin-left:10px;color:black;font-weight: bold">Giá: {{number_format($product['item']['price'])}} đ</li>
                            </ul>
                            @endforeach
                            <div class="checkout__order__total">Total:<span>{{number_format(Session('cart')->totalPrice)}}VND</span></div>
                            <button type="submit" class="site-btn">Đặt Hàng</button>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection