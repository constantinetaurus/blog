@extends('main')

@section('title', '| All Categories')

@section('content')

	<div class="row justify-content-center">
		<div class="col-md-8">
			<h1>All Categories</h1>
			<table class="table">
				<thead>
					<th>#</th>
					<th>Name</th>
					<th></th>
				</thead>

				<tbody>
					@foreach($categories as $category)
						<tr>
							<th>{{ $category->id }}</th>
							<td>{{ $category->name }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div> <!-- end of col-md-8 -->

		<div class="col-md-3">
			<div class="jumbotron">
				{!! Form::open(['route' => 'categories.store']) !!}

				<h4>New Category</h4>

				{{ Form::label('name', 'Name:', ['class' => 'form-spacing-top']) }}

				{{ Form::text('name', null, ['class' => 'form-control']) }}

				{{ Form::submit('Create New Category', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}

				{!! Form::close() !!}
			</div>
		</div>
	</div>

@endsection