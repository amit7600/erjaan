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
                    {{__('message.role')}} {{__('message.list')}}
                    <a href="{{route('user_roles.create')}}"
                        class="btn btn-primary btn-sm float-right mb-3">{{__('message.create')}}</a>
                </h4>
                <div class="table-responsive ">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width:5%" class="text-center">S.No</th>
                                <th class="text-center">{{__('message.User')}} {{__('message.role')}}</th>
                                <th style="width:10%" class="text-center">{{__('message.level')}}</th>
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




<script type="text/javascript">
    var dataTable;
var columns = [
    {data: 'rownum', name: 'rownum'},
    {data: 'role', name: 'role'},
    {data: 'level', name: 'level'},
    {data: 'status', name: 'status'},
    {data: 'action', name: 'action'},
];

var ajaxUrl = '{!! route('user_roles.index') !!}'; //Url of ajax datatable where you fetch data

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

            /*{
             "targets": 5,
             "orderable": false,
             "class":"text-center"
             },*/
];
//var columnDefs = [];
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.more-details', function () {
            var tr = $(this).closest('tr');
            var row = dataTable.row(tr).data();
            $('#image_on_popup').html(row.image_path);
            $('#myModalHorizontal').modal('show');
        });
    });
</script>
<script type="text/javascript">
    $(document).on('change','.isActive',function(e){
            //debugger;
            var tr = $(this).closest('tr');
            var row = dataTable.row(tr).data();
            var id = row.id;
            if($(this).is(":checked")) {
                var is_active = 1
                }else{
                    var is_active = 0
                }
            var url = "{{route('user_status')}}";        
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
                        '_token': "{{ csrf_token() }}",
                        'id' : id,
                        'status' : is_active
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
                    dataTable.ajax.reload();
                    swal(
                        'Cancelled',
                        '{{__('message.is_safe')}}',
                        'error'
                    )
                }
            })
        });
</script>
@include('datatable.alert_js')
@include('datatable.dt_js')
@stop