@extends('user.layout.app')

@section('content')
<form method="POST" action="{{route('auth.forgot')}}">
    <h3>Quên mật khẩu</h3>
    @if (session('success'))
        <div class="alert alert-info" role="alert">
            {{session('success')}}
          </div>@endif
    @if (session('fail'))
        <div class="alert alert-danger" role="alert">
            {{session('fail')}}
          </div>@endif
    <div class="mb-3">
      <label for="username" class="form-label">Tên đăng nhập</label>
      @csrf
      <input type="username" class="form-control" id="username" name="username">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email">
    </div>
    <button type="submit" class="btn btn-primary">Xác nhận</button>
  </form>
@endsection