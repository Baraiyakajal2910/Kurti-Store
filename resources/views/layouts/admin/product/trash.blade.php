@extends('layouts.admin.app')
@section('title','Product')
@section('content')
<div class="container-fluid">
<div class="row">
<div class="col-12">
    <div class="page-title-box">
        <h4 class="page-title float-left">Product</h4>

        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="#">Adminox</a></li>
            <!-- <li class="breadcrumb-item"><a href="#">Color</a></li> -->
            <li class="breadcrumb-item active">Products</li>
        </ol>
        <div class="clearfix"></div>
    </div>
</div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive ">
            @include('layouts/admin/common/message')
            <div class="text-right mb-3">
                <a href="{{ url('admin/product/show')}}" class="btn btn-primary waves-effect waves-light btn-sm"><i class="fa fa-angle-left"></i> Back</a>
            </div>

            <table id="datatable" class="table table-bordered">
                <thead> 
                <tr>
                    <th>Id</th>
                    <th>UPC</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Description</th>
                    <th>Created_At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($product as $product)
                <tr>
                    <td>{{ $loop->index+1}}</td>
                    <td>{{ $product->upc}}</td>
                    <td>{{ $product->name}}</td>
                    <td>{{ $product->color_name}}</td>
                    <td>{{ $product->brand_name}}</td>
                    <td>{{ $product->price}}</td>
                    <td>{{ $product->stock}}</td>
                    <td>{{ $product->description}}</td>
                    <td>{{ $product->created_at}}</td>
                    <td>
                        <a href="{{ url('admin/product/restore',$product->id)}}" class="btn btn-info"><i class="fas fa-undo"></i> Restore</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> <!-- end row -->
</div>
@endsection
@section('script')

<script src="{{ url('resources/assets/admin/plugins/footable/js/footable.all.min.js') }}"></script>
<script src="{{ url('resources/assets/admin/pages/jquery.footable.js') }}"></script>
 <script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable();
        $('.alert').delay(2000).fadeOut(2000);

        //Buttons examples
    } );

     // $('.toggle').change(function(){
     //    // alert('bjijni');
     //    // if(!this.checked) 
     //    var status = $(this).prop('checked') == true ? 1 : 0; 
     //    var user_id = $(this).data('id'); 

     // });

    $('.toggle').change(function(){
            if(this.checked)
            {
                var status = 'Y';  
            }
            else{
                var status = 'N';
            }


            $.ajax({
                    type: "get",
                    url: "{{url('admin/product/changeProductStatus')}}",
                    data: {
                        id: $(this).attr('id'),
                        status:status
                    },
                    success: function(){
                        // alert('done!');
                    }
                });
        });


        

     

</script>

@endsection