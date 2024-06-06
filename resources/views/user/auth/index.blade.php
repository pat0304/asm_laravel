@extends('user.layout.app')

@section('content')
    <div class="row mt-5 al">
      @if (session('success'))
        <div class="alert alert-info" role="alert">
            {{session('success')}}
          </div>@endif
    @if (session('fail'))
        <div class="alert alert-danger" role="alert">
            {{session('fail')}}
          </div>@endif
        <div class="col-md-6">
            <h3 class="text-center mb-4">Đăng nhập</h3>
            <form action="{{route('auth.login')}}" method="POST" class=" bg-primary-subtle px-4 py-5 rounded-5 shadow">
            <div class="form-floating mb-3">
              @csrf
                <input type="text" class="form-control" name="username" value="{{old('username')}}" id="floatingInput" placeholder="Tên đăng nhập">
                <label for="floatingInput">Tên đăng nhập</label>
              </div>
              <div class="form-floating">
                <input type="password" class="form-control" name="password" value="{{old('password')}}" id="floatingPassword" placeholder="Mật khẩu">
                <label for="floatingPassword">Mật khẩu</label>
              </div>
              <div class="d-flex my-2 justify-content-between">
              <div class="form-check ">
                <input class="form-check-input" type="checkbox" value="" id="remember" />
                <label class="form-check-label" for="remember"> Nhớ mật khẩu </label>
              </div>
              <div class="">
                <a href="{{route('auth.forgot.index')}}">Quên mật khẩu</a>
              </div>
              </div>
              <button
                type="submit"
                class="btn btn-primary"
              >
                Đăng nhập
              </button>
              
            </form>
        </div>
        <div class="col-md-6">
            <h3 class="text-center mb-4">Đăng ký</h3>

            <form action="{{route('auth.register')}}" method="POST" class=" px-4 py-5 rounded-5 border">
              @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="reg_username"  id="floatingInput" placeholder="Tên đăng nhập">
                    <label for="floatingInput">Tên đăng nhập</label>
                  </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="reg_email" id="floatingInput" placeholder="abc@gmail.com">
                    <label for="floatingInput">Email</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="reg_phone" id="floatingPassword" placeholder="Số điện thoại">
                    <label for="floatingPassword">Số điện thoại</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="reg_password" id="floatingPassword" placeholder="Mật khẩu">
                    <label for="floatingPassword">Mật khẩu</label>
                  </div>
                  <div class="form-floating">
                    <input type="password" class="form-control" name="reg_repassword" id="floatingPassword" placeholder="Nhập lại mật khẩu">
                    <label for="floatingPassword">Nhập lại mật khẩu</label>
                  </div>
                  @if(session("error"))
                  <div
                    class="alert alert-danger"
                    role="alert"
                  >
                    <strong>Lỗi:</strong> Tên đăng nhập đã tồn tại
                  </div>
                  @endif
                  
                  <button
                    type="submit"
                    class="btn btn-outline-primary mt-3"
                  >
                    Đăng ký
                  </button>
                  
                </form>
        </div>
    </div>
@endsection