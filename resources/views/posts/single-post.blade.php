@extends('layouts.master');
@section('title', 'single post')
@section('content')
<div class="container">
	title: <p>{{$post->title}}</p>
	content: <p>{{$post->content}}</p>
	category: <p>{{$post->category->name}}</p>

</div>

@endsection