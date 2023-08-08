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
                                <form action="{{ url('login') }}" name="front_login" method="post" class="login form-in-checkout">
                                    @csrf
                                    <div class="checkout-info-text">
                                        @include('layouts/admin/common/message')
                                        <h3>Login</h3>
                                        <p>Already Registed? Please login below.</p>
                                    </div>
                                    <p class="form-row">
                                        <label for="username">Email address <span class="required">*</span></label>
                                        <input type="text" class="input-text" name="email" id="username">
                                    </p>
                                    <p class="form-row">
                                        <label for="password">Password <span class="required">*</span></label>
                                        <input class="input-text" type="password" name="password" id="password">
                                    </p>
                                    <p class="form-row">
                                        <a class="lost_password" href="{{url('reset')}}">Forgot your password?</a>
                                    </p>
                                    <div class="clear"></div>
                                    <div class="checkout-col-footer">
                                        <input type="submit" class="button btn-step" name="login" value="Login">
                                        <label for="rememberme" class="inline">
                                              <p class="text-muted">Don't have an account?
                                                <!-- <a href="{{url('register')}}" class="btn-step">Sign Up</a></p> -->
                                              <a href="{{url('register')}}">
                                                <input type="button" value="SIGN UP" class="btn-step">
                                              </a>
                                        </label>
                                    </div>
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
            $('.alert').delay(2000).fadeOut(2000);
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
                minlength: 8
              }
            },
            messages: {
              password: {
                required: "Please provide a password",
                // minlength: "Your password must be at least 8 characters long"
              },
              email:
              {
              required: "Please enter a valid email address",
              remote: "Email Id is not Registed",
              }
            },
            submitHandler: function(form) {
              form.submit();
            }
            });
        });                       
</script>

@endsection