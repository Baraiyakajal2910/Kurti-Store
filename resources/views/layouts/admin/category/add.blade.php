@extends('layouts.admin.app')
@section('title')
    Add
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Category</h4>

                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="#">Adminox</a></li>
                    <li class="breadcrumb-item"><a href="#">Cotegory</a></li>
                    <li class="breadcrumb-item active">Add</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
<!-- end row -->
    <div class="row">
        <div class="col-lg-12">
			<form action="{{ url('admin/categories/store')}}" method="POST" name="Add_category">
				@csrf
				<div class="card-box">
                    
                    <div class="form-group text-right m-b-0">
                        <a href="{{ url('admin/categories/show')}}" class="btn btn-primary waves-effect waves-light btn-sm">
                        <i class="fa fa-angle-left"></i> Back
                        </a>
                    </div>

                    <div class="form-group">
                        <label>Category Name</label>
                            <input type="text" name="name" id="name" parsley-trigger="change"
                                placeholder="Enter category name" class="form-control" class="@error('name') is-invalid @enderror">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary waves-effect waves-light btn-sm" type="submit">
                        Add
                        </button>
                    </div>

                </div>
            </form>
        </div> 
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-1.12.3.min.js"
integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="{{ url('resources/assets/admin/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ url('resources/assets/admin/pages/jquery.sweet-alert.init.js') }}"></script>


<script>
$(document).ready(function() {
$("form[name='Add_category']").validate({
rules: {
    name:{
        required: true,
        remote:{
            url:"{{ url('admin/categories/checkBrandname')}}",
            type:"get",
            data: {
            category:function(){
                return $("#name").val();
                }
            },
        }
    }
  
},
messages: {
    name: {
        required:"Please enter Category Name",
        remote:'The category name has already been taken'
  }
  
},

submitHandler: function(form) {
  form.submit();
}
});
});                       
</script>
@endsection