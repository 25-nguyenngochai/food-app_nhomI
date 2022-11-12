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
                    <h2 style='font-family: auto;'>Cảm ơn bạn</h2>
                    <div class="breadcrumb__option"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <div class="row">
                <h2 style='text-align: center;font-family: auto;'>
                    Quý Khách Đã Đặt Hàng Thành Công Xin Vui Lòng Kiểm Tra Gmail Để Xem Lại Đơn Hàng</h2>
            </div>
        </div>
    </div>
</section>
@endsection