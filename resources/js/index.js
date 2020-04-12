$(document).ready(function () {

    $('#changePassword').on('click', function () {
        $.ajax({
            type: 'GET',
            url: '/api/change-password/' + $(this).attr('data-user'),
            headers: authHeaders,
            data: {
                password: function () {return $('#password').val()},
                password_confirmation: function () {return $('#password_confirmation').val()},
                secret: function () {return $('#secret').val()},
            },
        }).then((response) => {
            $('#password').val('');
            $('#password_confirmation').val('');
            $('#secret').val('');
            $('#closeButton').click();
            if(response == true) {
                Swal.fire({
                    title: 'Пароль змінено',
                    text: 'Ви успішно змінили пароль',
                    type: 'info',
                    confirmButtonColor: '#22688b',
                    confirmButtonText: 'OK',
                })
            } else {
                Swal.fire({
                    title: 'Пароль не змінено',
                    text: 'Невдала спроба змінити пароль',
                    type: 'error',
                    confirmButtonColor: '#d33d33',
                    confirmButtonText: 'OK',
                })
            }
        })

    });
    $('#changeSecret').on('click', function () {
        Swal.fire({
            title: 'Ви впевнені?',
            text: 'Ви збираєтесь змінити секретний пароль. Всі облікові записи, додані за допомогою попереднього секретного пароля, будуть знищені. Продовжити?',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#8b4d04',
            cancelButtonColor: '#1b960c',
            confirmButtonText: 'Так, змінити і видалити!',
            cancelButtonText: 'Ні, я згадаю свій секретний пароль!',
        }).then((result) => {
            if(result.value) {
                $.ajax({
                    type: 'GET',
                    url: '/api/change-password-secret/' + $(this).attr('data-user'),
                    headers: authHeaders,
                }).then((response) => {
                    if(response == true) {
                        Swal.fire({
                            title: 'Секретний пароль змінено',
                            text: 'Ви успішно змінили секретний пароль. Перевірте свою поштову скриньку.',
                            type: 'info',
                            confirmButtonColor: '#22688b',
                            confirmButtonText: 'OK',
                        })
                    }

                })
            } else {
                Swal.fire({
                    title: 'Секретний пароль не змінено',
                    text: 'Невдала спроба змінити секретний пароль',
                    type: 'error',
                    confirmButtonColor: '#d33d33',
                    confirmButtonText: 'OK',
                })
            }


        })
        return false;

    });
});