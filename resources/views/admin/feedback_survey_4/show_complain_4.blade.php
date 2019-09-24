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
    .main_loader{
            text-align: center;
            position: fixed;
            top: 10%;
            width: 88%;
            height: 100vh;
            z-index: 3;
            background: #ffffffb5;
            padding-top: 19%;
    }
    .main_loader .spinner-bubble{
       font-size: 11px;
    }
</style>

@stop
{{-- Page content --}}
@section('inner_body')

 <div class="row">
    <div class="col-lg-12 main_loader loaderShow">
        <div class="spinner-bubble spinner-bubble-primary m-5"></div>
    </div>
</div>
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
      
        <div class="card mb-4 text-left">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    {{__('message.filter')}} {{__('message.complain')}} {{__('message.report')}}
                </h4>
                <div class="form-group row">
                    <label for="staticEmail" class="ul-form__label col-lg-3 col-md-3 col-sm-3 col-form-label text-right">
                    {{__('message.select')}} {{__('message.status')}}<span class="required">*</span></label>
                    <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                        <div class="input-right-icon">
                            {!! Form::select('status', ['new' => 'New','in_progress' => 'In Progress','resolved' => 'Resolved','late' => 'Late'], null, ['class' => 'form-control','id' => 'status','placeholder' => __('message.select').' '.__('message.status')]) !!}
                            <span class="span-right-input-icon">
                            <i class="ul-form__icon i-Arrow-Down"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="mc-footer">
                    <div class="row text-right">
                        <div class="col-sm-4"></div>
                        <div class="ol-lg-6 text-left">
                            <input type="submit" onclick="submitForm()" class="btn btn-success" value="{{__('message.view')}} {{__('message.report')}}">
                        </div>
                    </div>      
                </div>
            </div>
        </div>
       
        <!-- start survey question option form -->
        <div class="card mb-4 text-left">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    {{__('message.feedback')}} {{__('message.answer')}} {{__('message.list')}}
                </h4>
                <div class="table-responsive ">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">S.No</th>
                                <th class="text-center">{{__('message.name')}}</th>
                                <th class="text-center">{{__('message.e-mail')}}</th>
                                <th class="text-center">{{__('message.number')}}</th>
                                <th class="text-center">{{__('message.comments')}}</th>
                                <th class="text-center">{{__('message.status')}}</th>
                                <th class="text-center">{{__('message.modified_by')}}</th>
                                <th class="text-center">{{__('message.created_at')}}</th>
                                <th class="text-center">{{__('message.updated_at')}}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- end survey question option form -->
        <!-- end::form 2-->
    </div>
</div>


@stop
{{-- page level scripts --}}
@section('footer_scripts')


<script type="text/javascript">


    function submitForm(){
        var status = $('#status').val();
        extraData = {};
        extraData.status = status;
        dataTable.ajax.reload();
    }
</script>

<script type="text/javascript">
var dataTable;
var extraData;
var columns = [
    {data: 'rownum', name: 'rownum'},
    {data: 'name', name: 'name'},
    {data: 'email', name: 'email'},
    {data: 'mobile', name: 'mobile'},
    {data: 'comment', name: 'comment'},
    {data: 'status', name: 'status'},
    {data: 'modified_by', name: 'modified_by'},
    {data: 'created_at', name: 'created_at'},
    {data: 'updated_at', name: 'updated_at'},
];

var ajaxUrl = '{!! route('show_complain') !!}'; //Url of ajax datatable where you fetch data

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
        "class": "text-left"
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
        "orderable": true,
        "class": "text-center",
    },
    {
        "targets": 5,
        "orderable": true,
        "class": "text-left"
    },
    {
        "targets": 6,
        "orderable": true,
        "class": "text-left"
    },
    {
        "targets": 7,
        "orderable": true,
        "class": "text-left"
    },
    {
        "targets": 8,
        "orderable": true,
        "class": "text-left"
    },
];
//var columnDefs = [];
</script> 

<script type="text/javascript">
    $(document).ready(function () {
        $(".loaderShow").hide();
        $(document).on('click', '.more-details', function () {
            var tr = $(this).closest('tr');
            var row = dataTable.row(tr).data();
            $('#image_on_popup').html(row.image_path);
            $('#myModalHorizontal').modal('show');
        });
    });
</script>
<script type="text/javascript">
    function isActive(){
        alert($('#isActive').val());
    }
    $(document).on('change','.isActive',function(e){
            //debugger;
            var tr = $(this).closest('tr');
            var row = dataTable.row(tr).data();
            var id = row.id;
            var url = "{{route('change_status')}}";
            if($(this).is(":checked")) {
                var is_active = 1
            }else{
                var is_active = 0
            }
            $.ajax({
                  type: "POST",
                  url: url,
                  data: {
                    "_token": "{{ csrf_token() }}",
                    'id' : id,
                    'is_selected' : is_active
                    },
                  success: function(resp){
                    alert(resp.message)
                  },
        });
    });

    function changeStatus (id, userId) {
        
        var value = $('#change_status_'+id).find(":selected").val()        
        var color = '#639';
        if (value == 'new') {
            color = '#639';
        }
        if (value == 'in_progress') {
            color = '#e0a800';
        }
        if (value == 'resolved') {
            color = '#409444';
        }
        if (value == 'late') {
            color = 'rgb(244, 67, 54)';
        }
        
        $('#change_status_'+id).css("background-color", color);
        var url = "{{route('change_status_feedback')}}";

        swal({
            title: '{{__('message.are_you_sure')}}',
            text: "{{__('message.change_this_status')}}",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0CC27E',
            cancelButtonColor: '#FF586B',
            confirmButtonText: '{{__('message.yes_change')}}',
            cancelButtonText: '{{__('message.no_cancel')}}',
            confirmButtonClass: 'btn btn-success mr-5',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false
        }).then(function () {
            $(".loaderShow").show();
            $.ajax({
                type: "POST",
                url: url,
                data: {
                "_token": "{{ csrf_token() }}",
                'id' : id,
                'user_id' : userId,
                'status': value
                },
                success: function (resp) {
                    $(".loaderShow").hide();
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
            });
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

@include('datatable.dt_js')
@stop

