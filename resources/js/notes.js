$(document).ready(function () {
   let table = $('#notes').DataTable( {
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
            { name: "name", className: "table-text-align-center", width: "75%" },
            { name: "actions", className: "table-text-align-center", width: "25%"},
        ],
        ajax: {
            url:'/api/data/' + $('#notes').attr('data-user') + '/notes',
            type: "GET",
            headers: authHeaders
        },
    } );


    $('.closeModal').click(function () {
        resetData()
    })




    $('body').on('click', '.delete', function () {
        Swal.fire({
            title: 'Ви впевнені?',
            text: 'Ви збираєтесь видалити посилання',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#8b1005',
            cancelButtonColor: '#1b960c',
            confirmButtonText: 'Так, видалити!',
            cancelButtonText: 'Ні, відмінити!',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: '/api/data/' + $('#notes').attr('data-user') + '/notes/delete/' + $(this).attr('data-id'),
                    headers: authHeaders,
                }).then((response) => {
                    if (response == true) {
                        Swal.fire({
                            title: 'Нотатки видалено',
                            type: 'info',
                            confirmButtonColor: '#22688b',
                            confirmButtonText: 'OK',
                        })
                    }
                })
            } else {
                Swal.fire({
                    title: 'Відміна',
                    text: 'Видалення не відбулось',
                    type: 'error',
                    confirmButtonColor: '#d33d33',
                    confirmButtonText: 'OK',
                })
            }
            table.ajax.reload();
        });
    });

});