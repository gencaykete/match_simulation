const table = $('#datatable').DataTable(
    {
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.2/i18n/tr.json"
        },
        order: [
            [0,'DESC']
        ],
        serverSide: true,
        processing : true,
        columns: DATA_COLUMNS,
        responsive: true,
        columnDefs: [
            {
                targets: -1,
            }
        ],
        ajax: {
            url: DATA_URL
        },
    }
);

$('#datatable-search').on("keyup", (function () {
    table.search($(this).val()).draw()
}))

$(document).keydown(function (e) {
    if (e.keyCode == '82') {
        table.ajax.reload(null, false);
    }
})
