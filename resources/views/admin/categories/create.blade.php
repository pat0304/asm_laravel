@extends('admin.layout.app')

@section('content')
<form method="POST" action="{{ route('categories.store') }}">
  @csrf
    <div class="row mb-3">
      <label for="category" class="col-sm-2 col-form-label" >Tên danh mục</label>
      <div class="col-sm-10">
        <input type="text" name="name" class="form-control" id="category">
      </div>
      @error('name')
          <div class="text-danger">{{$message}}</div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">Sửa</button>
</form>
@endsection