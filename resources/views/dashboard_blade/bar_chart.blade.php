<div class="row">
    <div class="col-sm-12 col-xs-12 col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title mb-3">{{__('message.select_chart_type')}}</div>
                {{ Form::open(['url' => 'admin/dashboardChange']) }}
                <div class="form-group row">

                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <div class="input-right-icon">
                            <select class="select2_group form-control" id="select_chart_type" name="select_chart_type">
                                <option <?php
                                        if (Session::get('select_chart_type') == 2) {
                                            echo "selected";
                                        }
                                        ?> value="2">{{__('message.bar_chart')}}</option>
                                <option <?php
                                        if (Session::get('select_chart_type') == 1) {
                                            echo "selected";
                                        }
                                        ?> value="1"> {{__('message.pie_chart')}}</option>
                            </select>
                            <span class="span-right-input-icon">
                                <i class="ul-form__icon i-Arrow-Down"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2 mt-3 mt-md-0">
                        <input type="submit" name="submit" value="{{__('message.view')}}"
                            class="btn btn-primary btn-block">
                    </div>
                </div>
                {{ Form::close() }}
                <!-- if chart type == bar chart -->
                <div class="row">
                    @if(Session::get('select_chart_type') == 2)
                    <?php
                        $month = Session::get('select_chart_by') == 2 ? 'month' : 'year';
                        $m = Session::get('select_chart_by') == 2 ? 'm' : 'Y';

                        $year_month_value = Session::get('select_chart_by') == 2 ? 11 : 5;
                        if (isset($survey_form_data) && count($survey_form_data) > 0) {
                            $chart_bar = array();
                            foreach ($survey_form_data as $question) {
                                $form_id = $survey_form_data[0]->id;

                                foreach ($question->survey_questions as $survey_form) {
                                if ($survey_form->question_type == 1) {
                                    if (isset($setting[4]) and $setting[4]->setting_key == 'survey_form_id' and $setting[4]->setting_value == $form_id) {
                                        $answer_array = array();
                                        $explode = explode(',', $setting[4]->survey_question_chart);
                                        foreach ($explode as $key => $value) {
                                            $explode2 = explode('_', $value);                                               
                                            if ($survey_form->id == $explode2[0] && $explode2[1] == 2) {
                                                    $answer_array = array();
                                                    // for pie chart

                                                    $quest_option = CommonHelper::getAnswerByQuestionId($survey_form->id);
                                                    $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");

                                                    $answer_array = array();
                                                    foreach ($quest_option as $opt_value) {
                                                        $answer_array['answer_value'][] = $opt_value->survey_option_title;
                                                    }

                                                    $i = 0;

                                                    foreach ($answer_array['answer_value'] as $ans_value) {
                                                        $answer_count = CommonHelper::getAnswerCount($survey_form->id, $year = $survey_form->created_at->year, $ans_value, $participant_id = "",$time_period,$created_from,$created_to);

                                                        $chart_ans_count = 0;
                                                        if (!empty($answer_count)) {
                                                            $chart_ans_count = $answer_count->ans_count;
                                                        }

                                                        $chart_ans_percent = 0;

                                                        if (count($total_result_count) > 0) {
                                                            $total_ans_count = count($total_result_count);
                                                            $chart_ans_percent = ($chart_ans_count * 100 / $total_ans_count);
                                                        }

                                                        $chart_pie[$i][0] = $ans_value;
                                                        $chart_pie[$i][1] = $chart_ans_percent;
                                                        $i++;
                                                    }

                                                    $tempChart = [];
                                                    foreach ($chart_pie as $key => $value) {
                                                        $tempChart[$key]['value'] = $value[1];
                                                        $tempChart[$key]['name'] = $value[0];
                                                    }
                                                    $chart_label = json_encode($tempChart);
                                                    ?>
                    <div class="col-sm-6 col-md-6 col-xs-12">
                        <div class="card mb-4">
                            <h3 class="text-center m-0 p-2"
                                style=" background-color: #663399; border-radius:10px 10px 0px 0px; color: #fff;">
                                {{$survey_form->survey_question}}</h3>
                            <div class="card-body">
                                <div id="chart_container_<?php echo $survey_form->id; ?>" style="height: 300px;"></div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            let chart_container_<?php echo $survey_form->id; ?> = document.getElementById('chart_container_<?php echo $survey_form->id; ?>');
                            if (chart_container_<?php echo $survey_form->id; ?>) {
                                let chart_label_Pie = echarts.init(chart_container_<?php echo $survey_form->id; ?>);
                                chart_label_Pie.setOption({
                                    color: ['#c03018', '#f36e12', '#ebcb37', '#a1b968', '#0d94bc', '#6957af'],
                                    tooltip: {
                                        show: true,
                                        backgroundColor: 'rgba(0, 0, 0, .8)'
                                    },
    
                                    series: [{
                                            name: '{{$survey_form->survey_question}}',
                                            type: 'pie',
                                            radius: '60%',
                                            center: ['50%', '50%'],
                                            data: <?php echo $chart_label; ?>,
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
                                        chart_label_Pie.resize();
                                    }, 500);
                                });
                            }
                        </script>
                    </div>
                    <?php
                        } elseif ($survey_form->id == $explode2[0] && $explode2[1] == 1) {
                            $answer_array = array();
                        // barchart                                     
                            $quest_option = CommonHelper::getAnswerByQuestionId($survey_form->id);

                            $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");

                            $answer_array = array();
                            $time_period = 'all_data';
                            if (empty($computed_arr)) {
                                
                                for ($y = 0; $y <= 11; $y++) {
                                    $year_data = date('m', strtotime(date("Y/01/01")."+".$y.'month'));
                                    //store year data in to array
                                    $computed_arr[] = $year_data;
                                }
                            }
                            // dd($computed_arr);
                            // create new array
                            $answer_array = [];
                            $option_name = [];
                            $responses_1 = [];
                            //for option value foreach
                            foreach ($quest_option as $key => $opt_value) {
                                //store option value in variable
                                $ans_value = $opt_value->survey_option_title;
                                //store option value in array
                                $option_name[] = $ans_value;
                                //create new array
                                $answer_count_data = [];
                                //this loop for year data loop and get answer count
                                foreach ($computed_arr as $key => $year_data) {
                                    //send value to common helper function
                                    $answer_count = CommonHelper::getAnswerCount($survey_form->id, $year_data, $ans_value, $participant_id = "",$time_period,$created_from,$created_to);
                                    $radiobutton_ans_percent = 0;
                                            if (count($total_result_count) > 0) {
                                                $total_ans_count = count($total_result_count);
                                                // $radiobutton_ans_percent = ($answer_count->ans_count * 100 / $total_ans_count);
                                                $radiobutton_ans_percent = $answer_count->ans_count;
                                            }
                                    //store data into the array
                                    $answer_count_data[] = $radiobutton_ans_percent;
                                    $responses_1[] = $radiobutton_ans_percent;
                                }
                                //year data array and answer count array store in to one single array
                                $answer_array[] = [$answer_count_data,$option_name];
                            }
                            //encode year data array to string for bar chart
                            $yearData = json_encode($computed_arr);
                            $responses_1 = array_sum($responses_1);

                    ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <script type="text/javascript">
                            $(document).ready(function () {

                                // Chart in Dashboard version 1
                                var echartElemBar = document.getElementById('columnchart_material_<?php echo $survey_form->id; ?>');
                                if (echartElemBar) {
                                    var echartBar = echarts.init(echartElemBar);
                                    echartBar.setOption({
                                        legend: {
                                            borderRadius: 0,
                                            orient: 'horizontal',
                                            x: 'right',
                                            data:[
                                            //this loop for getting value dynamic option name
                                            <?php foreach ($option_name as $key => $value1) { ?>
                                                '<?php echo $value1; ?>',
                                            <?php } ?>
                                            ]
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
                                            data: <?php echo $yearData ?>,
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
                                            max: <?php echo $responses_1 ?>,
                                            interval: 5,
                                            axisLine: {
                                                show: false
                                            },
                                            splitLine: {
                                                show: true,
                                                interval: 'auto'
                                            }
                                        }],

                                        series:[
                                        <?php foreach ($answer_array as $key => $value) { 
                                            $answer_count = json_encode($value[0])
                                            ?>
                                        {
                                            name: '<?php echo $value[1][$key]  . ' Response' ; ?>',
                                            data: <?php  echo $answer_count; ?> ,
                                            label: { show: false, color: '#0168c1' },
                                            type: 'bar',
                                            barGap: 0,
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
                        <div class="text-center card card-icon-bg card-icon-bg-primary o-hidden mb-5 pb-2 ">
                            <h3 class="p-2">{{$survey_form->survey_question}}</h3>
                            <div id="columnchart_material_<?php echo $survey_form->id; ?>" class="p-3"
                                style="height: 300px;"></div>
                        </div>
                    </div>
                    <?php
                    }
                }
            }
        }

    //==========Here End question type 1 radiobox answer===============


            if ($survey_form->question_type == 2) {
                $quest_option = CommonHelper::getAnswerByQuestionId($survey_form->id);

                $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");

                $answer_array = array();
                if (isset($setting[4]) and $setting[4]->setting_key == 'survey_form_id' and $setting[4]->setting_value == $form_id) {
                    $answer_array = array();
                    $explode = explode(',', $setting[4]->survey_question_chart);
                    foreach ($explode as $key => $value) {
                        $explode2 = explode('_', $value);
                        if ($survey_form->id == $explode2[0] && $explode2[1] == 2) {
                            $answer_array = array();
                            // for pie chart
                            $quest_option = CommonHelper::getAnswerByQuestionId($survey_form->id);

                            $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");

                            $answer_array = array();
                            foreach ($quest_option as $opt_value) {
                                $answer_array['answer_value'][] = $opt_value->survey_option_title;
                            }

                            $i = 0;

                            foreach ($answer_array['answer_value'] as $ans_value) {
                                $answer_count = CommonHelper::getCheckboxAnswerCount($survey_form->id, $year = $survey_form->created_at->year, $ans_value, $participant_id = "");

                                $chart_ans_count = 0;
                                if (!empty($answer_count)) {
                                    $chart_ans_count = $answer_count->ans_count;
                                }

                                $chart_ans_percent = 0;

                                if (count($total_result_count) > 0) {
                                    $total_ans_count = count($total_result_count);
                                    $chart_ans_percent = ($chart_ans_count * 100 / $total_ans_count);
                                }

                                $chart_pie[$i][0] = $ans_value;
                                $chart_pie[$i][1] = $chart_ans_percent;
                                $i++;
                            }

                            $checkboxArray = [];
                            foreach ($chart_pie as $key => $value) {
                                $checkboxArray[$key]['value'] = $value[1];
                                $checkboxArray[$key]['name'] = $value[0];
                            }
                            $checkbox_chart_label = json_encode($checkboxArray);
                        ?>
                    <div class="col-sm-6 col-md-6 col-xs-12">
                        <div class="card mb-4">
                            <h3 class="text-center m-0 p-2"
                                style=" background-color: #663399; border-radius:10px 10px 0px 0px; color: #fff;">
                                {{$survey_form->survey_question}}</h3>
                            <div class="card-body">
                                <div id="chart_container_<?php echo $survey_form->id; ?>" style="height: 300px;"></div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            let checkbox_chart_label_<?php echo $survey_form->id; ?> = document.getElementById('chart_container_<?php echo $survey_form->id; ?>');
                            if (checkbox_chart_label_<?php echo $survey_form->id; ?>) {
                                let checkbox_chart_Pie_<?php echo $survey_form->id; ?> = echarts.init(checkbox_chart_label_<?php echo $survey_form->id; ?>);
                                checkbox_chart_Pie_<?php echo $survey_form->id; ?>.setOption({
                                    color: ['#c03018', '#f36e12', '#ebcb37', '#a1b968', '#0d94bc', '#6957af'],
                                    tooltip: {
                                        show: true,
                                        backgroundColor: 'rgba(0, 0, 0, .8)'
                                    },

                                    series: [{
                                            name: '<?php echo $survey_form->survey_question; ?>',
                                            type: 'pie',
                                            radius: '60%',
                                            center: ['50%', '50%'],
                                            data: <?php echo $checkbox_chart_label; ?>,
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
                                        checkbox_chart_Pie_<?php echo $survey_form->id; ?>.resize();
                                    }, 500);
                                });
                            }
                        </script>
                    </div>
                    <?php
                } elseif ($survey_form->id == $explode2[0] && $explode2[1] == 1) {
                    // for bar chart
                    

                    $push_answer_array = array(ucfirst($month));

                    $quest_option_name = [];
                    foreach ($quest_option as $key => $opt_value) {
                        array_push($push_answer_array, $opt_value->survey_option_title);
                        $quest_option_name[] = $opt_value->survey_option_title;
                    }

                    // $answer_array[] = $push_answer_array;
                    // $quest_option_value = [];
                    // for ($y = $year_month_value; $y >= 0; $y--) {

                    //     $year_data = date($m, strtotime("-" . $y . $month));
                    //     $computed_arr = array($year_data);
                    //     foreach ($push_answer_array as $ans_value) {

                    //         if ($ans_value != ucfirst($month)) {
                    //             $answer_count = CommonHelper::getCheckboxAnswerCount($survey_form->id, $year_data, $ans_value, $participant_id = "");

                    //             $checkbox_ans_percent = 0;
                    //             if (count($total_result_count) > 0) {
                    //                 $total_ans_count = count($total_result_count);
                    //                 $checkbox_ans_percent = ($answer_count->ans_count * 100 / $total_ans_count);
                    //             }
                    //             array_push($computed_arr, $checkbox_ans_percent);
                    //             $quest_option_value[] = $checkbox_ans_percent;
                    //         }
                    //     }
                    //     $answer_array[] = $computed_arr;
                    // }
                    $yearValue = [];
                    //this loop for prevent mutiple year data
                    $time_period = 'all_data';
                    if(empty($yearValue)) {
                        for ($y = 0; $y <= 11; $y++) {
                            $year_data = date('m', strtotime(date("Y/01/01")."+".$y.'month'));
                            //store year data in to array
                            $yearValue[] = $year_data;
                        }
                    }
                    // create new array
                    $answer_array = [];
                    $option_name = [];
                    $responses_2 = [];
                    //for option value foreach
                    foreach ($quest_option as $key => $opt_value) {
                        //store option value in variable
                        $ans_value = $opt_value->survey_option_title;
                        //store option value in array
                        $option_name[] = $ans_value;
                        //create new array
                        $answer_count_data = [];
                        //this loop for year data loop and get answer count
                        foreach ($yearValue as $key => $year_data) {
                            //send value to common helper function
                            $answer_count = CommonHelper::getCheckboxAnswerCount($survey_form->id, $year_data, $ans_value, $participant_id = "",$time_period,$created_from,$created_to);
                            $checkbox_ans_percent = 0;
                                    if (count($total_result_count) > 0) {
                                        $total_ans_count = count($total_result_count);
                                       // $checkbox_ans_percent = ($answer_count->ans_count * 100 / $total_ans_count);
                                        $checkbox_ans_percent = $answer_count->ans_count;
                                    }
                            //store data into the array
                            $answer_count_data[] = $checkbox_ans_percent;
                            $responses_2[] = $checkbox_ans_percent;
                        }
                        $answer_array[] = [$answer_count_data,$ans_value];
                        //year data array and answer count array store in to one single array
                    }
                        $responses_2 = array_sum($responses_2);
                    $checkbox_chart_label = json_encode($answer_array);
                    $yearData = json_encode($yearValue);
                    ?>
                    <!-- checkbox bar chart start here -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <script type="text/javascript">
                            $(document).ready(function () {

                                    // Chart in Dashboard version 1
                                    var checkbox_<?php echo $survey_form->id; ?> = document.getElementById('columnchart_material_<?php echo $survey_form->id; ?>');
                                    if (checkbox_<?php echo $survey_form->id; ?>) {
                                        var checkbox_bar = echarts.init(checkbox_<?php echo $survey_form->id; ?>);
                                        checkbox_bar.setOption({
                                            legend: {
                                                borderRadius: 0,
                                                orient: 'horizontal',
                                                x: 'right',
                                                data:[
                                                //this loop for getting value dynamic option name
                                                <?php foreach ($quest_option_name as $key => $value1) { ?>
                                                 '<?php echo $value1; ?>',
                                                <?php } ?>
                                                ]
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
                                                data: <?php echo $yearData ?>,
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
                                                max: <?php echo $responses_2 ?>,
                                                interval: 5,
                                                axisLine: {
                                                    show: false
                                                },
                                                splitLine: {
                                                    show: true,
                                                    interval: 'auto'
                                                }
                                            }],

                                            series:[
                                            <?php foreach ($answer_array as $key => $value) { 
                                                $answer_count = json_encode($value[0])
                                                ?>
                                            {
                                                name: '<?php echo $value[1] . ' Response' ; ?>',
                                                data: <?php  echo $answer_count; ?> ,
                                                label: { show: false, color: '#0168c1' },
                                                type: 'bar',
                                                barGap: 0,
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
                                                checkbox_bar.resize();
                                            }, 500);
                                        });
                                    }
                                    });
                        </script>
                        <div class="text-center card card-icon-bg card-icon-bg-primary o-hidden mb-5 pb-2 ">
                            <h3 class="p-2">{{$survey_form->survey_question}}</h3>
                            <div id="columnchart_material_<?php echo $survey_form->id; ?>" class="p-3"
                                style="height: 300px;"></div>
                        </div>
                    </div>
                    <!-- checkbox bar chart end here -->
                    <?php }

                        }
                    }
                }

            //==========Here End question type 2 checkbox answer===============
            ?>


                    <?php
        if ($survey_form->question_type == 5) {
            $answer_array = array();
            $checkArray = [];
            $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");
            // kandarp pandya 11-09-2018
            $answer_array = array();
            if (isset($setting[4]) and $setting[4]->setting_key == 'survey_form_id' and $setting[4]->setting_value == $form_id) {
                $explode = explode(',', $setting[4]->survey_question_chart);
                foreach ($explode as $key => $value) {
                    $explode2 = explode('_', $value);                                               
                    if ($explode2[0] == $survey_form->id and $explode2[1] == 2) {
                        $answer_array[] = array('0' => ucfirst($month), '1' => 'Terrible', '2' => 'Poor', '3' => 'Good', '4' => 'Great', '5' => 'Fantastic');
                        // for pi chart 
                        $checkArray = [$form_id];
                        $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");
                        $answer_array = array('1' => 'Terrible', '2' => 'Poor', '3' => 'Good', '4' => 'Great', '5' => 'Fantastic');

                        $i = 0;
                        // start foreach
                        foreach ($answer_array as $key => $ans_value) {
                            $answer_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year =$survey_form->created_at->year , $key, $participant_id = "",$created_from,$created_to,$time_period);
                            

                            $chart_ans_count = 0;
                            if (!empty($answer_count)) {
                                $chart_ans_count = $answer_count->ans_count;
                            }

                            $chart_ans_percent = 0;

                            if (count($total_result_count) > 0) {
                                $total_ans_count = count($total_result_count);
                                $chart_ans_percent = ($chart_ans_count * 100 / $total_ans_count);
                            }

                            $chart_pie[$i][0] = $ans_value;
                            $chart_pie[$i][1] = $chart_ans_percent;
                            $i++;
                        }
                        // end Foreach
                        $ratingArray = [];
                        foreach ($chart_pie as $key => $value) {
                            $ratingArray[$key]['value'] = $value[1];
                            $ratingArray[$key]['name'] = $value[0];
                        }   
                        $star_rating_chart_label = json_encode($ratingArray);
                        ?>

                    <div class="col-sm-6 col-md-6 col-xs-12">
                        <div class="card mb-4">
                            <h3 class="text-center m-0 p-2"
                                style=" background-color: #663399; border-radius:10px 10px 0px 0px; color: #fff;">
                                {{$survey_form->survey_question}}</h3>
                            <div class="card-body">
                                <div id="chart_container_<?php echo $survey_form->id; ?>" style="height: 300px;"></div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            let star_rating_chart_label_<?php echo $survey_form->id; ?> = document.getElementById('chart_container_<?php echo $survey_form->id; ?>');
                            if (star_rating_chart_label_<?php echo $survey_form->id; ?>) {
                                let star_rating_Pie = echarts.init(star_rating_chart_label_<?php echo $survey_form->id; ?>);
                                star_rating_Pie.setOption({
                                    color: ['#c03018', '#f36e12', '#ebcb37', '#a1b968', '#0d94bc', '#6957af'],
                                    tooltip: {
                                        show: true,
                                        backgroundColor: 'rgba(0, 0, 0, .8)'
                                    },

                                    series: [{
                                            name: '{{$survey_form->survey_question}}',
                                            type: 'pie',
                                            radius: '60%',
                                            center: ['50%', '50%'],
                                            data: <?php echo $star_rating_chart_label; ?> ,
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
                                        star_rating_Pie.resize();
                                    }, 500);
                                });
                            }
                        </script>
                    </div>

                    <?php
                        } else {
                                // if question type = bar chart
                                $answer_array = array();
                                //create variable
                                $tarrible = array();
                                $poor = array();
                                $good = array();
                                $great = array();
                                $fantastic = array();
                                $year = array();
                                $responses_5 = [];

                                $answer_array[] = array('0' => ucfirst($month), '1' => 'Terrible', '2' => 'Poor', '3' => 'Good', '4' => 'Great', '5' => 'Fantastic');
                                
                            }
                        }
                        } else {
                            // $answer_array = array();
                            $answer_array[] = array('0' => ucfirst($month), '1' => 'Terrible', '2' => 'Poor', '3' => 'Good', '4' => 'Great', '5' => 'Fantastic');
                        }
                                        
                        $tarrible = array();
                                $poor = array();
                                $good = array();
                                $great = array();
                                $fantastic = array();
                                $year = array();
                    $i = 1;
                    $time_period = 'All_data';
                    for ($y = 0; $y <= 11; $y++) {
                        // $year_data = date($m, strtotime("-" . $y . $month));
                        $year_data = date('m', strtotime(date("Y/01/01")."+".$y.'month'));

                        $tarrible_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '1', $participant_id = "",$created_from,$created_to,$time_period);
                        $poor_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '2', $participant_id = "",$created_from,$created_to,$time_period);
                        $good_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '3', $participant_id = "",$created_from,$created_to,$time_period);
                        $great_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '4', $participant_id = "",$created_from,$created_to,$time_period);
                        $fantastic_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '5', $participant_id = "",$created_from,$created_to,$time_period);


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
                            $fantastic_ans_percent = $fantastic_count->ans_count;
                        }


                        $answer_array[] = array($year_data, $tarrible_ans_percent, $poor_ans_percent, $good_ans_percent, $great_ans_percent, $fantastic_ans_percent);

                        $tarrible[] = $tarrible_ans_percent;
                        $poor[] = $poor_ans_percent;
                        $good[] = $good_ans_percent;
                        $great[] = $great_ans_percent;
                        $fantastic[] = $fantastic_ans_percent;
                        $year[] = $year_data;
                    }
                    $responses_5 = array_merge($tarrible,$poor,$good,$great,$fantastic
                                    );
                    //store all data separately
                    $tarrible = json_encode($tarrible);
                    $poor = json_encode($poor);
                    $good = json_encode($good);
                    $great = json_encode($great);
                    $fantastic = json_encode($fantastic);
                    $year = json_encode($year);
                    $star_rating_bar_chart_label = json_encode($answer_array);
                    $responses_5 = array_sum($responses_5);
                    ?>
                    @if (!in_array($form_id, $checkArray))
                    <!-- star rating bar chart start here -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <script type="text/javascript">
                            $(document).ready(function () {
                                // Chart in Dashboard version 1
                                    var echartElemBar = document.getElementById('echartBar_<?php echo $survey_form->id; ?>');
                                    if (echartElemBar) {
                                        var echartBar = echarts.init(echartElemBar);
                                        echartBar.setOption({
                                            legend: {
                                                borderRadius: 0,
                                                orient: 'horizontal',
                                                x: 'right',
                                            data: ["{{__('message.terrible')}}", "{{__('message.poor')}}", "{{__('message.good')}}","{{__('message.great')}}", "{{__('message.fantastic')}}"]
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
                                                max: <?php echo ($responses_5) ?>,
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
                                                name: "{{__('message.terrible')}} {{__('message.responses')}}",
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
                                                name: "{{__('message.poor')}} {{__('message.responses')}}",
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
                                                name: "{{__('message.good')}} {{__('message.responses')}}",
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
                                                name: "{{__('message.great')}} {{__('message.responses')}}",
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
                                                name: "{{__('message.fantastic')}} {{__('message.responses')}}",
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
                            <h3 class="p-2">{{$survey_form->survey_question}}</h3>
                            <div id="echartBar_<?php echo $survey_form->id; ?>" class="p-3" style="height: 300px;">
                            </div>
                        </div>
                    </div>
                    <!-- star rating bar chart end here -->
                    @endif
                    <?php } ?>
                    <?php
        if ($survey_form->question_type == 6) {
            $answer_array = array();
            $checkArray = [];
            $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");
            // kandarp pandya 11-09-2018
            $answer_array = array();
            if (isset($setting[4]) and $setting[4]->setting_key == 'survey_form_id' and $setting[4]->setting_value == $form_id) {
                $explode = explode(',', $setting[4]->survey_question_chart);
                foreach ($explode as $key => $value) {
                    $explode2 = explode('_', $value);                                               
                    if ($explode2[0] == $survey_form->id and $explode2[1] == 2) {
                        $answer_array[] = array('0' => ucfirst($month), '1' => 'Terrible', '2' => 'Poor', '3' => 'Good', '4' => 'Great', '5' => 'Fantastic');
                        // for pi chart 
                        $checkArray = [$form_id];
                        $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");
                        $answer_array = array('1' => 'Terrible', '2' => 'Poor', '3' => 'Good', '4' => 'Great', '5' => 'Fantastic');

                        $i = 0;
                        // start foreach
                        foreach ($answer_array as $key => $ans_value) {
                            $answer_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year = $survey_form->created_at->year , $key, $participant_id = "",$created_from,$created_to,$time_period);

                            $chart_ans_count = 0;
                            if (!empty($answer_count)) {
                                $chart_ans_count = $answer_count->ans_count;
                            }

                            $chart_ans_percent = 0;

                            if (count($total_result_count) > 0) {
                                $total_ans_count = count($total_result_count);
                                $chart_ans_percent = ($chart_ans_count * 100 / $total_ans_count);
                            }

                            $chart_pie[$i][0] = $ans_value;
                            $chart_pie[$i][1] = $chart_ans_percent;
                            $i++;
                        }
                        // end Foreach
                        $ratingArray = [];
                        foreach ($chart_pie as $key => $value) {
                            $ratingArray[$key]['value'] = $value[1];
                            $ratingArray[$key]['name'] = $value[0];
                        }   
                        $star_rating_chart_label = json_encode($ratingArray);
                        ?>

                    <div class="col-sm-6 col-md-6 col-xs-12">
                        <div class="card mb-4">
                            <h3 class="text-center m-0 p-2"
                                style=" background-color: #663399; border-radius:10px 10px 0px 0px; color: #fff;">
                                {{$survey_form->survey_question}}</h3>
                            <div class="card-body">
                                <div id="chart_container_<?php echo $survey_form->id; ?>" style="height: 300px;"></div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            let star_rating_chart_label_<?php echo $survey_form->id; ?> = document.getElementById('chart_container_<?php echo $survey_form->id; ?>');
                            if (star_rating_chart_label_<?php echo $survey_form->id; ?>) {
                                let star_rating_Pie = echarts.init(star_rating_chart_label_<?php echo $survey_form->id; ?>);
                                star_rating_Pie.setOption({
                                    color: ['#c03018', '#f36e12', '#ebcb37', '#a1b968', '#0d94bc', '#6957af'],
                                    tooltip: {
                                        show: true,
                                        backgroundColor: 'rgba(0, 0, 0, .8)'
                                    },

                                    series: [{
                                            name: '{{$survey_form->survey_question}}',
                                            type: 'pie',
                                            radius: '60%',
                                            center: ['50%', '50%'],
                                            data: <?php echo $star_rating_chart_label; ?> ,
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
                                        star_rating_Pie.resize();
                                    }, 500);
                                });
                            }
                        </script>
                    </div>

                    <?php
                        } else {
                                // if question type = bar chart
                                $answer_array = array();
                                //create variable
                                $tarrible = array();
                                $poor = array();
                                $good = array();
                                $great = array();
                                $fantastic = array();
                                $year = array();
                                $responses_6 = [];

                                $answer_array[] = array('0' => ucfirst($month), '1' => 'Terrible', '2' => 'Poor', '3' => 'Good', '4' => 'Great', '5' => 'Fantastic');
                                
                            }
                        }
                        } else {
                            // $answer_array = array();
                            $answer_array[] = array('0' => ucfirst($month), '1' => 'Terrible', '2' => 'Poor', '3' => 'Good', '4' => 'Great', '5' => 'Fantastic');
                        }
                                        
                        $tarrible = array();
                                $poor = array();
                                $good = array();
                                $great = array();
                                $fantastic = array();
                                $year = array();
                    $i = 1;
                    $time_period = 'All_data';
                    for ($y = 0; $y <= 11; $y++) {
                        // $year_data = date($m, strtotime("-" . $y . $month));
                        $year_data = date('m', strtotime(date("Y/01/01")."+".$y.'month'));

                        $tarrible_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '1', $participant_id = "",$created_from,$created_to,$time_period);
                        $poor_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '2', $participant_id = "",$created_from,$created_to,$time_period);
                        $good_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '3', $participant_id = "",$created_from,$created_to,$time_period);
                        $great_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '4', $participant_id = "",$created_from,$created_to,$time_period);
                        $fantastic_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '5', $participant_id = "",$created_from,$created_to,$time_period);


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
                            $fantastic_ans_percent = $fantastic_count->ans_count;
                        }


                        $answer_array[] = array($year_data, $tarrible_ans_percent, $poor_ans_percent, $good_ans_percent, $great_ans_percent, $fantastic_ans_percent);

                        $tarrible[] = $tarrible_ans_percent;
                        $poor[] = $poor_ans_percent;
                        $good[] = $good_ans_percent;
                        $great[] = $great_ans_percent;
                        $fantastic[] = $fantastic_ans_percent;
                        $year[] = $year_data;
                    }
                    $responses_6 = array_merge($tarrible,$poor,$good,$great,$fantastic
                                    );
                    //store all data separately
                    $tarrible = json_encode($tarrible);
                    $poor = json_encode($poor);
                    $good = json_encode($good);
                    $great = json_encode($great);
                    $fantastic = json_encode($fantastic);
                    $year = json_encode($year);
                    $star_rating_bar_chart_label = json_encode($answer_array);
                    $responses_6 = array_sum($responses_6);
                    ?>
                    @if (!in_array($form_id, $checkArray))
                    <!-- star rating bar chart start here -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <script type="text/javascript">
                            $(document).ready(function () {
                                // Chart in Dashboard version 1
                                    var echartElemBar = document.getElementById('echartBar_<?php echo $survey_form->id; ?>');
                                    if (echartElemBar) {
                                        var echartBar = echarts.init(echartElemBar);
                                        echartBar.setOption({
                                            legend: {
                                                borderRadius: 0,
                                                orient: 'horizontal',
                                                x: 'right',
                                            data: ["{{__('message.terrible')}}", "{{__('message.poor')}}", "{{__('message.good')}}","{{__('message.great')}}", "{{__('message.fantastic')}}"]
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
                                                max: <?php echo ($responses_6) ?>,
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
                                                name: "{{__('message.terrible')}} {{__('message.responses')}}",
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
                                                name: "{{__('message.poor')}} {{__('message.responses')}}",
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
                                                name: "{{__('message.good')}} {{__('message.responses')}}",
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
                                                name: "{{__('message.great')}} {{__('message.responses')}}",
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
                                                name: "{{__('message.fantastic')}} {{__('message.responses')}}",
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
                            <h3 class="p-2">{{$survey_form->survey_question}}</h3>
                            <div id="echartBar_<?php echo $survey_form->id; ?>" class="p-3" style="height: 300px;">
                            </div>
                        </div>
                    </div>
                    <!-- star rating bar chart end here -->
                    @endif
                    <?php } 
                                }
                            }
                        } else {
                            ?>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center"><span style="width: 100%;float: left; position: relative;margin: 10px 0px;font-size: 22px; color: red;">No record found!</span></div>
                    <?php } ?>
                    @else
                    @include('dashboard_blade.pie_chart')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>