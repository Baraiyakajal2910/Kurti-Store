@extends('layouts.front.app')
@section('content')
<div class="main-container col1-layout content-color color">
                <div class="breadcrumbs">
                    <div class="container">
                        <ul>
                            <li class="home"> <a href="{{url('/')}}" title="Go to Home Page">Home</a></li>
                        </ul>
                    </div>
                </div><!--- .breadcrumbs-->
                <div class="woocommerce">
                    <div class="container">
                        <form name="registration" method="post" class="checkout woocommerce-checkout form-in-checkout" action="{{url('store')}}">
                            {{ csrf_field() }}
                            <ul class="row">
                                <li class="col-md-9">
                                    <div class="checkout-info-text">
                                        <h3>Register</h3>
                                    </div>
                                    @include('layouts/admin/common/message')
                                    <div class="woocommerce-billing-fields">
                                        <ul class="row">
                                            <li class="col-md-12">
                                                <p class="form-row validate-required" id="billing_first_name_field">
                                                    <label for="billing_first_name" class="">Full Name</label>
                                                    <input class="input-text " type="text" name="name" id="username">
                                                    @error('name')
                                                      <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </p>
                                            </li>
                                            <li class="col-md-12 gender1">
                                                <p class="form-row validate-required" id="billing_first_name_field">
                                                    <label for="gender">Gender</label>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                          <input type="radio" class="form-check-input" name="gender" id="male" value="male">
                                                          Male
                                                        </label>
                                                      </div>
                                                      <div class="form-check">
                                                      <label class="form-check-label">
                                                          <input type="radio" class="form-check-input" name="gender" id="female" value="female">
                                                          Female
                                                        </label>
                                                      </div>
                                                      <div class="form-check">
                                                      <label class="form-check-label">
                                                          <input type="radio" class="form-check-input" name="gender" id="other" value="other">
                                                          Other
                                                      </label>
                                                    @error('radio')
                                                      <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    </div>
                                                </p>
                                            </li>
                                            <li class="col-md-12  col-left- 12">
                                                <p class="form-row  validate-required validate-email">
                                                    <label>Email ID</label>
                                                    <input type="email" class="input-text " name="email" id="email">
                                                    @error('email')
                                                      <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </p>
                                            </li>
                                            <li class="col-md-12  col-left- 12">
                                                <p class="form-row  validate-required validate-email">
                                                    <label>Password</label>
                                                    <input type="password" class="input-text" name="password" id="password">
                                                    @error('password')
                                                      <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </p>
                                            </li>
                                            <li class="col-md-12  col-left- 12">
                                                <p class="form-row  validate-required validate-email">
                                                    <label>Confirm Password</label>
                                                    <input type="password" class="input-text" name="confirm_password" id="c_password">
                                                    @error('confirm_password')
                                                      <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </p>
                                            </li>
                                            <li class="col-md-12">
                                                <p class="form-row validate-required validate-phone woocommerce-validated" id="billing_phone_field">
                                                    <label for="billing_phone" class="">Phone number</label>
                                                    <input  class="input-text " type="text" name="phone_no" id="phone_no" placeholder="+91">
                                                    @error('phone_no')
                                                      <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </p>
                                            </li>
                                        </ul>
                                    </div><!--- .woocommerce-billing-fields-->  
                                    
                                    <div class="checkout-col-footer">
                                        <input type="submit" value="Register" class="btn-step">
                                    </div><!--- .checkout-col-footer--> 
                                </li>
                            </ul>
                        </form><!--- form.checkout-->
                        <div class="line-bottom"></div>
                    </div><!--- .container-->
                </div><!--- .woocommerce-->
</div>
@endsection
@section('script')
<script>
  $("#phone_no").on('keypress',function(e)
    { 
        var keyCode = e.charCode;
        // console.log(keyCode);
        if((keyCode != 8 || keyCode == 32) && (keyCode <48 || keyCode >57))
        {
            e.preventDefault();
            return false;
        }
    });

  $(document).ready(function() {
    $("form[name='registration']").validate({
      rules: 
      {
        name:{
          required: true,
          minlength:3,
          maxlength:50
        },
        gender:{
          required:true
        },
        email:{
          required:true,
          remote:{
                        url:"{{url('front/checkEmail')}}",
                        type:"get",
                        data:{
                            Url:function(){
                            return $("#email").val();
                            }
                        }
                    },
          maxlength:30
        },
        password: {
          required: true,
          minlength: 8,
          maxlength: 20
        },
        confirm_password:{
          required: true,
          equalTo: "#password",
          minlength: 8,
          maxlength: 20
        },
        phone_no: {
          required: true,
          phoneUS: true,
          minlength:10,
          maxlength: 10
        },
      },
      messages: 
      {
        name:{
          required: "Please Enter Your Full Name"
        },
        gender:{
          required:"Select Your Gender"
        },
        email:{
          required:"Please Enter Email Id",
          remote:"These Email Id is already taken"
        },
        password: {
          required: "Please provide a password"
        },
        confirm_password:{
          equalTo:"Password Doesn't Match"
        },
        phone_no: {
          required: "Please enter your Phone No.",
          phoneUS: "Please enter valid Phone No.",
          minlength: "Enter 10 digit Mobile number",
          maxlength: "Enter 10 digit Mobile number"
          },
      },
      errorPlacement: function(error, element) {

                if (element.is(":radio")) {
                   error.appendTo(element.parents('.gender1'));
                 } else {
                   error.insertAfter(element);

              }
      },

      submitHandler: function(form) {
        form.submit();
      }
  });
});                       
</script>
@endsection
