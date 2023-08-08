@extends('layouts.admin.app')
@section('title','ShowCategory')
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
            <div class="text-right mb-3">
                <a href="{{ url('admin/categories/show')}}" class="btn btn-primary waves-effect waves-light btn-sm">
                <i class="fa fa-angle-left"></i> Back
                </a>
            </div>

            <table id="datatable" class="table table-bordered">
                <thead> 
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($name as $data)
                <tr>
                    <td>{{ $id++ }}</td>
                    <td>{{ $data->name }}</td>
                    <td>
                    <a href="{{url('admin/categories/restore',$data->id)}}" class="btn btn-info"><i class="fas fa-undo"></i> Restore</a>
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

        //Buttons examples
        var table = $('#datatable-buttons').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'colvis']
        });

        table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
    } );

   
</script>
@endsection