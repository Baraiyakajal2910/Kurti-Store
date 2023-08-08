<div class="header-container header-color color">
	<div class="header_full">
		<div class="header">
			<div class="header-logo show-992">
				<a href="index.html" class="logo"> <img class="img-responsive" src="{{ asset('assets/front/images/logo.png') }}" alt="" /></a>
			</div><!--- .header-logo -->
			<div class="header-bottom">

				<div class="container">
					<div class="row">
						<div class="header-config-bg">
							<div class="header-wrapper-bottom">
								<div class="custom-menu col-lg-12">
									<div class="showpopup d-none">
									<div class="block block-subscribe popup">
									<div id="popup-newsletter" style="background-color: rgba(255,255,255,0.6);"> 
										<a href="assets/images/popup-newletter.jpg"></a>
										<form action="#" method="post" id="popup-newsletter-validate-detail">
											<div class="block-content">
												<div class="form-subscribe-header block-title">
													<h2>Product Added Into Cart Successfully...</h2>
												</div>
												
											</div>
									</form>
									</div>
									</div>
									</div>
									<div class="header-logo hidden-992">
										<a href="{{url('/')}}" class="logo"> <img class="img-responsive" src="{{ asset('assets/front/images/kurti_logo.png') }}" width="70px" height="50px" alt="" /></a>
									</div><!--- .header-logo -->
									<div class="magicmenu clearfix">
										<ul class="nav-desktop sticker">
											<li class="level0 logo display"><a class="level-top" href="index.html"><img alt="logo" src="{{ asset('assets/front/images/logo.png') }}"></a></li>
											<li class="level0 home">
												<a class="level-top" href="{{url('/')}}"><span class="icon-home fa fa-home"></span><span class="icon-text">Home</span></a>
											</li>
											<li class='level0 cat first'>
												<a class="level-top" href="{{url('laptop/products')}}"><span>Products</span><span class="boder-menu"></span></a>
											</li>
										</ul>
									</div><!--- .nav-mobile -->
								</div><!--- .custom-menu -->
							</div><!--- .header-wrapper-bottom -->
						</div><!--- .header-config-bg -->
					</div><!--- .row -->
				</div><!--- .container -->
			</div><!--- .header-bottom -->
			<div class="header-page clearfix">
				<div class="header-setting">
					<div class="settting-switcher">
						<div class="dropdown-toggle">
							<div class="icon-setting"><i class="icon-settings icons"></i></div>
						</div>
						<div class="dropdown-switcher">
							<div class="top-links-alo">
								<div class="header-top-link">
									<ul class="links">
									<li class="last">
										@if(isset(Auth::user()->role) && Auth::user()->role == '0')
											welcome, {{Auth::user()->name}}!
											<a href="{{ url('logout') }}">Logout</a>
											<a href="{{ url('orders')}}">My Orders</a>
										@else
	                                     	<li class=" last"><a href="{{ url('login') }}" title="Log In" >Log In</a></li>
	                                     	<li class=" last"><a href="{{ url('register') }}" title="Log In" >Register</a></li>
										@endif

									</li>
									</ul>
								</div>
							</div><!--- .top-links-alo -->
						</div><!--- .dropdown-switcher -->
					</div><!--- .settting-switcher -->
				</div><!--- .header-setting -->
				<div class="miniCartWrap">
					<div class="mini-maincart">
						<div class="cartSummary">
							<div class="crat-icon"> 
								<span class="icon-handbag icons"></span>
								<p class="mt-cart-title">My Cart</p>
							</div>
							<div class="cart-header"> 
								<span class="zero">0</span>
								<p class="cart-tolatl"> 
									<span class="toltal">Total:</span>
									<span><span class="price">$0.00</span></span>
								</p>
							</div>
						</div><!--- .cartSummary -->
						
						<div class="mini-contentCart" style="display: none">
							<div class="block-content">
								<ol id="cart-sidebar" class="mini-products-list clearfix">
								@php
								$cartdata = showCart();
								@endphp

								@if(isset($cartdata) && !empty($cartdata))
								<p class="block-subtitle">Recently added item(s)</p>
									@foreach($cartdata as $key => $products)
									@if($key == 3)
										@break
									@endif
									<li class="item clearfix">
									<div class="cart-content-top">
									<a href="#" class="product-image"><img src="{{url('/')}}/resources/assets/admin/images/product/{{$products['upc']}}/main.png" width="60" height="77" alt="Brown Arrows Cushion"></a>
									<div class="product-details">
									<p class="product-name"><a href="#">{{$products['name']}}</a></p>
									<strong>{{$products['qty']}}</strong> x <span class="price">{{$products['price']}}</span>
									<p class="product-name">Total Price: {{$products['qty'] * $products['price']}}</p>
									</div>
									</div>
									</li>
									@endforeach
								@else
									<h2>Cart is Empty !</h2>
								@endif	
								</ol>
								<div class="actions"> <a href="{{url('product/cart')}}" class="view-cart"> View cart </a> </div>
							</div>
						</div><!--- .mini-contentCart -->
					</div><!--- .mini-maincart -->
				</div><!--- .miniCartWrap -->
			</div><!--- .header-page -->
		</div><!--- .header -->
	</div><!--- .header_full -->
</div><!--- .header-container -->