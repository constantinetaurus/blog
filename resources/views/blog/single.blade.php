@extends('main')

@section('title', "| $post->title")  {{-- if you use a double quotations it means that php variable can be used --}}

@section('content')

<div class="row justify-content-center">
	<div class="col-md-8">

		<img src="{{ asset('images/' . $post->image) }}" height="400" width="800"> {{-- asset links us to the public folder of our Laravel project --}}
		<h1>{{ $post->title }}</h1>
		<p>{!! $post->body !!}</p>
		<hr>
		<p>Posted In: {{ $post->category->name }}</p>
	</div>
</div>

<div class="row justify-content-center">
	<div class="col-md-8">
	<h3 class="comments-title">{{$post->comments()->count()}} Comments</h3>
		@foreach($post->comments as $comment)
			<div class="comment">
				<div class="autho-info">
					<img src="{{"https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email)))}}" class="author-image" />
					<div class="author-name">
						<h5>{{$comment->name}}</h5>
						<p class="author-time">{{date('F nS, Y - g:iA', strtotime($comment->created_at))}}</p>
					</div>
				</div>
				<div class="comment-content">
					{{$comment->comment}}
				</div>
				<hr>
			</div>
		@endforeach
	</div>
</div>

<div class="row justify-content-center">
	<div class="comment-form col-md-8">
		{{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST' ]) }}

			<div class="row">

				<div class="col-md-6">
					{{ Form::label('name', 'Name:', ['class' => 'form-spacing-top']) }}
					{{ Form::text('name', null, ['class' => 'form-control']) }}
				</div>

				<div class="col-md-6">
					{{ Form::label('email', 'Email:', ['class' => 'form-spacing-top']) }}
					{{ Form::text('email', null, ['class' => 'form-control']) }}
				</div>

				<div class="col-md-12">
					{{ Form::label('comment', 'Comment:') }}
					{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}
				
					{{ Form::submit('Add Comment', ['class' => 'btn btn-success btn-block form-spacing-top']) }}
				</div>

			</div>

		{{ Form::close() }}
	</div>
</div>

@endsection
