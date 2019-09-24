@php
if (Session::has('locale')) {
if(Session::get('locale') == 'ar') {
$locale = 'rtl';
$right_content ='right_content';
}else {
$locale = 'ltl';
$right_content ='';
}
}else {
$locale = 'ltl';
$right_content ='';
}
@endphp

<!DOCTYPE html>
<html lang="en" dir="{{$locale}}" class="{{$right_content}}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Digital survey | Administrator</title>

    <script src="{{asset('admin_css/assets/gentelella/vendors/jquery/dist/jquery.min.js')}}"></script>
    {{-- <script src="{{asset('assets/js/vendor/jquery-3.3.1.min.js')}}"></script> --}}
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{asset('admin_css/assets/gentelella/vendors/jquery/dist/loader.js')}}"></script>
    <script src="{{asset('admin_css/assets/js/pie_chart/zingchart.min.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    {{-- <link href="{{asset('admin_css/assets/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css')}}"
    rel="stylesheet"> --}}
    <!-- Custom Theme Style -->
    {{-- <link href="{{asset('admin_css/assets/gentelella/build/css/custom.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_css/assets/gentelella/build/css/custom_lang.css')}}" rel="stylesheet">
    <link href="{{asset('css/jquery.timepicker.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-multiselect.css')}}">
    <!-- for multisect in add new trigger --> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script> --}}

    <link rel="stylesheet" href="{{asset('emoji/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('emoji/css/animate.css')}}">
    <!-- new latest css -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    @yield('before-css')
    {{-- theme css --}}
    <link id="gull-theme" rel="stylesheet" href="{{mix('assets/styles/css/themes/lite-purple.min.css')}}">
    <!--<link rel="stylesheet" href="{{asset('assets/styles/vendor/perfect-scrollbar.css')}}">-->
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-colorpicker.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-multiselect.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">
    {{-- page specific css --}}
    @yield('page-css')
    <!-- end latest css -->
    @yield('header_styles')
</head>
<?php 
    $user = Auth::user();
    $role = $user->user_role;
    $id = Auth::user()->id;
    $permission_data = CommonHelper::getUserPermissionData();
    $category = DB::table('tbl_categories')->get();
    $group = DB::table('tbl_groups')->get();
    $type = DB::table('tbl_types')->get();
    $quick_show = DB::table('tbl_quick_add_setting')->where('id', 1)->first();
    $country = DB::table('countries')->get();
?>

