@extends('layouts.admin.app')
@section('title','TrashUsers')
@section('content')
<?php $id=1 ?>
<div class="container-fluid">
<div class="row">
<div class="col-12">
    <div class="page-title-box">
        <h4 class="page-title float-left">Users</h4>

        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="#">Adminox</a></li>
            <!-- <li class="breadcrumb-item"><a href="#">Color</a></li> -->
            <li class="breadcrumb-item active">Users</li>
        </ol>
        <div class="clearfix"></div>
    </div>
</div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive ">
            <div class="text-right mb-3">
                <a href="{{ url('admin/user/index')}}" class="btn btn-primary waves-effect waves-light btn-sm">
                <i class="fa fa-angle-left"></i> Back
                </a>
            </div>

            <table id="datatable" class="table table-bordered">
                <thead> 
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Registered Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($user as  $user)
                <tr>
                    <td>{{ $user->name}}</td>
                    <td>{{ $user->email}}</td>
                    <td>{{ $user->phone_no}}</td>
                    <td>{{ $user->created_at}}</td>
                    <td>
                        <a href="{{ url('admin/user/restore',$user->id)}}" class="btn btn-info">
                             <i class="fas fa-undo"></i> 
                        </a>
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