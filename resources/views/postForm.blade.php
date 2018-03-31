<form action="{{route('postForm')}}" method="post">
	{{ csrf_field() }}
	<!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
	<input type="text" name="username">
	<input type="text" name="tuoi">
	<input type="text" name="sdt">
	<input type="submit" value="SUBMIT">
</form>