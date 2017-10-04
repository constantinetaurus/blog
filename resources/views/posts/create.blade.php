@extends('main')

@section('title', '| Create New Post')

@section('stylesheets')

	{{ Html::style('css/parsley.css') }}
	{{ Html::style('css/select2.min.css') }}
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script> <!-- WISYWIG Editor -->

	<script>
		tinymce.init({ 
			selector:'textarea',	// add the selector 
			plugin: 'link code', 	// add whatever plugins you need 
			menubar: false			// customize menubar (to set up a manimalistic view for the menubar)
	});
	</script>

@endsection

@section('content')

	<div class="row justify-content-center"> 
		<div class="col-md-8">
			<h1>Create New Post</h1>
			<hr>
			{!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '','files' => 'true']) !!}
				{{ Form::label('title', 'Title:') }}
				{{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255', 'minlength' => '5')) }}

				{{ Form::label('slug', 'Slug:', ['class' => 'form-spacing-top']) }}
				{{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

				{{ Form::label('category', 'Category:', ['class' => 'form-spacing-top']) }}
				
				<select class="form-control" name="category_id">

					@foreach($categories as $category)

						<option value="{{ $category->id }}">{{ $category->name }}</option> <!-- the easiest way to set up our select -->

					@endforeach

				</select>

				{{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
				
				<select class="form-control select2-multi" name="tags[]" multiple="multiple">

					@foreach($tags as $tag)

						<option value="{{ $tag->id }}">{{ $tag->name }}</option> <!-- the easiest way to set up our select -->

					@endforeach

				</select>

				{{ Form::label('featured_image', 'Upload Featured Image:', ['class' => 'form-spacing-top']) }}
				{{ Form::file('featured_image') }} {{-- add 'files' => 'true' into the Form::open helper --}} 


			
				{{ Form::label('body', "Post Body:") }}
				{{ Form::textarea('body', null, array('class' => 'form-control')) }}

				{{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
			
			{!! Form::close() !!}

		</div>
	</div>

@endsection

@section('scripts')

	{{ Html::script('js/parsley.min.js') }}
	{{ Html::script('js/select2.min.js') }}

	<script type="text/javascript">
		$('.select2-multi').select2();
	</script>

@endsection