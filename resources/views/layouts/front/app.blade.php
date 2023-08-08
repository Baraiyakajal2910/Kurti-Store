<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" class="template-default template-all">
<head>
	@yield('title')
	@include('layouts.front.common.head')

	<style type="text/css">
		.d-none{
			display: none;
		}
	</style>
</head>
<body>
	 <div class="wrapper">
		<div class="page">
				@include('layouts.front.common.header')
				
				@section('content')

				@show

				@include('layouts.front.common.footer')	
		</div><!--- .page -->
	</div><!--- .wrapper -->
	
	@include('layouts.front.common.js')
</body>
</html>