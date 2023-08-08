<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        @include('layouts.admin.common.head')
        <style type="text/css">
        .error{
                color:red;
        }

        </style>
    </head>
    <body>
        <!-- Begin page -->
        <div id="wrapper">
        <!-- Top Bar start -->

                @include('layouts.admin.common.header')
            <!-- ========== Left Sidebar Start ========== -->
                @include('layouts.admin.common.sidebar')
            <!-- Left Sidebar End -->


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <div class="content">
                    @section('content')
                    @show
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
            @include('layouts.admin.common.footer')

        </div>
        <!-- END wrapper -->
        @include('layouts.admin.common.js')
    </body>
</html>