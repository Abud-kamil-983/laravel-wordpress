@extends('layouts.master');
@section('title', 'Posts list')
@section('content')

<div class="container">
	<a href="{{route('post.create')}}" class="btn btn-info btn-lg">Add post</a>
  <a href="{{route('category.create')}}" class="btn btn-info btn-lg">Add Category</a>
  <a href="{{route('tag.create')}}" class="btn btn-info btn-lg">Add tag</a>
  <h2>Posts lists</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Sl no.</th>
        <th>Title</th>
        <th>Slug</th>
        <th>Category</th>
        <th>Tag</th>
        <th>Content</th>
      </tr>
    </thead>
    <tbody>
    @php
$i = 1
@endphp
    @foreach($posts as $post)
      <tr>
        <td>{{$i}}</td>
        <td>{{$post->title}}</td>
        <td>{{$post->slug}}</td>
        <td>{{$post->category->name}}</td>

        <td>
        @foreach ($post->tags as $tag)
        <span class="label label-info">{{$tag->name}}</span>&nbsp;
        @endforeach
        </td>
        
        <td>
        {{substr($post->content , 0 , 20)}}

        </td>
        <td><a href="{{route('post.single' , $post->slug)}}" class="btn btn-info btn-xs">Read more</a></td>
        @if(!empty(Auth::User()->email) && Auth::User()->email == 'kamil@vyrazu.com')
        <td><a href="{{route('post.edit' , $post->id)}}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span>edit</a></td>
        <td>{{ Form::open(['method' => 'DELETE', 'route' => ['post.destroy', $post->id]]) }}
                {{ Form::hidden('id', $post->id) }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) }}
            {{ Form::close() }}</td>@endif
      </tr>
      @php
		$i++
		@endphp
    @endforeach  
     </tbody>
  </table>
  {{ $posts->links() }}
</div>
@endsection