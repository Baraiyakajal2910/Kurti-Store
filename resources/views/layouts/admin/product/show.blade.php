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
                <a href="{{ url('admin/product/add')}}" class="btn btn-primary waves-effect waves-light btn-sm">
                <i class="fa fa-plus-square"></i> Add
                </a>
                <a href="{{ url('admin/product/trash')}}" class="btn btn-danger waves-effect waves-light btn-sm display:inline">
                <i class="fa fa-trash-o"></i> Trash
                </a>
            </div>

            <table id="datatable" class="table table-bordered">
                <thead> 
                <tr>
                    <th>UPC</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Detail</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Created_At</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($product as  $product)
                <tr>
                    <td>{{ $product->upc}}</td>
                    <td><img src="{{asset('assets/admin/images/product/'.$product->upc.'main.png')}}" class="img-thumbnail" width="50px"   alt="image" id="image"></td>
                    <td>{{ $product->name}}</td>
                    <td><b>Color Name:</b>{{ $product->color_name}}<br>
                        <b>Catogory Name:</b>{{ $product->brand_name}}</td>
                    <td>{{ $product->price}}</td>
                    <td>{{ $product->stock}}</td>
                    <td>{{ $product->created_at}}</td>
                    <td>
                         <input type="checkbox" id="{{$product->id}}" class="toggle" data-plugin="switchery" data-color="#039cfd" data-size="small" @if($product->deleted_at == 'Y') checked  @endif />
                    </td>
                    
                    <td>
                        <a href="{{ url('admin/product/showEditForm',$product->id)}}"><i class="fa fa-edit fa-lg"></i></a>
                        <a href="{{ url('admin/product/update',$product->id)}}">
                             <i class="fa fa-trash-o fa-lg"></i> 
                        </a>
                        <a href="{{ url('/',$product->access_url)}}"><i class="fa fa-eye"></i></a>
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
        $('#datatable').DataTable({

            'columnDefs':[{
                'targets':[1,7,8],
                'orderable':false,
            }]

            });
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