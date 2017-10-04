@extends('main')

@section('title', '| Delete Comment?')

@section('content')

	<div class="row justify-content-center">
		<div class="col-md-8">
			<h1>DELETE THIS COMMENT?</h1>
			<p><strong>Name:</strong> {{$comment->name}}</p><br/>
			<p><strong>Email:</strong> {{$comment->email}}</p><br/>
			<p><strong>Comment:</strong> {{$comment->comment}}</p><br/>
		
			{{ Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) }}

			{{ Form::submit('YES', ['class' => 'btn btn-block btn-danger btn-lg']) }}

			{{ Form::close() }}

		</div>
	</div>

@endsection