@extends('layouts.app')

@section('title', 'Documents ! All for you')

@section('header')
	@parent
	<h1>Day la noi dung Header</h1>
@endsection


@section('container')
	@parent
	<div class="form-search">
		<form action="{{route('search')}}" method="POST">
			{{ csrf_field() }}
			<input type="text" name="doc-name">
		</form>
	</div>
	<div class="results">
		<ul>
			@if($result != "")
				<li>{!!$result!!}</li>
			@endif
		</ul>
	</div>
@endsection

@section('footer')
	@parent
	<h3>Day la noi dung footer</h3>
@endsection