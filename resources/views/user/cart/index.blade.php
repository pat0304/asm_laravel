@extends('user.layout.app')
@section('title', 'Giỏ hàng')
@section('content')
    <div class="row mt-4">
        @if (session()->has('cart'))
            @if (session('cart')->products != null)
                <div class="col-lg-9">
                    <h2 class="fw-bold text-center mb-5">Giỏ hàng</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Ảnh minh họa</th>
                                <th>Thông tin sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach (session('cart')->products as $i)
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
                                            <strong
                                                class=" fs-5">{{ number_format($i['product']['price'], 0, '.', '.') }}đ</strong>
                                        @endif

                                    </td>
                                    <td class="py-5">
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            <a href="
                            @if ($i['quantity'] > 1) {{ route('cart.decrease', $i['product']['id']) }}
                            @else
                            # @endif
                            "
                                                class="btn btn-outline-primary bi bi-dash"></a>
                                            <input type="button" value="{{ $i['quantity'] }}" disabled=""
                                                class="btn btn-outline-primary">
                                            <a href="{{ route('cart.increase', $i['product']['id']) }}"
                                                class="btn btn-outline-primary bi bi-plus"></a>
                                        </div>
                                    </td>
                                    <td class="py-5 fs-5 text-danger fw-bold">{{ number_format($i['total'], 0, '.', '.') }}
                                    </td>
                                    <td class="py-5">
                                        <form action="{{ route('cart.delete', $i['product']['id']) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-outline-danger" type="submit">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- <tr class="cart-item">
                    <td>
                        <div style="background: url('https://thanhvinhpet.vn/wp-content/uploads/2019/01/vneck-tee-2.jpg');
                    background-size: cover;
                    background-position:center; height: 150px;"></div>
                    </td>
                    <td>
                        <h5>Tên sản phẩm</h5>
                        <select class="form-select form-select-sm my-2 w-75" aria-label="Default select example">
                            <option value="M">M</option>
                        </select><strong class="text-danger fs-5">900.000</strong>
                    </td>
                    <td class="py-5">
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <button type="button" class="btn btn-outline-primary bi bi-dash"></button>
                            <input type="button" value="1" disabled="" class="btn btn-outline-primary">
                            <button type="button" class="btn btn-outline-primary bi bi-plus"></button>
                        </div>
                            </td>
                            <td class="py-5 fs-5 text-danger fw-bold">900.000</td>
                            <td class="py-5"><button class="btn btn-outline-danger">Xóa</button></td>
                        </tr> --}}
                        </tbody>
                    </table>
                </div>

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
                    <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100 my-4">Thanh toán</a>
                </div>
            @else
                <h2 class="fw-bold text-center mb-5">Giỏ hàng</h2>
                <p class="fw-light text-center text-secondary">Giỏ hàng rỗng</p>
            @endif
        @else
            <h2 class="fw-bold text-center mb-5">Giỏ hàng</h2>
            <p class="fw-light text-center text-secondary">Giỏ hàng rỗng</p>
        @endif
    </div>
@endsection
