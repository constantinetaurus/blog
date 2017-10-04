@if (Session::has('success'))

	<div class="alert alert-success" role="alert">
		<strong>Success:</strong> {{ Session::get('success') }}
	</div>

@endif

@if (count($errors) > 0) <!-- make sure js form validation is off to get the error messages shown -->

	<div class="alert alert-danger" role="alert">
		<strong>Erorrs:</strong>
		<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
		</ul>
	</div>

@endif