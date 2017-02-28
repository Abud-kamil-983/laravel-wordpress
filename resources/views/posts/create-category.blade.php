@extends('layouts.master')
@section('title', 'Create Category')
@section('content')
{!! Form::open(['url' => 'save-category']) !!}
<div class="form-group">
    <label for="email">Category:</label>
    {{ Form::text('name' , null , ['class' => 'form-control']) }}
    @if ($errors->has('name')) <p class="error text-danger">{{ $errors->first('name') }}</p> @endif
</div>

    <button type="submit" class="btn btn-default btn-lg">Submit</button>

{!!	Form::close() !!}

@endsection