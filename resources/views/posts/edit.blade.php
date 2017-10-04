@extends('main')

@section('title', '| Edit Blog Post')

@section('stylesheets')

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

	{!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files' => 'true']) !!}
	<div class="row">

		{{-- {!! Form::model($post, ['route' => ['posts.update', $post->id]]) !!} --}}

		<div class="col-md-8">

			{{ Form::label('title', 'Title:') }}
			{{ Form::text('title', null, ['class' => 'form-control form-control-lg']) }}

			{{ Form::label('slug', 'Slug:', ['class' => 'form-spacing-top']) }}
			{{ Form::text('slug', null, ['class' => 'form-control form-control-md']) }}

			{{ Form::label('category_id', 'Category:', ['class' => 'form-spacing-top']) }}
			{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }} <!-- the alternative way to set up our select -->

			{{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
			{{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}

			{{ Form::label('featured_image', 'Update Featured Image:') }}
			{{ Form::file('featured_image') }}

			{{ Form::label('body', 'Body:', ['class' => 'form-spacing-top']) }}
			{{ Form::textarea('body', null, ['class' => 'form-control form-control-sm']) }}
		</div>

		<div class="col-md-4">
			<div class="jumbotron jumbotron-spacing-top">
				<div class="lead text-center">
					<dl class="dl-horizontal">
						<dt>Created At:</dt>
						<dd>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</dd>
					</dl>

					<dl class="dl-horizontal">
						<dt>Last updated At:</dt>
						<dd>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</dd>
					</dl>
				</div>
				<hr>

				<div class="row">

					<div class="col-sm-6">

						{!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
						
					</div>

					<div class="col-sm-6">

						{{ Form::submit('Save Changes', array('class' => 'btn btn-success btn-block')) }}

					</div>

				</div>

			</div>
				
		</div>
		{{-- {!! Form::close() !!} --}}

	</div>
	{!! Form::close() !!}

@endsection

@section('scripts')

	{{ Html::script('js/select2.min.js') }}
	<script type="text/javascript">
		$('.select2-multi').select2();
		$('.select2-multi').select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');
	</script>

@endsection