<body class="text-left">
    @php
    $layout = session('layout');
    @endphp

    <!-- ============ Large SIdebar Layout start ============= -->
    <div class="app-admin-wrap layout-sidebar-large clearfix">
        @include('layouts.header-menu')

        {{-- end of header menu --}}
        @if(empty($menu_type))
        @include('layout.menu')
        @else
        @include('layout.admin_menu')
        @endif
        {{-- end of left sidebar --}}

        <!-- ============ Body content start ============= -->
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                @yield('inner_body')
            </div>
            @include('layouts.footer')
        </div>
        <!-- ============ Body content End ============= -->
    </div>
    <!--=============== End app-admin-wrap ================-->
    <!-- jQuery -->


    <!-- latest js -->

    {{-- common js --}}


    {{-- <script src="{{asset('assets/js/vendor/bootstrap.bundle.min.js')}}"></script> --}}
    <script src="{{asset('assets/js/vendor/perfect-scrollbar.min.js')}}"></script>
    <script src="{{mix('assets/js/common-bundle-script.js')}}"></script>
    @yield('page-js')
    <script src="{{asset('assets/js/es5/script.min.js')}}"></script>
    <script src="{{asset('assets/js/es5/sidebar.large.script.min.js')}}"></script>
    <script src="{{asset('assets/js/es5/customizer.script.min.js')}}"></script>

    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/es5/datatables.script.js')}}"></script>
    <script src="{{asset('admin_css/assets/gentelella/vendors/bootbox/bootbox.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert.script.js')}}"></script>

    @yield('bottom-js')


    <!-- end latest js -->
    <!-- Bootstrap -->
    {{-- <script src="{{asset('admin_css/assets/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    --}}
    <!-- FastClick -->
    <script src="{{asset('admin_css/assets/gentelella/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <!-- Chart.js -->
    <script src="{{asset('admin_css/assets/gentelella/vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- jQuery Sparklines -->
    <script src="{{asset('admin_css/assets/gentelella/vendors/jquery-sparkline/dist/jquery.sparkline.min.js')}}">
    </script>
    <!-- Flot -->
    <script src="{{asset('admin_css/assets/gentelella/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('admin_css/assets/gentelella/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('admin_css/assets/gentelella/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('admin_css/assets/gentelella/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('admin_css/assets/gentelella/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{asset('admin_css/assets/gentelella/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{asset('admin_css/assets/gentelella/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('admin_css/assets/gentelella/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{asset('admin_css/assets/gentelella/vendors/DateJS/build/date.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    {{-- <script src="{{asset('admin_css/assets/gentelella/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('admin_css/assets/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js')}}">
    </script> --}}
    <!-- Custom Theme Scripts -->
    <script src="{{asset('admin_css/assets/gentelella/build/js/custom.js')}}"></script>
    <script src="{{asset('admin_css/assets/front/js/jquery.polyglot.language.switcher.js')}}"></script>
    <script src="{{asset('js/jquery.timepicker.min.js')}}"></script>
    <!--        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>-->
    <!-- <script src="{{asset('admin_css/assets/js/typeahead.bundle.js')}}"></script> -->

    <!-- Bootstrap Tags Input Plugin Js -->

    <!-- <script src="{{asset('admin_css/assets/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script> -->

    <!-- Bootstrap Tags Input type head Js -->
    <script src="{{asset('admin_css/assets/chosen.jquery.min.js')}}"></script>
    <link href="{{asset('admin_css/assets/chosen.css')}}" rel="stylesheet">
    <link href="{{asset('admin_css/assets/js/bootstrap-select.css')}}" rel="stylesheet">

    <!--<script type="text/javascript" src="jquery.polyglot.language.switcher.js"></script>-->
    {{-- this script is for charts --}}
    <script src="{{asset('assets/js/vendor/echarts.min.js')}}"></script>
    <script src="{{asset('assets/js/es5/echart.options.min.js')}}"></script>
    <script src="{{asset('assets/js/es5/echarts.script.min.js')}}"></script>
    {{-- end chart script --}}
    {{-- custom js --}}
    <script src="{{asset('admin_css/assets/gentelella/build/js/custom.js')}}"></script>
    {{-- end here --}}
    {{-- multiselect js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js">
    </script>
    {{-- end --}}
    @if(empty($menu_type))
    <script type="text/javascript">
        $(document).ready(function () {
                $("form").on('submit', function (e) {
                    e.preventDefault();
                    var msg = "Loading...";
                    $(".api_response textarea").val(msg);
                    var formData = new FormData(this);
                    $.ajax({
                        url: $('form').attr('action'),
                        type: $('form').attr('method'),
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (res) {
                            var obj = JSON.parse(res);
                            var pretty = JSON.stringify(obj, undefined, 4);
                            setTimeout(function () {
                                $(".api_response textarea").val(pretty);
                            }, 1000);
                        },
                        error: function (res) {

                        }
                    });
                });
                var ugly = $(".api_response textarea").val();
                var obj = JSON.parse(ugly);
                var pretty = JSON.stringify(obj, undefined, 4);
                $(".api_response textarea").val(pretty);
            });
    </script>
    @endif
    @yield('footer_scripts')
    <div class="modal" role="dialog" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="alert alert-danger" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title">{{__('message.add')}} {{__('message.participant')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="form" action="{{ url('admin/Quick_Add_Participant')}} ">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <div class="form-row">
                            @if( isset($quick_show) && $quick_show->first_name == 1)
                            <div class="form-group col-md-6">
                                <label class="ul-form__label">{{__('message.first_name')}}</label>
                                <input type="text" name="first_name" class="form-control" id="name">
                            </div>
                            @endif
                            @if( isset($quick_show) && $quick_show->last_name == 1)
                            <div class="form-group col-md-6">
                                <label class="ul-form__label">{{__('message.last_name')}}</label>
                                <input type="text" name="last_name" class="form-control" id="name">
                            </div>
                            @endif
                            @if( isset($quick_show) && $quick_show->email == 1)
                            <div class="form-group col-md-6">
                                <label class="ul-form__label">{{__('message.e-mail')}}</label>
                                <input type="text" name="email" class="form-control" id="email">
                            </div>
                            @endif
                            @if( isset($quick_show) && $quick_show->location == 1 && $quick_show->mobile == 1)
                            <div class="form-group col-md-6">
                                <label class="ul-form__label">{{__('message.location')}}</label>
                                <div class="input-right-icon">
                                    <select class="select2_group form-control" id="location_id" name="location_id">
                                        <option value="0">{{__('message.add')}} {{__('message.location')}}</option>
                                        @foreach ($country as $row)
                                        <?php
                                            $selected = '';
                                                if ($row->id == 191)
                                                    $selected = 'selected';
                                            ?>
                                        <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="span-right-input-icon">
                                        <i class="ul-form__icon i-Arrow-Down"></i>
                                    </span>
                                </div>
                            </div>
                            @endif
                            @if( isset($quick_show) && $quick_show->mobile == 1 && $quick_show->location == 1)
                            <div class="form-group col-md-6">
                                <label class="ul-form__label">{{__('message.mobile')}}</label>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <input type="text" readonly="readonly" class="form-control" name="dialing_code"
                                            id="dialing_code">
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" name="mobile" class="form-control">
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if( isset($quick_show) && $quick_show->dob == 1)
                            <div class="form-group col-md-6">
                                <label class="ul-form__label">{{__('message.date_of_birth')}}</label>
                                <div class="input-right-icon">
                                    <input type="text" id="single_cal4" readonly="readonly" name="dob"
                                        class="form-control"
                                        value="{{!empty($repairman_data->dob)?$repairman_data->dob:Input::old('dob')}}"
                                        placeholder="YYYY-mm-dd">
                                    <span class="span-right-input-icon">
                                        <i class="ul-form__icon i-Calendar-4"></i>
                                    </span>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                            $('.datepicker').datepicker({
                                                locale: {
                                                    format: 'YYYY-MM-DD'
                                                },
                                                changeMonth: true,
                                                changeYear: true,
                                                singleDatePicker: true,
                                                singleClasses: "picker_4"
                                            }, function (start, end, label) {
                                                console.log(start.toISOString(), end.toISOString(), label);
                                            });
                                        });    
                            </script>
                            @endif
                            @if( isset($quick_show) && $quick_show->gender == 1)
                            <div class="form-group col-md-6">
                                <label class="ul-form__label">{{__('message.gender')}}</label>
                                <div class="input-right-icon">
                                    <select class="form-control" name="gender">
                                        <option value="1">{{__('message.male')}}</option>
                                        <option value="2">{{__('message.female')}}</option>
                                    </select>
                                    <span class="span-right-input-icon">
                                        <i class="ul-form__icon i-Arrow-Down"></i>
                                    </span>
                                </div>
                            </div>
                            @endif
                            @if( isset($quick_show) && $quick_show->category == 1)
                            <div class="form-group col-md-6">
                                <label class="ul-form__label">{{__('message.category')}}</label>
                                <div class="input-right-icon">
                                    <select class="select2_group form-control" id="category_id" name="category_id">
                                        <option value="0">{{__('message.select')}} {{__('message.category')}}</option>
                                        @foreach ($category as $row)
                                        <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->category_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="span-right-input-icon">
                                        <i class="ul-form__icon i-Arrow-Down"></i>
                                    </span>
                                </div>
                            </div>
                            @endif
                            @if( isset($quick_show) && $quick_show->sub_category == 1)
                            <div class="form-group col-md-6">
                                <label class="ul-form__label">{{__('message.sub_category')}}</label>
                                <div class="input-right-icon">
                                    <select class="select2_group form-control" id="sub_category_id"
                                        name="sub_category_id">
                                        <option value="0">{{__('message.select')}} {{__('message.sub_category')}}
                                        </option>
                                    </select>
                                    <span class="span-right-input-icon">
                                        <i class="ul-form__icon i-Arrow-Down"></i>
                                    </span>
                                </div>
                            </div>
                            @endif
                            @if( isset($quick_show) && $quick_show->group == 1)
                            <div class="form-group col-md-6">
                                <label class="ul-form__label">{{__('message.group')}}</label>
                                <div class="input-right-icon">
                                    <select class="select2_group form-control" id="group_id" name="group_id">
                                        <option value="0">{{__('message.select')}} {{__('message.group')}}</option>
                                        @foreach ($group as $row)
                                        <option value="{{ $row->id }}">{{$row->group_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="span-right-input-icon">
                                        <i class="ul-form__icon i-Arrow-Down"></i>
                                    </span>
                                </div>
                            </div>
                            @endif
                            @if( isset($quick_show) && $quick_show->type == 1)
                            <div class="form-group col-md-12">
                                <label class="ul-form__label">{{__('message.type')}}</label>
                                <div class="input-right-icon">
                                    <select class="select2_group form-control" id="type_id" name="type_id">
                                        <option value="">{{__('message.select')}} {{__('message.type')}}</option>
                                        @foreach ($type as $row)
                                        <option value="{{ $row->id }}">{{$row->type_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="span-right-input-icon">
                                        <i class="ul-form__icon i-Arrow-Down"></i>
                                    </span>
                                </div>
                            </div>
                            @endif
                            @if( isset($quick_show) && $quick_show->comment == 1)
                            <div class="form-group col-md-12">
                                <label class="ul-form__label">{{__('message.comment')}}</label>
                                <textarea name="comment" class="form-control" placeholder="Comment"></textarea>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" value="" class="btn btn-secondary"
                            data-dismiss="modal">{{__('message.close')}}</button>
                        <button type="submit" class="btn btn-success ml-2">{{__('message.submit')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#form").validate({
                rules: {
                    mobile: {
                        required : true,
                    },
                },
                highlight: function(mobile) {
                    $(mobile).css('background', '#ffdddd');
                },
            });
        });
    </script>
    <script type="text/javascript">
        $('#dialing_code').val(966)
            $(document).on('change','#location_id',function(){ 
            
            var location_id = $(this).val();
                $.ajax({
                    url  : '{{route('get_country_code')}}',
                    type : 'GET',
                    data : {location_id:location_id,_token: $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    success: function(resp){
                        if(resp){
                            $('#dialing_code').val(resp)
                        } 
                    },
                    error: function(resp){

                    }
            });
        });
    </script>
    <link href="{{asset('admin_css/assets/gentelella/build/css/jquery-ui.css')}}" rel="stylesheet">
    <script src="{{asset('admin_css/assets/gentelella/build/js/jquery-ui.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            $('#category_id').change(function(){
                var me = this;
                var url = '';
                var categoryId = $(this).find(':selected').val();
                $.ajax({
                    url  : url,
                    type : 'GET',
                    data : {category_id:categoryId},
                    dataType: 'json',
                    success: function(resp){
                        if(resp.data.length==0){
                            return false;
                        }
                        $('#sub_category_id').html('');
                        selectedSubCategory = '<?php echo !empty(Input::old('sub_category_id'))?Input::old('sub_category_id'):((!empty($repairman_data->sub_category_id)?$repairman_data->sub_category_id:0)) ?>';
                        $.each(resp.data, function (index, value) {
                            var obj = { 
                                value: value.id,
                                text : value.category_name,
                            };

                            if(selectedSubCategory==value.id){
                                obj.selected = 'selected';
                            }

                            $('#sub_category_id').append($('<option/>',obj));
                        });  
                    },
                    error: function(resp){

                    }
                });
            });

            var currentDate = new Date();
            var year = currentDate.getFullYear();
            $( "#datepicker" ).datepicker({
                dateFormat:'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: '1857:'+year
            });

            $('#quick_add_participant').on('click',function(){
                
            });
        });
    </script>
    <script>
        $(document).ready(function(){            
            $('#single_cal4').datepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                changeMonth: true,
                changeYear: true,
                singleDatePicker: true,
                singleClasses: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            $('#single_cal5').datepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                changeMonth: true,
                changeYear: true,
                singleDatePicker: true,
                singleClasses: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
        })
    </script>
    <style>
        .multiselect-container>li>a>label {
            padding: 10px 20px 9px 20px;
        }

        .multiselect-container>li>a .checkbox input {
            position: relative;
            opacity: 1;
            cursor: pointer;
            height: auto;
            width: auto;
            margin-top: 3px;
            float: left;
            margin-right: 8px;
        }
    </style>
</body>

</html>