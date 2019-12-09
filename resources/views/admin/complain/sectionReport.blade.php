<div class="">
    <?php
            $month = Session::get('select_chart_by') == 1 ? 'month' : 'year';
            $m = Session::get('select_chart_by') == 1 ? 'm' : 'Y';
            $year_month_value = Session::get('select_chart_by') == 1 ? 11 : 5;
            $userBar = [];
            if (count($userRoles) > 0) {
                $chart_bar = array();
                $tempBar = array();
                foreach ($data as $key => $user) { 
                    $all_average = [];
                    foreach ($userRoles as $key => $value) {
                        $role_id = $value->id;
                        
                        $total_result_count = FeedbackHelper::getTotalRole($role_id,$user_id,$city,$created_from,$created_to);
                            //this section is for date filter
                            $start_number = 0;
                            $tp = 'm';
                            $inc_dec  = '-';
                        if($time_period == 'last_14_day'){
                            $start_number = 0;
                            $year_month_value = 13;
                            $m=date('Y-m-d');
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = '-';
                            $year = array();
                            if(count($year) == 0 ){
                                for($i = 0; $i <= 13; $i++){
                                    $year[] = date('m/d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'this_week') {
                            for($i = 0; $i <= 6; $i++){
                            $x = date('Y-m-d',strtotime("-".$i."day"));
                            
                            if(date('D',strtotime($x)) == 'Mon')
                                break;
                            }
                            $start_number = 0;
                            $year_month_value = 6;
                            $m=$x;
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= 6; $i++){
                                    $year[] = date('Y-m-d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'last_week') {
                            for($i = 0; $i <= 6; $i++){
                            $first_of_week = date('Y-m-d',strtotime("-".$i."day"));
                            
                            if(date('D',strtotime($first_of_week)) == 'Mon')
                                break;
                            }
                            $start_number = 0;
                            $year_month_value = 6;
                            $m= date('Y-m-d',strtotime($first_of_week."-7"."day"));
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= 6; $i++){
                                    $year[] = date('Y-m-d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }

                        }elseif ($time_period == 'this_month') {
                            $first_of_month = date('Y-m-d',strtotime(date('Y-m-01')));
                            
                            $start_number = 0;
                            $year_month_value = date('t');
                            $m= $first_of_month;
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i < $year_month_value; $i++){
                                    $year[] = date('d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'last_month') {
                            $first_of_month = date('Y-m-d',strtotime(date('Y-m-01')."-1 month"));
                            $days = cal_days_in_month(CAL_GREGORIAN, date('m',strtotime("-1 month")), date('Y'));
                            
                            $start_number = 0;
                            $year_month_value = $days;
                            $m= $first_of_month;
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i < $year_month_value; $i++){
                                    $year[] = date('d',strtotime($m.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'last_year') {
                            $first_month_last_year = date('Y-m-d',strtotime(date('Y-01-d')."-1 year"));
                            
                            $start_number = 0;
                            $year_month_value = 11;
                            $m = date("Y/01/01",strtotime("-1 year"));
                            $month = 'month';
                            $tp = 'm';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('m/Y',strtotime(date("Y/01/01",strtotime("-1 year")).$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'today') {

                            $start_number = 0;
                            $year_month_value = 0;
                            $m = date('Y-m-d');
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('d/m',strtotime('d'.$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'yesterday') {
                            $start_number = 0;
                            $year_month_value = 0;
                            $m = date('Y-m-d',strtotime("-1 day"));
                            $month = 'day';
                            $tp = 'Y-m-d';
                            $inc_dec = "-";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('d/m',strtotime(date('Y-m-d',strtotime("-1 day")).$inc_dec.$i . $month));
                                }
                            }
                        }elseif ($time_period == 'specific_date') {
                            $first_month_year = date('Y-m-d',strtotime(date('Y-01-d')));

                            $start_number = 1;
                            $year_month_value = 12;
                            $m = 'm';
                            $month = 'month';
                            $tp = 'm';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('m/Y',strtotime(date("Y/01/01").$inc_dec.$i . $month));
                                }
                            }
                        }else {

                            $first_month_year = date('Y-m-d',strtotime(date('Y-01-d')));

                            $start_number = 0;
                            $year_month_value = 11;
                            $m = $first_month_year;
                            $month = 'month';
                            $tp = 'm';
                            $inc_dec = "+";
                            $year = array();

                            if(count($year) == 0 ){
                                for($i = 0; $i <= $year_month_value; $i++){
                                    $year[] = date('m/Y',strtotime(date("Y/01/01").$inc_dec.$i . $month));
                                }
                            }
                        }
                            $i = 1;
                            // for ($y = $year_month_value; $y >= 0; $y--) {
                                // $year_data = date($m, strtotime("-" . $y . $month));
                                $user_total_count = [];
                                $user_total_sum = [];
                            for ($y = $start_number; $y <= $year_month_value; $y++) {
                                if($time_period == 'specific_date'){
                                    // $year_data = date($m, strtotime("-" . $y . $month));
                                    $year_data = $y;
                                }else{
                                    $year_data = date($tp, strtotime($m.$inc_dec.$y . $month));    
                                }
                                $user_count = FeedbackHelper::getRoleCount($year_data, $role_id,$created_from,$created_to,$time_period);

                                $user_ans_percent = 0;
                                // $user_rating_sum = 0;
                                if (count($total_result_count) > 0) {
                                    $total_ans_count = count($total_result_count);
                                    // $tarrible_ans_percent = ($tarrible_count->ans_count * 100 / $total_ans_count);
                                    // $user_rating_sum = $user_count->rating_sum;
                                    $user_ans_percent = $user_count->ans_count;
                                }

                                $user_total_count[] = round($user_ans_percent);
                                // $user_total_sum[] = round($user_rating_sum);
                                
                                // $year[] = $year_data;
                            }
                            $total_count = array_sum($user_total_count) != 0 ? array_sum($user_total_count) : 1;
                            // $total_sum = array_sum($user_total_sum);
                            $average = array_sum($user_total_count) != 0 ? $total_count : 0 ;

                            
                            $all_average[] = array($value->role,$average,array_sum($user_total_count));
                            $userName[] = $value->role.'('.array_sum($user_total_count).')';
                            $tempBar[] = 0;
                            $userBar[] = round($average,1);
                        }
                        // dd($tempChek);  
                        $year = json_encode($userName);
                        $userBar = json_encode($userBar);
                        $barChart = [];
                        foreach ($all_average as $key => $value) {
                            for ($i=0; $i < count($tempBar); $i++) { 
                                $barChart[$key]['name'] = $value[0];
                                $barChart[$key]['response'] = $value[2];
                                if($key == $i){
                                    $barChart[$i]['value'][] = $value[1];
                                }else{
                                    
                                    $barChart[$i]['value'][] = 0;
                                }
                            }
                        }
                        $rolePie = [];
                        foreach ($all_average as $key => $value) {
                            $rolePie[$key]['value'] = $value[1];
                            $rolePie[$key]['name'] = $value[0];
                        }
                        $rolePie = json_encode($rolePie);
                            ?>
    @if(Session::get('select_chart_type') == 1)
    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4 text-center">
        <div class="x_panel">
            <div class="x_content">
                <h3 class="text-center m-0 p-2">{{__('message.complain_section_report')}}</h3>
                <div class="col-sm-12">
                    <div id="complain_section_<?php echo $complain1->id; ?>"
                        style="width: 100%; min-height: 400px; margin: 0 auto"></div>
                    <button class="btn btn-primary mb-3" style="width: 20%;margin: 0 auto;"
                        onclick="printChart('complain_section_<?php echo $complain1->id; ?>','Complain Chart','{{array_sum($response_array)}}')">{{__('message.print')}}
                        !</button>
                    <div class="append_filter"></div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            let section_pie_<?php echo $complain1->id; ?> = document.getElementById('complain_section_<?php echo $complain1->id; ?>');
                                        if (section_pie_<?php echo $complain1->id; ?>) {
                                            let complain_pie = echarts.init(section_pie_<?php echo $complain1->id; ?>);
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
                                                        data: <?php echo $rolePie; ?> ,
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
        <script type="text/javascript">
            $(document).ready(function () {
                        // Chart in Dashboard version 1
                            var echartElemBar = document.getElementById('columnchart_material_');
                            if (echartElemBar) {
                                var echartBar = echarts.init(echartElemBar);
                                echartBar.setOption({
                                    legend: {
                                        borderRadius: 0,
                                        orient: 'horizontal',
                                        x: 'right',
                                        data: ['user']
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
                                    xAxis: [
                                        {
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
                                        },
                                        
                                    }
                                    ],
                                    yAxis: [{
                                        type: 'value',
                                        axisLabel: {
                                            formatter: '{value}'
                                        },
                                        min: 0,
                                        max: 5,
                                        interval:1,
                                        axisLine: {
                                            show: false
                                        },
                                        splitLine: {
                                            show: true,
                                            interval: 'auto'
                                        }
                                    }],
                                    series: [
                                        {
                                        name: 'user',
                                        data: <?php echo $userBar; ?>,
                                        label: { show: false, color: '#0168c1' },
                                        type: 'bar',
                                        barWidth: '10%',
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
                                    },
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
            <h3 class="p-2" id="title_columnchart_material_">{{__('message.complain_section_report')}}
            </h3>
            <div id="columnchart_material_" class="p-3" style="height: 300px;"></div>
            <div class="append_filter"></div>
            <button class="btn btn-primary mb-3" style="width: 20%;margin: 0 auto;"
                onclick="printChart('columnchart_material_','User Chart','none')">{{__('message.print')}}
                !</button>
        </div>
    </div>
    @endif
    <?php
    }
} else {
    ?>
    <div style="text-align:center;color:#f00;font-size:22px;">{{__('message.no_record_found')}}</div>
    <?php } ?>
</div>