
<?php
$user = Auth::user();
$role = $user->user_role;
$user_name = DB::table('users')
            ->join('tbl_kpi','users.id','=','tbl_kpi.user_data')
            ->select('users.name')
            ->first();
            $id = Auth::user()->id;

            $permission_data = CommonHelper::getUserPermissionData($id);
?>
@extends('layout.admin')
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<link href="{{asset('dropzone/dist/dropzone.css')}}" rel="stylesheet"/>
@stop
{{-- Page content --}}
@section('inner_body')

<style type="text/css">
    .survey_title{
        font-size: 29px;
        margin: 0 auto;
        margin-left: 0%;
        width: 100%;
        /*padding-left: 45%;*/
        font-weight: bold;
        background-color: #73879C;
        color: white;
        height: 50px;
        padding-top: 0%;
        text-align: center;
    }
    .myoption{ 
        border: 1px solid #cccccc;
        height: 24px;
        padding: 3px;
        margin-top: 1%;
    }
    .highcharts-credits{
        display: none;
    }

    .noRecord {
        background-color: #73879C;
        color: #fff;
        font-weight: bolder;
        margin-left: 1%;
        text-align: center;
        width: 100%;
        position: absolute;
        z-index: 999;
        padding: 1%;
        margin-top: 0%;
        font-size: 17px;
        border: 1px solid #cccccc;
    }

    .ami{
        background-color: #26b99a;
        color: #fff;
        font-weight: normal;
        margin-left: 1%;
        text-align: center;
        width: 96%;
        position: absolute;
        z-index: 999;
        padding-top : 1%;
        margin-top: 14%;
        font-size: 15px;    padding: 13px 0;
        border : 1px solid #cccccc;    display: inline-block;    left: 3%;
    }
    .sent{
        background-color: transparent;
        color: #000;
        font-weight: normal;
        margin-left: 0%;
        text-align: center;
        width: 95%;
        position: absolute;
        z-index: 999;
        padding-top: 1%;
        margin-top:0%;
        font-size: 18px;
        border: 1px solid #f0f0f0;
        bottom: 4%;    left: 11px;
    }
    .amis{
        color: black;
        font-weight: bolder;
        margin-left: 0;
        text-align: center;
        width: 100%;
        margin-top: 5%;
        font-size: 20px;
    }

    
    .inner_text_center { text-align: center; }
    .inner_text_center .col-md-3 {margin: 0 auto; float: none;display: inline-block; }

    .horizontal-center.alert.alert-success{width: 85%;float: left;padding: 7px 15px;}
</style>
<script src="{{asset('resources/assets/js/pie_chart/highcharts.js')}}"></script>  
<script src="{{asset('resources/assets/js/pie_chart/highcharts-3d.js')}}"></script>


