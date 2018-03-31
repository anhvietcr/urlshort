<!DOCTYPE html>
<html>
<head>
	<title>Url Action</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link href="/css/style.css" rel="stylesheet">

</head>
<body>
  <div class="container">
  	<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #eee; padding: 10px">
	  <a class="navbar-brand" href="/home">URL:: ./HOME</a>
	  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	    <div class="navbar-nav">
	      <a class="nav-item nav-link active" href="/show">
	      	<button class="btn btn-lg navbar-btn">URLs</button>
	      </a>
	      <a class="nav-item nav-link" href="/add">
	      	<button class="btn btn-success btn-lg navbar-btn">ADD</button>
	      </a>
	      <a class="nav-item nav-link" href="/edit/0">
	      	<button class="btn btn-danger btn-lg navbar-btn">EDIT {0}</button>
	      </a>
	    </div>
	  </div>
	</nav>
    <h2 align="center">URL:: Chỉnh sửa / Thêm </h2>
      <hr>
       @isset($message)
       	<div class="alert alert-success" role="alert" align="center"> Item add success !</div>
       @endisset
      <div class="jumbotron">
      	<div id="overlay"></div>
	    <div id="loader"></div>

      	<div class="form-group">
      		<div class="row">
      	  <form action="{{ route('action')}}" method="POST">
      	  	{{ csrf_field() }}
			<input type="text" name="id" value="{{$data['id']}}" hidden>
			
			<div class="col-xs-9">
				<label> Url Gốc </label>
				<input type="text" name="url" class="form-control" value="{{ $data['url'] }}" required>
				<br>
			</div>
			<div class="col-xs-3">
				<label> 123 ShortLink </label>
				<input type="text" name="urlshort" class="form-control" value="{{ $data['urlshort'] }}" readonly>
				<br>
			</div>

			<div class="col-xs-12">
			<label>Title</label>
			<input type="text" name="title" class="form-control" value="{{ $data['title'] }}" required>
			<br>
			</div>
			
			<div class="col-xs-12">
			<label>Tags</label>
			<input type="text" name="tags" class="form-control" value="{{ $data['tags'] }}" required>
			<br>
			</div>
			
			<div class="btn-action">
				@if(!empty($data['url']))
				<div class="btn-action btn-action-left">
					<input class="btn btn-default btn-lg center-block" type="submit" name="update" value="Update">
				</div>
				<div class="btn-action btn-action-right">
				@endif
				@isset($data)
					<input class="btn btn-success btn-lg center-block" onclick="shortLink()" name="add-submit" value="Add">
					<input type="submit" name="add" id="js-add" hidden>
				</div>
				@endisset
			</div>
			</form>
			</div>
		</div>
	</div>
	 <script type="text/javascript">
		$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
			$(".alert-success").slideUp(500);
		});
	 </script>
	<script type="text/javascript">
		function shortLink()
		{
			var url = document.getElementsByName('url')[0].value;
			$.when( $.ajax({
	        	type: "GET",
	        	url: "/api-123-link",
	            data: {
	            	url: url
	            },
	        	dataType: "json",
	            cache: false,
	            beforeSend: function() {
	            	document.getElementById("overlay").style.display = "block";
					document.getElementById("loader").style.display = "block";
	            },
	            success: function (res) {
	            	document.getElementsByName('urlshort')[0].value = res['result']['shortenedUrl'];
	            },
	            error: function (err) {
	                console.log(err);
	            }
	   		})).then(function(){
				document.getElementById("overlay").style.display = "none";
	   			document.getElementById("loader").style.display = "none";
	            $("#js-add").trigger('click');
	   		});
		}
	</script>
</body>
</html>