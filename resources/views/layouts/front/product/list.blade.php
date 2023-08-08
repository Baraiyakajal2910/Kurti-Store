<!--  Product List page -->

<div class="list">
	<ol class="products-list" id="products-list">
		@foreach($product as $products)
		<li class="item odd">
			<div class="row">
-				<div class="col-mobile-12 col-xs-5 col-md-4 col-sm-4 col-lg-4">
					<div class="products-list-container">
						<div class="images-container">
							<div class="">
								<input type="hidden" value="{{$products->id}}" id="pid"> 
								<a href="{{ url('/',$products->access_url)}}" title="" class="product-image">
								
									<img id="product-collection-image-8" class="img-responsive" src="{{asset('assets/admin/images/product/'.$products->upc.'/main.jpg')}}" width="278" height="355" alt="{{$products->name}}"> 
									<!-- <span class="product-img-back"> 
										<img class="img-responsive" src="http://placehold.it/278x355?text=hover" width="278" height="355" alt=""> 
									</span> -->
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="product-shop col-mobile-12 col-xs-7 col-md-8 col-sm-8 col-lg-8">
					<div class="f-fix">
						<div class="product-primary products-textlink clearfix">
						    <h2 class="product-name">
						    	<a href="{{ url('/',$products->access_url)}}" title="Configurable Product">Model Name: {{$products->name}}</a>
						    </h2>
							<div class="price-box">
								<span class="regular-price">
									<span class="price">Price: ₹{{$products->price}}.00</span>
								</span>
							</div>
						</div>
						<div class="desc std">
							<p>
								<b>Description:</b> {{$products->description}}
							</p>
						</div>
						<div class="product-secondary actions-no actions-list clearfix">
							<p class="action">
								<button type="button" title="Add to Cart" id="{{$products->id}}" class="button btn-cart pull-left">
									<span>
										<i class="icon-handbag icons"></i>
										<span>Add to Cart</span>
									</span>
								</button>
							</p>
						</div>
					</div>
				</div>
			</div>
		</li><!--- .item-->
		@endforeach
	</ol><!--- .products-list-->
</div>