<aside class="left-sidebar mt-4" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav" style="margin-top:50px">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li class="sidebar-item pt-2">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/" aria-expanded="false">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <span class="hide-menu">HomePage</span>
                    </a>
                </li>
                <li class="sidebar-item pt-2">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/home" aria-expanded="false">
                        <i class="far fa-clock" aria-hidden="true"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item pt-2">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('profile')}}" aria-expanded="false">
                        <i class="far fa-user" aria-hidden="true"></i>
                        <span class="hide-menu">Profile</span>
                    </a>
                </li>
                @if(auth()->user()->type=="Admin")
                <li class="sidebar-item pt-2">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('site_setting')}}" aria-expanded="false">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                        <span class="hide-menu">Site Settings</span>
                    </a>
                </li>
                <li class="sidebar-item pt-2">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('category')}}" aria-expanded="false">
                        <i class="fa fa-book" aria-hidden="true"></i>
                        <span class="hide-menu">Categories</span>
                    </a>
                </li>
                <li class="sidebar-item pt-2">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('add-product')}}" aria-expanded="false">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <span class="hide-menu">Products</span>
                    </a>
                </li>
                <li class="sidebar-item pt-2">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('allproducts')}}" aria-expanded="false">
                        <i class="fa fa-window-restore" aria-hidden="true"></i>
                        <span class="hide-menu">All Products</span>
                    </a>
                </li>
                @endif
                <li class="sidebar-item pt-2">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" style="border:none;background:none"> <i class="fa fa-arrow-right" aria-hidden="true"></i><span class="hide-menu"><strong>log out</strong></span> </button>
                        </form>
                    </a>

                </li>
            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>