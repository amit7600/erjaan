<!-- start Compain status chart here -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="text-center">
                <input type="hidden" id="survey_form" name="survey_form"
                    value="<?php echo!empty($survey_form_id) ? $survey_form_id : '1' ?>">
                <div class="spinner-bubble spinner-bubble-primary m-10" id="gifImage" style="display: none;"></div>
                <div id="printableArea">
                    <?php
                        $month = Session::get('select_chart_by') == 2 ? 'month' : 'year';
                        $m = Session::get('select_chart_by') == 2 ? 'm' : 'Y';
                        
                        $year_month_value = Session::get('select_chart_by') == 2 ? 11 : 5;
                        $answer_array = [];
                        $year = [];
                        $time_period = 'all_data';
                        
                        if (count($feedback_complain[0]) > 0 && count($feedback_complain[1]) > 0 && count($feedback_complain[2]) > 0 && count($feedback_complain[3]) > 0) {
                            $chart_bar = array();
                            $new_ans_count = 0;
                            $in_progress_ans_percent = 0;
                            $resolved_ans_percent = 0;
                            $late_ans_percent = 0;
                            foreach ($data as $key => $value) {
                            
                                foreach ($feedback_complain as $key => $complain) {
                                    foreach ($complain as $key1 => $complain1) {
                                        $total_compain_count = FeedbackHelper::getTotalComplain($user_id,$city,$created_from,$created_to);

                                        $answer_array = array();
                                        $new = array();
                                        $in_progress = array();
                                        $resolved = array();
                                        $late = array();
                                        $year = array();
                                        $response_array = array();
                                        $new_response = array();
                                        $inProgress_response = array();
                                        $resolved_response = array();
                                        $late_response = array();

                                        $answer_array[] = array('0' => $month,'1' => "{{__('message.new')}}", '2' => "{{__('message.inProgress')}}", '3' => "{{__('message.resolved')}}", '4' => "{{__('message.late')}}");
                                        $i = 1;
                                        // for ($y = $year_month_value; $y >= 0; $y--) {
                                        //     $year_data = date($m, strtotime("-" . $y . $month));
                                        for($y = 0; $y <= 11; $y++) {
                                            $year_data =  date('m',strtotime(date("Y/01/01")."+".$y."month"));
                                            $new_count = FeedbackHelper::getComplainStatusCount($year_data, 'new', $user_id,$city,$created_from,$created_to,$time_period);
                                            $in_progress_count = FeedbackHelper::getComplainStatusCount($year_data, 'in_progress', $user_id,$city,$created_from,$created_to,$time_period);
                                            $resolved_count = FeedbackHelper::getComplainStatusCount($year_data, 'resolved', $user_id,$city,$created_from,$created_to,$time_period);
                                            $late_count = FeedbackHelper::getComplainStatusCount($year_data, 'late', $user_id,$city,$created_from,$created_to,$time_period);
                                            // $fantastic_count = FeedbackHelper::getStarRatingAnswerCount($question_id, $year_data, '5', $user_id,$city,$created_from,$created_to);
                                            
                                    
                                    $new_ans_count = 0;
                                    if (count($total_compain_count) > 0) {
                                        $total_ans_count = count($total_compain_count);
                                        // $new_ans_count = ($new_count->status_count * 100 / $total_ans_count);
                                        $new_ans_count = $new_count->status_count;
                                    }
                                    $in_progress_ans_percent = 0;
                                    if (count($total_compain_count) > 0) {
                                        $total_ans_count = count($total_compain_count);
                                        // $in_progress_ans_percent = ($in_progress_count->status_count * 100 / $total_ans_count);
                                        $in_progress_ans_percent = $in_progress_count->status_count;
                                    }

                                    $resolved_ans_percent = 0;
                                    if (count($total_compain_count) > 0) {
                                        $total_ans_count = count($total_compain_count);
                                        // $resolved_ans_percent = ($resolved_count->status_count * 100 / $total_ans_count);
                                        $resolved_ans_percent = $resolved_count->status_count;
                                    }
                                    $late_ans_percent = 0;
                                    if (count($total_compain_count) > 0) {
                                        $total_ans_count = count($total_compain_count);
                                        // $late_ans_percent = ($late_count->status_count * 100 / $total_ans_count);
                                        $late_ans_percent = $late_count->status_count;
                                    }
                                    $answer_array[] = array($year_data,$new_ans_count, $in_progress_ans_percent, $resolved_ans_percent, $late_ans_percent);

                                    //this section is for sum value for pie chart
                                    $new_value = array_sum($new)/$total_ans_count;
                                    $in_progress_value = array_sum($in_progress)/ $total_ans_count;
                                    $resolved_value = array_sum($resolved)/ $total_ans_count;  
                                    $late_value = array_sum($late)/ $total_ans_count;

                                    //this section for  store complain status value in array
                                    //this response is for show response data
                                    $new_response[] = $new_count->status_count;

                                    $inProgress_response[] = $in_progress_count->status_count;

                                    $resolved_response[] = $resolved_count->status_count;

                                    $late_response[] = $late_count->status_count;
                                   
                                    //this section is for sum value for pie chart
                                    $new[] = $new_ans_count;
                                    $in_progress[] = $in_progress_ans_percent;
                                    $resolved[] = $resolved_ans_percent;
                                    $late[] = $late_ans_percent; 
                                    $year[] = $year_data;
                                        }
                                        
                                    }
                                }
                                $response_array = array_merge($new_response,$inProgress_response,$resolved_response,$late_response);
                                $new = json_encode($new);
                                $in_progress = json_encode($in_progress);
                                $resolved = json_encode($resolved);
                                $late = json_encode($late);
                                $year = json_encode($year);
                                
                                $arary = [
                                            // ['question', 'question rating'],
                                            ['new' ,      $new_value],
                                            ['in_progress' ,        $in_progress_value ],
                                            ['resolved' ,    $resolved_value ],
                                            ['late' ,   $late_value ]
                                        ];
                                $complainPieArray = [];
                                foreach ($arary as $key => $value) {
                                    $complainPieArray[$key]['value'] = $value[1];
                                    $complainPieArray[$key]['name'] = $value[0];
                                }
                                $pie_chart = json_encode($complainPieArray);
                                $bar_chart = json_encode($answer_array);
                                    ?>
                    @if(isset($complain1))
                    @if(Session::get('select_chart_type') == 1)
                    <div>
                        <div class="x_panel">
                            <div class="x_content">
                                <h3 class="text-center m-0 mb-3 p-2">{{__('message.complain_status_chart')}}<br>
                                </h3>
                                <div id="compalinchart_material_<?php echo $complain1->id; ?>"
                                    style="width: 100%; min-height: 400px; margin: 0 auto"></div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <p class="text-14 mt-1 mb-3 text-center"><b> {{__('message.new')}}:</b>
                                            {{array_sum($new_response)}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="text-14 mt-1 mb-3 text-center"><b> {{__('message.inProgress')}}:</b>
                                            {{array_sum($inProgress_response)}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="text-14 mt-1 mb-3 text-center"><b> {{__('message.resolved')}}:</b>
                                            {{array_sum($resolved_response)}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="text-14 mt-1 mb-3 text-center"><b> {{__('message.late')}}:</b>
                                            {{array_sum($late_response)}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            let complain_pie_<?php echo $complain1->id; ?> = document.getElementById('compalinchart_material_<?php echo $complain1->id; ?>');
                                    if (complain_pie_<?php echo $complain1->id; ?>) {
                                        let complain_pie = echarts.init(complain_pie_<?php echo $complain1->id; ?>);
                                        complain_pie.setOption({
                                            color: ['#c03018', '#f36e12', '#ebcb37', '#a1b968', '#0d94bc', '#6957af'],
                                            tooltip: {
                                                show: true,
                                                backgroundColor: 'rgba(0, 0, 0, .8)'
                                            },

                                            series: [{
                                                    name: 'Complain Chart',
                                                    type: 'pie',
                                                    radius: '60%',
                                                    center: ['50%', '50%'],
                                                    data: <?php echo $pie_chart; ?> ,
                                                    itemStyle: {
                                                        emphasis: {
                                                            shadowBlur: 10,
                                                            shadowOffsetX: 0,
                                                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                                                        }
                                                    }
                                                }

                                            ]
                                        });
                                        $(window).on('resize', function() {
                                            setTimeout(() => {
                                                complain_pie.resize();
                                            }, 500);
                                        });
                                    }
                        </script>
                    </div>
                    @else
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <!-- bar chart start here -->
                        <script type="text/javascript">
                            $(document).ready(function () {

                                        // Chart in Dashboard version 1
                                            var echartElemBar = document.getElementById('compalinchart_material_<?php echo $complain1->id;; ?>');
                                            if (echartElemBar) {
                                                var echartBar = echarts.init(echartElemBar);
                                                echartBar.setOption({
                                                    legend: {
                                                        borderRadius: 0,
                                                        orient: 'horizontal',
                                                        x: 'right',
                                                        data: ["{{__('message.new')}}", "{{__('message.inProgress')}}", "{{__('message.resolved')}}", "{{__('message.late')}}"]
                                                    },
                                                    grid: {
                                                        left: '8px',
                                                        right: '8px',
                                                        bottom: '0',
                                                        containLabel: true
                                                    },
                                                    tooltip: {
                                                        show: true,
                                                        backgroundColor: 'rgba(0, 0, 0, .8)'
                                                    },
                                                    xAxis: [{
                                                        type: 'category',
                                                        data: <?php echo $year; ?>,
                                                        axisTick: {
                                                            alignWithLabel: true
                                                        },
                                                        splitLine: {
                                                            show: false
                                                        },
                                                        axisLine: {
                                                            show: true
                                                        }
                                                    }],
                                                    yAxis: [{
                                                        type: 'value',
                                                        axisLabel: {
                                                            formatter: '{value}'
                                                        },
                                                        min: 0,
                                                        max: <?php echo array_sum($response_array)?>,
                                                        interval: 5,
                                                        axisLine: {
                                                            show: false
                                                        },
                                                        splitLine: {
                                                            show: true,
                                                            interval: 'auto'
                                                        }
                                                    }],
                                                    series: [{
                                                        name: "{{__('message.new')}} {{__('message.responses')}}",
                                                        data: <?php echo $new; ?>,
                                                        label: { show: false, color: '#0168c1' },
                                                        type: 'bar',
                                                        barGap: 0,
                                                        color: 'rgb(66, 133, 244)',
                                                        smooth: true,
                                                        itemStyle: {
                                                            emphasis: {
                                                                shadowBlur: 10,
                                                                shadowOffsetX: 0,
                                                                shadowOffsetY: -2,
                                                                shadowColor: 'rgba(0, 0, 0, 0.3)'
                                                            }
                                                        }
                                                    }, {
                                                        name: "{{__('message.inProgress')}} {{__('message.responses')}}",
                                                        data: <?php echo $in_progress; ?> , 
                                                        label: { show: false, color: '#639' },
                                                        type: 'bar',
                                                        color: 'rgb(244, 180, 0)',
                                                        smooth: true,
                                                        itemStyle: {
                                                            emphasis: {
                                                                shadowBlur: 10,
                                                                shadowOffsetX: 0,
                                                                shadowOffsetY: -2,
                                                                shadowColor: 'rgba(0, 0, 0, 0.3)'
                                                            }
                                                        }
                                                    }, {
                                                        name: "{{__('message.resolved')}} {{__('message.responses')}}",
                                                        data: <?php echo $resolved; ?> ,
                                                        label: { show: false, color: '#639' },
                                                        type: 'bar',
                                                        color: ' rgb(15, 157, 88) ',
                                                        smooth: true,
                                                        itemStyle: {
                                                            emphasis: {
                                                                shadowBlur: 10,
                                                                shadowOffsetX: 0,
                                                                shadowOffsetY: -2,
                                                                shadowColor: 'rgba(0, 0, 0, 0.3)'
                                                            }
                                                        }
                                                    }, {
                                                        name: "{{__('message.late')}} {{__('message.responses')}}",
                                                        data: <?php echo $late; ?> ,
                                                        label: { show: false, color: '#639' },
                                                        type: 'bar',
                                                        color: 'rgb(219, 68, 55)',
                                                        smooth: true,
                                                        itemStyle: {
                                                            emphasis: {
                                                                shadowBlur: 10,
                                                                shadowOffsetX: 0,
                                                                shadowOffsetY: -2,
                                                                shadowColor: 'rgba(0, 0, 0, 0.3)'
                                                            }
                                                        }
                                                    }
                                                    ]
                                                });
                                                $(window).on('resize', function () {
                                                    setTimeout(function () {
                                                        echartBar.resize();
                                                    }, 500);
                                                });
                                            }
                                        });
                        </script>
                        <div class="text-center o-hidden mb-2 pb-2 ">
                            <h3 class="text-center m-0 mb-3 p-2">{{__('message.complain_status_chart')}} <br>
                            </h3>
                            <div id="compalinchart_material_<?php echo $complain1->id; ?>" class="p-3"
                                style="height: 300px;"></div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-3 col-6 text-center">
                                        <p class="text-14 mt-1 mb-1"><b>{{__('message.new')}} : </b>
                                            {{array_sum($new_response)}}</p>
                                    </div>
                                    <div class="col-md-3 col-6 text-center">
                                        <p class="text-14 mt-1 mb-1"><b>{{__('message.inProgress')}} : </b>
                                            {{array_sum($inProgress_response)}}</p>
                                    </div>
                                    <div class="col-md-3 col-6 text-center">
                                        <p class="text-14 mt-1 mb-1"><b>{{__('message.resolved')}} : </b>
                                            {{array_sum($resolved_response)}}</p>
                                    </div>
                                    <div class="col-md-3 col-6 text-center">
                                        <p class="text-14 mt-1 mb-1"><b>{{__('message.late')}} : </b>
                                            {{array_sum($late_response)}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @else
                    <div class="col-md-12 col-sm-12 col-xs-12"><span
                            style="width: 100%;float: left; position: relative;    margin: 10px 0px;font-size: 22px; color: red;">"{{__('message.no_record_found')}}"</span>
                    </div>
                    @endif
                    <?php
                                
                            }
                        } else {  ?>
                    <div class="col-md-12 col-sm-12 col-xs-12"><span
                            style="width: 100%;float: left; position: relative;    margin: 10px 0px;font-size: 22px; color: red;">"{{__('message.no_record_found')}}"</span>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>