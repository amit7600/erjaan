@if($role == 0 || isset($permission_data) &&
$permission_data->feedback_terminal_responses_1 == 1)
<div class="col-md-12">
    <div class="breadcrumb">
        <h1>{{__('message.feedback_responses_dashbord_1')}}</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white mb-4">
                <i class="i-Check text-40 mr-5"></i>
                <div class="content">
                    <h4 class="text-18 mb-1 text-white">{{__('message.today')}}</h4>
                    <span class="text-30 line-height-1 mb-2">{{ $feedback_today }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white mb-4">
                <i class="i-Calendar-4 text-40 mr-5"></i>
                <div class="content">
                    <h4 class="text-18 mb-1 text-white">{{__('message.weekly')}}</h4>
                    <span class="text-30 line-height-1 mb-2">{{ $feedback_weekly }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white mb-4">
                <i class="i-Calendar-2 text-40 mr-5"></i>
                <div class="content">
                    <h4 class="text-18 mb-1 text-white">{{__('message.month')}}</h4>
                    <span class="text-30 line-height-1 mb-2">{{ $feedback_month }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white mb-4">
                <i class="i-Calendar text-40 mr-5"></i>
                <div class="content">
                    <h4 class="text-18 mb-1 text-white">{{__('message.year')}}</h4>
                    <span class="text-30 line-height-1 mb-2">{{ $feedback_year }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if($role == 0 || isset($permission_data) &&
$permission_data->feedback_terminal_responses_2 == 1)
<div class="col-md-12">
    <div class="breadcrumb">
        <h1>{{__('message.feedback_responses_dashbord_2')}}</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white mb-4">
                <i class="i-Check text-40 mr-5"></i>
                <div class="content">
                    <h4 class="text-18 mb-1 text-white">{{__('message.today')}}</h4>
                    <span class="text-30 line-height-1 mb-2">{{ $feedback_today2 }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white mb-4">
                <i class="i-Calendar-4 text-40 mr-5"></i>
                <div class="content">
                    <h4 class="text-18 mb-1 text-white">{{__('message.weekly')}}</h4>
                    <span class="text-30 line-height-1 mb-2">{{ $feedback_weekly2}}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white mb-4">
                <i class="i-Calendar-2 text-40 mr-5"></i>
                <div class="content">
                    <h4 class="text-18 mb-1 text-white">{{__('message.month')}}</h4>
                    <span class="text-30 line-height-1 mb-2">{{ $feedback_month2 }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white mb-4">
                <i class="i-Calendar text-40 mr-5"></i>
                <div class="content">
                    <h4 class="text-18 mb-1 text-white">{{__('message.year')}}</h4>
                    <span class="text-30 line-height-1 mb-2">{{ $feedback_year2 }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if($role == 0 || isset($permission_data) &&
$permission_data->feedback_terminal_responses_3 == 1)
<div class="col-md-12">
    <div class="breadcrumb">
        <h1>{{__('message.feedback_responses_dashbord_3')}}</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white mb-4">
                <i class="i-Check text-40 mr-5"></i>
                <div class="content">
                    <h4 class="text-18 mb-1 text-white">{{__('message.today')}}</h4>
                    <span class="text-30 line-height-1 mb-2">{{ $feedback_today3 }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white mb-4">
                <i class="i-Calendar-4 text-40 mr-5"></i>
                <div class="content">
                    <h4 class="text-18 mb-1 text-white">{{__('message.weekly')}}</h4>
                    <span class="text-30 line-height-1 mb-2">{{ $feedback_weekly3}}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white mb-4">
                <i class="i-Calendar-2 text-40 mr-5"></i>
                <div class="content">
                    <h4 class="text-18 mb-1 text-white">{{__('message.month')}}</h4>
                    <span class="text-30 line-height-1 mb-2">{{ $feedback_month3 }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white mb-4">
                <i class="i-Calendar text-40 mr-5"></i>
                <div class="content">
                    <h4 class="text-18 mb-1 text-white">{{__('message.year')}}</h4>
                    <span class="text-30 line-height-1 mb-2">{{ $feedback_year3 }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if($role == 0 || isset($permission_data) &&
$permission_data->feedback_terminal_responses_4 == 1)
<div class="col-md-12">
    <div class="breadcrumb">
        <h1>{{__('message.feedback_responses_dashbord_4')}}</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white mb-4">
                <i class="i-Check text-40 mr-5"></i>
                <div class="content">
                    <h4 class="text-18 mb-1 text-white">{{__('message.today')}}</h4>
                    <span class="text-30 line-height-1 mb-2">{{ $feedback_today4 }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white mb-4">
                <i class="i-Calendar-4 text-40 mr-5"></i>
                <div class="content">
                    <h4 class="text-18 mb-1 text-white">{{__('message.weekly')}}</h4>
                    <span class="text-30 line-height-1 mb-2">{{ $feedback_weekly4}}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white mb-4">
                <i class="i-Calendar-2 text-40 mr-5"></i>
                <div class="content">
                    <h4 class="text-18 mb-1 text-white">{{__('message.month')}}</h4>
                    <span class="text-30 line-height-1 mb-2">{{ $feedback_month4 }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white mb-4">
                <i class="i-Calendar text-40 mr-5"></i>
                <div class="content">
                    <h4 class="text-18 mb-1 text-white">{{__('message.year')}}</h4>
                    <span class="text-30 line-height-1 mb-2">{{ $feedback_year4 }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if($role == 0 || isset($permission_data) &&
$permission_data->feedback_terminal_responses_5 == 1)
<div class="col-md-12">
    <div class="breadcrumb">
        <h1>{{__('message.feedback_responses_dashbord_5')}}</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white mb-4">
                <i class="i-Check text-40 mr-5"></i>
                <div class="content">
                    <h4 class="text-18 mb-1 text-white">{{__('message.today')}}</h4>
                    <span class="text-30 line-height-1 mb-2">{{ $feedback_today5 }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white mb-4">
                <i class="i-Calendar-4 text-40 mr-5"></i>
                <div class="content">
                    <h4 class="text-18 mb-1 text-white">{{__('message.weekly')}}</h4>
                    <span class="text-30 line-height-1 mb-2">{{ $feedback_weekly5}}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white mb-4">
                <i class="i-Calendar-2 text-40 mr-5"></i>
                <div class="content">
                    <h4 class="text-18 mb-1 text-white">{{__('message.month')}}</h4>
                    <span class="text-30 line-height-1 mb-2">{{ $feedback_month5 }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white mb-4">
                <i class="i-Calendar text-40 mr-5"></i>
                <div class="content">
                    <h4 class="text-18 mb-1 text-white">{{__('message.year')}}</h4>
                    <span class="text-30 line-height-1 mb-2">{{ $feedback_year5 }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endif