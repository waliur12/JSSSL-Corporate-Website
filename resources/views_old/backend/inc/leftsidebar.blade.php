<aside id="ms-side-nav" class="side-nav fixed ms-aside-scrollable ms-aside-left">
    <style>
    .active_leftbar {
        color: #ff0018;
        border-left: 3px solid red;
        padding: 9px 21px;
    }
    </style>
    <!-- Logo -->
    <div class="logo-sn ms-d-block-lg">
        <a class="pl-0 ml-0 text-center" href="{{url('/')}}">
            <img src="{{asset('assets/img/logo.png')}}" alt="logo">
        </a>
    </div>
    <ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">

        <li class="menu-item">
            <a href="{{url('admin/dashboard')}}" class="{{url()->current() == url('/admin') ? 'active' : ''}}"><span><i class="material-icons fs-16">dashboard</i>Dashboard </span></a>
        </li>
        <li class="menu-item">
            <a href="{{route('hero.section')}}"><span><i class="fas fa-users-cog"></i>Hero Section
                </span></a>
        </li>
        <li class="menu-item">
            <a href="#" class="has-chevron" data-toggle="collapse" data-target="#invoice" aria-expanded="false"
               aria-controls="invoice"> <span><i class="fas fa-file-invoice fs-16"></i>About Us</span>
            </a>
            <ul id="invoice" class="collapse" aria-labelledby="invoice" data-parent="#side-nav-accordion">
                <li><a href="{{url('/admin/founder-speech')}}"><i class="fa fa-arrow-right"></i> Founder Speech</a></li>
                <li><a href="{{url('/admin/board-members')}}"><i class="fa fa-arrow-right"></i>  Board Member</a></li>
               
                <li><a href="{{url('/admin/terms-policies')}}"><i class="fa fa-arrow-right"></i> Terms Policies</a></li>
                <li><a href="{{url('/admin/ethical-codes')}}"><i class="fa fa-arrow-right"></i> Ethical Codes</a></li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="#" class="has-chevron" data-toggle="collapse" data-target="#invoice3" aria-expanded="false"
               aria-controls="invoice3"> <span><i class="flaticon-layers"></i> Services </span>
            </a>
            <ul id="invoice3" class="collapse" aria-labelledby="invoice3" data-parent="#side-nav-accordion">
                <li><a href="{{url('/admin/all-services')}}"><i class="fa fa-arrow-right"></i> All Services</a></li>
                   <li><a href="{{url('/admin/sub-services-list')}}"><i class="fa fa-arrow-right"></i>Sub Services</a></li>

            </ul>
        </li>
  
        {{-- <li class="menu_item">
            <a href="{{url('admin/social-media')}}">
                <span class="{{url()->current() == url('/admin/social-media') ? 'active_leftbar' : ''}}"><i class=" material-icons">ac_unit</i> Social Media</span>
            </a>
        </li> --}}
        <li class="menu-item">
            <a href="#" class="has-chevron" data-toggle="collapse" data-target="#product" aria-expanded="false"
               aria-controls="product"> <span><i class="far fa-user-circle"></i>Clients</span>
            </a>
            <ul id="product" class="collapse" aria-labelledby="product" data-parent="#side-nav-accordion">
                <li><a href="{{url('/admin/client-categories')}}"><i class="fa fa-arrow-right"></i> Client Categories</a></li>
                <li><a href="{{url('/admin/clients')}}"><i class="fa fa-arrow-right"></i> Client</a></li>
            </ul>
        </li>



        <li class="menu-item">
            <a href="#" class="has-chevron job" data-toggle="collapse" data-target="#invoice5" aria-expanded="false"
               aria-controls="invoice5"> <span><i class="fas fa-file-invoice fs-16"></i>Career</span>
            </a>
            <ul id="invoice5" class="collapse job_collapse" aria-labelledby="invoice5" data-parent="#side-nav-accordion">
                <li ><a href="{{url('/admin/jobs')}}"  class="job"><i class="fa fa-arrow-right"></i>  Jobs</a></li>
                <li><a href="{{url('/admin/applications')}}"><i class="fa fa-arrow-right"></i> Applicants</a></li>
            </ul>
        </li>
        

        
        <li class="menu-item">
            <a href="#" class="has-chevron" data-toggle="collapse" data-target="#customer" aria-expanded="false"
               aria-controls="customer"> <span><i class="fa fa-calendar" aria-hidden="true"></i> News & Events </span>
            </a>
            <ul id="customer" class="collapse" aria-labelledby="customer" data-parent="#side-nav-accordion">
                <li><a href="{{url('/admin/news')}}"><i class="fa fa-arrow-right"></i> News</a></li>
                <li><a href="{{url('/admin/events')}}"><i class="fa fa-arrow-right"></i> Events</a>
                </li>
            </ul>
        </li>


         <li class="menu-item">
            <a href="#" class="has-chevron" data-toggle="collapse" data-target="#invoice2" aria-expanded="false"
               aria-controls="invoice2"> <span><i class="fa fa-envelope" aria-hidden="true"></i>Contacts </span>
            </a>
            <ul id="invoice2" class="collapse" aria-labelledby="invoice2" data-parent="#side-nav-accordion">
                <li><a href="{{url('/admin/messages')}}"><i class="fa fa-arrow-right"></i>Messages</a></li>
                <li><a href="{{url('/admin/offices')}}"><i class="fa fa-arrow-right"></i>Offices</a></li>
                <li><a href="{{url('/admin/main-office')}}"><i class="fa fa-arrow-right"></i>Main Office</a></li>
            </ul>
        </li>


        <li class="menu-item">
            <a href="{{url('admin/social-media')}}" class="{{url()->current() == url('/admin/social-media') ? 'active' : ''}}"><span><i class=" material-icons">ac_unit</i>Social Media </span></a>
        </li>
        <li class="menu-item">
            <a href="{{route('usermanage.view')}}"><span><i class="fas fa-users-cog"></i>User Mangement
                </span></a>
        </li>
    </ul>
</aside>
