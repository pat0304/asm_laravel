@extends('admin.layout.app')

@section('title', 'Người dùng')

@section('content')
<header>
    <h1>Quản lý người dùng</h1>
    @if (session('success'))
    <div class="alert alert-info" role="alert">
        {{session('success')}}
      </div>@endif
    <div class="row">
    
        <div class="col-sm-9">
            <form action="{{route('users.search')}}" method="POST" class="row g-3">
                @csrf
                <div class="col-sm-2">
                <select class="form-select " aria-label="Default select example" name="search_value">
                    <option value="id" selected>ID</option>
                    <option value="name">Username</option>
                  </select>
                </div>
                  <div class="col-sm-8">
                  <input type="text" class="form-control" placeholder="Tìm kiếm..." name="search_content" value="{{old('search_content')}}">
                </div>
                <div class="col-sm-2">
                  <button class="btn btn-outline-primary" type="submit">Tìm kiếm</button>
                </div>
              </form>
        </div>
    </div>
    
    <div class="container">
      <h3>Tất cả người dùng</h3>
      <table class="table">
        <thead>
          <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Username</th>
            <th class="text-center">Email</th>
            <th class="text-center">Số điện thoại </th>
            <th class="text-center">Vai trò</th>
            <th class="text-center">Ngày tham gia </th>
            <th class="text-center">Hành động</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $i)
          <tr>
            <td class="py-5 fs-5 text-center fw-bold">
              {{$i->id}}
            </td>
            <td class="py-5 fs-5 text-center fw-bold">
              {{$i->username}}
            </td>
            <td class="py-5 fs-5 text-center fw-bold">
              {{$i->email}}
            </td>
            <td class="py-5 fs-5 text-center fw-bold">
              {{$i->phone}}
            </td>
            <td class="py-5 fs-5 text-center fw-bold">
              @if ($i->role == 1)
                Admin
              @else
                User
              @endif
            </td>
            <td class="py-5 fs-5 text-center fw-bold">
              {{$i->created_at}}
            </td>
            <td class="py-5 fs-5 text-center fw-bold">
            <a href="{{route('users.edit', $i->id)}}" class="btn btn-success"><i class="bi bi-arrow-repeat"></i></a>
            <form class="d-inline-block" method="POST" action="{{route('users.destroy', $i->id)}}">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger" onclick="return confirm('Xác nhận xóa sản phẩm {{$i->username}}?')"><i class="bi bi-trash3-fill"></i></button>
            </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</header>
@endsection