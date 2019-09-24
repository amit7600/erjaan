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
    #image_on_popup img {
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

        <!-- start survey question option form -->
        <input type="hidden" name="session_data" id="session_data" value="{!! session('message.content') !!}">
        <div class="card mb-4 text-left">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    {{__('message.cities_list')}}
                    <a href="{{route('city.create')}}"
                        class="btn btn-primary btn-sm mb-3 float-right">{{__('message.create')}}</a>
                </h4>
                <div class="table-responsive ">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width:5%" class="text-center">{{__('message.no')}}</th>
                                <th class="text-center">{{__('message.city_name')}}</th>
                                <th style="width:5%" class="text-center">{{__('message.status')}}</th>
                                <th style="width:10%" class="text-center">{{__('message.action')}}</th>
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
<script src="{{asset('admin_css/assets/gentelella/vendors/bootbox/bootbox.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.11/handlebars.min.js"></script>
<style>
    .modal-title {
        text-align: center;
        line-height: 54px;
    }

    .option_val {
        margin-left: 40px;
    }
</style>

<script type="text/javascript">
    var dataTable;
var columns = [
    {data: 'id', name: 'id'},
    {data: 'cityName', name: 'cityName'},
    {data: 'isActive', name: 'isActive'},
    {data: 'action', name: 'action'},
];

var ajaxUrl = '{!! route('city.index') !!}'; //Url of ajax datatable where you fetch data

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
    }
            
];
//var columnDefs = [];
</script>


<script type="text/javascript">
    function isActive(){
        alert($('#isActive').val());
    }
    function fun_change_status(id){

        var url = "{{route('city_status')}}";        
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
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                    id : id,
                    },
                success: function(resp){
                    swal(
                        'Status!',
                        resp.message,
                        'success'
                    )
                },
            });
            
        }, function (dismiss) {
            // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
            if (dismiss === 'cancel') {
                swal(
                    '{{__('message.cancelled')}}',
                    '{{__('message.is_safe')}}',
                    'error'
                )
            }
        })
    };
</script>

@include('datatable.alert_js')
@include('datatable.dt_js')
@stop