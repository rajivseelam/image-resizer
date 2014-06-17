@extends('master')

@section('content')

<div class="container">
	<div class="row">

<div class="col-md-6 col-md-offset-3">
	<h2>Upload New Photo</h2>

	{{ Form::open(array('files' => true)) }}

	<div class="form-group">
		{{ Form::label('width', 'Width') }}

		{{ Form::text('width', Input::old('width'), array('class' => 'form-control')) }}

        @if($errors->has('width'))
        <div class="alert alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ $errors->first('width', ':message') }}
        </div>
        @endif
	</div>

	<div class="form-group">
		{{ Form::label('height', 'Height') }}

		{{ Form::text('height', Input::old('height'), array('class' => 'form-control')) }}

        @if($errors->has('height'))
        <div class="alert alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ $errors->first('height', ':message') }}
        </div>
        @endif
	</div>

	<div class="form-group">
		{{ Form::file('photo') }}

        @if($errors->has('photo'))
        <div class="alert alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ $errors->first('photo', ':message') }}
        </div>
        @endif
	</div>

	<div class="form-group">
		{{ Form::label('optimize','Just Optimize') }}
		{{ Form::checkbox('optimize') }}
	</div>

	{{ Form::submit('Resize and Optimize',array('class' => 'btn btn-blue btn-primary')) }}

	{{ Form::close() }}

</div>


		
	</div>
</div>

@stop