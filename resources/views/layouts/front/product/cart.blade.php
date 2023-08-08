<!--  product cart management page -->

@extends('layouts.front.app')
@section('content')
<div class="main-container col1-layout content-color color">
				<div class="breadcrumbs">
					<div class="container">
						<ul>
							<li class="home"> <a href="#" title="Go to Home Page">Home</a></li>
							<li> <strong>My Cart</strong></li>
						</ul>
					</div>
				</div><!--- .breadcrumbs-->
				
				<div class="container">
					<div class="content-top">
						<h2>My Cart</h2>
						<div class="wish-list-notice"><i class="icon-check"></i>
							<a href="{{url('/')}}">Click here</a> to continue shopping.
						</div>
					</div>
					@if(!empty($products))
						<div class="table-responsive-wrapper">
							<table class="table-order table-wishlist">
								<thead>
									<tr>
										<td>Remove</td>
										<td>Product Detail</td>
										<td></td>
									</tr>
								</thead>
								<tbody>
								@foreach($products as $key=>$products)
									<tr class="product-remove">
										<td class="main-remove">
											<button type="button" class="button-remove" id="{{$products['id']}}"><i class="icon-close"></i></button>
										</td>
										<td>
											<table class="table-order-product-item">
												<tr>
													<td><img src="{{asset('assets/admin/images/product/'.$products['upc'].'/main.jpg')}}" alt="main-image" width="100px" height="100px"/></td>
													<td><p>{{$products['name']}}<br></p></td>
												</tr>
											</table>
										</td>
										<td class="wish-list-control">
											<div class="price">
												₹{{$products['qty']*$products['price']}}
											</div>
											<div class="number-input">
												<button type="button" class="minus" id="{{$products['id']}}">-</button>
												<input type="text" name="qty" value="{{$products['qty']}}" class="qty" maxlength="3">
												<button type="button" class="plus">+</button>
												<input type="hidden" name="product_id" id="{{$products['id']}}">				
											</div>
											<!-- <div class="edit_control"><button type="button" class="btn-edit"><i class="icon-note"></i> Edit</button></div> -->
										</td>
									</tr>
									@endforeach

								</tbody>
							</table>
							<br>
							<div class="text-right">
								<a href="{{ url('product/order/details')}}">
									<button type="submit" class="btn-step btn-checkout">CHECKOUT</button>
								</a>
							</div>
						</div>
					@else
						<div>
							<center><h1>Cart Is Empty...</h1></center>
							<br><br><br>
						</div>
					@endif

					<div class="cartempty d-none">
						<center><h1>Cart Is Empty...</h1></center>
						<br><br><br>
					</div>
				</div><!--- .container-->
			</div><!--- .main-container -->
@endsection

@section('script')
<script type="text/javascript">
if($("tbody >tr").length >= 2)
	{
		$(".emptyCart").addClass("d-none");
		$(".block-subtitle").removeClass("d-none");
	}
		
$(".number-input").on('click input',"input[type='text'],button",function(){
	var price = $(this).parent().parent().find('.price');
	$.ajax({

			type:"get",
			url:"{{url('product/updateCart')}}",
			data:{
				qty:$(this).parent().find('.qty').val(),
				id:$(this).siblings("input[name='product_id']").attr('id'),
				btn:$(this).attr('class'),
				price:$(this).parent().find("input[name='product_price']").attr('id'),
			},
			success:function(response){
				$('.mini-contentCart').html(response.minicart);
				price.html('₹'+response.price);
			},
		});
});

$(".number-input").on("keypress",function(e){

		var keyCode = e.charCode;
        // console.log(keyCode);
        if((keyCode != 8 || keyCode == 32) && (keyCode <48 || keyCode >57))
        {
            e.preventDefault();
            return false;
        }
	});

// $(".main-remove").on("click",".button-remove",function()
// {
// 	$(this).closest(".product-remove").remove();

// });
$(".button-remove").click(function(){
	// alert($("tbody >tr").length);
	if($("tbody >tr").length == 2)
	{
		$(this).closest(".table-responsive-wrapper").remove();
		$(".cartempty").removeClass("d-none");
	}
	else
	{
		$(this).parent().parent().remove();
	}

	$.ajax({

			type:"get",
			url:"{{url('product/updateCart')}}",
			data:{
				id:$(this).attr('id'),
				deleteitem:$(this).attr('id'),
			},
			success:function(response){
				$('.mini-contentCart').html(response.minicart);
			},
		});

});
</script>
@endsection