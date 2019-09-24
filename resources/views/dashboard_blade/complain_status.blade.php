<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card text-left">
            <div class="card-body">
                <h4 class="card-title mb-3">{{__('message.complain_list')}}
                </h4>
                <div id="show_filter"></div>
                <div class="table-responsive">

                    <table id="zero_configuration_table" class="table table-striped table-bordered display">
                        <thead>
                            <tr>
                                <th style="width:5%" class="text-center">S.No</th>
                                <th class="text-center">{{__('message.name')}}</th>
                                <th class="text-center">{{__('message.e-mail')}}</th>
                                <th class="text-center">{{__('message.number')}}</th>
                                <th class="text-center">{{__('message.comments')}}</th>
                                <th class="text-center">{{__('message.status')}}</th>
                                <th class="text-center">{{__('message.modified_by')}}</th>
                                <th class="text-center">{{__('message.created_at')}}</th>
                                <th class="text-center">{{__('message.updated_at')}}</th>
                            </tr>
                        <tbody>
                            @foreach($complains_report as $key=>$complainsReportData)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $complainsReportData->name }}</td>
                                <td>{{ $complainsReportData->email }}</td>
                                <td>{{ $complainsReportData->mobile }}</td>
                                <td>{{ $complainsReportData->comment }}</td>
                                <td>
                                    <?php 
                                        $color = '#639';
                                        if ($complainsReportData->status == 'new')
                                            $color = '#639';
                                        if ($complainsReportData->status == 'in_progress')
                                            $color = '#e0a800';
                                        if ($complainsReportData->status == 'resolved')
                                            $color = '#409444';
                                        if ($complainsReportData->status == 'late')
                                            $color = '#f44336';
                                        ?>
                                    <select name="change_status" id="change_status_{{$complainsReportData->id}}"
                                        class="form-control"
                                        onchange="changeStatus({{$complainsReportData->id}},{{ $complainsReportData->user_id}})"
                                        style="color: white; background: {{ $color }}">
                                        <option value="new" @if($complainsReportData->status == 'new')
                                            selected='selected' @endif>{{__('message.new')}}</option>
                                        <option value="in_progress" @if($complainsReportData->status == 'in_progress')
                                            selected='selected' @endif>{{__('message.inProgress')}}</option>
                                        <option value="resolved" @if($complainsReportData->status == 'resolved')
                                            selected='selected' @endif>{{__('message.resolved')}}</option>
                                        <option value="late" @if($complainsReportData->status == 'late')
                                            selected='selected' @endif>{{__('message.late')}}</option>
                                    </select>
                                </td>
                                <td>@if(strlen($complainsReportData->modified_by) >
                                    0){{ $complainsReportData->modified_by }} @else - @endif</td>
                                <td>{{ date('d-m-Y',strtotime($complainsReportData->created_at)) }}</td>
                                <td>{{ date('d-m-Y',strtotime($complainsReportData->updated_at)) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var dataTable;
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

    var ajaxUrl = '{!! route('dashboard_complain') !!}'; //Url of ajax datatable where you fetch data

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

    $(document).ready(function () {
        $(".loaderShow").hide();
        $(document).on('click', '.more-details', function () {
            var tr = $(this).closest('tr');
            var row = dataTable.row(tr).data();
            $('#image_on_popup').html(row.image_path);
            $('#myModalHorizontal').modal('show');
        });
    });

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
            $(".loaderShow").show();
            $.ajax({
                  type: "POST",
                  url: url,
                  data: {
                    "_token": "{{ csrf_token() }}",
                    'id' : id,
                    'is_selected' : is_active
                    },
                  success: function(resp){
                    $(".loaderShow").hide();
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
            title: 'Are you sure?',
            text: "You are change this status?",
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
                        'Something went wrong !!!',
                        'Error'
                    )
                }
            });
        }, function (dismiss) {
            // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    }
</script>