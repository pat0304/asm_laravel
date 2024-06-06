@extends('user.layout.app')

@section('content')
<form method="POST" action="{{route('auth.reset')}}">
    @method('PUT')
    <h3>Đặt lại mật khẩu</h3>
    @if (session('success'))
        <div class="alert alert-info" role="alert">
            {{session('success')}}
          </div>@endif
    @if (session('fail'))
        <div class="alert alert-danger" role="alert">
            {{session('fail')}}
          </div>@endif
    <div class="mb-3">
      <label for="password" class="form-label">Mật khẩu mới</label>
      @csrf
      <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="mb-3">
      <label for="repassword" class="form-label">Nhập lại mật khẩu</label>
      <input type="password" class="form-control" id="repassword" name="repassword">
    </div>
    <input type="hidden" name="user" value="{{$user_id}}">
    <button type="submit" class="btn btn-primary">Xác nhận</button>
  </form>
@endsection