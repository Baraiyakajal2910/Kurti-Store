@extends('layouts.admin.app')
@section('title','Category')
@section('content')
<?php $id=1 ?>
<div class="container-fluid">
<div class="row">
<div class="col-12">
    <div class="page-title-box">
        <h4 class="page-title float-left">Categories</h4>

        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="#">Adminox</a></li>
            <!-- <li class="breadcrumb-item"><a href="#">Color</a></li> -->
            <li class="breadcrumb-item active">Categories</li>
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
                <a href="{{ url('admin/categories/add')}}" class="btn btn-primary waves-effect waves-light btn-sm">
                <i class="fa fa-plus-square"></i> Add
                </a>
                <a href="{{ url('admin/categories/trash')}}" class="btn btn-danger waves-effect waves-light btn-sm">
                <i class="fa fa-trash-o"></i> Trash
                </a>
            </div>

            <table id="datatable" class="table table-bordered">
                <thead> 
                <tr>
                    <th>Name</th>
                    <th>Created_At</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($name as $data)
                <tr>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->created_at }}</td>
                    <td>
                     
                        <input type="checkbox" id="{{$data->id}}" class="toggle" data-plugin="switchery" data-color="#039cfd" data-size="small" @if($data->deleted_at == 'Y') checked  @endif />
                    
                    </td>
                    <!-- <td><input type="checkbox" id="{{$data->id}}" checked class="toggle" data-plugin="switchery" data-color="#039cfd" data-size="small" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $data->deleted_at ? 'checked' : '' }} /></td> -->
                    <td><div><a href="{{ url('admin/categories/showEditForm',$data->id)}}" class="btn btn-info">Edit</a>
                       <!--  <form class="d-inline" action="{{ url('update/color',$data->id) }}" ><input type="submit" name="delete" value="Delete"  class="btn btn-danger"></form> -->
                        <a href="{{ url('admin/categories/update',$data->id)}}" class="btn btn-danger">Delete</a></div>
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
                'targets':[2,3],
                'orderable':false,
            }]

            });
        $('.alert').delay(2000).fadeOut(2000);
        //Buttons examples
        var table = $('#datatable-buttons').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'colvis']
        });

        table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
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
                    url: "{{ url('admin/categories/changeBrandStatus')}}",
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