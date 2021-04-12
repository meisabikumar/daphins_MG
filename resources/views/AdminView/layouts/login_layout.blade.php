<!DOCTYPE html>
<html>
	<head>
		<title><?php echo Config::get("Site.title"); ?></title>
		<link href="{{ asset('css/admin/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('css/admin/font-awesome.min.css') }}" rel="stylesheet">
		<link href="{{ asset('css/admin/AdminLTE.css') }}" rel="stylesheet">
		<script src="{{ asset('js/admin/jquery.min.js') }}"></script>		
<!-- 		<style type="text/css">
			.box-body01 {
			    position: fixed;
			    max-width: 370px;
			    top: 25px;
			    padding: 0px 15px;
			    left: 36%;
			    right: 7%;
			    width: 100%;
			}
			@media(max-width: 991.98px){
				.box-body01{
				    left: 29% !important;
				}
			}
			@media(max-width: 767.98px){
				.box-body01{
				    left: 0% !important;
				    right: 0px;
				    width: 100%;
				}
			}
		</style> -->
	</head>
	<body class="bg-black">
		@if(Session::has('error'))
			<div class="box-body01"> 
				<div class="alert alert-danger alert-dismissable">
					<i class="fa fa-ban"></i>
					<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> {{ Session::get('error') }}
				</div>
			</div>
			
		@endif
		
		@if(Session::has('success'))
			<div class="box-body01"> 
				<div class="alert alert-success alert-dismissable">
					<i class="fa fa-check"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					{{ Session::get('success') }}
				</div>
			</div>
			
		@endif

		@if(Session::has('flash_notice'))
			<div class="box-body01"> 
				<div class="alert alert-success alert-dismissable">
					<i class="fa fa-check"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					{{ Session::get('flash_notice') }}
				</div>
			</div>
		@endif
		
		@yield('content')
		<script src="{{ asset('js/admin/core/mws.js') }}"></script>	
		<script src="{{ asset('js/admin/core/themer.js') }}"></script>	
		<script src="{{ asset('js/admin/bootstrap.min.js') }}"></script>	
		<script src="{{ asset('js/admin/app.js') }}"></script>	
		<style type="text/css">
			.error-message{
				color:#f56954 !important;
			}
		</style>
	</body>
</html>