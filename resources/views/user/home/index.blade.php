@extends('user.layout.app')
@section('header')
@include('user.layout.header')
@endsection
@section('content')
{{-- Newest --}}
<div class="my-3">
  @if(session("token"))
    {{session("token")}}
  @endif
    <h3>Mới ra mắt</h3>
    <div class="row px-3">
      @foreach ($new as $i)
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img src="{{$i->image}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{ $i->name }}</h5>
                  <div class="price mt-3 position-relative">
                  @if ($i->sale != null)
                  <div class="position-absolute" style="top: -10px; font-size: 12px">Giá gốc: <span class=" text-decoration-line-through">{{number_format($i->price,0, ',', '.')}}đ</span></div>
                  <h4 class="text-danger">{{number_format($i->sale,0, ',', '.')}}đ</h4>
                  @endif
                  @if ($i->sale == null)
                    <h4 class="">{{number_format($i->price,0, ',', '.')}}đ</h4>
                  @endif
                  
                </div>
                  <a href="/product/{{$i->id}}" class="btn btn-primary">Chi tiết</a>
                </div>
              </div>
        </div>
      @endforeach
        
    </div>
  </div>
    {{-- Hot sale --}}
    <div class="my-3">
    <h3>Hot sale</h3>
    <div class="row px-3">
      @foreach ($sale as $i)
      <div class="col-md-4">
          <div class="card" style="width: 18rem;">
              <img src="{{$i->image}}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">{{ $i->name }}</h5>
                <div class="price mt-3 position-relative">
                @if ($i->sale != null)
                <div class="position-absolute" style="top: -10px; font-size: 12px">Giá gốc: <span class=" text-decoration-line-through">{{number_format($i->price,0, ',', '.')}}đ</span></div>
                <h4 class="text-danger">{{number_format($i->sale,0, ',', '.')}}đ</h4>
                @endif
                @if ($i->sale == null)
                  <h4 class="">{{number_format($i->price,0, ',', '.')}}đ</h4>
                @endif                
                
              </div>
              
                <a href="/product/{{$i->id}}" class="btn btn-primary">Chi tiết</a>
              </div>
            </div>
      </div>
    @endforeach
    </div></div>
@endsection