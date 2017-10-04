@extends('main')

@section('title', '| View Post')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>{{ $post->title }}</h1>
			<p class="lead">{!! $post->body !!}</p>
			<hr>
			<div class="tags">
				@foreach($post->tags as $tag)
					<span class="badge badge-pill badge-secondary">{{ $tag->name }}</span>
				@endforeach
			</div>

			<div id="backend-comments">
				<h3>Comments<small> {{$post->comments()->count()}} total</small></h3>
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Comment</th>
							<th></th>
						</tr>
					</thead>

					<tbody>

						@foreach($post->comments as $comment)
							<tr>
								<td>{{$comment->name}}</td>
								<td>{{$comment->email}}</td>
								<td>{{$comment->comment}}</td>
								<td>
									<a href="{{route('comments.edit', $comment->id)}}" class="btn btn-sm btn-outline-secondary btn-block">Edit</a>
									<a href="{{route('comments.delete', $comment->id)}}" class="btn btn-sm btn-outline-danger btn-block">Delete</a>
								</td>
							</tr>
						@endforeach
						
					</tbody>
				</table>
			</div>

		</div>
	
		<div class="col-md-4">
			<div class="jumbotron">
				<div class="lead">
					<dl class="dl-horizontal">
						<dt>Url:</dt>
						<dd><a href="{{ route('blog.single', $post->slug) }}">{{ route('blog.single', $post->slug) }}</a></dd>
					</dl>

					<dl class="dl-horizontal">
						<dt>Category:</dt>
						<dd>{{ $post->category->name }}</dd>
					</dl>

					<dl class="dl-horizontal">
						<dt>Created At:</dt>
						<dd>{{ date('M j, Y h:ia', strtotime($post->created_at))}}</dd>
					</dl>

					<dl class="dl-horizontal">
						<dt>Last updated At:</dt>
						<dd>{{ date('M j, Y h:ia', strtotime($post->updated_at))}}</dd>
					</dl>
				</div>
				<hr>

				<div class="row">

					<div class="col-sm-6">

						{!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block')) !!} {{-- Laravel way to place a link on the page --}}

						{{-- <a href="" class="btn btn-primary btn-block">Edit</a> original way to place a link on the page--}} 
						
					</div>

					<div class="col-sm-6">
						{!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}

						{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block', ]) !!}
					
						{!! Form::close() !!}
					</div>

				</div>

				<div class="row">
					<div class="col-12">

						{{ Html::linkRoute('posts.index', '<< See All Posts', [], ['class' => 'btn btn-sm btn-block btn-outline-secondary btn-h1-spacing']) }}
					
					</div>
				</div>

			</div>
				
		</div>
	</div>

@endsection