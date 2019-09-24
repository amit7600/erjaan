<!-- Footer Start -->
@php
$user_name = \Auth::user()->name;
$year = date('Y')
@endphp
<div class="flex-grow-1"></div>
<div class="app-footer">
    <div class="footer-bottom d-flex flex-column flex-sm-row align-items-center">
        <p><strong>{{__('message.welcome')}} {{$user_name}} <a
                    href="javascript:void(0)">{{__('message.by_digital_survey')}}</a></strong></p>
        <span class="flex-grow-1"></span>
        <div class="d-flex align-items-center">
            <?php
                $image_logo = Auth::user()->user_logo;
                $image_logo = !empty($image_logo) ? $image_logo : "";
                if (!file_exists($image_logo)) {
                    $image_logo = "uploads/logo.png";
                }
                $image_logo = url('/') . '/' . $image_logo;
                ?>
            <img class="logo" src="{{ $image_logo }}" alt="">
            <div>
                <p class="m-0">&copy; {{$year}} {{__('message.erjaan_smart_solution')}} </p>
                <p class="m-0"> {{__('message.all_right_reserved')}}</p>
            </div>
        </div>
    </div>
</div>
<!-- fotter end -->