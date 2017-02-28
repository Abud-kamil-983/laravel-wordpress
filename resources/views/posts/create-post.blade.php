@extends('layouts.master')

@section('title', 'Create Post')

@section('content')
    @if(isset($post))
        {{ Form::model($post, ['route' => ['post.update', $post->id] , 'method' => 'put' , 'files' => true])}}    

    @else
    {!! Form::open(['url' => 'post' , 'files' => true]) !!}
    @endif
    {{ csrf_field() }}
   
    <div class="form-group">
    <label for="email">Title:</label>
    {{ Form::text('title' , null , ['class' => 'form-control']) }}
    @if ($errors->has('title')) <p class="error text-danger">{{ $errors->first('title') }}</p> @endif
    </div>

    <div class="form-group">
    <label for="pwd">Content:</label>
    {{ Form::text('content' , null , ['class' => 'form-control']) }}
    @if ($errors->has('content')) <p class="error text-danger">{{ $errors->first('content') }}</p> @endif
    </div>

    <div class="form-group">
    <label for="pwd">category:</label>
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
    @if ($errors->has('category')) <p class="error text-danger">{{ $errors->first('category') }}</p> @endif
    </div>     
    <div class="form-group">
    <label for="pwd">Tags:</label>
    {!! Form::select('tag_id[]', $tags, null, ['selected' => 'true' , 'class' => 'form-control' , 'multiple' => 'multiple']) !!}
    @if ($errors->has('tag')) <p class="error text-danger">{{ $errors->first('tag') }}</p> @endif
    </div>

    <div class="form-group">
    <img id="blah" src="#" /><br>
    
    {{ Form::file('image', ['onchange' => 'readURL(this)']) }}
   
    
    @if ($errors->has('file')) <p class="error text-danger">{{ $errors->first('file') }}</p> @endif
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
    {!! Form::close() !!}

@endsection
@section('js')
<script type="text/javascript">
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
            
        }

  $('select').select2();
  @php if (isset($post)) { @endphp
  $('select').select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');
@php}@endphp
</script>

@endsection
