@extends('admin.layout.app')

@section('content')
    <div class="d-flex flex-column justify-content-between min-vh-100">
        <div class="">
            <h3>Thống kê</h3>
            <div class="row gap-2 text-center m-auto" style="width: 500px;">
                <div class="col-5 bg-danger py-2 rounded">
                    <h6 class="text-white">Tổng doanh thu:</h6>
                    <h5 class="text-white">5.000.000đ</h5>
                </div>
                <div class="col-5 bg-success py-2 rounded">
                    <h6 class="text-white">Sản phẩm đã bán:</h6>
                    <h5 class="text-white">30</h5>
                </div>
                <div class="col-5 bg-primary py-2 rounded">
                    <h6 class="text-white">Số lượng người dùng:</h6>
                    <h5 class="text-white">5000</h5>
                </div>
                <div class="col-5 bg-warning py-2 rounded">
                    <h6 class="text-white">Số lượng sản phẩm:</h6>
                    <h5 class="text-white">20</h5>
                </div>
            </div>
        </div>
        <div class="hot-products">
            <h3>Top 3 sản phẩm bán chạy</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">Ảnh minh họa</th>
                        <th>Thông tin sản phẩm</th>
                        <th class="text-center">Số lượng đã bán</th>
                        <th class="text-center">Tồn kho</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $i)
                        <tr class="cart-item">
                            <td class="">
                                <div
                                    style="background: url('{{ $i['product']->image }}');
                    background-size: cover;
                    background-position:center; height: 100px; width:100px; margin: auto">
                                </div>
                            </td>
                            <td>
                                <h5>{{ $i['product']->name }}</h5>
                                <strong class="text-danger fs-5">{{ $i['product']->price }}</strong>
                            </td>
                            <td class="py-5 fs-5 text-center fw-bold">{{ $i['amount'] }}</td>
                            <td class="py-5 fs-5 text-center fw-bold">{{ $i['product']->warehouse }}</td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection
