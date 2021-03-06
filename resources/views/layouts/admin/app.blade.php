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

	
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/src/plugins/jvectormap/jquery-jvectormap-2.0.3.css')}}">
	<!-- switchery css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/src/plugins/switchery/switchery.min.css')}}">
	<!-- bootstrap-tagsinput css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
	<!-- bootstrap-touchspin css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css')}}">

	<link rel="stylesheet" type="text/css" href="{{ asset('admin/src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/src/plugins/datatables/css/responsive.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/styles/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/src/plugins/sweetalert2/sweetalert2.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
	<script src="{{ asset('admin/src/scripts/jquery.min.js')}}"></script>
	
	{{-- dashboard css --}}
	<script src="{{ asset('admin/src/plugins/jQuery-Knob-master/jquery.knob.min.js')}}"></script>
	<script src="{{ asset('admin/src/plugins/highcharts-6.0.7/code/highcharts.js')}}"></script>
	<script src="{{ asset('admin/src/plugins/highcharts-6.0.7/code/highcharts-more.js')}}"></script>
	<script src="{{ asset('admin/src/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
	<script src="{{ asset('admin/src/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
	<script src="{{ asset('admin/vendors/scripts/dashboard.js')}}"></script>
	<script src="{{ asset('admin/vendors/scripts/dashboard2.js')}}"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	{{-- <script src="{{ asset('admin/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script> --}}
	{{-- <script src="{{ asset('admin/src/plugins/sweetalert2/sweetalert2.all.js')}}"></script> --}}
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
	<script>
    	var url = "{{ url('/') }}";
    	var universal_token = "{{ csrf_token() }}"
    </script>
</head>
<body>

@include('layouts.admin.header')
@include('layouts.admin.leftbar')
@include('layouts.admin.sidebar')



<div class="mobile-menu-overlay"></div>
@yield('content')

@include('layouts.admin.footer')



<!-- js -->
	<script src="{{ asset('admin/vendors/scripts/core.js')}}"></script>
	{{-- <script src="{{ asset('admin/vendors/scripts/script.js')}}"></script> --}}
	<script src="{{ asset('admin/vendors/scripts/script.min.js')}}"></script>
	<script src="{{ asset('admin/vendors/scripts/process.js')}}"></script>
	<script src="{{ asset('admin/vendors/scripts/layout-settings.js')}}"></script>
	<!-- switchery js -->
	<script src="{{ asset('admin/src/plugins/switchery/switchery.min.js')}}"></script>
	<!-- bootstrap-tagsinput js -->
	<script src="{{ asset('admin/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
	<!-- bootstrap-touchspin js -->
	<script src="{{ asset('admin/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js')}}"></script>
	<script src="{{ asset('admin/vendors/scripts/advanced-components.js')}}"></script>


	<script src="{{ asset('admin/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{ asset('admin/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{ asset('admin/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{ asset('admin/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
	<!-- buttons for Export datatable -->
	<script src="{{ asset('admin/src/plugins/datatables/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{ asset('admin/src/plugins/datatables/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{ asset('admin/src/plugins/datatables/js/buttons.print.min.js')}}"></script>
	<script src="{{ asset('admin/src/plugins/datatables/js/buttons.html5.min.js')}}"></script>
	<script src="{{ asset('admin/src/plugins/datatables/js/buttons.flash.min.js')}}"></script>
	<script src="{{ asset('admin/src/plugins/datatables/js/pdfmake.min.js')}}"></script>
	<script src="{{ asset('admin/src/plugins/datatables/js/vfs_fonts.js')}}"></script>
	<!-- Datatable Setting js -->
	<script src="{{ asset('admin/vendors/scripts/datatable-setting.js')}}"></script>
	<!-- add sweet alert js & css in footer -->
	

	
</body>
</html>