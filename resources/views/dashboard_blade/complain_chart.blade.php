<div>
    <h4 style="text-align: center;">{{__('message.complain')}} {{__('message.status')}} {{__('message.chart')}}</h4>
</div>
{{dd(321)}}
<div class="row" id="printableArea">
    <div id="showList"></div>
    <?php
                $month = Session::get('select_chart_by') == 1 ? 'month' : 'year';
                $m = Session::get('select_chart_by') == 1 ? 'm' : 'Y';
                
                $year_month_value = Session::get('select_chart_by') == 1 ? 11 : 5;
                    
                if (count($feedback_complain) > 0) {
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
                                $tarrible = array();
                                $poor = array();
                                $good = array();
                                $great = array();
                                $fantastic = array();
                                $response_array = array();
                                $new_response = array();
                                $inProgress_response = array();
                                $resolved_response = array();
                                $late_response = array();
                                $year = array();
                                $answer_array[] = array('0' => $month,'1' => "{{__('message.new')}}", '2' => "{{__('message.in_progress')}}", '3' => "{{__('message.resolved')}}", '4' => "{{__('message.late')}}");
                                $i = 1;
                                for ($y = $year_month_value; $y >= 0; $y--) {
                                    $year_data = date($m, strtotime("-" . $y . $month));
                                

                                    $new_count = FeedbackHelper::getComplainStatusCount($year_data, 'new', $user_id,$city,$created_from,$created_to);
                                    $in_progress_count = FeedbackHelper::getComplainStatusCount($year_data, 'in_progress', $user_id,$city,$created_from,$created_to);
                                    $resolved_count = FeedbackHelper::getComplainStatusCount($year_data, 'resolved', $user_id,$city,$created_from,$created_to);
                                    $late_count = FeedbackHelper::getComplainStatusCount($year_data, 'late', $user_id,$city,$created_from,$created_to);
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

                                    //this response is for show response data
                                    $new_response[] = $new_count->status_count;

                                    $inProgress_response[] = $in_progress_count->status_count;

                                    $resolved_response[] = $resolved_count->status_count;

                                    $late_response[] = $late_count->status_count;
                                   
                                    //this section is for sum value for pie chart
                                    $new_value = array_sum($new)/$total_ans_count;
                                    $in_progress_value = array_sum($in_progress)/ $total_ans_count;
                                    $resolved_value = array_sum($resolved)/ $total_ans_count;  
                                    $late_value = array_sum($late)/ $total_ans_count;

                                    //this section for  store complain status value in array
                                    $new[] = round($new_ans_count);
                                    $in_progress[] = round($in_progress_ans_percent);
                                    $resolved[] = round($resolved_ans_percent);
                                    $late[] = round($late_ans_percent);

                                }
                                
                            }
                        }
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
                              //   $arary = [
                              // ['question', 'question rating'],
                              // ["{{__('message.new')}}" ,      $new_ans_count],
                              // ["{{__('message.in_progress')}}" ,        $in_progress_ans_percent ],
                              // ["{{__('message.resolved')}}" ,    $resolved_ans_percent ],
                              // ["{{__('message.late')}}" ,   $late_ans_percent ]
                              // ];
                        $complainPieArray = [];
                        foreach ($arary as $key => $value) {
                            $complainPieArray[$key]['value'] = round($value[1]);
                            $complainPieArray[$key]['name'] = $value[0];
                        }
                        $pie_chart = json_encode($complainPieArray);
                              // $pie_chart = json_encode($arary);
                        $bar_chart = json_encode($answer_array);
                               
                              if($new_ans_count == 0 && $in_progress_ans_percent == 0 && $resolved_ans_percent == 0 && $late_ans_percent == 0){
                                ?>
    <div class="col-md-12 col-sm-12 col-xs-12"><span
            style="width: 100%;float: left; position: relative;    margin: 10px 0px;font-size: 22px; color: red;">{{__('message.no_record_found')}}</span>
    </div>
    <?php
                              }else{
                                ?>
    @if(Session::get('select_chart_type') == 2)
    <div class="col-md-6 col-sm-6 col-xs-12">
        <script type="text/javascript">
            google.charts.load('current', {'packages': ['corechart']});
                                    google.charts.setOnLoadCallback(drawChart);

                                    function drawChart() {
                                        var data = google.visualization.arrayToDataTable(
                                            <?php echo $pie_chart ; ?>);
                                       
                                        var options = {
                                            chart: {
                                                title: '<?php echo 'Complain Chart'; ?>',
                                                subtitle: 'Report in percentage', 
                                                pieHole: 0.4,
                                                is3D: true,
                                            }
                                            
                                            

                                        };

                                        var chart = new google.visualization.PieChart(document.getElementById('compalinchart_material_<?php echo $complain1->id; ?>'));

                                        chart.draw(data, options);
                                    }
        </script>
        <div class="x_panel">
            <div class="x_content">
                <div id="compalinchart_material_<?php echo $complain1->id; ?>"
                    style="width: 100%; min-height: 400px; margin: 0 auto">
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="col-md-6 col-sm-6 col-xs-12">

        <script type="text/javascript">
            google.charts.load('current', {'packages': ['bar']});
                                    google.charts.setOnLoadCallback(drawChart);

                                    function drawChart() {
                                        var data = google.visualization.arrayToDataTable(
                <?php echo $bar_chart; ?>
                                        );

                                        var options = {
                                            chart: {
                                                title: '<?php echo 'Complain Chart'; ?>',
                                                subtitle: 'Report in percentage', 
                                            }

                                        };

                                        var chart = new google.charts.Bar(document.getElementById('compalinchart_material_<?php echo $complain1->id; ?>'));

                                        chart.draw(data, google.charts.Bar.convertOptions(options));
                                    }
        </script>
        <div class="x_panel">
            <div class="x_content">
                <div id="compalinchart_material_<?php echo $complain1->id;; ?>"
                    style="width: 100%; min-height: 400px; margin: 0 auto"></div>
            </div>
        </div>

    </div>
    @endif

    <?php
                            
                        }
                    }
                    } else {
                        ?>
    <div class="col-md-12 col-sm-12 col-xs-12"><span
            style="width: 100%;float: left; position: relative;    margin: 10px 0px;font-size: 22px; color: red;">No
            record found!</span></div>
    <?php } ?>

</div>