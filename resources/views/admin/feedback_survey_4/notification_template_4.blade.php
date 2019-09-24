@extends('layout.admin')
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<!--     <link href="{{asset('dropzone/dist/dropzone.css')}}" rel="stylesheet"/>
-->
<style type="text/css">
    #image_on_popup img{
        max-width: 100%;
        max-height: 100%;
    }
</style>

@stop
{{-- Page content --}}
@section('inner_body')

<div class="row">
    <div class="col-lg-12 mb-3">
        @if(count($errors) > 0)
        @foreach ($errors->all() as $error)
        <div class="alert alert-card alert-danger">
            <strong class="text-capitalize">{{$error}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @break
        @endforeach
        @endif

        <!-- @if(session()->has('message.level'))
        <div class="alert alert-card alert-{{ session('message.level') }}"> 
            <strong class="text-capitalize">{!! session('message.content') !!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif -->

        <!-- start survey question option form -->
        <div class="card mb-4 text-left">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    {{__('message.status')}} {{__('message.list')}}
                </h4>
                <div class="table-responsive ">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width:5%" class="text-center">S.No</th>
                                <th class="text-center">{{__('message.reason')}}</th>
                                <th class="text-center" style="width:10%">{{__('message.status')}}</th>
                                <th class="text-center" style="width:10%">{{__('message.action')}}</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            <tr>
                                <td>1</td>
                                <td>{{__('message.new')}}</td>
                                <td style="padding-left:33px;">
                                    
                                    <label class="switch switch-primary mr-3">
                                        <input type="checkbox" class="isActive" onclick = "status_change(1,<?php echo $new_status; ?>)" <?php echo $new_status == 1 ? 'checked' : ''; ?>>
                                        <span class="slider"></span>
                                    </label>
                                   
                                </td>
                                <td>
                                    <a class="text-success" href="{{route('view_reason_template',1)}}"><i class="i-Eye-Scan text-25 nav-icon font-weight-bold"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>{{__('message.inProgress')}}</td>
                                <td style="padding-left:33px;">
                                    <label class="switch switch-primary mr-3">
                                        <input type="checkbox" class="isActive" onclick = "status_change(2,<?php echo $in_progress_status; ?>)" <?php echo $in_progress_status == 1 ? 'checked' : ''; ?>>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                                <td><a class="text-success" href="{{route('view_reason_template',2)}}"><i class="i-Eye-Scan text-25 nav-icon font-weight-bold"></i></a></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>{{__('message.resolved')}}</td>
                                <td  style="padding-left:33px;">
                                    <label class="switch switch-primary mr-3">
                                        <input type="checkbox" class="isActive" onclick = "status_change(3,<?php echo $resolve_status; ?>)" <?php echo $resolve_status == 1 ? 'checked' : ''; ?>>
                                        <span class="slider"></span>
                                    </label>   
                                </td>
                                <td>
                                    <a class="text-success" href="{{route('view_reason_template',3)}}"><i class="i-Eye-Scan text-25 nav-icon font-weight-bold"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>{{__('message.late')}}</td>
                                <td style="padding-left:33px;">
                                    <label class="switch switch-primary mr-3">
                                        <input type="checkbox" class="isActive" onclick = "status_change(4,<?php echo $late_status; ?>)" <?php echo $late_status == 1 ? 'checked' : ''; ?>>
                                        <span class="slider"></span>
                                    </label> 
                                </td>
                                <td>
                                    <a class="text-success" href="{{route('view_reason_template',4)}}"><i class="i-Eye-Scan text-25 nav-icon font-weight-bold"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end survey question option form -->
    </div>
</div>


@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript">
    dataTable = $('#datatable').DataTable({});    
    function status_change(id,status){
        if(status == 1){
            status = 0;
        }else{
            status = 1;
        }
        _token = "{{csrf_token()}}";
        url = "{{route('template_status')}}"
        swal({
            title: '{{__('message.are_you_sure')}}',
            text: "{{__('message.change_this_status')}}",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0CC27E',
            cancelButtonColor: '#FF586B',
            confirmButtonText: 'Yes, change it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success mr-5',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false
        }).then(function () {

            $.ajax({
                type: "POST",
                url : url,
                data:{
                    _token : _token,
                    id: id,
                    status : status
                },
                success: function (resp) {
                    swal(
                        'Changed!',
                        resp.message,
                        'success'
                    )
                },
                error: function () {
                    swal(
                        'Changed!',
                        '{{__('message.something_wrong')}}',
                        'Error'
                    )
                }
            })
        }, function (dismiss) {
            // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    '{{__('message.is_safe')}}',
                    'error'
                )
            }
        })    
    }
</script>
@include('datatable.alert_js') 
@stop

