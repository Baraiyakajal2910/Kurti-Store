@extends('layouts.admin.app')
@section('title','Edit Product')
@section('content')
<div class="container-fluid">
<div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Product</h4>

                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="#">Adminox</a></li>
                    <li class="breadcrumb-item"><a href="#">Product</a></li>
                    <li class="breadcrumb-item active">Add</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
<!-- end row -->
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-12">
                        <div class="p-20">
                            <form class="form-horizontal" name="add_product" enctype="multipart/form-data" action="{{ url('admin/product/edit',$product->id)}}" method="POST" role="form">
                                @csrf
                                <div class="form-group text-right m-b-15">
                                    <a href="{{ url('admin/product/show')}}" class="btn btn-primary waves-effect waves-light btn-sm">
                                    <i class="fa fa-angle-left"></i> Back
                                    </a>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" value="{{$product->upc}}" name="upc">
                                    <input type="hidden" value="{{$product->id}}" id="id">
                                    <label class="col-2 col-form-label">Product UPC</label>
                                    <div class="col-10">
                                        <input type="text" name="upc" value="{{$product->upc}}" id="upc" disabled class="form-control" placeholder="Enter Product UPC" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Product Name</label>
                                    <div class="col-10">
                                        <input type="text" id="name" name="name" value="{{$product->name}}" class="form-control" placeholder="Enter Product Name" class="@error('name') is-invalid @enderror"><br>
                                        <input type="hidden" name="access_url" id="access_url" value="{{$product->access_url}}">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                         <span>{{url('/')}}/<span id="access_url_span" class="access_url_span" name="access_url_span">{{$product->access_url}}</span>
                                            <input type="text" class="form-control d-none" value="{{$product->access_url}}" id="access_url_inp">
                                            <!-- <input id="access_url_span" class="access_url_span" type="text" style="border:none;"> -->
                                        </span>
                                        <span class="edit_save btn btn-action" ><i class="fa fa-edit"></i></span>
                                        <span class="save btn btn-action" style="display:none;" ><i class="fa fa-save"></i></span>
                                        
                                    </div>
                                    </div>        
                                    
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Product Category</label>
                                    <div class="col-10">
                                        <select class="form-control" name="brand_id" disabled>
                                        @foreach($brand as $brand)
                                            @if($brand->id == $product->brand_id)
                                            <option selected disabled hidden>{{$brand->name}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                       </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Product Color</label>
                                    <div class="col-10">
                                        <select class="form-control" disabled name="color_id" >
                                        @foreach($color as $color)
                                            @if($color->id == $product->color_id)
                                            <option value="" selected disabled hidden>{{$color->name}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Product Description</label>
                                    <div class="col-10">
                                        <textarea class="form-control" name="description" placeholder="Enter Product Description"  rows="5" class="@error('description') is-invalid @enderror">{{$product->description}}</textarea>
                                        @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Product Price</label>
                                    <div class="col-md-10">
                                        <input class="form-control" value="{{$product->price}}" name="price" type="text" placeholder="Enter Product Price"  class="@error('price') is-invalid @enderror">
                                        @error('price')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Product Stock</label>
                                    <div class="col-md-10">
                                        <input class="form-control" value="{{$product->stock}}"  name="stock" type="text" placeholder="Enter Product Stock" class="@error('stock') is-invalid @enderror">
                                        @error('stock')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Product Image</label>
                                    <div class="col-md-10">
                                        <input class="form-control" onchange="readUrl(this);" name="image" type="file"  class="@error('image') is-invalid @enderror">
                                        @error('image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <img src="{{url('resources/assets/admin/images/product/'.$product->upc,'main.png')}}" class="img-thumbnail" width="100px" hiegth="100px" alt="image" id="image">
                                    </div>
                                </div>
                                    <div class="list_more">
                                    @foreach($image as $k=>$image)
                                    @if($image->product_id == $product->id)
                                    <div class="moreimages">
                                    <div class="form-group row add_image">
                                        <input type="hidden" value="{{$image->id}}" name="id[]">
                                        <label class="col-2 col-form-label">Add More Imges</label>
                                        <div class="col-md-4">
                                            <input class="form-control" name="mul_img[]" type="file" class="@error('mul_img') is-invalid @enderror">
                                            <img src="{{url('resources/assets/admin/images/product/'.$product->upc,$product->upc.'_'.$k.'.png')}}" class="img-thumbnail" width="100px" hiegth="100px" alt="image" id="image">
                                            @error('mul_img')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <input class="form-control" id="sort" value="{{$image->sort}}" name="sort[]" placeholder="Sort Order" type="text" class="@error('sort') is-invalid @enderror" >
                                            @error('sort')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn-sm btn btn-primary add">
                                            <i class="fa fa-plus"></i></button>
                                            <button type="button" class="btn-sm btn btn-danger remove" value="{{$image->id}}">
                                            <i class="fa fa-minus"></i></button>
                                        </div>

                                    </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    <div class="moreimages" style="display:none">
                                    <div class="form-group row add_image">
                                        <input type="hidden" name="id[]">
                                        <label class="col-2 col-form-label">Add More Imges</label>
                                        <div class="col-md-4">
                                            <input class="form-control" name="mul_img[]" type="file" class="@error('mul_img') is-invalid @enderror">
                                            <!-- <img src="{{url('resources/assets/admin/images/product/'.$product->upc)}}" class="img-thumbnail" width="100px" hiegth="100px" alt="image" id="image"> -->
                                            @error('mul_img')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <input class="form-control sort" name="sort[]" id="sort" placeholder="Sort Order" type="text" class="@error('sort') is-invalid @enderror" >
                                            @error('sort')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn-sm btn btn-primary add">
                                            <i class="fa fa-plus"></i></button>
                                            <button type="button" class="btn-sm btn btn-danger remove" style="display:none;">
                                            <i class="fa fa-minus"></i></button>
                                        </div>          
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group text-right m-b-0">
                                    <input type="submit" class="btn btn-primary" value="Update">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- end row -->

            </div> <!-- end card-box -->
        </div><!-- end col -->
    </div>
    <!-- end row -->
</div>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-1.12.3.min.js"
integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<script>
function readUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

 $(document).on("click",".edit_save",function()
{
    // $(".access_url_span").addClass("form-control").attr("contenteditable",true);
    $(".access_url_span").addClass("d-none");
    $("#access_url_inp").removeClass("d-none");
    $(".edit_save").hide();
    $(".save").show();
});
// $(document).ready(function() {
    
//     $(document).on("click",".addMoreP",function()
//     {
//         var obj = $(this).parent().parent().clone();
//         $(this).parent().parent().after(obj);
//     });
//     $(".moreimages").on('click','.add',function(){
//         $(this).closest('.add_image').clone().find("input").val("").end().insertAfter($(this).closest('.add_image'));
//         $('.remove').show();
//       });
    
//     $(".moreimages").on('click','.remove',function(){
//         if($(".add_image").length > 1)
//         {
//             $(this).closest(".add_image").remove();
//         }
//         if($(".add_image").length == 1)
//         {
//             $('.remove').hide();
//         }
//     });

$(document).ready(function() {

    /*$('#name').keyup(function(){
    var str= $(this).val();
    // var trims= $.trim(str);
    var url_name=str.trim().replace(/[^a-z0-9\s]/gi,'').replace(/ +/g,'-').replace(/^-|-$/g,'');
    $('#access_url_span').text(url_name.toLowerCase());
     $('#access_url').val($('#access_url_span').text());

    });*/
    $(document).on("input ","#name",function()
    {
        var currVal = $(this).val();
        // console.log(currVal);
        var access_url = currVal.trim().replace(/[^a-z0-9\s]/gi,'').replace(/ +/g,'-').replace(/^-|-$/g,'');
        $(document).find("#access_url_span").text(access_url.toLowerCase());
        $(document).find("#access_url_inp").val(access_url.toLowerCase());
        
        // console.log(access_url);
    });
    $(document).on("input","#access_url_inp",function(){
        // alert();
        // console.log($(this).val());
        var one = $(this).val().toLowerCase().replace(/[\s]+/gi,'-').replace(/[^a-z0-9\s-]/gi,'').replace(/[-]+/g,'-');
        $(this).val(one);
        $(this).focus();
  });


    $('.save').click(function(){
        // $("#access_url_span").removeClass("form-control").attr("contenteditable",false);
        
        $('#access_url').val($('#access_url_inp').val());
        $("#access_url_inp").addClass("d-none");
        $('#access_url_span').text($('#access_url_inp').val());
        $("#access_url_span").removeClass("d-none");
        $(".save").hide();
        $(".edit_save").show();

    });

    $(".moreimages").on('keypress',"#sort",function(e)
    { 
        console.log(keyCode);
        var keyCode = e.charCode;
        if((keyCode != 8 || keyCode == 32) && (keyCode <48 || keyCode >57))
        {
            e.preventDefault();
            return false;
        }
    });


    if($(".list_more >div").length == 1)
    {
            $('.moreimages').show();

    }

    $(".moreimages").on('click','.add',function(){

        $(this).closest('.add_image').clone().find("input").val("").end().insertAfter($(this).closest('.add_image'));
        $('.remove').show();
      });

    $(".moreimages").on('click','.remove',function(){
        if($(".moreimages >div").length > 1)
        {
            $(this).closest(".add_image").remove();


        }
        if($(".moreimages >div").length == 1)
        {
            $('.remove').hide();
            $('.moreimages').show(); 
        }

    });

    // $(document).ready(function() {
    // if($(".list_more >div").length == 1)
    //     {
    //         $('.moreimages').show();

    //     }

    //     $(".list_more").on('click','.add',function(){
    //     $(this).closest('.add_image').clone().find("input").val("").end().insertAfter($(this).closest('.add_image'));
    //     if($(".list_more> div").length != 1)
    //     {
    //         $('.remove').show();
    //         }
    //   });

    //     $(".list_more").on('click','.remove',function(){
    //     if($(".list_more >div").length > 1)
    //     {
    //         $(this).closest(".moreimages").remove();
    //     }
    //     if($(".list_more >div").length == 1)
    //     {
    //         $('.remove').remove();
    //         $('.moreimages').show();

    //     }

    // });




               
            $("form[name='add_product']").validate({
                ignore : [],

            rules: {
           
                name:{
                    required: true,
                    },
                access_url:{
                    required: true,
                    remote:{
                        url:"{{url('admin/product/checkUrl')}}",
                        type:"get",
                        data:{
                            id: $("#id").val(),
                            access_url: $(".access_url").val()
                        },
                    },
                },
                price:{
                    required: true,
                    number: true,
                    maxlength:10,
                    },
                stock:{
                    required:true,
                    digits:true,
                    maxlength:4,
                  },
                image:{
                    accept:"jpg,png,jpeg,gif"
                },
                'mul_img[]' :{
                    // required: true,
                    accept:"jpg,png,jpeg,gif",
                },
                'sort[]' :{
                    // required:true,
                    number:true,
                    maxlength:3,
                },
            },
            messages:{
                name:{
                    required:"Enter Product Name"
                },
                access_url:{
                    required:"Enter Url",
                    remote:"Enter Unique Url"  
                },
                price:{
                    required:"Enter Price",
                    number:"Price Must be in Numeric",
                    // maxlength: "Enter Price Under Rs.999999"
                    maxlength: "Price not to be greater than 10 Numbers"
                },
                stock:{
                    required:"Enter Stock",
                    digits:"Price Must be in Numeric",
                    maxlength: "Stock not to be greater than 4 Numbers"
                },
                image:{
                    accept:"Choose only jpg,png,jpeg,gif"
                },
                'mul_img[]':{
                    // required : "Please upload atleast 1 photo",
                    accept:"Choose only jpg,png,jpeg,gif",
                },
                'sort[]':{
                    // required: "Please Enter Image order",
                    number: "Order must be in Numeric",
                }
            },
            submitHandler: function(form) {
              form.submit();
            }
            });
        }); 

// $('.remove').click(function(){


             
//             $.ajax({
//                     type: "get",
//                     url: "{{url('admin/product/removeImg')}}",
//                     data: {
//                         id: $(this).attr('id'),
//                     },
//                     success: function(){
//                         // alert('done!');
//                     }
//                 });
//         });

</script>
@endsection