@extends('main')

@section('title', '| Forgot my Password')

@section('content')

	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
    				Reset Password
  				</div>
			  	<div class="card-body">
			    	
			    	{{-- if you do not use helpers such as 'Html or Form' csrf_token() is needed --}}
			    	{!! Form::open(['url' => 'password/reset', 'method' => 'POST']) !!}

			    	{{ Form::hidden('token', $token) }}

			    	{{ Form::label('email', 'Email Address:') }}

			    	{{ Form::email('email', $email, ['class' => 'form-control']) }}

			    	{{ Form::label('password', 'New Password:') }}

			    	{{ Form::password('password', ['class' => 'form-control']) }}

			    	{{ Form::label('password_confirmation', 'Confirm New Password:') }}

			    	{{ Form::password('password_confirmation', ['class' => 'form-control']) }}

			    	{{ Form::submit('Reset Password', ['class' => 'btn btn-primary btn-block form-spacing-top']) }}

			    	{!! Form::close() !!}

			  	</div>
			</div>
		</div>
	</div>

@endsection