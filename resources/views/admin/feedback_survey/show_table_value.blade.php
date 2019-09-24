@extends('layout.admin')
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')

<style type="text/css">
    #image_on_popup img {
        max-width: 100%;
        max-height: 100%;
    }
</style>
@stop
{{-- Page content --}}
@section('inner_body')

<div class="row">
    <div class="col-lg-12 mb-3">
        @if(count($errors) > 0)
        @foreach ($errors->all() as $error)
        <div class="alert alert-card alert-danger">
            <strong class="text-capitalize">{{$error}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @break
        @endforeach
        @endif

        @if(session()->has('message.level'))
        <div class="alert alert-card alert-{{ session('message.level') }}">
            <strong class="text-capitalize">{!! session('message.content') !!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <form class="form-horizontal form-label-left" action="{{ route('feedbackResponce') }}" method="GET">
            <input type="hidden"
                value="<?php echo!empty($form_data['schedule_id']) ? $form_data['schedule_id'] : ''; ?>"
                id="schedule_id" name="schedule_id">
            <input type="hidden" value="1" name="feedback_id">
            <!-- start SURVEY Form Layout-->
            <div class="card mb-4">
                <div class="card-header bg-transparent">
                    <h3 class="card-title"> {{__('message.step_1_filter_feedback_responses')}}</h3>
                </div>
                <div class="card-body ">

                    <div class="row">

                        <div class="col-sm-3 col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_user')}}
                                    <span class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <select class="select2_group form-control" id="user_id" name="user_id">
                                            <?php $selected = ''; ?>
                                            <option value="">{{__('message.select_user')}}</option>
                                            @foreach($users as $user)
                                            <option value="{{ $user->id}}">{{ $user->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="span-right-input-icon">
                                            <i class="ul-form__icon i-Arrow-Down"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_time_period')}}<span
                                        class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        @php
                                        $time_period_selected = Session::get('time_period') ;
                                        @endphp
                                        {!!
                                        Form::select('time_period',$time_filter,$time_period_selected,['class'=>'form-control','id'=>'time_period','placeholder'=>__('message.select_time_period')])
                                        !!}
                                        <span class="span-right-input-icon">
                                            <i class="ul-form__icon i-Arrow-Down"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="business_name"
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_location')}}<span
                                        class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        @php
                                        $city_name = Session::get('city');
                                        @endphp
                                        {!! Form::select('city', $location, $city_name, ['class' => 'form-control','id'
                                        =>
                                        'location','placeholder' => __('message.select_location')]) !!}
                                        <span class="span-right-input-icon">
                                            <i class="ul-form__icon i-Arrow-Down"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3 col-xs-12 col-md-3" id="created_from" style="display: none">
                            <div class="form-group">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_from')}}<span
                                        class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <input name="created_from" value="<?php echo Session::get('created_from') ?>"
                                            readonly type="text" class="form-control has-feedback-left" id="single_cal5"
                                            placeholder="From Date YYYY-MM-DD" aria-describedby="inputSuccess2Status4">
                                        <span class="fa fa-calendar-o span-right-input-icon form-control-feedback left">
                                            <i class="ul-form__icon i-Calendar-4"></i>
                                        </span>
                                        <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12 col-md-3" id="created_to" style="display: none">
                            <div class="form-group">
                                <label for="staticEmail"
                                    class="ul-form__label col-lg-12 col-md-12 col-sm-12 col-form-label text-left ">{{__('message.select_to')}}<span
                                        class="required">*</span></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p-0">
                                    <div class="input-right-icon">
                                        <input name="created_to" value="<?php echo Session::get('created_to') ?>"
                                            readonly type="text" class="form-control has-feedback-left" id="single_cal4"
                                            placeholder="To Date YYYY-MM-DD" aria-describedby="inputSuccess2Status4">
                                        <span class="fa fa-calendar-o span-right-input-icon form-control-feedback left">
                                            <i class="ul-form__icon i-Calendar-4"></i>
                                        </span>
                                        <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="mc-footer">
                        <div class="row text-right">
                            <div class="col-lg-12 text-center">
                                <button type="button" class="btn btn-success"
                                    id="btn-search">{{__('message.search')}}</button>
                                <button type="submit" class="btn btn-primary ml-4">{{__('message.export')}} </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end survey Form Layout-->
        </form>
        <!-- start survey question option form -->
        <div class="card mb-4 text-left">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    {{-- {{__('message.feedback_answer_list')}} --}}
                    {{-- <a href="{{URL::to('admin/show_table_value/feedbackResponce')}}"
                    class="btn btn-primary float-right mb-4">{{__('message.export')}}</a> --}}
                </h4>
                <div class="table-responsive ">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">{{__('message.Day')}}</th>
                                <th class="text-center">{{__('message.responses')}}</th>
                                <th class="text-center"><i class="i-Happy"
                                        style="font-size: 35px;color: #000;background: #40d941;border-radius: 50px;"></i>
                                </th>
                                <th class="text-center"><i class="i-Smile"
                                        style="font-size: 35px;color: #000;background: #8cd840;border-radius: 50px;"></i>
                                </th>
                                <th class="text-center"><i class="i-Friendster"
                                        style="font-size: 35px;color: #000;background: #ffd504;border-radius: 50px;"></i>
                                </th>
                                <th class="text-center"><i class="i-Depression"
                                        style="font-size: 35px;color: #000;background: #d96742;border-radius: 50px;"></i>
                                </th>
                                <th class="text-center"><i class="i-Crying"
                                        style="font-size: 35px;color: #000;background: #da4241;border-radius: 50px;"></i>
                                </th>
                                {{-- <th class="text-center">{{__('message.happy_index')}}</th> --}}
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- end survey question option form -->
        <!-- end::form 2-->
    </div>
</div>


@stop
{{-- page level scripts --}}
@section('footer_scripts')


<script type="text/javascript">
    var dataTable;
var columns = [
    {data: 'day', name: 'day'},
    {data: 'responses', name: 'responses'},
    {data: 'fantastic', name: 'fantastic'},
    {data: 'good', name: 'good'},
    {data: 'average', name: 'average'},
    {data: 'poor', name: 'poor'},
    {data: 'very_poor', name: 'very poor'},
    // {data: 'created_at', name: 'created_at'},
];

var ajaxUrl = '{!! route('show_table_value') !!}'; //Url of ajax datatable where you fetch data

//It may be empty array
var columnDefs = [
    {
        "targets": 0,
        "orderable": true,
        "class": "text-center",
    },
    {
        "targets": 1,
        "orderable": true,
        "class": "text-center"
    },
    {
        "targets": 2,
        "orderable": true,
        "class": "text-center"
    },
    {
        "targets": 3,
        "orderable": true,
        "class": "text-center"
    },
    {
        "targets": 4,
        "orderable": true,
        "class": "text-center"
    },
    {
        "targets": 5,
        "orderable": true,
        "class": "text-center"
    },
    {
        "targets": 6,
        "orderable": true,
        "class": "text-center"
    },
    
];
//var columnDefs = [];
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.more-details', function () {
            var tr = $(this).closest('tr');
            var row = dataTable.row(tr).data();
            $('#image_on_popup').html(row.image_path);
            $('#myModalHorizontal').modal('show');
        });
    });
