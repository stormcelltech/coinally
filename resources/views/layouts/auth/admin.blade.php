<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('admin/vendors/images/apple-touch-icon.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('admin/vendors/images/favicon-32x32.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/vendors/images/favicon-16x16.png')}}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/styles/core.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/styles/icon-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/src/plugins/jquery-steps/jquery.steps.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/styles/style.css')}}">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
	<style>
		.auth-btn{
			font-weight: 600; background-color: #1d2840; color: white; padding: 7px 12px; border: 1px solid transparent; border-radius: 5px;
		}
		.auth-btn:hover{
			background-color: transparent; border: 1px solid #1d2840; color: #1d2840;
		}
		.text-skezzole{
			color: #628c23;
		}
	</style>
</head>

<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="{{ url('/') }}">
					<img src="{{ asset('assets/images/coinally.png') }}" alt="">
				</a>
			</div>

			@yield('content')


<!-- success Popup html End -->
	<!-- js -->
	<script src="{{ asset('admin/vendors/scripts/core.js')}}"></script>
	<script src="{{ asset('admin/vendors/scripts/script.min.js')}}"></script>
	<script src="{{ asset('admin/vendors/scripts/process.js')}}"></script>
	<script src="{{ asset('admin/vendors/scripts/layout-settings.js')}}"></script>
	<script src="{{ asset('admin/src/plugins/jquery-steps/jquery.steps.js')}}"></script>
	<script src="{{ asset('admin/vendors/scripts/steps-setting.js')}}"></script>

	
</body>

</html>