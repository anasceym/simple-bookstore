<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../favicon.ico">

	<title>Falcon Agency Test</title>

	<!-- Bootstrap core CSS -->
	<link href="/css/application.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body id="falcon-agency-test-application">

@include('_partials.navbar')

@if (Session::has('flash_notification.message'))
	<div class="hidden">
		<input type="hidden" data-plugin="notification" data-type="{{ Session::get('flash_notification.level') }}" value="{{ Session::get('flash_notification.message') }}"/>
	</div>
@endif

<div class="container">
	@yield('content')
</div>

<script src="/js/application.js"></script>
</body>
</html>
