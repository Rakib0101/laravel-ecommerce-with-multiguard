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
