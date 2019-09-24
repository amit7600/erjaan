<style type="text/css">
    .myoption{ 
        border: 1px solid #cccccc;
        height: 24px;
        padding: 3px;
        margin-top: 1%;
    }
</style>

@extends('layout.admin',['image'=>$image])
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
//expload category function values
if (!empty($repairman_data)) {
    $r = $repairman_data->function_category;
    $ids = explode(',', $r);

//    echo '<pre>';
//    print_r($ids);die;
}




$title = "Create Survey Question";
$action = route('surveyquestion.store');
$method = "";
$image = "";
$button = "Save";
$edit = false;
if (!empty($repairman_data->id)) {
    $edit = true;
    $title = "Edit Survey Question";
    $action = route('surveyquestion.update', $repairman_data->id);
    $method = '<input type="hidden" name="_method" value="PUT" />';
}
?>

<div class="right_col" role="main" style="min-height: 1214px;">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><span>{{$title}}</span><small></small></h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search"></div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?php echo $title; ?></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>
                        @if(count($errors) > 0)
                        @foreach ($errors->all() as $error)
                        <div class="horizontal-center alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{$error}}
                        </div>
                        @break
                        @endforeach
                        @endif

                        @if(session()->has('message.level'))
                        <div class="horizontal-center alert alert-{{ session('message.level') }}"> 
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            {!! session('message.content') !!}
                        </div>
                        @endif
                        <form method="post" action="{{$action}}" id="demo-form2" class="form-horizontal form-label-left">
                            {!! $method !!}
                            

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="survey_form_id">Survey Form<span class="required"></span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="select2_group form-control" id="survey_form_id" name="survey_form_id">
                                        <option value="">Survey Form</option>
                                        @foreach ($survey_form as $row)
                                        <?php
                                        $selected = '';
                                        if (!empty($repairman_data)) {
                                            if ($repairman_data->survey_form_id == $row->id)
                                                $selected = 'selected';
                                        }
                                        ?>
                                        <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->survey_form_title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="question_type">Question Type<span class="required"></span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="select2_group form-control" id="question_type" name="question_type">
                                        <option value="">Question Type</option>
                                        <option value="1" <?php echo ($edit && $repairman_data->question_type==1)? "selected":""; ?>>Radio</option>
                                        <option value="2" <?php echo ($edit && $repairman_data->question_type==2)? "selected":""; ?>>Checkbox</option>
                                        <option value="3" <?php echo ($edit && $repairman_data->question_type==3)? "selected":""; ?>>Textbox</option>
                                        <option value="4" <?php echo ($edit && $repairman_data->question_type==4)? "selected":""; ?>>Textarea</option>
                                        <option value="5" <?php echo ($edit && $repairman_data->question_type==5)? "selected":""; ?>>Rating</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Survey Question <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="survey_question" maxlength="200" name="survey_question" class="form-control col-md-7 col-xs-12" value="{{!empty($repairman_data->survey_question)?$repairman_data->survey_question:Input::old('survey_question')}}" placeholder="Survey Question">
                                </div>
                            </div>

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success"><?php echo $button; ?></button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
@stop
{{-- page level scripts --}}
@section('footer_scripts')

@stop