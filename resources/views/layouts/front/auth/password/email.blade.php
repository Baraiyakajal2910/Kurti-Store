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
                                <form action="{{ url('password/email') }}" method="POST" name="Reset_Pwd" class="login form-in-checkout">
                                    @csrf
                                    <div class="checkout-info-text">
                                        @include('layouts/admin/common/message')
                                        <h3>Password Reset</h3>
                                        <p>Enter your email address and we'll send you an email with instructions to reset your password.</p>
                                    </div>
                                    <p class="form-row">
                                        <label for="username">Email address <span class="required">*</span></label>
                                        <input type="text" class="input-text" name="email" id="username">
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </p>
                                    <div class="clear"></div>
                                    <div class="checkout-col-footer">
                                        <input type="submit" class="button btn-step" name="login" value="Reset Password"><br><br>
                                    <div>
                                        <label for="rememberme" class="inline">
                                          <p class="text-muted">Back to
                                          <a href="{{ url('login') }}">
                                            <input type="button" value="Sign In" class="btn-step">
                                          </a>
                                        </label>
                                    </div>
                                    </div>
                                    <div>

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
            $("form[name='Reset_Pwd']").validate({
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
            },
            messages: {
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