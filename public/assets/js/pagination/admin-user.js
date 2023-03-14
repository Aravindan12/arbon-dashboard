$(document).ready(function(){
    $('#date_picker').daterangepicker({
        opens: 'left',
        autoUpdateInput: false,
    });
    $('#date_picker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY') + ' to ' + picker.endDate.format('DD-MM-YYYY'));
    });

    $(document).on('click', '#filter', function () {
        let date = $('#date_picker').val();
        $('#users_table').DataTable().destroy();
        pagination(date);
    });
    pagination()
})

function pagination(date = '') {
    $('#users_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        paging: true,
        pageLength: 10,
        "searching": true,
        "ordering": true,
        "order": [[ 0, "desc" ]],
        "info": true,
        "lengthChange": true,
        "bProcessing": true,
        "bServerSide": true,
        "destroy": true,
        "sAjaxSource": adminUserUrl,
        "fnServerParams": function(aoData) {
            aoData.push({
                "name": "date",
                "value": date
            });
        },
        "fnDrawCallback": function( oSettings ) {
            $('#title_checkbox').prop('checked',false);
            $('[name="user_checkbox[]"]').prop('checked',false);
        },
        columns: [
            {data: "checkbox"},
            {data: "id"},
            {data: "name"},
            {data: "email"},
        ]
    });
}

$(document).on('change', '#title_checkbox', function () {
    $('[name="user_checkbox[]"]').prop('checked',this.checked);
});

$('#download-report').on('submit', function(e){
    e.preventDefault();

    let form = this;

    $('[name="user_checkbox[]"]:checked').each(function () {
        $(form).append(
            $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'user_ids[]')
                .val($(this).val())
        );
    });
    form.submit();
    $('[name="user_ids[]"]').remove();
    $('[name="user_checkbox[]"]').prop('checked',false);
    $('#title_checkbox').prop('checked',false);
});