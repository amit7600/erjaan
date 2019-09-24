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

        @if(session()->has('message.level'))
        <div class="alert alert-card alert-{{ session('message.level') }}"> 
            <strong class="text-capitalize">{!! session('message.content') !!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
      

        <!-- start survey question option form -->
        <div class="card mb-4 text-left">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    {{__('message.feedback_ratings')}}</h4>
                <div class="table-responsive ">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width:5%" class="text-center">S.No</th>
                                <th class="text-center">{{__('message.user')}}</th>
                                <th class="text-center">{{__('message.comment')}}</th>
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
<style>.modal-title{text-align: center;line-height:54px;}.option_val {margin-left: 40px;}</style>
<script type="text/javascript">
var dataTable;
var columns = [
    {data: 'rownum', name: 'rownum'},
    {data: 'name', name: 'name'},
    {data: 'comment', name: 'comment'},
];

var ajaxUrl = '{!! route('getFeedbackRatings_3') !!}'; //Url of ajax datatable where you fetch data

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
</script>
<script type="text/javascript">
    $(document).on('keyup','.question_order',function(e){
            var tr = $(this).closest('tr');
            var row = dataTable.row(tr).data();
            var id = row.id;
            var url = "{{route('question_order')}}";
            var question_order = $('#question_order_'+id).val();
            $.ajax({
                  type: "POST",
                  url: url,
                  data: {
                    "_token": "{{ csrf_token() }}",
                    'id' : id,
                    'question_order' : question_order
                    },
                  success: function(resp){
                    
                  },
                  error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseJSON.message)
                  }
        });
    })
</script>
@include('datatable.dt_js') 
@stop