<div class="container body">
    <div class="main_container">
        
        <!-- page content -->
        <div class="right_col" role="main" style="min-height: 1214px;">
        
        @if($role == 0 || isset($permission_data->view_dashboard) && $permission_data->view_dashboard == 1 || $role != 4)
            <br />
            <div class="">

                <div class="row top_tiles">
                  
                <div class="">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <p class="survey_title"><?php echo!empty($survey_form_title) ? $survey_form_title : 'No Survey Form Found!' ?></p>
                            <input type="hidden" id="survey_form" name="survey_form" value="<?php echo!empty($survey_form_id) ? $survey_form_id : '1' ?>">
                            <img src="http://bestanimations.com/Science/Gears/loadinggears/loading-gears-animation-6-4.gif" id="gifImage" style="display: none; margin-left: 38%;"/>
                            <div id="choose_question_above" class="col-md-12 col-sm-12 col-xs-12"></div>

                            <div id="choose_question" class="col-md-12 col-sm-12 col-xs-12 inner_text_center"></div>

                        </div>
                    </div>
                    <!-- <label class="control-label col-md-1 col-sm-1 col-xs-12" for="retail_email">Select Chart Type</label>
                                    {{ Form::open(['url' => 'admin/dashboardChange']) }}
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <select class="select2_group form-control" id="select_chart_by" name="select_chart_by">
                                            <option <?php
                                                // if (Session::get('select_chart_by') == 1) {
                                                //     echo "selected";
                                                // }
                                                ?> value="1" >Yearly Chart</option>
                                            <option <?php
                                                // if (Session::get('select_chart_by') == 2) {
                                                //     echo "selected";
                                                // }
                                                ?>
                                             value="2" >Monthly Chart</option>
                                            </select>
                                            <input type="submit" name="submit" value="Go">
                                        </div>
                                    {{ Form::close() }}
                                   
                </div> -->

                <div class="col-sm-12" style="padding: 0px;">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="retail_email" style="    margin-top: 6px;    width: auto">Select Chart Type</label>
                                    {{ Form::open(['url' => 'admin/dashboardChange']) }}
                                        <div class="col-md-4 col-sm-4 col-xs-12" style="margin-bottom: 20px;">
                                            <select class="select2_group form-control" id="select_chart_by" name="select_chart_by">
                                            <option <?php
                                                if (Session::get('select_chart_by') == 1) {
                                                    echo "selected";
                                                }
                                                ?> value="1" >Yearly Chart</option>
                                            <option <?php
                                                if (Session::get('select_chart_by') == 2) {
                                                    echo "selected";
                                                }
                                                ?>
                                             value="2" >Monthly Chart</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12" style="margin-bottom: 20px;">
                                            <select class="select2_group form-control" id="select_chart_type" name="select_chart_type">
                                            <option <?php
                                                if (Session::get('select_chart_type') == 1) {
                                                    echo "selected";
                                                }
                                                ?> value="1" >Bar Chart</option>
                                            <option <?php
                                                if (Session::get('select_chart_type') == 2) {
                                                    echo "selected";
                                                }
                                                ?>
                                             value="2" > Pie Chart</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2">
                                            <input type="submit" name="submit" value="view" class=" btn btn-info btn-sm">
                                            
                                        </div>
                                    {{ Form::close() }}
        <!-- if chart type == bar chart -->
        @if(Session::get('select_chart_type') == 1)
                    <?php
                  $month = Session::get('select_chart_by') == 1 ? 'year' : 'month';
                  $m = Session::get('select_chart_by') == 1 ? 'Y' : 'm' ;
                  $year_month_value = Session::get('select_chart_by') == 2 ? 11 : 5;
                    if (count($survey_form_data) > 0) {
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
                                                    $answer_count = CommonHelper::getAnswerCount($survey_form->id, $year = $survey_form->created_at->year, $ans_value, $participant_id = "");

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

                                                $chart_label = json_encode($chart_pie);
                                                ?>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <script type="text/javascript">
                                    $(document).ready(function () {
                                    var chart = {
                                    type: 'pie',
                                    options3d: {
                                    enabled: true,
                                    alpha: 25,
                                    beta: 0
                                    }
                                    };
                                    var title = {
                                    text: '<?php echo $survey_form->survey_question; ?>'
                                    };
                                    var tooltip = {
                                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                    };
                                    var plotOptions = {
                                    pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    depth: 45,

                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.name}'
                                    },
                                    showInLegend: true
                                    }
                                    };
                                    var series = [{
                                    type: 'pie',
                                    name: 'Avarage Survey Report',
                                    data: <?php echo $chart_label; ?>
                                    }];
                                    var json = {};
                                    json.chart = chart;
                                    json.title = title;
                                    json.tooltip = tooltip;
                                    json.plotOptions = plotOptions;
                                    json.series = series;
                                    $('#chart_container_<?php echo $survey_form->id; ?>').highcharts(json);
                                    });
                                                    </script>

                                                    <div class="x_panel">
                                                        <div class="x_content">
                                                            <div id="chart_container_<?php echo $survey_form->id; ?>" style="width: 100%; height: auto; margin: 0 auto"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            } elseif ($survey_form->id == $explode2[0] && $explode2[1] == 1) {
                                                $answer_array = array();
                                            // barchart                                     
                                                $quest_option = CommonHelper::getAnswerByQuestionId($survey_form->id);

                                            $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");

                                            $answer_array = array();

                                            $push_answer_array = array(ucfirst($month));

                                            foreach ($quest_option as $key => $opt_value) {
                                                array_push($push_answer_array, $opt_value->survey_option_title);
                                            }

                                            $answer_array[] = $push_answer_array;

                                            for ($y = $year_month_value; $y >= 0; $y--) {

                                                $year_data = date($m, strtotime("-" . $y . $month));
                                                $computed_arr = array($year_data);
                                                foreach ($push_answer_array as $ans_value) {

                                                    if ($ans_value != ucfirst($month)) {
                                                        $answer_count = CommonHelper::getAnswerCount($survey_form->id, $year_data, $ans_value, $participant_id = "");

                                                        $radiobutton_ans_percent = 0;
                                                        if (count($total_result_count) > 0) {
                                                            $total_ans_count = count($total_result_count);
                                                            $radiobutton_ans_percent = ($answer_count->ans_count * 100 / $total_ans_count);
                                                        }
                                                        array_push($computed_arr, $radiobutton_ans_percent);
                                                    }
                                                }
                                                $answer_array[] = $computed_arr;
                                            }

                                    $radiobutton_chart_label = json_encode($answer_array);
                                    ?>
                                    <div class="col-md-6 col-sm-6 col-xs-12">

                                        <script type="text/javascript">
                                            google.charts.load('current', {'packages': ['bar']});
                                            google.charts.setOnLoadCallback(drawChart);

                                            function drawChart() {
                                            var data = google.visualization.arrayToDataTable(
                                            <?php echo $radiobutton_chart_label; ?>
                                            );

                                            var options = {
                                            chart: {
                                                title: '<?php echo $survey_form->survey_question; ?>',
                                                subtitle: 'Report in percentage',
                                            }
                                            };

                                            var chart = new google.charts.Bar(document.getElementById('columnchart_material_<?php echo $survey_form->id; ?>'));

                                            chart.draw(data, google.charts.Bar.convertOptions(options));
                                            }
                                                                    </script>
                                                                    <div class="x_panel">
                                                                        <div class="x_content">
                                                                            <div id="columnchart_material_<?php echo $survey_form->id; ?>" style="width: 100%; min-height: 400px; margin: 0 auto"></div>
                                                                        </div>
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

                        $checkbox_chart_label = json_encode($chart_pie);
                        ?>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    var chart = {
                                        type: 'pie',
                                        options3d: {
                                            enabled: true,
                                            alpha: 25,
                                            beta: 0
                                        }
                                    };
                                    var title = {
                                        text: '<?php echo $survey_form->survey_question; ?>'
                                    };
                                    var tooltip = {
                                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                    };
                                    var plotOptions = {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            depth: 45,

                                            dataLabels: {
                                                enabled: true,
                                                format: '{point.name}'
                                            },
                                            showInLegend: true
                                        }
                                    };
                                    var series = [{
                                            type: 'pie',
                                            name: 'Avarage Survey Report',
                                            data: <?php echo $checkbox_chart_label; ?>
                                        }];
                                    var json = {};
                                    json.chart = chart;
                                    json.title = title;
                                    json.tooltip = tooltip;
                                    json.plotOptions = plotOptions;
                                    json.series = series;
                                    $('#chart_container_<?php echo $survey_form->id; ?>').highcharts(json);
                                });
                            </script>

                            <div class="x_panel">
                                <div class="x_content">
                                    <div id="chart_container_<?php echo $survey_form->id; ?>" style="width: 100%; height: auto; margin: 0 auto"></div>
                                </div>
                            </div>
                        </div><?php
                                            } elseif ($survey_form->id == $explode2[0] && $explode2[1] == 1) {
                                                // for bar chart
                                                $push_answer_array = array(ucfirst($month));

                                    foreach ($quest_option as $key => $opt_value) {
                                        array_push($push_answer_array, $opt_value->survey_option_title);
                                    }
                                    $answer_array[] = $push_answer_array;

                                    for ($y = $year_month_value; $y >= 0; $y--) {

                                        $year_data = date($m, strtotime("-" . $y . $month));
                                        $computed_arr = array($year_data);
                                        foreach ($push_answer_array as $ans_value) {

                                            if ($ans_value != ucfirst($month)) {
                                                $answer_count = CommonHelper::getCheckboxAnswerCount($survey_form->id, $year_data, $ans_value, $participant_id = "");

                                                $checkbox_ans_percent = 0;
                                                if (count($total_result_count) > 0) {
                                                    $total_ans_count = count($total_result_count);
                                                    $checkbox_ans_percent = ($answer_count->ans_count * 100 / $total_ans_count);
                                                }
                                                array_push($computed_arr, $checkbox_ans_percent);
                                            }
                                        }
                                        $answer_array[] = $computed_arr;
                                    }

                                    $checkbox_chart_label = json_encode($answer_array);
                                    ?>
                                    <div class="col-md-6 col-sm-6 col-xs-12">

                                        <script type="text/javascript">
                                            google.charts.load('current', {'packages': ['bar']});
                                            google.charts.setOnLoadCallback(drawChart);

                                            function drawChart() {
                                                var data = google.visualization.arrayToDataTable(
                                                        <?php echo $checkbox_chart_label; ?>
                                                );

                                                var options = {
                                                    chart: {
                                                        title: '<?php echo $survey_form->survey_question; ?>',
                                                        subtitle: 'Report in percentage',
                                                    }
                                                };

                                                var chart = new google.charts.Bar(document.getElementById('columnchart_material_<?php echo $survey_form->id; ?>'));

                                                chart.draw(data, google.charts.Bar.convertOptions(options));
                                            }
                                        </script>
                                        <div class="x_panel">
                                            <div class="x_content">
                                                <div id="columnchart_material_<?php echo $survey_form->id; ?>" style="width: 100%; min-height: 400px; margin: 0 auto"></div>
                                            </div>
                                        </div>

                                    </div>
                                    <?php
                                }

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
                                                    $answer_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year =$survey_form->created_at->year , $key, $participant_id = "");
                                                    

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
                                                $star_rating_chart_label = json_encode($chart_pie);
                                                ?>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <script type="text/javascript">
                                                        $(document).ready(function () {
                                                            var chart = {
                                                                type: 'pie',
                                                                options3d: {
                                                                    enabled: true,
                                                                    alpha: 25,
                                                                    beta: 0
                                                                }
                                                            };
                                                            var title = {
                                                                text: '<?php echo $survey_form->survey_question; ?>'
                                                            };
                                                            var tooltip = {
                                                                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                                            };
                                                            var plotOptions = {
                                                                pie: {
                                                                    allowPointSelect: true,
                                                                    cursor: 'pointer',
                                                                    depth: 45,

                                                                    dataLabels: {
                                                                        enabled: true,
                                                                        format: '{point.name}'
                                                                    },
                                                                    showInLegend: true
                                                                }
                                                            };
                                                            var series = [{
                                                                    type: 'pie',
                                                                    name: 'Avarage Survey Report',
                                                                    data: <?php echo $star_rating_chart_label; ?>
                                                                }];
                                                            var json = {};
                                                            json.chart = chart;
                                                            json.title = title;
                                                            json.tooltip = tooltip;
                                                            json.plotOptions = plotOptions;
                                                            json.series = series;
                                                            $('#chart_container_<?php echo $survey_form->id; ?>').highcharts(json);
                                                        });
                                                    </script>

                                                    <div class="x_panel">
                                                        <div class="x_content">
                                                            <div id="chart_container_<?php echo $survey_form->id; ?>" style="width: 100%; height: auto; margin: 0 auto"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                } else {
                                                    // if question type = bar chart
                                                    $answer_array = array();
                                                    $answer_array[] = array('0' => ucfirst($month), '1' => 'Terrible', '2' => 'Poor', '3' => 'Good', '4' => 'Great', '5' => 'Fantastic');
                                                    
                                                    
                                                }
                                            }
                                    } else {
                                        // $answer_array = array();
                                        $answer_array[] = array('0' => ucfirst($month), '1' => 'Terrible', '2' => 'Poor', '3' => 'Good', '4' => 'Great', '5' => 'Fantastic');
                                    }
                                    
                                    

                                    $i = 1;
                                    for ($y =$year_month_value; $y >= 0; $y--) {
                                        $year_data = date($m, strtotime("-" . $y . $month));

                                        $tarrible_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '1', $participant_id = "");
                                        $poor_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '2', $participant_id = "");
                                        $good_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '3', $participant_id = "");
                                        $great_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '4', $participant_id = "");
                                        $fantastic_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year_data, '5', $participant_id = "");


                                        $tarrible_ans_percent = 0;
                                        if (count($total_result_count) > 0) {
                                            $total_ans_count = count($total_result_count);
                                            $tarrible_ans_percent = ($tarrible_count->ans_count * 100 / $total_ans_count);
                                        }

                                        $poor_ans_percent = 0;
                                        if (count($total_result_count) > 0) {
                                            $total_ans_count = count($total_result_count);
                                            $poor_ans_percent = ($poor_count->ans_count * 100 / $total_ans_count);
                                        }

                                        $good_ans_percent = 0;
                                        if (count($total_result_count) > 0) {
                                            $total_ans_count = count($total_result_count);
                                            $good_ans_percent = ($good_count->ans_count * 100 / $total_ans_count);
                                        }


                                        $great_ans_percent = 0;
                                        if (count($total_result_count) > 0) {
                                            $total_ans_count = count($total_result_count);
                                            $great_ans_percent = ($great_count->ans_count * 100 / $total_ans_count);
                                        }

                                        $fantastic_ans_percent = 0;
                                        if (count($total_result_count) > 0) {
                                            $total_ans_count = count($total_result_count);
                                            $fantastic_ans_percent = ($fantastic_count->ans_count * 100 / $total_ans_count);
                                        }


                                        $answer_array[] = array($year_data, $tarrible_ans_percent, $poor_ans_percent, $good_ans_percent, $great_ans_percent, $fantastic_ans_percent);
                                    }

                                    $star_rating_bar_chart_label = json_encode($answer_array);
                                    ?>
                                    @if (!in_array($form_id, $checkArray))
                                    <div class="col-md-6 col-sm-6 col-xs-12">

                                        <script type="text/javascript">
                                            google.charts.load('current', {'packages': ['bar']});
                                            google.charts.setOnLoadCallback(drawChart);

                                            function drawChart() {
                                                var data = google.visualization.arrayToDataTable(
                <?php echo $star_rating_bar_chart_label; ?>
                                                );

                                                var options = {
                                                    chart: {
                                                        title: '<?php echo $survey_form->survey_question; ?>',
                                                        subtitle: 'Report in percentage',
                                                    }
                                                };

                                                var chart = new google.charts.Bar(document.getElementById('columnchart_material_<?php echo $survey_form->id; ?>'));

                                                chart.draw(data, google.charts.Bar.convertOptions(options));
                                            }
                                        </script>
                                        <div class="x_panel">
                                            <div class="x_content">
                                                <div id="columnchart_material_<?php echo $survey_form->id; ?>" style="width: 100%; min-height: 400px; margin: 0 auto"></div>
                                            </div>
                                        </div>

                                    </div>
                                    @endif
                                <?php } ?>
                                <?php
                            }
                        }
                    } else {
                        ?>
                        <div style="text-align:center;color:#f00;font-size:22px;">No Record available.</div>
                    <?php } ?>
                @else
                <!-- pie chart begin -->
                <div class="row">
            <?php
            //if(count($participant_id)>0){
            $chart_pie = array();
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

                        foreach ($answer_array['answer_value'] as $ans_value) {
                            $answer_count = CommonHelper::getAnswerCount($survey_form->id, $year = $survey_form->created_at->year, $ans_value, $participant_id = "");

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

                        $chart_label = json_encode($chart_pie);
                        ?>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <script type="text/javascript">
            $(document).ready(function () {
            var chart = {
            type: 'pie',
            options3d: {
            enabled: true,
            alpha: 25,
            beta: 0
            }
            };
            var title = {
            text: '<?php echo $survey_form->survey_question; ?>'
            };
            var tooltip = {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            };
            var plotOptions = {
            pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 45,

            dataLabels: {
                enabled: true,
                format: '{point.name}'
            },
            showInLegend: true
            }
            };
            var series = [{
            type: 'pie',
            name: 'Avarage Survey Report',
            data: <?php echo $chart_label; ?>
            }];
            var json = {};
            json.chart = chart;
            json.title = title;
            json.tooltip = tooltip;
            json.plotOptions = plotOptions;
            json.series = series;
            $('#chart_container_<?php echo $survey_form->id; ?>').highcharts(json);
            });
                            </script>

                            <div class="x_panel">
                                <div class="x_content">
                                    <div id="chart_container_<?php echo $survey_form->id; ?>" style="width: 100%; height: auto; margin: 0 auto"></div>
                                </div>
                            </div>
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

                        $checkbox_chart_label = json_encode($chart_pie);
                        ?>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    var chart = {
                                        type: 'pie',
                                        options3d: {
                                            enabled: true,
                                            alpha: 25,
                                            beta: 0
                                        }
                                    };
                                    var title = {
                                        text: '<?php echo $survey_form->survey_question; ?>'
                                    };
                                    var tooltip = {
                                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                    };
                                    var plotOptions = {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            depth: 45,

                                            dataLabels: {
                                                enabled: true,
                                                format: '{point.name}'
                                            },
                                            showInLegend: true
                                        }
                                    };
                                    var series = [{
                                            type: 'pie',
                                            name: 'Avarage Survey Report',
                                            data: <?php echo $checkbox_chart_label; ?>
                                        }];
                                    var json = {};
                                    json.chart = chart;
                                    json.title = title;
                                    json.tooltip = tooltip;
                                    json.plotOptions = plotOptions;
                                    json.series = series;
                                    $('#chart_container_<?php echo $survey_form->id; ?>').highcharts(json);
                                });
                            </script>

                            <div class="x_panel">
                                <div class="x_content">
                                    <div id="chart_container_<?php echo $survey_form->id; ?>" style="width: 100%; height: auto; margin: 0 auto"></div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }

                    if ($survey_form->question_type == 5) {

                        $total_result_count = CommonHelper::getTotalAnswer($survey_form->id, $form_id, $participant_id = "");
                        $answer_array = array('1' => 'Terrible', '2' => 'Poor', '3' => 'Good', '4' => 'Great', '5' => 'Fantastic');

                        $i = 0;

                        foreach ($answer_array as $key => $ans_value) {
                            $answer_count = CommonHelper::getStarRatingAnswerCount($survey_form->id, $year =$survey_form->created_at->year , $key, $participant_id = "");
                            

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

                        $star_rating_chart_label = json_encode($chart_pie);
                        ?>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    var chart = {
                                        type: 'pie',
                                        options3d: {
                                            enabled: true,
                                            alpha: 25,
                                            beta: 0
                                        }
                                    };
                                    var title = {
                                        text: '<?php echo $survey_form->survey_question; ?>'
                                    };
                                    var tooltip = {
                                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                    };
                                    var plotOptions = {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            depth: 45,

                                            dataLabels: {
                                                enabled: true,
                                                format: '{point.name}'
                                            },
                                            showInLegend: true
                                        }
                                    };
                                    var series = [{
                                            type: 'pie',
                                            name: 'Avarage Survey Report',
                                            data: <?php echo $star_rating_chart_label; ?>
                                        }];
                                    var json = {};
                                    json.chart = chart;
                                    json.title = title;
                                    json.tooltip = tooltip;
                                    json.plotOptions = plotOptions;
                                    json.series = series;
                                    $('#chart_container_<?php echo $survey_form->id; ?>').highcharts(json);
                                });
                            </script>

                            <div class="x_panel">
                                <div class="x_content">
                                    <div id="chart_container_<?php echo $survey_form->id; ?>" style="width: 100%; height: auto; margin: 0 auto"></div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            ?>

        </div>
                ?>
                @endif  
                </div> <!--end row div-->

                <div class="" id="question_answer" style="margin-top: 4%">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Question Type Text Answers<small>List</small></h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width:5%" class="text-center">S.No</th>
                                            <th class="text-center">Question</th>
                                            <th class="text-center">Participant Name</th>
                                            <th class="text-center">Mobile Number</th>
                                            <th class="text-center">Answer</th>
                                            <th class="text-center">Created Date</th>
                                            <th class="text-center">Updated Date</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
         @endif
        </div>
        <!-- /page content -->
        
    </div>
