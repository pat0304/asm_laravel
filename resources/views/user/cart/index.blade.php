@extends('user.layout.app')
@section('content')
<div class="row mt-4">
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
                <tr class="cart-item">
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
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-lg-3 mt-5">
        <div class="card w-100 mt-5" style="">
            <div class="card-header">
                Thanh toán
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between"><span>Tổng cộng
                        (VNĐ):</span><span>900.000</span></li>
                <li class="list-group-item d-flex justify-content-between"><span>Thuế
                        (2%):</span><span>18.000</span></li>
                <li class="list-group-item d-flex justify-content-between"><span>Giảm giá:</span><span>0</span>
                </li>
            </ul>
            <div class="card-footer d-flex justify-content-between">
                <span>Thành tiền (VNĐ):</span> <span>918.000</span>
            </div>
        </div>
        <button class="btn btn-primary w-100 my-4">Thanh toán</button>
    </div>
</div>
@endsection