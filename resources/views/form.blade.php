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
<?php $this->response = $setting['default_response']; ?>
<div class="right_col" role="main" style="min-height: 3214px;">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><span>{{$setting['method']}} </span><small>{{route($setting['action'])}}</small></h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search"></div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" method="{{$setting['method']}}" action="{{route($setting['action'])}}">
                            @if(!empty($form))
                            @foreach($form as $key => $val)
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12 {{$val['type']}}">{{$key}}<span class="required">{{$val['required']}}</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    @if($val['type'] == 'radio')
                                        @php($i = 0)
                                        @foreach($val['value'] as $objVal)
                                        <input type="{{$val['type']}}" name="{{$key}}" value="{{$objVal}}"> {{$val['value_text'][$i]}}
                                        @php($i++) 
                                        @endforeach                                     
                                    @else
                                        <input type="{{$val['type']}}" name="{{$key}}" value="{{$val['value']}}" class="form-control" placeholder="{{!empty($val['placeholder'])?$val['placeholder']:''}}">
                                    @endif                                    
                                </div>
                            </div>
                            @endforeach
                            @endif                            
                            {{-- <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">email<span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <input type="text" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">password<span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">password_confirmation</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">address</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <input type="text" name="address" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">user_role<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="radio" value='1' name='user_role'> I am trainee(1)
                                    <input type="radio" value='2' name='user_role'> I am trainner(2) 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">user_image</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <input type="file" name="user_image" class="form-control" value="User Image">
                                </div>
                            </div>   --}}                          
                            <div class="form-group">
                                <button type="submit" id="frm_submit_btn" class="btn btn-info pull-right">Submit</button>
                            </div>                    
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                @include('layout.response')
            </div>
        </div>
    </div>
</div>    
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript">
    $(document).ready(function(){

    });
</script>   
@stop