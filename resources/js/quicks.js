$(document).ready(function () {
    function resetData() {
         $('#passstrength').removeClass();
         $("#addModalForm").trigger("reset");
        $('#passstrengthPolosa').css("width", "0%")
         $('#passstrengthPolosa').attr('aria-valuenow', '0');
        $('#passstrengthSpan').html(' ');
        $('#groupName').val(' ');
    }
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
            url:'/api/data/' + $('#webs').attr('data-user') + '/quick',
            type: "GET",
            data: {
                url: function () {return $('#url').val()},
            },
            headers: authHeaders
        },
    } );


    $('#url').on('focus', function () {
        $(this).attr('readonly', true);
        $(this).removeAttr('readonly')
    })

    $('#url').focusout( function () {
        $(this).attr('readonly');
        $(this).removeAttr('readonly')
    })
    $('#url').keyup($.debounce(250, function(e) {
        table.ajax.reload();
    }));



    $('.closeModal').click(function () {
        resetData()
    })



    $('body').on('click', '.deleteWeb', function () {
        Swal.fire({
            title: 'Ви впевнені?',
            text: 'Ви збираєтесь видалити ресурс',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#8b1005',
            cancelButtonColor: '#1b960c',
            confirmButtonText: 'Так, видалити!',
            cancelButtonText: 'Ні, відмінити!',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'GET',
                    url: '/api/data/' + $('#webs').attr('data-user') + '/webs/delete/' + $(this).attr('data-id'),
                    headers: authHeaders,
                }).then((response) => {
                    if (response == true) {
                        Swal.fire({
                            title: 'Ресурс видалено',
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

    $('body').on('click', '.deleteObl', function () {
        Swal.fire({
            title: 'Ви впевнені?',
            text: 'Ви збираєтесь видалити обліковий запис',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#8b1005',
            cancelButtonColor: '#1b960c',
            confirmButtonText: 'Так, видалити!',
            cancelButtonText: 'Ні, відмінити!',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'GET',
                    url: '/api/data/' + $('#webs').attr('data-user') + '/webs/delete-resource/' + $(this).attr('data-id'),
                    headers: authHeaders,
                }).then((response) => {
                    if (response == true) {
                        Swal.fire({
                            title: 'Обліковий запис видалено',
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
    })

    $('body').on('click', '.copyPassword', function () {
        if($(this).attr('data-method') == 1) {
            Swal.fire({
                title: 'Введіть секретний пароль',
                input: 'password',

                showCancelButton: true,
                confirmButtonText: 'Скопіювати пароль',
                cancelButtonText: 'Відмінити',
                showLoaderOnConfirm: false,
                preConfirm: (secret) => {
                    return secret;

                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: '/api/data/' + $('#webs').attr('data-user') + '/webs/getSavePassword/'+ $(this).attr('data-id'),
                        headers: authHeaders,
                        data: {
                            'secret': result.value
                        },
                    }).then((response) => {
                        if(response) {
                            var $temp = $("<input>");
                            $("body").append($temp);
                            $temp.val(response).select();
                            document.execCommand("copy");
                            $temp.remove();
                            Swal.fire({
                                position: 'top-end',
                                type: 'success',
                                title: 'Пароль скопійовано',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: `Помилка. Спробуйте ще раз`,

                            })
                        }

                    })
                }  else {
                    Swal.fire({
                        type: 'error',
                        title: `Відміна!`,

                    })
                }
            })
        } else {
            $.ajax({
                type: 'GET',
                url: '/api/data/' + $('#webs').attr('data-user') + '/webs/getSavePassword/'+ $(this).attr('data-id'),
                headers: authHeaders,
            }).then((response) => {
                if(response) {
                    var $temp = $("<input>");
                    $("body").append($temp);
                    $temp.val(response).select();
                    document.execCommand("copy");
                    $temp.remove();
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Пароль скопійовано',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        type: 'error',
                        title: `Помилка. Спробуйте ще раз`,

                    })
                }

            })
        }
    });

    $('body').on('click', '.addToQuick', function () {
        $.ajax({
            type: 'GET',
            url: '/api/data/' + $('#webs').attr('data-user') + '/webs/add-to-quick/'+ $(this).attr('data-id'),
            headers: authHeaders,
        }).then((response) => {
            if(response) {
                Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: 'Виконано',
                    text: response,
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                Swal.fire({
                    type: 'error',
                    title: `Помилка. Спробуйте ще раз`,

                })
            }

        })
        table.ajax.reload()
    });


});