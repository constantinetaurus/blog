@extends('main')

@section('title', '| All Tags')

@section('content')

	<div class="row justify-content-center">
		<div class="col-md-8">
			<h1>All Tags</h1>
			<table class="table">
				<thead>
					<th>#</th>
					<th>Name</th>
					<th></th>
				</thead>

				<tbody>
					@foreach($tags as $tag)
						<tr>
							<th>{{ $tag->id }}</th>
							<td>
								<a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div> <!-- end of col-md-8 -->

		<div class="col-md-3">
			<div class="jumbotron">
				{!! Form::open(['route' => 'tags.store']) !!}

				<h4>New Tag</h4>

				{{ Form::label('name', 'Name:', ['class' => 'form-spacing-top']) }}

				{{ Form::text('name', null, ['class' => 'form-control']) }}

				{{ Form::submit('Create New Tag', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}

				{!! Form::close() !!}
			</div>
		</div>
	</div>

@endsection