</script>
<script type="text/javascript">
    function isActive(){
        alert($('#isActive').val());
    }
    $(document).on('change','.isActive',function(e){
            //debugger;
            var tr = $(this).closest('tr');
            var row = dataTable.row(tr).data();
            var id = row.id;
            var url = "{{route('change_status')}}";
            if($(this).is(":checked")) {
                var is_active = 1
            }else{
                var is_active = 0
            }
            $.ajax({
                  type: "POST",
                  url: url,
                  data: {
                    "_token": "{{ csrf_token() }}",
                    'id' : id,
                    'is_selected' : is_active
                    },
                  success: function(resp){
                    alert(resp.message)
                },
        });
    });
    $('#btn-search').click(function () {
        var user_id = $('#user_id').find('option:selected').val();
        var time_period = $('#time_period').find('option:selected').val();
        var location = $('#location').find('option:selected').val();
        
        extraData = {};
        extraData.user_id = user_id;
        extraData.time_period = time_period;
        extraData.location = location;
        extraData.segment = '{{Request::segment(2)}}';
        extraData.search_filter_value = $('#search_filter_value').val();
        dataTable.ajax.reload();
    });
</script>
<script>
    $(document).ready(function(){
        if($('#time_period').val() == 'specific_date'){
            $('#created_from').show();
            $('#created_to').show();
        }
        $('#time_period').change(function(){
            const value = $(this).val()
            if(value == 'specific_date'){
                $('#created_from').show();
                $('#created_to').show();
            }else {
                $('#created_from').hide();
                $('#created_to').hide();
            }
        })
    })
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#export').click(function(){
            var user_id = $('#user_id').find('option:selected').val();
            var time_period = $('#time_period').find('option:selected').val();
            var location = $('#location').find('option:selected').val();
            var created_from = $('#single_cal5').val();
            var created_to = $('#single_cal4').val();
            var feedback_id = 1;


            $.ajax({
                type: "GET",
                url: '{{route("feedbackResponce")}}' ,
                data: {
                "_token": "{{ csrf_token() }}",
                'user_id' : user_id,
                'time_period' : time_period,
                'location' : location,
                'created_from' : created_from,
                'created_to' : created_to,
                'feedback_id' : feedback_id
                },
                success: function(resp){
                }
            })

        });
    });
</script>
@include('datatable.dt_js')
@stop