<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
</head>
<body>
    @include('layouts.header')

    <section>
        <div class="container">
            @section('container')
            @show
        </div>
    </section>
    
    @include('layouts.footer')
</body>
</html>