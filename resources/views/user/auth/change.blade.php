@extends('user.layout.app')

@section('content')
<form method="POST" action="{{route('auth.changePassword')}}">
    <div class="mb-3">
      <label for="password" class="form-label">Mật khẩu cũ</label>
      @csrf
      <input type="password" class="form-control" id="password" aria-describedby="emailHelp" name="password">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Mật khẩu mới</label>
      <input type="password" class="form-control" id="exampleInputPassword1" name="new_password">
    </div>
    <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
  </form>
@endsection