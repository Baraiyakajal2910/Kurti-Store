@extends('layouts.front.app')
@section('content')
<div class="main-container cms-no-route-2 col1-layout content-color color">
				<div class="breadcrumbs">
					<div class="container">
						<ul>
							<li class="home"> <a href="#" title="Go to Home Page">Home</a></li>
							<li> <strong>404 Page</strong></li>
						</ul>
					</div>
				</div><!--- .breadcrumbs-->
				
				<div class="container">
					<div class="page-not-found-2">
						<div class="page-title">
							<h1>PAGE NOT FOUND</h1>
						</div>
						<p>We’re sorry!<br>We can`t seem to find the page you`re looking for.</p>
						<form action="#" method="get">
							<div class="form-search clearfix">
								<input id="search-inp" type="search" name="q" value="" class="input-text required-entry" maxlength="128" placeholder="Search...">
								<button type="submit" title="Search" class="button"><i class="fa fa-search"></i></button>
							</div>
						</form>
						<p>Please try your search again or go to <br>
						<a href="{{url('/')}}">Homepage</a></p>
					</div><!--- .page-not-found-2-->
				</div><!--- .container-->	
			</div><!--- .main-container -->
@endsection