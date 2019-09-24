<script type="text/javascript">
    $(document).ready(function () {        
        datatableFun();
        $('#buttonFilter').click(function(){
            dataTable = $('#datatable').DataTable();
            dataTable.destroy();
            datatableFun($('#filter').val(), $('#filter2').val());
        });
    });
    function datatableFun(filter = null, filter2 = null) {
        dataTable = $('#datatable').DataTable({
            retrieve: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: ajaxUrl,
                data: function (d){
                    if (typeof extraData !== 'undefined') {
                        d.extraData = extraData;
                        d.extraData.filter = filter;
                        d.extraData.filter2 = filter2;
                    }
                }
            },
            columns: columns,
            columnDefs: columnDefs,
            "fnDrawCallback": function(seting){
                if(!dataTable.data().any()){
                    $('#question_answer').remove();
                }
            }
            
        });
    }
    
    

</script>