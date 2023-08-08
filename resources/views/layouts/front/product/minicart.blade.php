<!--  product minicart popup -->

<div class="block-content">
	<!-- <p class="emptyCart">No Items Into Cart</p> -->
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
		<a href="#" class="product-image"><img src="{{asset('assets/admin/images/product/'.$products['upc'].'/main.jpg')}}" width="60" height="77" alt="Brown Arrows Cushion"></a>
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
	<div class="actions"> <a href="{{url('product/cart')}}" class="view-cart"> View cart </a></div>
</div>
