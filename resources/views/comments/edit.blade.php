@extends('main')

@section('title', '| Edit Comment')

@section('content')

	<div class="row justify-content-center">

		<div class="col-md-8">

			<h1>Edit Comment</h1>

			{{ Form::model($comment, ['route' => ['comments.update', $comment->id], 'method' => 'PUT']) }}

			{{ Form::label('name', 'Name:', ['class' => 'form-spacing-top']) }}
			{{ Form::text('name', null, ['class' => 'form-control', 'disabled' => '']) }}

			{{ Form::label('email', 'Email:', ['class' => 'form-spacing-top']) }}
			{{ Form::text('email', null, ['class' => 'form-control', 'disabled' => '']) }}

			{{ Form::label('comment', 'Comment:', ['class' => 'form-spacing-top']) }}
			{{ Form::text('comment', null, ['class' => 'form-control']) }}

			{{ Form::submit('Update Comment', ['class' => 'btn btn-block btn-success btn-outline-primary form-spacing-top']) }}

			{{ Form::close() }}

		</div>

	</div>

@endsection