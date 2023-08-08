@extends('layouts.admin.app')
@section('title','Add Product')
@section('content')
<div class="container-fluid">
    <style type="text/css">
    .d-none{
        display: none;
    }
    </style>
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
                            <form class="form-horizontal" name="add_product" enctype="multipart/form-data" action="{{ url('admin/product/store')}}" method="POST" role="form">
                            	@csrf
                            	<div class="form-group text-right m-b-15">
			                        <a href="{{ url('admin/product/show')}}" class="btn btn-primary waves-effect waves-light btn-sm">
			                        <i class="fa fa-angle-left"></i> Back
			                        </a>
                    			</div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Product UPC</label>
                                    <div class="col-10">
                                        <input type="text" name="upc" id="upc" class="form-control" placeholder="Enter Product UPC" class="@error('upc') is-invalid @enderror">
                                        @error('upc')
                                			<div class="alert alert-danger">{{ $message }}</div>
                            			@enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Product Name</label>
                                    <div class="col-10">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Product Name" class="@error('name') is-invalid @enderror"><br>
                                        <input type="hidden" name="access_url" id="access_url">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <span>{{url('/')}}/<span id="access_url_span" class="access_url_span" name="access_url_span"></span>
                                            <input type="text" class="form-control d-none" id="access_url_inp">
                                            <!-- <input id="access_url_span" class="access_url_span" type="text" style="border:none;"> -->
                                        </span>
                                        <span class="edit_save btn btn-action" ><i class="fa fa-edit"></i></span>
                                        <span class="save btn btn-action" style="display:none;" ><i class="fa fa-save"></i></span>
                                        
                                    </div>
                                    </div>
                                    <!-- <span>
                                             {{url('/')}}/<p type="text" id="url_name" readonly class="d-inline"></p>
                                             <a href="#" id="editname" ><i class="fa fa-edit"></i></a><i class="fa fa-save"></i>
                                    </span> -->
                                    
                                    <div class="form-group row">
                                    <label class="col-2 col-form-label">Product Category</label>
                                    <div class="col-10">
                                        <select class="form-control" name="brand_id" class="@error('brand_id') is-invalid @enderror">
                                            <option value="none" selected disabled hidden>Select Product Category</option>
                                            @foreach($brand as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Product Color</label>
                                    <div class="col-10">
                                        <select class="form-control" name="color_id" class="@error('color_id') is-invalid @enderror">
                                            <option value="none" selected disabled hidden>Select Product Color</option>
                                            @foreach($color as $color)
                                            <option value="{{$color->id}}">{{$color->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('color_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
								<div class="form-group row">
                                    <label class="col-2 col-form-label">Product Description</label>
                                    <div class="col-10">
                                        <textarea class="form-control" name="description" style="resize:none;" placeholder="Enter Product Description"  rows="5" class="@error('description') is-invalid @enderror"></textarea>
                                        @error('description')
                                			<div class="alert alert-danger">{{ $message }}</div>
                            			@enderror
                                    </div>
                                </div>

									<div class="form-group row">
                                    <label class="col-2 col-form-label">Product Price</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="price" type="text" placeholder="Enter Product Price"  class="@error('price') is-invalid @enderror">
                                        @error('price')
                                			<div class="alert alert-danger">{{ $message }}</div>
                            			@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Product Stock</label>
                                    <div class="col-md-10">
                                        <input class="form-control"  name="stock" type="text" placeholder="Enter Product Stock" class="@error('stock') is-invalid @enderror">
                                        @error('stock')
                                			<div class="alert alert-danger">{{ $message }}</div>
                            			@enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Product Image</label>
                                    <div class="col-md-10">
                                        <input class="form-control"  name="image" type="file"  class="@error('image') is-invalid @enderror">
                                        @error('image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="moreimages">
                                <div class="form-group row add_image">
                                    <label class="col-2 col-form-label">Add More Imges</label>
                                    <div class="col-md-4">
                                        <input class="form-control"  name="mul_img[]" type="file"  class="@error('mul_img') is-invalid @enderror">
                                        @error('mul_img')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <input class="form-control" name="sort[]" id="sort" placeholder="Sort Order" type="text" class="@error('sort') is-invalid @enderror" >
                                        @error('sort')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn-sm btn btn-primary add">
                                        <i class="fa fa-plus"></i></button>
                                        <button type="button" class="btn-sm btn btn-danger remove" style="display:none">
                                        <i class="fa fa-minus"></i></button>
                                    </div>

                                </div>
                                </div>
                                <div class="form-group text-right m-b-0">
			                        <input type="submit" class="btn btn-primary" value="Save">
                    			</div>
                                <!-- <div class="row">
                                    <div class="col-8">Pray</div>
                                    <div class="col-2">
                                        <a class="btn btn-primary addMoreP"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div> -->
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
<script src="{{ url('resources/assets/admin/js/jquery-1.12.3.min.js') }}"
integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ=" crossorigin="anonymous"></script>
<script src="{{ url('resources/assets/admin/js/jquery.js') }}"></script>
<script src="{{ url('resources/assets/admin/js/jquery.validate.min.js') }}"></script>
<script src="{{ url('resources/assets/admin/js/additional-methods.min.js') }}"></script>
 <!-- Jquery filer js -->
<script src="{{ url('resources/assets/admin/plugins/jquery.filer/js/jquery.filer.min.js') }}"></script>
<!-- Bootstrap fileupload js -->
<script src="{{ url('resources/assets/admin/plugins/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>
<!-- page specific js -->
<script src="{{ url('resources/assets/admin/pages/jquery.fileuploads.init.js') }}"></script>
<script src="{{ url('resources/assets/admin/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ url('resources/assets/admin/pages/jquery.sweet-alert.init.js') }}"></script>

<script>
/*$(document).on("input","#name",function()
{
    var thisVal = $(this).val();
    $(document).find("#access_url_span").text(thisVal);
    // $(document).find("#access_url_input").text(thisVal);

});*/
$(document).on("click",".edit_save",function()
{
    // $(".access_url_span").addClass("form-control").attr("contenteditable",true);
    $(".access_url_span").addClass("d-none");
    $("#access_url_inp").removeClass("d-none");
    // $(document).find('#access_url').val()
    $(".save").show();
    $(".edit_save").hide();
});

$(document).ready(function(){

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
        $('#access_url').val($('#access_url_inp').val());
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

    // $(document).on("keydown",".sort",function(event){
    //     // var keyCode = e.which;
    //     if( !(event.keyCode == 8                                // backspace
    //     || event.keyCode == 46                                  // delete                             
    //     || (event.keyCode >= 35 && event.keyCode <= 40)     // arrow keys/home/end
    //     || (event.keyCode >= 48 && event.keyCode <= 57)     // numbers on keyboard
    //     || (event.keyCode >= 96 && event.keyCode <= 105))   // number on keypad
    //     ) 
    //     {
    //         event.preventDefault();     // Prevent character input
    //     }
    // });

    // $(document).on('keydown',"#sort",function(e)
    // { 
    //     var keyCode = e.which;
    //     console.log(keyCode);
    //     if((keyCode >47 && keyCode <58) || (keyCode >96 && keyCode <105))
    //     {

    //         return true;
    //     }
    //     else
    //     {
    //         e.preventDefault();
    //         return false;
    //     }
    // });


    $(".moreimages").on('keypress',"#sort",function(e)
    { 
        var keyCode = e.charCode;
        // console.log(keyCode);
        if((keyCode != 8 || keyCode == 32) && (keyCode <48 || keyCode >57))
        {
            e.preventDefault();
            return false;
        }
    });

    // $(document).on("click",".addMoreP",function()
    // {
    //     var obj = $(this).parent().parent().clone();
    //     $(this).parent().parent().after(obj);
    // });
    $(".moreimages").on('click','.add',function(){
        $(this).closest('.add_image').clone().find("input").val("").end().insertAfter($(this).closest('.add_image'));
        $('.remove').show();
      });
    
    $(".moreimages").on('click','.remove',function(){
        if($(".add_image").length > 1)
        {
            $(this).closest(".add_image").remove();
        }
        if($(".add_image").length == 1)
        {
            $('.remove').hide();
        }
    });
    
    $("form[name='add_product']").validate({
        ignore:[],
        rules: {
                 brand_id: {

                    required: true,
                },
                color_id:{
                    required:true,
                },
                upc:{
                    required: true,
                    minlength: 10,
                    maxlength: 30,
                    digits: true,
                    remote:{
                        url:"{{url('admin/product/checkUpc')}}",
                        type:"get",
                        data:{
                            UPC:function(){
                            return $("#upc").val();
                            }
                        }
                    },
                    },
                name:{
                    required: true,
                    maxlength: 50
                    },
                access_url:{
                    required: true,
                    remote:{
                        url:"{{url('admin/product/checkUrl')}}",
                        type:"get",
                        data:{
                            Url:function(){
                            return $("#access_url").val();
                            }
                        }
                    },
                },
                description:{
                    maxlength: 255,
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
                    required:true,
                    accept:"jpg,png,jpeg,gif",
                },
                'mul_img[]' :{
                    // required: true,
                    accept:"jpg,png,jpeg,gif",
                },
                'sort[]' :{
                    // required:true,
                    // number:true,
                    maxlength:3,
                },

            },
            messages:{
                brand_id:{
                    required:"Select Category Name"
                },
                color_id: {
                    required:"Select Color Name"
                },
                upc:{
                    required:"Enter UPC",
                    minlength:"The Minimum UPC length Must be 10 Number",
                    maxlength: "The Maximum UPC length Must be 30 Number",
                    digits: "UPC Must be in Numeric",
                    remote:"Enter Unique UPC"  
                },
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
                    required:"choose file",
                    accept:"Choose only jpg,png,jpeg,gif",
                },
                'mul_img[]':{
                    // required : "Please upload atleast 1 photo",
                    accept:"Choose only jpg,png,jpeg,gif",
                },
            },
            submitHandler: function(form) 
            {
                    form.submit();
            }
        });
    }); 
</script>
@endsection