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
                        <ul class="row">
                            <li class="col-md-6">
                                <form name="front_login" action="{{ url('password/reset') }}" method="POST" class="login form-in-checkout">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="checkout-info-text">
                                        <h3>Reset Password</h3>
                                        <p>Now Reset Your Password</p>
                                    </div>
                                    <p class="form-row">
                                        <label for="username">Email address <span class="required">*</span></label>
                                        <input class="input-text" type="email" name="email" id="emailaddress">
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </p>
                                    <p class="form-row">
                                        <label for="password">Enter New Password <span class="required">*</span></label>
                                        <input class="input-text" type="password" name="password" id="password">
                                        @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </p>
                                    <p class="form-row">
                                        <label for="password">Confirm Password <span class="required">*</span></label>
                                        <input class="input-text" type="password" name="confirm_password" >
                                        @error('confirm_password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </p>
                                    <input type="submit" class="button btn-step" name="login" value="Sign In">
                                    <div class="clear"></div>
                                </form><!--- form.login-->
                            </li>
                        </ul>
                        <div class="line-bottom"></div>
                    </div><!--- .container-->
                </div><!--- .woocommerce--> 
            </div><!--- .main-container -->
@endsection
@section('script')
<script>
            $(document).ready(function() {
            $("form[name='front_login']").validate({
            rules: {
              email: {
                required: true,
                remote:{
                        url:"{{url('front/checkUsername')}}",
                        type:"get",
                        data:{
                            Username:function(){
                            return $("#username").val();
                            }
                        }
                    },
                email: true,
                maxlength: 64
              },
              password: {
                required: true,
                minlength: 8,
                maxlength:15
              },
              confirm_password:{
                required: true,
                equalTo: "#password",
                minlength: 8,
                maxlength:15
              },
            },
            messages: {
              email:
              {
              required: "Please enter a valid email address",
              remote: "Email Id is not Registed",
              },
              password: {
                required: "Please provide a password",
                // minlength: "Your password must be at least 8 characters long"
              },
              confirm_password:{
                equalTo:"Password doesn't match"
              },
            },
            submitHandler: function(form) {
              form.submit();
            }
            });
        });                       
</script>

@endsection