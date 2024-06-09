@extends('user.layout.app')
@section('title', 'Lịch sử mua hàng')

@section('content')
    <div class="row mt-4">
        <div class="col-lg-9">
            <h2 class="fw-bold text-center mb-5">Giỏ hàng</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Ảnh minh họa</th>
                        <th>Thông tin sản phẩm</th>
                        <th class=" text-center">Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($order_detail['products'] as $i)
                        <tr class="cart-item">
                            <td>
                                <div
                                    style="background: url('{{ url($i['product']['image']) }}');
                                    background-size: cover;
                                    background-position:center; height: 150px;">
                                </div>
                            </td>
                            <td>
                                <h5>{{ $i['product']['name'] }}</h5>
                                @if ($i['product']['sale'] != null)
                                    <strong
                                        class="text-danger fs-5">{{ number_format($i['product']['sale'], 0, '.', '.') }}đ</strong>
                                @else
                                    <strong class=" fs-5">{{ number_format($i['product']['price'], 0, '.', '.') }}đ</strong>
                                @endif

                            </td>
                            <td class="py-5 text-center">
                                {{ $i['quantity'] }}
                            </td>
                            <td class="py-5 fs-5 text-danger fw-bold">{{ number_format($i['total'], 0, '.', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-3 mt-5">
            <div class="card w-100 mt-5" style="">
                <div class="card-header">
                    Thông tin đơn hàng
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between"><span>Họ tên khách
                            hàng:</span><span>{{ $order->lastname . ' ' . $order->firstname }}</span></li>
                    <li class="list-group-item d-flex justify-content-between"><span>Số điện
                            thoại:</span><span>{{ $order->phone }}</span></li>
                    <li class="list-group-item d-flex justify-content-between"><span>Địa
                            chỉ:</span><span>{{ $order->address }}</span></li>
                    <li class="list-group-item d-flex justify-content-between"><span>Tổng số
                            lượng:</span><span>{{ $order_detail['totalQuantity'] }}</span></li>
                    <li class="list-group-item d-flex justify-content-between"><span>Tổng cộng
                            (VNĐ):</span><span>{{ number_format($order_detail['totalPrice'], 0, '.', '.') }}</span>
                    </li>
                </ul>
                <div class="card-footer d-flex justify-content-between">
                    <span>Trạng thái:</span>
                    <span>
                        @switch($order->status)
                            @case(0)
                                Chờ xác nhận
                            @break

                            @case(1)
                                Đã xác nhận
                            @break

                            @case(2)
                                Đang vận chuyển
                            @break

                            @case(3)
                                Đã nhận hàng
                            @break

                            @case(-1)
                                Đã hủy
                            @break

                            @default
                        @endswitch
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
