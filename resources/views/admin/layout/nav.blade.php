<div class="d-flex flex-column justify-content-between  min-vh-100">
   <div class="bg-dark p-2">
    <a href="" class="d-flex text-decoration-none align-items-center text-light fs-2 ms-4 d-none d-sm-block">PatStore</a>
    <hr class=" text-light">
    <ul
        class="nav nav-pulls flex-column mt-4"
    >
    <li class="nav-item py-2 py-sm-0">
        <a class="nav-link text-white" href="/admin" aria-current="page"
            ><i class="fs-5 bi bi-speedometer"></i>
            <span class="fs-4 d-none d-sm-inline ms-2">Thống kê</span></a
        ></li>

    <li class="nav-item py-2 py-sm-0">
        <a class="nav-link text-white" href="/admin/categories" aria-current="page"
            ><i class="bi bi-bookmark-fill"></i>
            <span class="fs-4 d-none d-sm-inline ms-2">Danh mục</span></a
        ></li>
    <li class="nav-item py-2 py-sm-0">
        <a class="nav-link text-white" href="/admin/products" aria-current="page"
            ><i class="fs-5 bi bi-list-ul"></i>
            <span class="fs-4 d-none d-sm-inline ms-2">Sản phẩm</span></a
        ></li>
    <li class="nav-item py-2 py-sm-0">
        <a class="nav-link text-white" href="/admin/users" aria-current="page"
            ><i class="fs-5 bi bi-people-fill"></i>
            <span class="fs-4 d-none d-sm-inline ms-2">Người dùng</span></a
        ></li>
    <li class="nav-item py-2 py-sm-0">
        <a class="nav-link text-white" href="/admin" aria-current="page"
            ><i class="fs-5 bi bi-bag-check-fill"></i>
            <span class="fs-4 d-none d-sm-inline ms-2">Đơn hàng</span></a
        ></li>
    </ul>
    
</div>

<div class="dropdown open">
    <button
        class="btn btn-secondary dropdown-toggle"
        type="button"
        id="triggerId"
        data-bs-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
    >
        <i class="bi bi-user"></i><span>{{Auth::user()->username}}</span>
    </button>
    <div class="dropdown-menu" aria-labelledby="triggerId">
        <form class="" action="{{route('auth.logout')}}" method="POST">
            @csrf
            <button class="dropdown-item ">Đăng xuất</button></form>
    </div>
</div> 
</div>