</div>

<style>
    #choose_question{color:black;}
</style>
@stop
{{-- page level scripts --}}
@section('footer_scripts')

<script src="{{asset('resources/assets/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('resources/assets/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('resources/assets/gentelella/vendors/bootbox/bootbox.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.11/handlebars.min.js"></script>
<style>.modal-title{text-align: center;line-height:54px;}.option_val {margin-left: 40px;}</style>
<script type="text/javascript">
                                    var dataTable;
                                    var lastQuestion = '';
                                    var columns = [
                                        {data: 'rownum', name: 'rownum'},
                                        {data: 'question', name: 'question'},
                                        {data: 'participant_name', name: 'participant_name'},
                                        {data: 'mobile', name: 'mobile'},
                                        {data: 'answer', name: 'answer'},
                                        {data: 'created_at', name: 'created_at'},
                                        {data: 'updated_at', name: 'updated_at'},
                                    ];
                                    var ajaxUrl = "{!! route('get_question_answer_dashbaord', $survey_form_id) !!}" //Url of ajax datatable where you fetch data


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
                                            "class": "text-left",
                                            "render": function (data, type, full, meta) {
                                                //if (lastQuestion != full['survey_question']) {
                                                    lastQuestion = full['survey_question'];
                                                    return full['survey_question'];
                                               // }
                                               // lastQuestion = full['survey_question'];
                                                //return '';
                                            },
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
                                            "orderable": false,
                                            "class": "text-center"
                                        },
                                        {
                                            "targets": 5,
                                            "orderable": false,
                                            "class": "text-center"
                                        },
                                    ];

                                    $(document).ready(function () {
                                        $('#gifImage').css('display', 'block');
                                        zingchart.THEME = "";
                                        var url = '{{route("get_kpi_report_detials")}}';
                                        var form_id = $('#survey_form').val();
                                        $('#survey_form_id').val(form_id);
                                        $.ajax({
                                            url: url,
                                            type: 'GET',
                                            data: {form_id: form_id},
                                            dataType: 'json',
                                            success: function (resp) {
                                                $('#gifImage').css('display', 'none');
                                                if (resp) {
                                                    $('#choose_question_above').html('');
                                                    $('#choose_question').html('');
                                                    if (resp['survey_form'].length == 0) {
                                                        console.log('trst');
                                                        $('#choose_question').html('<div class=""><span class="noRecord" style=" position: relative; width: 100%; float: left; margin-bottom: 20px; margin: 16px 0;">No record found!</span></div>');
                                                    }
                                                    var sum = 0;
                                                    for (var i = 0; i < resp['survey_form'].length; i++) {

//remove zingchar powered by
                                                        setTimeout(function () {
                                                            for (var i = 0; i < resp['survey_form'].length; i++) {
                                                                $('#chart_div_' + i + '-license-text').css('display', 'none');
                                                            }
                                                        }, 3000);


                                                        zingchart.exec('chart_div_' + i, 'destroy');

                                                        var min = resp['survey_form'][i].minimum_value;
                                                        var max = resp['survey_form'][i].maximum_value;

//devide values for colour
                                                        var t = resp['survey_form'][i].maximum_value / 3;
                                                        var r1 = 0;
                                                        var r2 = r1 + t;
                                                        var y1 = r2;
                                                        var y2 = y1 + t;
                                                        var g1 = y2;
                                                        var g2 = g1 + t;


                                                        var myConfig = {
                                                            "graphset": [
                                                                {
                                                                    "type": "gauge",
                                                                    "background-color": "#fff #eee",
                                                                    "plot": {
                                                                        "background-color": "#666"
                                                                    },
                                                                    "plotarea": {
                                                                        "margin": "0 0 0 0"
                                                                    },
                                                                    "scale": {
                                                                        "size-factor": 0.70,
                                                                        "offset-y": 30
                                                                    },
                                                                    "tooltip": {
                                                                        "background-color": "black"
                                                                    },
                                                                    "scale-r": {
                                                                        "values": min + ":" + max,
                                                                        "border-color": "#b3b3b3",
                                                                        "border-width": "1",
                                                                        "background-color": "#eeeeee,#b3b3b3",
                                                                        "ring": {
                                                                            "size": 5,
                                                                            "offset-r": "30px",
                                                                            "rules": [
                                                                                {
                                                                                    "rule": "%v >=" + r1 + " && %v < " + r2 + "",
                                                                                    "background-color": "red"
                                                                                },
                                                                                {
                                                                                    "rule": "%v >= " + y1 + " && %v < " + y2 + "",
                                                                                    "background-color": "yellow"
                                                                                },
                                                                                {
                                                                                    "rule": "%v >= " + g1 + " && %v < " + g2 + "",
                                                                                    "background-color": "green"
                                                                                },
                                                                            ]
                                                                        }
                                                                    },
                                                                    "labels": [

                                                                        {
                                                                            "id": "lbl2",
                                                                            "x": "35%",
                                                                            "y": "75%",
                                                                            "width": 30,
                                                                            "offsetX": 70,
                                                                            "textAlign": "center",
                                                                            "padding": 10,
                                                                            "anchor": "c",
                                                                            "text": "High",
                                                                            "backgroundColor": "green",
                                                                            "tooltip": {
                                                                                "padding": 10,
                                                                                "backgroundColor": "green",
                                                                                "text": "> " + g1.toFixed(2) + " < " + g2.toFixed(2) + "<br>Units",
                                                                                "shadow": 0
                                                                            }
                                                                        },
                                                                        {
                                                                            "id": "lbl3",
                                                                            "x": "40%",
                                                                            "y": "75%",
                                                                            "width": 40,
                                                                            "offsetX": 25,
                                                                            "textAlign": "center",
                                                                            "padding": 10,
                                                                            "anchor": "c",
                                                                            "text": "Medium",
                                                                            "backgroundColor": "yellow",
                                                                            "tooltip": {
                                                                                "padding": 10,
                                                                                "backgroundColor": "yellow",
                                                                                "text": "> " + y1.toFixed(2) + " < " + y2.toFixed(2) + "<br>Units",
                                                                                "shadow": 0
                                                                            }
                                                                        },
                                                                        {
                                                                            "id": "lbl4",
                                                                            "x": "35%",
                                                                            "y": "75%",
                                                                            "width": 30,
                                                                            "offsetX": 2,
                                                                            "textAlign": "center",
                                                                            "padding": 10,
                                                                            "anchor": "c",
                                                                            "text": "Low",
                                                                            "backgroundColor": "red",
                                                                            "tooltip": {
                                                                                "padding": 10,
                                                                                "backgroundColor": "red",
                                                                                "text": "> " + r1.toFixed(2) + " < " + r2.toFixed(2) + "<br>Units",
                                                                                "shadow": 0
                                                                            }
                                                                        },
                                                                    ],


                                                                    "series": [
                                                                        {
                                                                            "values": [resp.final_value[i].avg],
                                                                            "animation": {
                                                                                "method": 5,
                                                                                "effect": 2,
                                                                                "speed": 2500
                                                                            }
                                                                        }
                                                                    ],
                                                                    "alpha": 1
                                                                }
                                                            ]};

                                                        sum += resp['final_value'][i].totle_kpi_count;
                                                        
                                                        
                                        $('#choose_question').append('<div class="col-md-3 col-sm-12 col-xs-12 middle_text" style=" margin-bottom:20px;" id="chart_div_' + i + '"><span class="ami">'+ resp['survey_form'][i].kpi_name + '<br>' + resp['survey_form'][i].name + ''  +
                                                            ( resp['survey_form'][i].type_name != null ? ', ' +  resp['survey_form'][i].type_name + '' : '' ) +
                                                             ( resp['survey_form'][i].group_name != null ?   ', '  + resp['survey_form'][i].group_name +'' : '') + 
                                                             (resp['survey_form'][i] .category_name ? ', '+ resp['survey_form'][i] .category_name : '' ) 
                                                             + '</span>'+'<span class="sent">Sent :' + resp['survey_form'][i].sent + '  Response:' + resp['survey_form'][i].response + ' </span></div>'
                                                            
                                                            );
                                                            
                                                            //14/09/2018
                                                        // $('#choose_question').append('<div class="col-md-3 col-sm-12 col-xs-12" style=" margin-bottom:20px;" id="chart_div_' + i + '"><span class="ami">User Name: ' + resp['survey_form'][i].name + '<br> KPI Name : ' + resp['survey_form'][i].kpi_name + '<br>' +
                                                        //     ( resp['survey_form'][i].type_name != null ?  ' Type Name : ' + resp['survey_form'][i].type_name + '<br>' : '' ) +
                                                        //      ( resp['survey_form'][i].group_name != null ?   'Group Name : ' + resp['survey_form'][i].group_name +'<br>' : '') + 
                                                        //      (resp['survey_form'][i] .category_name ? 'Category Name : '+ resp['survey_form'][i] .category_name : '' ) 
                                                        //      + '</span>'+'<span class="sent">sent :' + resp['final_value'][i].sent_value + '   <br>response:' + resp['final_value'][i].resp_value + ' </span></div>'
                                                            
                                                        //     );
                                                        // '<br>Star Ratting Sum : ' + resp['final_value'][i].star_sum + '<br>Radio Button Sum : ' + resp['final_value'][i].radio_sum + '<br>CheckBox Sum : ' + resp['final_value'][i].check_sum + 

                                                        zingchart.render({
                                                            id: 'chart_div_' + i,
                                                            data: myConfig,
                                                        });
                                                    }
                                                    // var kpiSum = 'KPI TOTLE : ' + sum;

                                                    $('#choose_question_above').append('<span class="amis">' );
                                                    //+ kpiSum
                                                }
                                            }
                                        });
                                    });
</script>   
@include('datatable.dt_js')  
@stop
