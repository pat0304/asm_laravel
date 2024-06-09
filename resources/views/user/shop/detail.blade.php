@extends('user.layout.app')
@section('title', $title)
@section('content')
    <div class="row mt-5 gap-2">
      <div class="col-lg-6">
        <img width="500px" class="m-auto ms-5" src="{{$data->image}}" alt="">
      </div>
      <div class="col-lg-5">
        <div class="row mb-3">
        <h1>{{$data->name}}</h1>
        <div class="price position-relative mt-4">
        @if ($data->sale != null)
                  <div class="position-absolute" style="top: -10px; font-size: 12px">Giá gốc: <span class=" text-decoration-line-through">{{number_format($data->price,0, ',', '.')}}đ</span></div>
                  <h4 class="text-danger fs-2">{{number_format($data->sale,0, ',', '.')}}đ</h4>
                  @endif
                  @if ($data->sale == null)
                    <h4 class="fs-2">{{number_format($data->price,0, ',', '.')}}đ</h4>
                  @endif
        </div>
        <div class="">
            <h6>Mô tả:</h6>
            <p>{{$data->description}}</p>
        </div>
        
        </div>
        <form action="{{route('cart.add')}}" method="POST" class="row g-3">
          @csrf
            {{-- <div class="row mt-3">
              
            <div class="">
            <h6>Size:</h6>
            <input type="radio" class="btn-check" name="options" id="M" autocomplete="off" checked="">
            <label class="btn btn-outline-dark" for="M">M</label>

            <input type="radio" class="btn-check" name="options" id="L" autocomplete="off">
            <label class="btn btn-outline-dark" for="L">L</label>
          </div>
        </div> --}}
        <div class="col-3">
          <label for="">Số lượng</label>
        <input type="number" class="mb-2 form-control" value="1" step="1" max="{{$data->warehouse}}" name="quantity" min="1">
      </div>
        <input type="hidden" name="id" value="{{$data->id}}">
        <div class="col-6">
            <button type="submit" class="btn btn-danger mt-3 btn-lg">Thêm vào giỏ hàng</button></div>
          </form>
    </div>
    </div>
    <div class="mt-5">
        <h3>Sản phẩm tương tự:</h3>
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
          </div>
    </div>

    @endsection