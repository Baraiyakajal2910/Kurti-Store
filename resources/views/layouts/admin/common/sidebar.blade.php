 <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li>
                                <a href="{{ url('admin/index')}}">
                                    <i class="fi-air-play"></i><span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/user/index')}}">
                                    <i class="fa fa-user"></i><span>User</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);"><i class="fas fa-palette"></i> <span>Color</span><span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded=false>
                                    <li><a href="{{ url('admin/color/add')}}">Add</a></li>
                                    <li><a href="{{ url('admin/color/show')}}">Colors</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);"><i class="fa fa-list-alt"></i> <span>Category</span><span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded=false>
                                    <li><a href="{{ url('admin/categories/add')}}">Add</a></li>
                                    <li><a href="{{ url('admin/categories/show')}}">Categories</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);"><i class="fa fa-product-hunt"></i> <span>Product</span><span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded=false>
                                    <li><a href="{{ url('admin/product/add')}}">Add</a></li>
                                    <li><a href="{{ url('admin/product/show')}}">Products</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{url('admin/order/show')}}"><i class="fi-paper"></i> <span>Order</span></a>
                                
                            </li>
                            <!-- <li>
                                <a href="javascript: void(0);"><i class="fa fa-image"></i> <span>Image</span><span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded=false>
                                    <li><a href="{{ url('admin/Image/add')}}">Add</a></li>
                                    <li><a href="{{ url('admin/Image/show')}}">Images</a></li>
                                </ul>
                            </li> -->
                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->
                
            </div>
            <!-- Left Sidebar End -->
