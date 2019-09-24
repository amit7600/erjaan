
    <div class="side-content-wrap">
        <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
            <ul class="navigation-left">
                <li class="nav-item active" data-item="dashboard">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Bar-Chart"></i>
                        <span class="nav-text">Authentication Process</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item " data-item="user">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Library"></i>
                        <span class="nav-text">User</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-item-hold" href="{{route('view_api','view_plan_form')}}">
                        <i class="nav-icon i-Suitcase"></i>
                        <span class="nav-text">Plan List</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item" data-item="familymember">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Computer-Secure"></i>
                        <span class="nav-text">Family Member</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                <li class="nav-item" data-item="trainer">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-File-Clipboard-File--Text"></i>
                        <span class="nav-text">Trainer</span>
                    </a>
                    <div class="triangle"></div>
                </li>
            </ul>
        </div>
    
        <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
            <!-- Submenu Dashboards -->
            <ul class="childNav" data-parent="dashboard">
                <li class="nav-item ">
                    <a href="{{route('view_api','login')}}">
                        <i class="nav-icon i-Clock-3"></i>
                        <span class="item-name">Login</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('view_api','signup')}}">
                        <i class="nav-icon i-Clock-4"></i>
                        <span class="item-name">Registration</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('view_api','forget_password')}}">
                        <i class="nav-icon i-Over-Time"></i>
                        <span class="item-name">Forgot Password</span>
                    </a>
                </li>
            </ul>
            <ul class="childNav" data-parent="user">
                <li class="nav-item">
                    <a href="{{route('view_api','user-profile')}}">
                        <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                        <span class="item-name">User Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('view_api','user-update')}}">
                        <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                        <span class="item-name">User Update</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('view_api','get-near-by-partner')}}">
                        <i class="nav-icon i-Split-Vertical"></i>
                        <span class="item-name">Near By Partner(Trainee List)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('view_api','upload-gallery-image')}}">
                        <i class="nav-icon i-Split-Vertical"></i>
                        <span class="item-name">Upload Gallery Images</span>
                    </a>
                </li>
    
                <li class="nav-item">
                    <a href="{{route('view_api','delete-gallery-image')}}">
                        <i class="nav-icon i-Receipt-4"></i>
                        <span class="item-name">Delete Gallery Image</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('view_api','activity-list')}}">
                        <i class="nav-icon i-Close-Window"></i>
                        <span class="item-name">Activity List</span>
                    </a>
                </li>
            </ul>
            <ul class="childNav" data-parent="familymember">
                <li class="nav-item">
                    <a href="{{route('view_api','add-family-member')}}">
                        <i class="nav-icon i-Receipt-4"></i>
                        <span class="item-name">Add Family Member</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('view_api','view-family-member')}}">
                        <i class="nav-icon i-Receipt-4"></i>
                        <span class="item-name">View Family Member</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('view_api','delete-family-member')}}">
                        <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                        <span class="item-name">Delete Family member</span>
                    </a>
                </li>
                    <li class="nav-item">
                    <a href="{{route('view_api','update-family-member')}}">
                        <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                        <span class="item-name">Update Family member</span>
                    </a>
                </li>
            </ul>
    
            <ul class="childNav" data-parent="trainer">
                <li class="nav-item">
                    <a href="{{route('view_api','get-near-by-trainers')}}">
                        <i class="nav-icon i-Add-File"></i>
                        <span class="item-name">Near By Trainers</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidebar-overlay"></div>
    </div>
    <!--=============== Left side End ================-->
    