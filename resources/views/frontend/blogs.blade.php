
@extends('layouts.frontend')
@section('title','Blogs')
@section('content')
@foreach ($blogs as $blog)
<img src="{{asset('blog_images/'.$blog->image)}}" alt=""> <br><br>
    <div class="row">
       <img src="{{asset('blog_images/big-'.$blog->image)}}" alt=""> <br>
        <h2>{{$blog->title}}</h2>
        {!!$blog->details!!}
    </div>
@endforeach

@endsection