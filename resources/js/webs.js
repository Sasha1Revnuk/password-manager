$(document).ready(function () {
   let table = $('#webs').DataTable( {
        processing: true,
        serverSide: true,
        lengthMenu: [ 10, 25, 50],
        searching: false,
        ordering: false,
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Ukrainian.json"
        },
        responsive: true,
        columns: [
            { name: "fa", className: "table-text-align-center", width: "5%" },
            { name: "site", className: "table-text-align-center", width: "50%" },
            { name: "login", className: "table-text-align-center", width: "20%" },
            { name: "actions", className: "table-text-align-center", width: "25%"},
        ],
        ajax: {
            url:'/api/data/' + $('#webs').attr('data-user') + '/webs',
            type: "GET",
            data: {
                url: function () {return $('#url').val()},
            },
            headers: authHeaders
        },
    } );


    // $('#url').on('keyup', function () {
    //     table.ajax.reload();
    // })



});