<div class="form-upload">
	<form action="{{route('uploading')}}" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}
		<input type="file" name="filename">
		<input type="submit" value="UPLOAD">
	</form>
</div>