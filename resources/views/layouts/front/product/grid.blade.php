<div class="grid">
	<ul class="products-grid row products-grid--max-3-col last odd">
	@foreach($product as $products)
		<li class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-mobile-12 item">
			<div class="category-products-grid">
				<div class="images-container">
					<div class="product-hover"> 
						<!-- <span class="sticker top-left"><span class="labelnew">New</span></span>  -->
						<a href="{{ url('/',$products->access_url)}}" title="Configurable Product" class="product-image"> 

							<img id="product-collection-image-8" class="img-responsive" src="{{url('/')}}/resources/assets/admin/images/product/{{$products->upc}}/main.png?{{rand()}}" width="278" height="355" alt="{{$products->name}}"> 
							<span class="product-img-back"> <img class="img-responsive" src="{{url('/')}}/resources/assets/admin/images/product/{{$products->upc}}/main.png?{{rand()}}" width="278" height="355" alt="{{$products->name}}"> </span> 
						</a>
					</div>
					<div class="actions-no hover-box">
						<div class="actions">
							<button type="button" title="Add to Cart" id="{{$products->id}}" class="button btn-cart pull-left "><span><i class="icon-handbag icons"></i><span>Add to Cart</span></span></button>
						</div>
					</div>
				</div>
				<div class="product-info products-textlink clearfix">
					<h2 class="product-name"><a href="#" title="Configurable Product">{{$products->name}}</a></h2>
					<div class="price-box"> <span class="regular-price"> <span class="price">{{$products->price}}</span> </span></div>
					<!-- <div class="ratings">
						<div class="rating-box">
							<div class="rating" style="width:80%"></div>
						</div>
						<span class="amount"><a href="#">1 Review(s)</a></span>
					</div> -->
				</div>
			</div>
		</li>
	@endforeach
	</ul><!--- .products-grid-->
</div>