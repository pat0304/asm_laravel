<nav class="navbar navbar-expand-lg bg-light position-sticky start-0 end-0 top-0 z-3">
    <div class="container">
        <a class="navbar-brand" href="/">PatStore</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="position-relative" role="search">
                <input class="form-control rounded-5 ps-5" type="search" placeholder="Nhập tên sản phẩm..."
                    aria-label="Search">
                <i class="bi bi-search position-absolute fs-5 top-50 start-0 ms-3 translate-middle-y"></i>
            </form>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fs-6 fw-bold gap-3">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Trang chủ</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Sản phẩm
                    </a>
                    <ul class="dropdown-menu">
                        @php
                            $categories = \App\Models\Category::getCategories();
                        @endphp
                        <li><a class="dropdown-item" href="/products">Tất cả sản phẩm</a></li>
                        @foreach ($categories as $i)
                            <li><a class="dropdown-item"
                                    href="/products/category/{{ $i->id }}">{{ $i->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/post">Tin tức</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/cart"><i class="bi bi-cart-fill"> Giỏ hàng</i></a>
                </li>
                @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ Auth::user()->username }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/products">Thông tin người dùng</a></li>
                            <li><a class="dropdown-item" href="{{ route('order.index') }}">Lịch sử mua hàng</a></li>
                            <li><a class="dropdown-item" href="{{ route('auth.changePassword.index') }}">Đổi mật
                                    khẩu</a></li>
                            <li>
                                <form class="" action="{{ route('auth.logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item ">Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/login"><i class="bi bi-person-circle">
                                Tài khoản
                            </i></a>
                    </li>
                @endif
            </ul>

        </div>
    </div>
</nav>
