<?php
//if(count($participant_id)>0){
// $chart_pie = array();
$time_period = 'all_data';
foreach ($survey_form_data as $question) {
    $form_id = $survey_form_data[0]->id;

    foreach ($question->survey_questions as $survey_form) {
        if ($survey_form->question_type == 1) {
            $quest_option = CommonHelper::getAnswerByQuestionId($survey_form->id);
            $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");

            $answer_array = array();
            foreach ($quest_option as $opt_value) {
                $answer_array['answer_value'][] = $opt_value->survey_option_title;
            }

            $i = 0;
            $chart_pie = [];
            $allRecord = [];
            foreach ($answer_array['answer_value'] as $ans_value) {
                for ($y = 0; $y <= 12; $y++) {
                                    $year_data = date('m', strtotime(date("Y/01/01")."+".$y.'month'));    
                                
                            $answer_count = CommonHelper::getAnswerCount($survey_form->id, $year_data, $ans_value, $participant_id = "",$created_from,$created_to,$time_period);

                            $chart_ans_count = 0;
                            if (!empty($answer_count)) {
                                $chart_ans_count = $answer_count->ans_count;
                            }

                            $chart_ans_percent = 0;

                            if (count($total_result_count) > 0) {
                                $total_ans_count = count($total_result_count);
                                $chart_ans_percent = ($chart_ans_count * 100 / $total_ans_count);
                            }

                        }
                        $chart_pie[0] = $chart_ans_percent;
                        $chart_pie[1] = $ans_value;
                            // $i++;
                            $allRecord[] = $chart_pie;
                        }
                        $tempChart = [];
                        foreach ($allRecord as $key => $value) {
                            // dd($value);
                            $tempChart[$key]['value'] = $value[0];
                            $tempChart[$key]['name'] = $value[1];
                        }
                        $chart_label = json_encode($tempChart);
            ?>
<div class="col-sm-6 col-md-6 col-xs-12">
    <div class="card mb-4">
        <div class="card-body">
            <span class="feedback"> {{$survey_form->survey_question}}</span>
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
        }

        if ($survey_form->question_type == 2) {
            $quest_option = CommonHelper::getAnswerByQuestionId($survey_form->id);

            $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");

            $answer_array = array();
            foreach ($quest_option as $opt_value) {
                $answer_array['answer_value'][] = $opt_value->survey_option_title;
            }

            $i = 0;
            $chart_pie = [];
            $allRecord = [];
            foreach ($answer_array['answer_value'] as $ans_value) {
                $total_chart_value = [];
                            for ($y = 0; $y <=11; $y++) {
                            $year_data = date('m', strtotime(date("Y/01/01")."+".$y.'month'));
                                

                            $answer_count = CommonHelper::getCheckboxAnswerCount($survey_form->id, $year_data, $ans_value, $participant_id = "",$time_period,$created_from,$created_to);
                            
                            $chart_ans_count = 0;
                            if (!empty($answer_count)) {
                                $chart_ans_count = $answer_count->ans_count;
                            }


                            $total_chart_value[] = $chart_ans_count;
                            // $chart_pie[$i][0] = $ans_value;
                            // $chart_pie[$i][1] = $chart_ans_percent;
                            }
                            // dd(array_sum($total_chart_value));
                            $chart_ans_percent = 0;
                            if (count($total_result_count) > 0) {
                                $total_ans_count = count($total_result_count);
                                $chart_ans_percent = (array_sum($total_chart_value) * 100 / $total_ans_count);
                            }
                            $chart_pie[0] = $chart_ans_percent;
                            $chart_pie[1] = $ans_value;
                            // $i++;
                            $allRecord[] = $chart_pie;
                            $total_chart_value = [];
                        }
                        $checkboxArray = [];
                        foreach ($allRecord as $key => $value) {
                            $checkboxArray[$key]['value'] = $value[0];
                            $checkboxArray[$key]['name'] = $value[1];
                        }

                        $checkbox_chart_label = json_encode($checkboxArray);
            
            ?>
<div class="col-sm-6 col-md-6 col-xs-12">
    <div class="card mb-4">
        <div class="card-body">
            <span class="feedback"> {{$survey_form->survey_question}}</span>
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
        }

        if ($survey_form->question_type == 5) {

            $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");
            $answer_array = array('1' => 'Terrible', '2' => 'Poor', '3' => 'Good', '4' => 'Great', '5' => 'Fantastic');

            $i = 0;
            $chart_pie = [];
            $allRecord = [];
            foreach ($answer_array as $key => $ans_value) {
                $total_chart_value = [];
                            for ($y = 0; $y <= 11; $y++) {
                                    $year_data = date('m', strtotime(date("Y/01/01")."+".$y.'month'));
                                $answer_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, $key, $participant_id = "",$created_from,$created_to,$time_period);                            

                                $chart_ans_count = 0;
                                if (!empty($answer_count)) {
                                    $chart_ans_count = $answer_count->ans_count;
                                }

                                $total_chart_value[] = $chart_ans_count;

                            }
                                $chart_ans_percent = 0;

                                if (count($total_result_count) > 0) {
                                    $total_ans_count = count($total_result_count);
                                    $chart_ans_percent = (array_sum($total_chart_value) * 100 / $total_ans_count);
                                }
                            // $chart_pie[$i][0] = $ans_value;
                            // $chart_pie[$i][1] = $chart_ans_percent;
                            // $i++;
                            $chart_pie[0] = $chart_ans_percent;
                            $chart_pie[1] = $ans_value;
                            // $i++;
                            $allRecord[] = $chart_pie;
                            $total_chart_value = [];
                        }
                        $ratingArray = [];
                        foreach ($allRecord as $key => $value) {
                            $ratingArray[$key]['value'] = $value[0];
                            $ratingArray[$key]['name'] = $value[1];
                        }   
                        $star_rating_chart_label = json_encode($ratingArray);
            ?>
<div class="col-sm-6 col-md-6 col-xs-12">
    <div class="card mb-4">
        <div class="card-body">
            <span class="feedback">{{$survey_form->survey_question}}</span>
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
        }
    }
}
?>