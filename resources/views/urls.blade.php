<!DOCTYPE html>
<html>
<head>
	<title>List All URL in Database Controll</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  
    <link href="css/style.css" rel="stylesheet">
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
	      <a class="nav-item nav-link" href="{{ route('add') }}">
	      	<button class="btn btn-success btn-lg navbar-btn">ADD</button>
	      </a>
	      <a class="nav-item nav-link" href="{{ route('editById', 0) }}">
	      	<button class="btn btn-danger btn-lg navbar-btn">EDIT {0}</button>
	      </a>
	    </div>
	  </div>
	</nav>
    <h2 align="center">URL:: Tất cả dữ liệu</h2>
	  <div class="row">
	    <div class="table-reponsive col-xs-12">
	      <table class="table">
	    	<tr>
			  <th>Url</th>
			  <th>Title</th>
			  <th>Tags</th>
			  <th>Action</th>
			</tr>
			@foreach($data as $url)
			<tr>
			  <td>{{ $url['url'] }} <br><button class="btn">{{ $url['urlshort'] }}</button> </td>
			  <td>{{ $url['title'] }}</td>
			  <td>{{ $url['tags'] }}</td>
			  <td><a href="{{ route('editById', $url['id']) }}" title="Edit"><button class="btn btn-primary">Edit</button></a></td>
			  <td><a href="{{ route('deleteById', $url['id']) }}" title="Delete"><button class="btn btn-danger">Delete</button></a></td>
				</tr>
			@endforeach
		</table>
		{{ $data->links() }}
	  </div>
	<br>
	<hr>
	</div><!--container-->
</body>
</html>