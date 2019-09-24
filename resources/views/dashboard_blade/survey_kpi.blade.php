<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
        <h3 class="text-center m-0 p-2">
            @if(!empty($survey_form_title))
            {{ $survey_form_title }}
            @else
            {{__("message.survey")}} {{__("message.form")}}
            @endif
        </h3>
        <div class="text-center">
            <input type="hidden" id="survey_form" name="survey_form"
                value="<?php echo!empty($survey_form_id) ? $survey_form_id : '1' ?>">
            <div class="spinner-bubble spinner-bubble-primary m-10" id="gifImage" style="display: none;"></div>
            {{-- <div id="choose_question_above"></div> --}}
            <div id="choose_question" class="col-md-12 col-sm-12 col-xs-12 inner_text_center"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
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
                    console.log(resp)
                    $('#choose_question_above').html('');
                    $('#choose_question').html('');
                    if (resp['survey_form'].length == 0) {
                        console.log('trst');
                    $('#choose_question').html('<div class="col-md-12 col-sm-12 col-xs-12"><span style="width: 100%;float: left; position: relative;margin: 10px 0px;font-size: 22px; color: red;">{{__('message.no_record_found')}}</span></div>');
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

                        $('#choose_question').append(' <table class="table" style="width: 50%; float: left;"> <tr> <td style="border-top:none;"> <div class="text-center card card-icon-bg card-icon-bg-primary o-hidden pb-2 "> <div style="height: 400px;"> <h3 class="p-2 text-18"> {{__('message.kpi_name')}} : '+resp['survey_form'][i].kpi_name+'</h3> <div class="col-md-12 col-sm-12 col-xs-12" style="height: 400px;" id="chart_div_' + i + '"></div></div><div class="row"> <div class="col-md-6 col-6 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.no_of_sent')}}:</b> '+ resp['survey_form'][i].sent +'</p></div><div class="col-md-6 col-6 text-center"> <p class="text-14 mt-1 mb-1"><b>{{__('message.no_of_responses')}}:</b> '+ resp['survey_form'][i].response +'</p></div></div></div></td></tr></table>');

                            let gaugeChartElem = document.getElementById('chart_div_' + i);
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
                                        name: resp['survey_form'][i].kpi_name,
                                        type: 'gauge',
                                        min: 0,
                                        max: 5,
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
                                            value: resp.final_value[i].avg,
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
                    // var kpiSum = 'KPI TOTLE : ' + sum;

                    $('#choose_question_above').append('<span class="amis">' );
                    //+ kpiSum
                }
            }
        });
    });
</script>