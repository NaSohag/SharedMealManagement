<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
</head>
<body>
	@include('includes.header')

	<div class="container">
		@include('includes.message')
		@yield('content')
	</div>
	


	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>

</body>
</html>