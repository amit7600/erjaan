<!-- start Compain KPI Report here -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <h3 class="text-center m-0 mb-3 p-2">{{__('message.complain_kpi_report')}}</h3>
            <div class="text-center">
                <input type="hidden" id="survey_form" name="survey_form"
                    value="<?php echo!empty($survey_form_id) ? $survey_form_id : '1' ?>">
                <div class="spinner-bubble spinner-bubble-primary m-10" id="gifImage" style="display: none;"></div>
                <div id="complain_kpi_count" class="col-md-12 col-sm-12 col-xs-12"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div id="complain_kpi" class="table-responsive">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end Compain KPI Report here -->
<script type="text/javascript">
    $(document).ready(function () {
            // $('#survey_form').on('change',function(){
            //     var id = $('#survey_form').val()
            //     drawChart(id)
            // })
            complain_kpi();
            function complain_kpi() {
                
                $('#gifImage').css('display', 'block');
                zingchart.THEME = "";
                var url = '{{route("get_complain_report")}}';
                var form_id = $('#survey_form').find(":selected").val();
                $('#survey_form_id').val(form_id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: '',
                    dataType: 'json',
                    success: function (resp) {
                        // console.log(resp)
                        // return false;
                        $('#gifImage').css('display', 'none');
                        if (resp) {
                            $('#complain_kpi_count').html('');
                            $('#complain_kpi').html('');
    
                            if (resp['compalin_count'].maximum_value == 0) {
                                
                                var sum = 0;
                                $('#complain_kpi').html('<div class="col-md-12 col-sm-12 col-xs-12"><span style="width: 100%;float: left; position: relative;margin: 10px 0px;font-size: 22px; color: red;">"{{__('message.no_record_found')}}"</span></div>');
                            }else{
                            var sum = 0;
                            for (var i = 0; i < resp['compalin_count'].length; i++) {
    
                                //remove zingchar powered by
                                setTimeout(function () {
                                    for (var i = 0; i < resp['compalin_count'].length; i++) {
                                        $('#complain_div_' + i + '-license-text').css('display', 'none');
                                    }
                                }, 3000);
    
    
                                
                                
                                if(i == 0 ){
                                var status = resp['compalin_count'][i][0] != undefined ? resp['compalin_count'][i][0].status : '{{__('message.new')}}';
    
                                }
                                if(i == 1){
                                var status = resp['compalin_count'][i][0] != undefined ? resp['compalin_count'][i][0].status : '{{__('message.inProgress')}}';
    
                                }
                                if(i == 2){
    
                                var status = resp['compalin_count'][i][0] != undefined ? resp['compalin_count'][i][0].status : '{{__('message.resolved')}}';
                                }
                                if(i == 3){
                                var status = resp['compalin_count'][i][0] != undefined ? resp['compalin_count'][i][0].status : '{{__('message.late')}}';
    
                                }
    
                                $('#complain_kpi').append(' <table class="table" style="width: 50%; float: left;"> <tr> <td> <div> <h3 class="p-2 text-16"> {{__('message.status')}} : '+ status +'</h3> </div><div class="col-md-12 col-sm-12 col-xs-12" style="height: 400px;" id="complain_div_' + i + '"></div><div class="col-sm-12"> <div class="row"> <div class="col-md-12"> <p class="text-16 mt-1 mb-1 text-center"><b>{{__('message.responses')}}:</b> '+ resp['compalin_count'][i].length +'</p></div></div></div></td></tr></table>');
    
    
                                let gaugeChartElem = document.getElementById('complain_div_' + i);
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
                                            max: resp['compalin_count'].maximum_value,
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
                                                value: resp.status_count[i],
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
                            //var kpiSum = 'KPI TOTLE : ' + sum;
    
                            $('#complain_kpi_count').append('<span class="">');
                        }
                    }
                });
            }
        });
</script>