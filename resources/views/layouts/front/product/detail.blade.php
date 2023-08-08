@extends('layouts.front.app')
@section('content')
<div class="main-container col2-left-layout ">
				<div class="breadcrumbs">
					<div class="container">
						<ul>
							<li class="home"> <a href="#" title="Go to Home Page">Home</a></li>
							<li class="category4"> <strong>laptop</strong></li>
						</ul>
					</div>
				</div><!--- .breadcrumbs-->
				<div class="container">
			  <!-- The Modal -->
			  <div class="modal mb-3" id="myModal">
			    <div class="modal-dialog">
			      <div class="modal-content">
			      
			        <!-- Modal Header -->
			        <!-- <div class="modal-header">
			          <h4 class="modal-title">Modal Heading</h4>
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			        </div> -->
			        
			        <!-- Modal body -->
			        <div class="modal-body">
			        	<!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
			          Product Added into Cart Successfully.
			        </div>
			        
			        <!-- Modal footer -->
			        <div class="modal-footer">
			          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			        </div>
			        
			      </div>
			    </div>
			  </div>
			  
			</div>
				
				<div class="container">
					<div class="main">
						<div class="row">
							<div class="col-main col-lg-12">
								<div class="product-view">
									<div class="product-essential">
										<div class="row">
											<form action="#" method="post" id="product_addtocart_form">
												@csrf
												<div class="product-img-box clearfix col-md-5 col-sm-5 col-xs-12">
													<div class="product-img-content">
														<div class="product-image product-image-zoom">
															<div class="product-image-gallery"><img id="image-main"
																class="gallery-image visible img-responsive"
																src="{{url('resources/assets/admin/images/product/'.$product->upc,'main.png')}}"
																alt="{{$product->name}}"
																title="{{$product->name}}"/></div>
														</div><!--- .product-image-->
														<div class="more-views">
															<h2>More Views</h2>
															<ul class="product-image-thumbs">
																<li> 
																	<a class="thumb-link" href="{{url('resources/assets/admin/images/product/'.$product->upc,'main.png')}}" title="" data-image-index="0"> <img class="img-responsive" id="sub_img" src="{{url('resources/assets/admin/images/product/'.$product->upc,'main.png')}}"alt="main-image" width="100px" height="100px"/> </a>
																</li>
																@foreach($image as $k=>$image)
																<li> 
																	<a class="thumb-link" href="{{url('resources/assets/admin/images/product/'.$product->upc,$product->upc.'_'.$k.'.png')}}" title="" data-image-index="1"> <img class="img-responsive" id="sub_img" src="{{url('resources/assets/admin/images/product/'.$product->upc,$product->upc.'_'.$k.'.png')}}" alt="image" width="100px" height="100px"/> </a>
																</li>
																@endforeach
															</ul>
														</div><!--- .more-views -->
													</div><!--- .product-img-content-->
												</div><!--- .product-img-box-->
												<div class="product-shop col-md-7 col-sm-7 col-xs-12">
													
													<div class="product-shop-content">
														<div class="product-name">
															<h1>{{$product->name}}</h1>
														</div>
														<!-- <div class="ratings">
															<div class="rating-box">
																<div class="rating" style="width:60%"></div>
															</div>
															<p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Your Review</a></p>
														</div> -->
														<div class="product-type-data">
															<div class="price-box">
							
																<p class="special-price"><span class="price">₹{{$product->price}}</span></p>
															</div>
															<p class="availability in-stock">Availability: <span>{{$product->stock >0 ? 'In Stock' : 'Out Of Stock'}}</span></p>
															<div class="products-sku"> <span class="text-sku">Product Code:{{$product->upc}}</span></div>
														</div>
														<div class="short-description">
															<h2>Short Description</h2>
															<p>{{$product->description}}</p>
														</div>
														<div class="add-to-box add">
															<div class="product-qty">
																<label for="qty">Qty:</label>
																<div class="custom-qty"> 
																	<input type="text" name="qty" id="qty" maxlength="12" value="{{$product_qty}}" title="Qty" class="input-text qty" /> 
																	<button  type="button" class="increase items" onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;"> <i class="fa fa-plus"></i> </button> <button  type="button" class="reduced items" onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) && qty > 1 ) result.value--;return false;"> <i class="fa fa-minus"></i> </button>
																</div>
															</div>
															<div class="add-to-cart">
																 <button type="button" title="Add to Cart" id="{{$product->id}}" class="button btn-cart" onclick="productAddToCartForm.submit(this)"  data-toggle="modal" data-target="#myModal" > <span> <span class="view-cart icon-handbag icons">Add to Cart</span> </span></button>
															</div>
														</div>
														<div class="addit">
															<div class="alo-social-links clearfix">
																
															</div>
														</div>
													</div><!--- .product-shop-content-->
												</div><!--- .product-shop-->
											</form>
										</div>
									</div><!--- .product-essential-->
								</div><!--- .product-view-->
							</div><!--- .col-main-->
						</div><!--- .row-->
					</div><!--- .main-->
				</div><!--- .container-->
</div><!--- .main-container -->
@endsection
@section('script')
<script>
	$('.thumb-link').hover(function(){
		// alert('gvgvb');
		$('#image-main').attr('src',$(this).children('#sub_img').attr('src'));
	});

	$(".qty").keypress(function(e){
		var keyCode = e.charCode;
        // console.log(keyCode);
        if((keyCode != 8 || keyCode == 32) && (keyCode <48 || keyCode >57))
        {
            e.preventDefault();
            return false;
        }
	});

	$('.add').on('click',".btn-cart",function(){
		// alert('hgh');
		$.ajax({
			type:"get",
			url:"{{url('product/addToCart')}}",
			data:{
				id:$(this).attr('id'),
				qty:$("#qty").val()
			},

			success: function(response){
				$('.mini-contentCart').html(response.minicart);
			}
		});
	});
</script>
@endsection