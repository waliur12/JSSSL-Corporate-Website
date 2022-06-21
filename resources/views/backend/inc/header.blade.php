<nav class="navbar ms-navbar">
    <div class="ms-aside-toggler ms-toggler pl-0" data-target="#ms-side-nav" data-toggle="slideLeft"><span
            class="ms-toggler-bar bg-primary"></span>
        <span class="ms-toggler-bar bg-primary"></span>
        <span class="ms-toggler-bar bg-primary"></span>
    </div>
    <h4 style="font-size: 17px;opacity:.6;">@yield('title','JSSSL-Dashboard')</h4>
    <div class="logo-sn logo-sm ms-d-block-sm">
        <a class="pl-0 ml-0 text-center navbar-brand mr-0" href="../../index.html">
            <img src="https://via.placeholder.com/84x41" alt="logo">
        </a>
    </div>
    <ul class="ms-nav-list ms-inline mb-0" id="ms-nav-options">

        <li class="ms-nav-item ms-nav-user dropdown">
            <a href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="ms-user-img ms-img-round float-right" style="height: 40px;width:40px;" src="{{asset(Auth::user()->image)}}"
                     alt="User">
            </a>
            <ul class="dropdown-menu dropdown-menu-right user-dropdown" aria-labelledby="userDropdown">
                <li class="dropdown-menu-header text-center">
                    <h6 class="dropdown-header ms-inline m-0"><span
                            class="text-disabled">Welcome, {{Auth::user()->name}}</span></h6>
                </li>
                <li class="dropdown-divider"></li>


                <li class="dropdown-divider"></li>
                <li class="dropdown-menu-footer">
                    <a class="media fs-14 p-2" href="{{url('admin/profile')}}"> <span><i
                                class="flaticon-user mr-2"></i> Profile</span>
                    </a>
                </li>
                <li class="dropdown-menu-footer">
                    <a class="media fs-14 p-2" href="{{url('admin/settings')}}"> <span><i
                                class="flaticon-gear mr-2"></i> Change Password</span>
                    </a>
                </li>
                <li class="dropdown-menu-footer">
                    <a class="dropdown-item media fs-14 p-2" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <span><i class="flaticon-shut-down mr-2"></i> {{ __('Logout') }}</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>


                </li>
            </ul>
        </li>
    </ul>
    <div class="ms-toggler ms-d-block-sm pr-0 ms-nav-toggler" data-toggle="slideDown" data-target="#ms-nav-options">
        <span class="ms-toggler-bar bg-primary"></span>
        <span class="ms-toggler-bar bg-primary"></span>
        <span class="ms-toggler-bar bg-primary"></span>
    </div>
</nav>
