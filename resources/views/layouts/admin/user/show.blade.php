@extends('layouts.admin.app')
@section('title','Users')
@section('content')
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
            @include('layouts/admin/common/message')
            <div class="text-right mb-3">
                <a href="{{ url('admin/user/trash')}}" class="btn btn-danger waves-effect waves-light btn-sm display:inline">
                <i class="fa fa-trash-o"></i> Trash
                </a>
            </div>

            <table id="datatable" class="table table-bordered">
                <thead> 
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Registered Date</th>
                    <th>Status</th>
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
                         <input type="checkbox" id="{{$user->id}}" class="toggle" data-plugin="switchery" data-color="#039cfd" data-size="small" @if($user->deleted_at == 'Y') checked  @endif />
                    </td>
                    
                    <td>
                        <a href="{{ url('admin/user/update',$user->id)}}" class="btn btn-danger">
                             <i class="fa fa-trash-o fa-lg"></i> 
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
        $('.alert').delay(2000).fadeOut(2000);
        $('#datatable').DataTable({

            'columnDefs':[{
                'targets':[1,7,8],
                'orderable':false,
            }]

            });
        

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
                    url: "{{url('admin/user/changeUserStatus')}}",
                    data: {
                        id: $(this).attr('id'),
                        status:status
                    },
                    success: function(){
                        
                    }
                });
        });
</script>
@endsection