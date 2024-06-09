@extends('user.layout.app')

@section('title', 'Thanh toán')

@section('content')
    <div class="row">
        <div class="col-lg-9">
            <h2 class="fw-bold text-center mb-5">
                Thông tin thanh toán
            </h2>
            <form action="{{ route('checkout.buy') }}" class="row g-3" method="POST">
                @csrf
                <div class="col-md-6">
                    <label for="firstname" class="form-label">Tên</label>
                    <input type="text" name="firstName" class="form-control" id="firstname">
                </div>
                <div class="col-md-6">
                    <label for="lastname" class="form-label">Họ</label>
                    <input type="text" name="lastName" class="form-control" id="lastname">
                </div>
                <div class="col-md-12">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <input type="text" placeholder="123 Trần Hưng Đạo, Bình Thạnh, TP Hồ Chí Minh" name="address"
                        class="form-control" id="address">
                </div>
                <div class="col-md-12">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" id="phone">
                </div>
                <button type="submit" class="btn btn-primary w-100 my-4 col-12">Thanh toán</button>
            </form>
        </div>

        @if (session()->has('cart'))
            @if (session('cart')->products != null)
                <div class="col-lg-3 mt-5">
                    <div class="card w-100 mt-5" style="">
                        <div class="card-header">
                            Thanh toán
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between"><span>Tổng số
                                    lượng:</span><span>{{ session('cart')->totalQuantity }}</span></li>
                            <li class="list-group-item d-flex justify-content-between"><span>Tổng cộng
                                    (VNĐ):</span><span>{{ number_format(session('cart')->totalPrice, 0, '.', '.') }}</span>
                            </li>
                        </ul>
                        <div class="card-footer d-flex justify-content-between">
                            <span>Thành tiền (VNĐ):</span>
                            <span>{{ number_format(session('cart')->totalPrice, 0, '.', '.') }}</span>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
@endsection
