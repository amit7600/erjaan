<!-- start Compain KPI Report here -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <h3 class="text-center m-0 mb-3 p-2">{{__('message.feedback')}} {{__('message.reason_4')}}</h3>
            <div class="text-center">
                <div class="spinner-bubble spinner-bubble-primary m-10" id="gifImage" style="display: none;"></div>
                <div id="printableArea">
                    <div id="showList"></div>
                    <?php
                        $month = Session::get('select_chart_by') == 2 ? 'month' : 'year';
                        $m = Session::get('select_chart_by') == 2 ? 'm' : 'Y';
                        
                        $year_month_value = Session::get('select_chart_by') == 2 ? 11 : 5;
                        if (count($feedback_reason_data4) > 0) {
                            $chart_bar = array();
                            foreach ($feedback_reason_data4 as $key1 => $reason1) 
                            {
                                $feedback_reason = $reason1->feedback_reason;
                                $reason_id = $reason1->id;
                                $answer_array = array();
                                $answer_array[] = array($month, $reason1->feedback_reason);
                                $i = 1;
                                for ($y = $year_month_value; $y >= 0; $y--) {
                                    $year_data = date($m, strtotime("-" . $y . $month));
                                    $tarrible_count = FeedbackHelper::getStarRatingReasonCount($reason_id, $year_data, $feedback_reason, $user_id,$city,$created_from,$created_to);
                                    $tarrible_ans_percent = 0;
                                    
                                    if ($total_reason > 0) {
                                        $total_ans_count = $total_reason;
                                        $tarrible_ans_percent = ($tarrible_count->ans_count * 100 / $total_ans_count);
                                    }
                                    $answer_array[] = array($year_data,$tarrible_ans_percent);
                                }
                                $arary =[$reason1->feedback_reason,$tarrible_ans_percent]; 
                                $final[] = $arary;
                                //this section for bar chart.
                                $bar_chart = json_encode($answer_array);

                                // $reasonData = Session::get('select_chart_by') == 1 ? json_decode($monthValueData) :  json_decode($yearValueData) ;
                                // $yearValue =  Session::get('select_chart_by') == 1 ? $monthValues :  $yearValues ;
                                $reasonData = json_decode($monthValueData4);
                                $yearValue =  $monthValues4;
                            }
                            // this section for pie chart
                            $reasonArray = [];
                            foreach ($final as $key => $value) {
                                $reasonArray[$key]['value'] = $value[1];
                                $reasonArray[$key]['name'] = $value[0];
                            }
                            $ar = [['question', 'question rating']];
                            $final = array_merge($ar,$final);
                            $arary = json_encode($reasonArray);

                            $star_rating_bar_chart_label = json_encode($arary);
                            ?>
                    @if(Session::get('select_chart_type') == 1)
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <div id="reasonchart_4_material_<?php echo $reason_id; ?>"
                                    style="width: 100%; min-height: 400px; margin: 0 auto"></div>
                                <div class="row">
                                    {{-- this section is only for response count --}}
                                    @foreach ($feedback_reason_data as $key=>$value)
                                    @php
                                    $feedback_reason = $value->feedback_reason
                                    @endphp
                                    <div class="col-md-4">
                                        <p class="text-14 mt-1 mb-2 text-center"><b> {{$feedback_reason}}:</b>
                                            {{$response_array[$key][$feedback_reason]}}</p>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            let reasonchart_4_material_<?php echo $reason_id; ?> = document.getElementById('reasonchart_4_material_<?php echo $reason_id; ?>');
                                    if (reasonchart_4_material_<?php echo $reason_id; ?>) {
                                        let reason_pie = echarts.init(reasonchart_4_material_<?php echo $reason_id; ?>);
                                        reason_pie.setOption({
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
                                                    data: <?php echo $arary; ?> ,
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
                                                reason_pie.resize();
                                            }, 500);
                                        });
                                    }
                        </script>
                    </div>
                    @endif
                    <!-- pie chart section end here -->
                    <!-- bar chart section start here -->
                    @if(Session::get('select_chart_type') == 2)
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <script type="text/javascript">
                            $(document).ready(function () {
                            // Chart in Dashboard version 1
                            var echartElemBar = document.getElementById('reasonchart_4_material_<?php echo $reason_id; ?>');
                            if (echartElemBar) {
                                var echartBar = echarts.init(echartElemBar);
                                echartBar.setOption({
                                    legend: {
                                        borderRadius: 0,
                                        orient: 'horizontal',
                                        x: 'right',
                                        data:[
                                        //this loop for getting value dynamic option name
                                        <?php foreach ($reasonData as $key => $value1) { ?>
                                            
                                         '<?php echo $value1->text ?>' ,
                                        <?php } ?>
                                        ]
                                    },
                                    grid: {
                                        left: '8px',
                                        right: '8px',
                                        bottom: '0PX',
                                        containLabel: true
                                    },
                                    tooltip: {
                                        show: true,
                                        backgroundColor: 'rgba(0, 0, 0, .8)'
                                    },
                                    xAxis: [{
                                        type: 'category',
                                        data: <?php echo $yearValue; ?> ,
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
                                        max: 100,
                                        interval: 25,
                                        axisLine: {
                                            show: false
                                        },
                                        splitLine: {
                                            show: true,
                                            interval: 'auto'
                                        }
                                    }],

                                    series:[
                                    <?php foreach ($reasonData as $key => $value) { 
                                        $answer_count = json_encode($value->values)
                                        ?>
                                    {
                                        name: '<?php echo $value->text; ?>',
                                        data: <?php  echo $answer_count; ?> ,
                                        label: { show: false, color: '#0168c1' },
                                        type: 'bar',
                                        barGap: 0.1,
                                        // color: '#bcbbdd',
                                        smooth: true,
                                        itemStyle: {
                                            emphasis: {
                                                shadowBlur: 10,
                                                shadowOffsetX: 0,
                                                shadowOffsetY: -2,
                                                // shadowColor: 'rgba(0, 0, 0, 0.3)'
                                            }
                                        }
                                    },
                                <?php } ?>
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
                        {{-- this section is only for response count --}}

                        <div id="reasonchart_4_material_<?php echo $reason_id; ?>" class="p-3" style="height: 400px;">
                        </div>

                        <div class="row">
                            @foreach ($feedback_reason_data4 as $key=>$value)
                            @php
                            $feedback_reason = $value->feedback_reason
                            @endphp
                            <div class="col-md-4">
                                <p class="text-16 mt-1 mb-3 text-center"><b>{{$feedback_reason}}:</b>
                                    {{$response_array4[$key][$feedback_reason]}}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <!-- bar chart section end here -->
                    <?php 
                        } else {
                        ?>
                    <div class="col-md-12 col-sm-12 col-xs-12"><span
                            style="width: 100%;float: left; position: relative;    margin: 10px 0px;font-size: 22px; color: red;">{{__('message.no_record_found')}}</span>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>