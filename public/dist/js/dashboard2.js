$(document).ready(function () {
    //$(".selectpicker").selectpicker("render");

    $("#datepicker-autoClose").datepicker({
        todayHighlight: true,
        autoclose: true
    });

    $('#data-table').DataTable(
        {
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            "autoWidth": false
        }
    );
});


