$(document).ready(function () {
    function resetData() {
        $('#editNameUrl').val(' ');
        $('#addNameUrl').val(' ');
    }
   let table = $('#marks').DataTable( {
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
            { name: "name", className: "table-text-align-center", width: "30%" },
            { name: "site", className: "table-text-align-center", width: "45%" },
            { name: "actions", className: "table-text-align-center", width: "25%"},
        ],
        ajax: {
            url:'/api/data/' + $('#marks').attr('data-user') + '/marks',
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
                    url: '/api/data/' + $('#marks').attr('data-user') + '/marks/delete/' + $(this).attr('data-id'),
                    headers: authHeaders,
                }).then((response) => {
                    if (response == true) {
                        Swal.fire({
                            title: 'Посилання видалено',
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


    $('body').on('click', '.edit', function () {
        $('#editNameUrl').val($(this).attr('data-url'));
        $('#editMarkButton').attr('data-id', $(this).attr('data-id'));
    })

    $('#editMarkButton').on('click', function () {
        $.ajax({
            type: 'POST',
            url: '/api/data/' + $('#marks').attr('data-user') + '/marks/edit/' + $(this).attr('data-id'),
            headers: authHeaders,
            data: {
                'url':  $('#editNameUrl').val(),
            },
        }).then((response) => {
            if(response) {
                Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: 'Закладка збережена',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                Swal.fire({
                    type: 'error',
                    title: `Помилка. Спробуйте ще раз`,

                })
            }
            table.ajax.reload();
            $('.closeModal').click();
        })
    })

    $('#addMarkButton').on('click', function () {
        $.ajax({
            type: 'POST',
            url: '/api/data/' + $('#marks').attr('data-user') + '/marks/add',
            headers: authHeaders,
            data: {
                'url':  $('#addNameUrl').val(),
            },
        }).then((response) => {
            if(response) {
                Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: 'Закладка додана',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                Swal.fire({
                    type: 'error',
                    title: `Помилка. Спробуйте ще раз`,

                })
            }
            table.ajax.reload();
            $('.closeModal').click();
        })
    })

});