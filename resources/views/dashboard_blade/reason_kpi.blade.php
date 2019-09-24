<!-- start Compain KPI Report here -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <h3 class="text-center m-0 mb-3 p-2">{{__('message.reason_kpi_report')}}</h3>
            <div class="text-center">
                <input type="hidden" id="survey_form" name="survey_form"
                    value="<?php echo!empty($survey_form_id) ? $survey_form_id : '1' ?>">
                <div class="spinner-bubble spinner-bubble-primary m-10" id="gifImage" style="display: none;"></div>
                <div id="printableArea">
                    <div id="showList"></div>
                    <div id="choose_reason_above" class="col-md-12 col-sm-12 col-xs-12"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div id="choose_reason" class="table-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
           
            reasonChart();
            function reasonChart() {
                
                $('#gifImage').css('display', 'block');
                zingchart.THEME = "";
                var url = '{{route("get_kpi_report")}}';
                var form_id = $('#survey_form').find(":selected").val();
                $('#survey_form_id').val(form_id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: '',
                    dataType: 'json',
                    success: function (resp) {
                         // console.log(resp);
                         
                    $('#gifImage').css('display', 'none');
                    if (resp) 
                    {
                        $('#choose_reason_above').html('');
                        $('#choose_reason').html('');
    
                        if (resp['reason_count'].length == 0) {
                            
                            var sum = 0;
                            $('#choose_reason').html('<div class="col-md-12 col-sm-12 col-xs-12"><span style="width: 100%;float: left; position: relative;    margin: 10px 0px;font-size: 22px; color: red;"{{__('message.no_record_found')}}</span></div>');
                        }else
                        {
                            var sum = 0;
                            for (var i = 0; i < resp['reason_count'].length; i++) {
    
                                //remove zingchar powered by
                                setTimeout(function () {
                                    for (var i = 0; i < resp['reason_count'].length; i++) {
                                        $('#reason_div_' + i + '-license-text').css('display', 'none');
                                    }
                            }, 3000);
                                $('#choose_reason').append(' <table class="table" style="width: 50%; float: left;"> <tr> <td style="border-top:none;"> <div class="text-center card card-icon-bg card-icon-bg-primary o-hidden pb-2"> <div style="height: 400px;"> <h3 class="p-2 text-16">{{__('message.reason')}}: '+ resp['reason_count'][i].feedback_reason +'</h3> <div class="col-md-12 col-sm-12 col-xs-12" id="reason_div_' + i + '" style="height: 400px;"></div></div><div class="col-md-12"> <p class="text-16 mt-1 mb-1 text-center"><b>{{__('message.no_of_responses')}}: </b> '+ resp.reason_value[i][0] +'</p></div></div></td></tr></table>');
                                let gaugeChartElem = document.getElementById('reason_div_' + i);
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
                                            name: status,
                                            type: 'gauge',
                                            min: 0,
                                            max: resp['reason_count'].maximum_value,
                                            splitNumber: 5,
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
                                                value: resp.reason_value[i][0],
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
                                //end here
                            }
                        }
                        //var kpiSum = ' ';
    
                        $('#choose_reason_above').append('<span class="">');
                    }
                }
            });
        }
    });
</script>