@extends('admin.layout.app')

@section('title', 'Đơn hàng')

@section('content')
    <h3>Quản lý đơn hàng</h3>
    @if (session('success'))
        <div class="alert alert-info" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">

        <div class="col-sm-9">
            <form action="{{ route('orders.search') }}" method="GET" class="row g-3">
                @csrf
                <div class="col-sm-2">
                    <select class="form-select " aria-label="Default select example" name="search_value" disabled>
                        <option value="id" selected>ID</option>
                    </select>
                </div>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Tìm kiếm..." name="search_content">
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-outline-primary" type="submit">Tìm kiếm</button>
                </div>
            </form>
        </div>
        <div class="col-sm-3 text-end">
        </div>
        <div class="container">
            <h3>Tất cả đơn hàng</h3>
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
                                    href="{{ route('orders.show', $i->id) }}">#{{ $i->id }}</a>
                            </td>
                            <td class="text-center">
                                {{ $i->amount }}
                            </td>
                            <td class="text-center">
                                {{ number_format($i->total, 0, '.', '.') }}
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
                            <td class="text-center">
                                <form class="d-inline-block" method="POST" action="{{ route('orders.update') }}">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $i->id }}">
                                    <select name="status" id="" class="form-select form-select-sm mb-3"
                                        onchange="this.form.submit()">
                                        <option value="{{ $i->status }}" selected>
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
                                        </option>
                                        <option value="0">Đang xử lý</option>
                                        <option value="1">Đã xác nhận</option>
                                        <option value="2">Đang vận chuyển</option>
                                        <option value="3">Đã nhận</option>
                                        <option value="-1">Đã hủy</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
