@extends('layout.admin')
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')

@stop
{{-- Page content --}}
@section('inner_body')

<?php
$title = __('message.survey_details');
?>

<div class="breadcrumb">
    <h1>{{$title}}</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="card mb-4">
            <?php if (!$form_data->isEmpty()) { ?>
            <div class="card-header bg-transparent">
                <h3 class="card-title">{{__('message.form_name')}} :
                    <?php echo $form_details->survey_form_title; ?><br />{{__('message.form_submitted_date')}} :
                    <?php echo date('d-m-Y', strtotime($form_details->created_at)); ?> <p class="float-right"> <img
                            style="height:50px;"
                            src="<?php echo url('/') . "/" . $form_details->survey_form_logo; ?>" /></p>
                </h3>
            </div>
            <div class="card-body ">
                <div class="col-sm-12">
                    <div class="accordion" id="accordionRightIcon">
                        <!-- to show the radio, text ,star rating question and answers-->
                        <?php if (!$form_data->isEmpty()) { ?>
                        @foreach ($form_data as $key => $row)
                        <?php if ($row->question_type == 1) { ?>
                        <div class="card ul-card__v-space">
                            <div class="card-header ">
                                <h6 class="card-title mb-0">
                                    <a class="text-default">{{__('message.question')}} :
                                        <?php echo $row->survey_question; ?></a>
                                </h6>
                            </div>
                            <div class="collapse show" style="">
                                <div class="card-body">
                                    {{__('message.answer')}} : <?php echo $row->survey_answer; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                                }
                                if ($row->question_type == 3) {
                                    $d = unserialize($row->answer);
                                    ?>
                        <div class="card ul-card__v-space">
                            <div class="card-header ">
                                <h6 class="card-title mb-0">
                                    <a class="text-default">{{__('message.question')}} :
                                        <?php echo $row->survey_question; ?></a>
                                </h6>
                            </div>
                            <div class="collapse show" style="">
                                <div class="card-body">
                                    {{__('message.answer')}} : <?php echo $d['answer'][0]; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                                }

                                if ($row->question_type == 4) {
                                    $d = unserialize($row->answer);
                                    ?>
                        <div class="card ul-card__v-space">
                            <div class="card-header ">
                                <h6 class="card-title mb-0">
                                    <a class="text-default">{{__('message.question')}} :
                                        <?php echo $row->survey_question; ?></a>
                                </h6>
                            </div>
                            <div class="collapse show" style="">
                                <div class="card-body">
                                    {{__('message.answer')}} : <?php echo $d['answer'][0]; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                                }
                                if ($row->question_type == 5) {
                                    ?>
                        <div class="card ul-card__v-space">
                            <div class="card-header ">
                                <h6 class="card-title mb-0">
                                    <a class="text-default">{{__('message.question')}} :
                                        <?php echo $row->survey_question; ?></a>
                                </h6>
                            </div>
                            <div class="collapse show" style="">
                                <div class="card-body">
                                    {{__('message.answer')}} : <?php echo $row->start_rating_answer; ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        @endforeach
                        <?php } ?>



                        <?php if (!$form_data_check_box->isEmpty()) { ?>
                        <?php $i = 1; ?>
                        @foreach ($form_data_check_box as $key => $row)
                        <div class="card ul-card__v-space">
                            <?php if ($i == 1) { ?>
                            <div class="card ul-card__v-space">
                                <div class="card-header ">
                                    <h6 class="card-title mb-0">
                                        <a class="text-default">{{__('message.question')}} :
                                            <?php echo $row->survey_question; ?></a>
                                    </h6>
                                </div>
                                <?php } ?>

                                <?php if ($i == 1) { ?>
                                <div class="collapse show" style="">
                                    <div class="card-body">
                                        {{__('message.answer')}} : <?php echo $row->check_box_ans . '.'; ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <?php $i++; ?>
                            @endforeach
                            <?php } ?>
                            <!-- to show the checkbox question and answers-->
                        </div>
                    </div>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <?php } else { ?>
                <div class="questions_data">
                    <b>{{__('message.no')}} {{__('message.survey')}} {{__('message.details')}}
                        {{__('message.found')}}!</b>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    @stop
    {{-- page level scripts --}}
    @section('footer_scripts')
    @stop