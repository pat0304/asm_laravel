@extends('user.layout.app')
@section('title', 'Lịch sử mua hàng')

@section('content')
    <h3 class=" text-center mb-3">Lịch sử mua hàng</h3>
    <div class="row">

    </div>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">Mã đơn hàng</th>
                <th class="text-center">Số lượng sản phẩm</th>
                <th class="text-center">Tổng tiền</th>
                <th class="text-center">Ngày mua hàng</th>
                <th class="text-center">Trạng thái</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $i)
                <tr>
                    <td class="text-center ">
                        <a class="btn btn-outline-info fw-bold"
                            href="{{ route('order.detail', $i->id) }}">#{{ $i->id }}</a>
                    </td>
                    <td class="text-center">
                        {{ $i->amount }}
                    </td>
                    <td class="text-center">
                        {{ $i->total }}
                    </td>
                    <td class="text-center">
                        {{ $i->created_at }}
                    </td>
                    <td class="text-center">
                        @switch($i->status)
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
                    </td>
                    <td class="text-center"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
