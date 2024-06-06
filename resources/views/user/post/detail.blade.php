@extends('user.layout.app')

@section('content')
<div class="row"><a href="/post">Back</a>
    <div class="col-md-9">
    
        <h3>{{$data->title}}</h3>
        <h5>{{$data->description}}</h5>
        @php
            $content = json_decode($data->content);
        @endphp
        <p>{{$content[0]}}</p>
        <img src="{{$content[1]}}" class="w-100" loading="lazy" alt="">
        <br/>
    </div>
    <div class="col-md-3">
        <h5>Thông tin bài viết</h5>
        <p>Danh mục: {{ $nameCata }}</p>
        <p>Lượt xem: {{$data->view}}</p>
        <p>Ngày đăng: {{$data->created_at}}</p>
    </div>
    </div>
@endsection