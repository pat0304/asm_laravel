@extends('user.layout.app')

@section('content')
<div class="container">
    <h2 class="mt-5 mb-3">Tất cả bài viết</h2>
    <div class="row">
        <div class="col-md-8">
            <div class="row">
            @foreach ($data as $i)
                <div class="col-md-4 col-sm-6">
            <a href="/post/{{$i->id}}" class="text-decoration-none">
            <div class="card mb-3">
                <img src="{{$i->image}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{$i->title}}</h5>
                  <p class="card-text">{{$i->description}}</p>
                  <p class="card-text"><small class="text-body-secondary">View: {{$i->view}}</small></p>
                </div>
              </div></a>
        </div>
            @endforeach
        
    </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-2" style="width: 18rem;">
                    <div class="card-header">
                      Sắp xếp
                    </div>
                    <ul class="list-group list-group-flush">
                        <a href="?sort=id">
                      <li class="list-group-item">Mới nhất</li></a>
                        <a href="?sort=view">
                      <li class="list-group-item">Lượt xem giảm dần</li></a>
                      
                    </ul>
                    <div class="card-footer">
                        Sắp xếp
                    </div>
                  </div>
            <div class="card" style="width: 18rem;">
                
                <div class="card-header">
                  Danh mục
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($cata as $item)
                  <a href="/cat/{{$item->id}}" class=" text-decoration-none"><li class="list-group-item">{{$item->name}}</li></a>
                  @endforeach
                </ul>
                <div class="card-footer">
                    Danh mục
                </div>
              </div>
        </div>

    
    </div>
</div>
@endsection