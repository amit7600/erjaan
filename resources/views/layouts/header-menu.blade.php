<div class="main-header">
    <div class="logo">
        <?php
        $quick_button = DB::table('tbl_quick_add_setting')->first();

        $flag = Session::has('locale') ?  Session::get('locale').'.png' : 'en.png';

        $image_logo = Auth::user()->user_logo;
        $image_logo = !empty($image_logo) ? $image_logo : "";
        if (!file_exists($image_logo)) {
            $image_logo = "uploads/logo.png";
        }
        $image_logo = url('/') . '/' . $image_logo;
        ?>
        <a href="{{route('admin')}}" class="site_title">
            <span>
                <img src="{{ $image_logo }}">
            </span>
        </a>
    </div>

    <div class="menu-toggle">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div style="margin: auto"></div>

    <div class="header-part-right">
        <!-- Full screen toggle -->
        <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>
        {{-- RTL Spinner Start--}}
        <div class="dropdown">
            <div class="badge-top-container" id="dropdownNotification" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span><img class="flags" src='{{url("img/flags/$flag")}}'></span>
            </div>

            <!-- Notification dropdown -->
            <div class="dropdown-menu rtl-ps-none dropdown-menu-right" aria-labelledby="dropdownNotification"
                data-perfect-scrollbar data-suppress-scroll-x="true">

                <a class="dropdown-item" href="{{URL::to('locale/en')}}">
                    <img src="{{url('img/flags/en.png')}}" class="img"> {{__('message.english')}} </a>
                <a class="dropdown-item arabic" href="{{URL::to('locale/ar')}}">
                    <img src="{{url('img/flags/ar.png')}}" class="img"> {{__('message.arabic')}} </a>
            </div>
        </div>
        {{-- RTL Spinner End--}}
        @if ( $role == 0 || isset($quick_button) && $quick_button->quick_add_button == 1)
        @if($role == 0 || $permission_data->quick_add_participants_button == 1)
        <button class="btn btn-primary btn-icon m-1" id="quick_add_participant" data-toggle="modal"
            data-target="#myModal">
            <span class="ul-btn__icon"><i class="i-Gear-2"></i></span>
            <span class="ul-btn__text">{{__('message.quick_add_participant')}}</span>
        </button>
        @endif
        @endif
        <!-- User avatar dropdown -->
        @if(!empty($menu_type))
        <div class="dropdown">
            <div class="user col align-self-end">
                <?php
                    $image = Auth::user('user_image');
                    $image = !empty($image->user_image) ? $image->user_image : "";
                    if (!file_exists($image)) {
                        $image = "uploads/user_image.jpg";
                    }
                    $image = url('/') . '/' . $image;
                    ?>

                <img src="{{$image}}" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-header">
                        <i class="i-Lock-User mr-1"></i> {{ Auth::user()->name }}
                    </div>
                    <a class="dropdown-item" href="{{route('get_admin_profile')}}">{{__('message.profile')}}</a>
                    <a class="dropdown-item" href="{{route('logout')}}">{{__('message.logout')}}</a>
                </div>
            </div>
        </div>
        @endif


    </div>

</div>
<!-- header top menu end -->
<style>
    .changeCursor span.span-right-input-icon {
        left: 10px;
        right: auto;
    }

    .changeCursor .emotion-Icon {
        right: 0px;
    }
</style>