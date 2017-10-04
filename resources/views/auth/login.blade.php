@extends('main')

@section('title', "| Login")

@section('content')

	<div class="row justify-content-center">
		<div class="col-md-6">
			{!! Form::open() !!}

				{{ Form::label('email', 'Email:') }}
				{{ Form::email('email', null, ['class' => 'form-control']) }}			

				{{ Form::label('password', 'Password:', ['class' => 'form-spacing-top']) }}
				{{ Form::password('password', ['class' => 'form-control']) }}

				{{ Form::checkbox('remember') }} {{ Form::label('remember', 'Remember Me') }}
				

				{{ Form::submit('Login', ['class' => 'btn btn-primary btn-block form-spacing-top']) }}

				<p><a href="{{ url('password/reset') }}">Forgot My Password</a></p>

			{!! Form::close() !!}
		</div>
	</div>

@endsection