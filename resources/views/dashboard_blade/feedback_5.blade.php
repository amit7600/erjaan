<!-- start Feedback terminal chart here -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <h3 class="text-center m-0 mb-3 p-2"> {{__('message.feedback')}} {{__('message.terminal')}}
                {{__('message.chart_5')}} </h3>
            {{-- <div class="separator-breadcrumb border-top"></div> --}}
            <div class="text-center">
                <input type="hidden" id="survey_form" name="survey_form"
                    value="<?php echo!empty($survey_form_id) ? $survey_form_id : '1' ?>">
                <div class="spinner-bubble spinner-bubble-primary m-10" id="gifImage" style="display: none;"></div>
                {{-- <div id="choose_question_above"></div> --}}
                <div class="row" style="width: 100%;">

                    <?php
                        $month = 'month';
                        $m = 'm';
                        $time_period = 'all_data';
                        $year_month_value = 11;
                        if (count($feedback_question[0]) > 0) {
                            $chart_bar = array();
                            foreach ($feedback_question5 as $key => $question) {
                                foreach ($total_question5 as $key1 => $question1) {

                                    $tarrible = array();
                                    $poor = array();
                                    $good = array();
                                    $great = array();
                                    $fantastic = array();
                                    $year = array();
                                    $response_array = array();

                                    $question_id = $question1->id;

                                        $total_result_count = FeedbackHelper::getTotalAnswer($question_id,$user_id,$city,$created_from,$created_to);
                                        $answer_array = array();
                                        $answer_array[] = array('0' => $month,'1' => $question1->emoji_name_1, '2' => $question1->emoji_name_2, '3' => $question1->emoji_name_3, '4' => $question1->emoji_name_4, '5' => $question1->emoji_name_5);
                                        
                                        $i = 1;
                                        for ($y = 0; $y <= 11; $y++) {
                                            $year_data = date('m', strtotime(date("Y/01/01")."+".$y.'month'));
                                            
                                            $tarrible_count = FeedbackHelper::getStarRatingAnswerCount($question_id, $year_data, '1', $user_id,$city,$created_from,$created_to,$time_period);
                                            $poor_count = FeedbackHelper::getStarRatingAnswerCount($question_id, $year_data, '2', $user_id,$city,$created_from,$created_to,$time_period);
                                            $good_count = FeedbackHelper::getStarRatingAnswerCount($question_id, $year_data, '3', $user_id,$city,$created_from,$created_to,$time_period);
                                            $great_count = FeedbackHelper::getStarRatingAnswerCount($question_id, $year_data, '4', $user_id,$city,$created_from,$created_to,$time_period);
                                            $fantastic_count = FeedbackHelper::getStarRatingAnswerCount($question_id, $year_data, '5', $user_id,$city,$created_from,$created_to,$time_period);
                                            $tarrible_ans_percent = 0;
                                            
                                            if (count($total_result_count) > 0) {
                                                $total_ans_count = count($total_result_count);
                                                // $tarrible_ans_percent = ($tarrible_count->ans_count * 100 / $total_ans_count);
                                                $tarrible_ans_percent = $tarrible_count->ans_count;
                                            }
                                            $poor_ans_percent = 0;
                                            if (count($total_result_count) > 0) {
                                                $total_ans_count = count($total_result_count);
                                                // $poor_ans_percent = ($poor_count->ans_count * 100 / $total_ans_count);
                                                $poor_ans_percent = $poor_count->ans_count ;
                                            }
                                            $good_ans_percent = 0;
                                            if (count($total_result_count) > 0) {
                                                $total_ans_count = count($total_result_count);
                                                // $good_ans_percent = ($good_count->ans_count * 100 / $total_ans_count);
                                                $good_ans_percent = $good_count->ans_count;
                                            }
                                            $great_ans_percent = 0;
                                            if (count($total_result_count) > 0) {
                                                $total_ans_count = count($total_result_count);
                                                // $great_ans_percent = ($great_count->ans_count * 100 / $total_ans_count);
                                                $great_ans_percent = $great_count->ans_count ;
                                            }
                                            $fantastic_ans_percent = 0;
                                            if (count($total_result_count) > 0) {
                                                $total_ans_count = count($total_result_count);
                                                // $fantastic_ans_percent = ($fantastic_count->ans_count * 100 / $total_ans_count);
                                                $fantastic_ans_percent = $fantastic_count->ans_count ;
                                            }
                                            $answer_array[] = array($year_data,$tarrible_ans_percent, $poor_ans_percent, $good_ans_percent, $great_ans_percent, $fantastic_ans_percent);


                                            $tarrible[] = $tarrible_ans_percent;
                                            $poor[] = $poor_ans_percent;
                                            $good[] = $good_ans_percent;
                                            $great[] = $great_ans_percent;
                                            $fantastic[] = $fantastic_ans_percent;
                                            $year[] = $year_data;
                                        }
                                        $response_array = array_merge($tarrible,$poor,$good,$great,$fantastic);
                                        $rating1 = $question1->emoji_name_1 != null ? $question1->emoji_name_1:'Very poor';
                                        $rating2 = $question1->emoji_name_2 != null ? $question1->emoji_name_2 : 'Poor';
                                        $rating3 = $question1->emoji_name_3 != null ? $question1->emoji_name_3 : 'Average';
                                        $rating4 = $question1->emoji_name_4 != null ? $question1->emoji_name_4 : 'Good';
                                        $rating5 = $question1->emoji_name_5 != null ? $question1->emoji_name_5 : 'Excellent';
                                        $array = [
                                        [array_sum($tarrible), $rating1],
                                        [array_sum($poor), $rating2],
                                        [array_sum($good), $rating3],
                                        [array_sum($great), $rating4],
                                        [array_sum($fantastic), $rating5]
                                    ];
                                        $tarrible = json_encode($tarrible);
                                        $poor = json_encode($poor);
                                        $good = json_encode($good);
                                        $great = json_encode($great);
                                        $fantastic = json_encode($fantastic);
                                         $year = json_encode($year);
                                                        
                                        $emoji = "emoji_name_".($key1+1);


                                        //this section for new pie chart
                                        $pieArray = [];
                                        foreach ($array as $key => $value) {
                                            $pieArray[$key]['value'] = $value[0];
                                            $pieArray[$key]['name'] = $value[1];
                                        }
                                        //end
                                        $array = json_encode($pieArray);
                                        $star_rating_bar_chart_label = json_encode($answer_array);
                                        ?>
                    @if(Session::get('select_chart_type') == 1)
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <div id="columnchart_2_material_<?php echo $question_id; ?>"
                                    style="width: 100%; min-height: 400px; margin: 0 auto"></div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            let FeedbackPieChart_<?php echo $question_id; ?> = document.getElementById('columnchart_2_material_<?php echo $question_id; ?>');
                                if (FeedbackPieChart_<?php echo $question_id; ?>) {
                                    let feedback_Pie = echarts.init(FeedbackPieChart_<?php echo $question_id; ?>);
                                    feedback_Pie.setOption({
                                        color: ['#c03018', '#f36e12', '#ebcb37', '#a1b968', '#0d94bc', '#6957af'],
                                        tooltip: {
                                            show: true,
                                            backgroundColor: 'rgba(0, 0, 0, .8)'
                                        },

                                        series: [{
                                                name: '<?php echo $question1->question; ?>',
                                                type: 'pie',
                                                radius: '60%',
                                                center: ['50%', '50%'],
                                                data: <?php echo $array; ?> ,
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
                                            feedback_Pie.resize();
                                        }, 500);
                                    });
                                }
                        </script>
                    </div>
                    @else
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <script type="text/javascript">
                            $(document).ready(function () {
                            // Chart in Dashboard version 1
                                var echartElemBar = document.getElementById('columnchart_2_material_<?php echo $question_id; ?>');
                                if (echartElemBar) {
                                    var echartBar = echarts.init(echartElemBar);
                                    echartBar.setOption({
                                        legend: {
                                            borderRadius: 0,
                                            orient: 'horizontal',
                                            x: 'right',
                                            data: ['Terrible', 'Poor', 'Good','Great', 'Fantastic']
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
                                            max: <?php echo (array_sum($response_array)) ?>,
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
                                            name: 'Terrible Response',
                                            data: <?php echo $tarrible; ?>,
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
                                            name: 'Poor Response',
                                            data: <?php echo $poor; ?> , 
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
                                        }, {
                                            name: 'Good Response',
                                            data: <?php echo $good; ?> ,
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
                                            name: 'Great Response',
                                            data: <?php echo $great; ?> ,
                                            label: { show: false, color: '#639' },
                                            type: 'bar',
                                            color: 'rgb(15, 157, 88)',
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
                                            name: 'Fantastic Response',
                                            data: <?php echo $fantastic; ?>,
                                            label: { show: false, color: '#639' },
                                            type: 'bar',
                                            color: 'rgb(171, 71, 188)',
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
                        <div class="text-center card card-icon-bg card-icon-bg-primary o-hidden mb-5 pb-2 ">
                            <h3 class="p-2">{{$question1->question}}</h3>
                            <div id="columnchart_2_material_<?php echo $question_id; ?>" class="p-3"
                                style="height: 300px;"></div>
                        </div>
                    </div>
                    @endif
                    <?php
                                    }
                                } 
                    //end if condition that
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


<script type="text/javascript">
    $(document).ready(function () {
        // $('#survey_form').on('change',function(){
        //     var id = $('#survey_form').val()
        //     drawChart(id)
        // })
        drawChart();
        function drawChart() {
            
            $('#gifImage').css('display', 'block');
            zingchart.THEME = "";
            var url = '{{route("feedback_report")}}';
            var form_id = $('#survey_form').find(":selected").val();
            $('#survey_form_id').val(form_id);
            $.ajax({
                url: url,
                type: 'GET',
                data: '',
                dataType: 'json',
                success: function (resp) {
                    console.log(resp)
                    $('#gifImage').css('display', 'none');
                    if (resp) {
                        $('#feedback_kpi_count').html('');
                        $('#feedback_kpi').html('');

                        if (resp['question_survey'].length == 0) {
                            
                            var sum = 0;
                            $('#feedback_kpi').html('<div class="col-md-12 col-sm-12 col-xs-12"><span style="width: 100%;float: left; position: relative;margin: 10px 0px;font-size: 22px; color: red;">"{{__('message.no_record_found')}}"</span></div>');
                        }else{
                        var sum = 0;
                        for (var i = 0; i < resp['final_feedback'].length; i++) {

                            //remove zingchar powered by
                            setTimeout(function () {
                                for (var i = 0; i < resp['feedback_survey'].length; i++) {
                                    $('#report_div_' + i + '-license-text').css('display', 'none');
                                }
                            }, 3000);


                            zingchart.exec('report_div_' + i, 'destroy');

                            var min = resp['feedback_survey'].minimum_value;
                            var max = resp['feedback_survey'].maximum_value;

                            $('#feedback_kpi').append(' <table class="table" style="width: 50%; float: left;"> <tr> <td> <div> <h3 class="p-2 text-16"> {{__('message.question')}} : '+resp['feedback_survey'][i].question+'</h3> </div><div class="col-md-12 col-sm-12 col-xs-12" style="height: 400px;" id="report_div_' + i + '"></div><div class="col-sm-12><div class="row"> <div class="col-md-12"> <p class="text-16 mt-1 mb-1 text-center"><b>{{__('message.responses')}}:</b> '+ resp['final_feedback'][i].response +'</p></div></div></div></td></tr></table>');

                            let gaugeChartElem = document.getElementById('report_div_' + i);
                            if (gaugeChartElem) {
                                let gaugeChart = echarts.init(gaugeChartElem);


                                var option = {
                                    grid: {
                                        left: '%',
                                        right: '4%',
                                        bottom: '3%',
                                        containLabel: true
                                    },
                                    tooltip: {
                                        formatter: "{a} <br/>{b} : {c}%"
                                    },
                                    toolbox: {
                                        // feature: {
                                        //     restore: {},
                                        //     saveAsImage: {}
                                        // }
                                    },
                                    series: [{
                                        name: resp['feedback_survey'][i].question,
                                        type: 'gauge',
                                        min: 0,
                                        max: max,
                                        axisLine: {            
                                                lineStyle: {       
                                                    color: [[0.2, '#c23531'],[0.8, '#63869e'],[1, '#91c7ae']], 
                                                    width: 25
                                                }
                                            },
                                        detail: {
                                            formatter: '{value}%'
                                        },
                                        data: [{
                                            value: resp.final_feedback[i].avg,
                                            name: ''
                                        }]
                                    }]
                                };
                                gaugeChart.setOption({

                                    option

                                });
                                    gaugeChart.setOption(option, true);
                                $(window).on('resize', function() {
                                    setTimeout(() => {
                                        gaugeChart.resize();
                                    }, 500);
                                });
                            }
                        }
                    }
                        //var kpiSum = 'KPI TOTLE : ' + sum ;

                        $('#feedback_kpi_count').append('<span class="amis">');
                    }
                }
            });
        }

    });
</script>