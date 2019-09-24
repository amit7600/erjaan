<script type="text/javascript">
    $(document).on('click', 'a.delete_data', function (e) {
        e.preventDefault(); // does not go through with the link.
        var url = $(this).attr('data-href');
        swal({
            title: '{{__('message.are_you_sure')}}',
            text: "{{__('message.wont_be_revert')}}",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0CC27E',
            cancelButtonColor: '#FF586B',
            confirmButtonText: '{{__('message.yes_delete_it')}}',
            cancelButtonText: '{{__('message.no_cancel')}}',
            confirmButtonClass: 'btn btn-success mr-5',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false
        }).then(function () {
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: {
                    _method: 'delete',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (resp) {
                    if (resp.status || resp.success) {
                        dataTable.ajax.reload();
                    }
                    swal(
                        '{{__('message.deleted')}}',
                        resp.message,
                        'success'
                    )
                },
                error: function () {
                    swal(
                        'Deleted!',
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
    });


    $(document).on('click', 'a.change_data', function (e) {
        e.preventDefault(); // does not go through with the link.
        var url = $(this).attr('data-href');
        swal({
            title: '{{__('message.are_you_sure')}}',
            text: "{{__('message.change_this_status')}}",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0CC27E',
            cancelButtonColor: '#FF586B',
            confirmButtonText: '{{__('message.yes_change_it')}}',
            cancelButtonText: '{{__('message.no_cancel')}}',
            confirmButtonClass: 'btn btn-success mr-5',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false
        }).then(function () {
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: {
                    _method: 'delete',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (resp) {
                    if (resp.status) {
                        dataTable.ajax.reload();
                    }
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
        
    });
    $(document).on('click', 'a.active_inactive_data', function (e) {
        e.preventDefault(); // does not go through with the link.
        var url = $(this).attr('data-href');
        bootbox.confirm("Are you sure?", function (confirmed) {
            if (!confirmed) {
                bootbox.hideAll()
                return false;
            }

            //Ajax Start Here Delete Routes
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function (resp) {
                    if (resp.status) {
                        dataTable.ajax.reload();
                    }
                    bootbox.alert(resp.message);
                },
                error: function () {
                    bootbox.alert("Something went wrong !!!");
                }
            });
        });
    });
    $(document).ready(function(){
        var sessionData = "{{Session::get('message.level')}}"
        if(sessionData == "success"){
            swal({
                type: 'success',
                title: 'Success!',
                text: "{!! session('message.content') !!}",
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-lg btn-success'
            })
        }
        
        
    });
</script>
<script type="text/javascript">
    function displayView(value){

        if(value == "true"){
            $('.show_display_option').hide();
        }else{
            $('.show_display_option').show();

        }
    }
</script> 
