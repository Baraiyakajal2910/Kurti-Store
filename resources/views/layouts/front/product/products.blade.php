@extends('layouts.front.app')
@section('content')
 <div class="main-container col2-left-layout ">
				<div class="breadcrumbs">
					<div class="container">
						<ul>
							<li class="home"> <a href="{{url('/')}}" title="Go to Home Page">Home</a></li>
							<li class="category4"> <strong>Products</strong></li>
						</ul>
					</div>
				</div>
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
					<div class="main sort">
						<div class="row filter">
							<div class="col-left sidebar col-lg-3 col-md-3 left-color color">
								<div class="anav-container">
									<div class="block block-anav">
										<div class="block-title"> <strong><span>Categories</span></strong></div>
										<ul style="" class="nav-accordion">
											<li class="level0 nav-2 level-top parent">
												<a href="#" class="level-top"><span>Categories</span></a>
												<ul style="" class="level0">
													@foreach($brand as $brand)
													<li class="level1 nav-2-1 first parent">
														<a href="#"><label><input type="checkbox" name="brand" class="brand" value="{{$brand->id}}"><span> {{$brand->name}} </span></label></a>
													</li>
													@endforeach
												</ul>
											</li>
										</ul>
									</div><!--- .block-anav-->
								</div><!--.anav-container-->
								<!-- <div class="block block-subscribe popup" style="display:none;">
									<div id="popup-newsletter"> 
										<a href="assets/images/popup-newletter.jpg"></a>
										<form action="#" method="post" id="popup-newsletter-validate-detail">
											<div class="block-content">
												<img src="assets/images/logo-newletter.png" alt=""/>
												<div class="form-subscribe-header block-title">
													<label for="newsletter">Subscribe</label>
												</div>
												<p>For all the latest news, products, collection...</p>
												<p>Subscribe now to get 20% off</p>
												<div class="newsletter-new clearfix">
													<div class="input-box"> 
														<input type="text" name="email" id="pnewsletter" title="Sign up for our newsletter" class="input-text required-entry validate-email" placeholder="Your email adress ..."/>
													</div>
													<div class="actions">
														<button type="submit" title="Subscribe" class="button">
															<span><i class="fa fa-play"></i></span>
														</button>
													</div>
												</div>
												<div class="subscribe-bottom"> <input type="checkbox" />Don’t show this popup again</div>
											</div>
										</form>
									</div>
								</div> -->
								<div class="anav-container">
									<div class="block block-anav">
										<div class="block-title"> <strong><span>Colors</span></strong></div>
										<ul style="" class="nav-accordion">
											<li class="level0 nav-2 level-top parent">
												<a href="#" class="level-top"><span>Colors</span></a>
												<ul style="" class="level0">
													@foreach($color as $color)
													<li class="level1 nav-2-1 first parent">
														<a href="#"><label><input type="checkbox" name="color" class="color" value="{{$color->id}}"><span> {{$color->name}} </span></a>
													</li>
													@endforeach
												</ul>
											</li>
										</ul>
									</div><!--- .block-anav-->
								</div>
								<div class="block block-layered-nav block-layered-nav--no-filters">
									<div class="block-title"> <strong><span>Shop By</span></strong></div>
									<div class="block-content toggle-content">
										<p class="block-subtitle block-subtitle--filter">Filter</p>
										<dl id="narrow-by-list">
											<dt class="even">By Price</dt>
											<dd class="even">
												<div class="slider-ui-wrap">
													<div id="price-range" class="slider-ui" slider-min="0" slider-max="99999" slider-min-start="0" slider-max-start="99999"></div>
												</div>
												<form action="#" class="price-range-form">
													<input type="text" class="range_value range_value_min" target="#price-range" /> - <input type="text" class="range_value range_value_max" target="#price-range" />
													<input type="submit" class="btn-submit" value="OK" />
												</form> 
											</dd>
										</dl>
									</div>
								</div><!--- .block-layered-nav-->
							</div><!--- .sidebar-->
							
							<div class="col-main col-lg-9 col-md-9 content-color color">
								<p class="category-image"><img src="http://placehold.it/875x360" alt="Men" title="Men"></p>
								<div class="category-products">
									<div class="toolbar">
										<div class="sorter">
											<p class="view-mode"> <label>View as:</label> 
												<a id="grid" title="Grid" class="redirectjs grid grid_list"> <i class="icon-grid icons"></i> </a>
												<a id="list" title="List" class="list active grid_list"> <i class="icon-list icons"></i> </a>
											</p>
										</div>
									</div><!--- .toolbar-->
									<div class="showproducts">
									</div>
								</div><!--- .category-products-->
							</div><!--- .col-main-->

						</div><!--- .row-->
					</div><!--- .main-->
				</div><!--- .container-->
			<!-- </div>- .main-container  -->
@endsection

@section('script')
<script>
$(document).ready(function(){

	$.ajax({
		type:"get",
		url:"{{url('product/sort')}}",
		dataType: "HTML",

		success: function(response){
			$('.showproducts').html(response);
		}
	});


	$('.view-mode').on('click',"a",function(){
		// alert('vhgh');
			if($(this).attr('id') == 'grid')
			{
				$(this).addClass('active');
				$('#list').removeClass('active');
			}
			else
			{
				$(this).addClass('active');
				$('#grid').removeClass('active');
			}
	});

	$(".range_value_max,.range_value_min").on("keypress",function(e){

		var keyCode = e.charCode;
        // console.log(keyCode);
        if((keyCode != 8 || keyCode == 32) && (keyCode <48 || keyCode >57))
        {
            e.preventDefault();
            return false;
        }
	});

	$(document).on('click',"input[type='checkbox'],input[type='submit'],.grid_list",function(){
		// alert('ftgh');
		var brand = [];
		$("input[name='brand']:checked").each(function(){
			brand.push($(this).val());
			// console.log(brand);
		});

		var color = [];
		$("input[name='color']:checked").each(function(){
			color.push($(this).val());
		});

		$.ajax({

			type:"get",
			url:"{{url('product/sort')}}",
			dataType: "HTML",
			data:{

				brand_id:brand,
				color_id:color,
				grid_list:$('#grid').hasClass('active'),
				max_price:$(".range_value_max").val().match(/\d+/),
				min_price:$(".range_value_min").val().match(/\d+/)
			},

			success: function(response){
				$('.showproducts').html(response);
			}
		});
	});

	$(document).on('click',".btn-cart",function(){
		$.ajax({
			type:"get",
			url:"{{url('product/addToCart')}}",
			data:{
				id:$(this).attr('id'),
			},

			success: function(response){
				$('.mini-contentCart').html(response.minicart);
			}
		});
		$(".showpopup").removeClass('d-none');
	});

	$(".close-btn").click(function(){
		$(".showpopup").addClass('d-none');
	});
});

</script>
@endsection
