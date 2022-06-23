<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="index.html">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend/images/logo-dark.png')}}" alt="">
                        <h3><b>Sunny</b> Admin</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{ (request()->is('admin/dashboard')) ? 'active': '' }}">
                <a href="{{ route('admin.home') }}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview {{ (request()->is('admin/brands*')) ? 'active': '' }}">
                <a href="{{ route('admin.brands.index') }}">
                    <i data-feather="message-circle"></i>
                    <span>Brands</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('admin/brands*')) ? 'active': '' }}"><a
                            href="{{ route('admin.brands.index') }}"><i class="ti-more"></i>All Brands</a></li>
                </ul>
            </li>

            <li class="treeview {{ (request()->is('admin/categories*')) ? 'active': '' }}">
                <a href="{{ route('admin.category.index') }}">
                    <i data-feather="mail"></i> <span>Categories</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('admin/categories*')) ? 'active': '' }}"><a
                            href="{{ route('admin.category.index') }}"><i class="ti-more"></i>All Categories</a></li>
                    <li class="{{ (request()->is('admin/categories*')) ? 'active': '' }}"><a
                            href="{{ route('admin.sub_category.index') }}"><i class="ti-more"></i>All Sub Categories</a>
                    </li>
                    <li class="{{ (request()->is('admin/categories*')) ? 'active': '' }}"><a
                            href="{{ route('admin.child_category.index') }}"><i class="ti-more"></i>All Child
                            Categories</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Products</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.product.index')}}"><i class="ti-more"></i>All Products</a></li>
                    <li><a href="{{route('admin.product.create')}}"><i class="ti-more"></i>Add Product</a></li>
                    <li><a href="#"><i class="ti-more"></i>Manage Product</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Slider</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.slider.index')}}"><i class="ti-more"></i>All Slider</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Coupons</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.coupon.index')}}"><i class="ti-more"></i>Manage Coupon</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Shipping Area</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.division.index')}}"><i class="ti-more"></i>Manage Division</a></li>
                    <li><a href="{{route('admin.district.index')}}"><i class="ti-more"></i>Manage District</a></li>
                    <li><a href="{{route('admin.state.index')}}"><i class="ti-more"></i>Manage State</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.order.all')}}"><i class="ti-more"></i>All Orders</a></li>
                    <li><a href="{{route('admin.order.pending')}}"><i class="ti-more"></i>Pending Orders</a></li>
                    <li><a href="{{route('admin.order.cancel')}}"><i class="ti-more"></i>Cancel Orders</a></li>
                    <li><a href="{{route('admin.order.confirmed')}}"><i class="ti-more"></i>Confirm Orders</a></li>
                    <li><a href="{{route('admin.order.processing')}}"><i class="ti-more"></i>Processing Orders</a></li>
                    <li><a href="{{route('admin.order.delivered')}}"><i class="ti-more"></i>Delivered Orders</a></li>
                    <li><a href="{{route('admin.order.picked')}}"><i class="ti-more"></i>Picked Orders</a></li>
                    <li><a href="{{route('admin.order.shipped')}}"><i class="ti-more"></i>Shipped Orders</a></li>

                </ul>
            </li>
            <li style="margin-top: 50px;">
                <a href="{{route('home')}}" style="background-color: green; color:black; text-align:center; display:block;">View Website</a>
            </li>
        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings"
            aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i
                class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i
                class="ti-lock"></i></a>
    </div>
</aside>
