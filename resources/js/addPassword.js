$(document).ready(function () {
   //Показати або сховати пароль при доаванні чи редагуванні
    $('.changeTypePassword').on('click', function (event) {
        event.preventDefault();
        if($($(this).attr('data-input')).attr('type') == 'password') {
            $($(this).attr('data-input')).attr('type', 'text');

            $(this).attr('title', 'Приховати пароль');
            $($(this).attr('data-i')).removeClass('fa-toggle-off');
            $($(this).attr('data-i')).addClass('fa-toggle-on');
        } else {
            $($(this).attr('data-input')).attr('type', 'password');
            $($(this).attr('data-i')).removeClass('fa-toggle-on');
            $($(this).attr('data-i')).addClass('fa-toggle-off');
            $(this).attr('title', 'Показати пароль');

        }
    })
    $('#url').on('focus', function () {
        $(this).attr('readonly', true);
        $(this).removeAttr('readonly')
    })

    //Генерація пароля
    $('.generatePassword').click(function () {
        event.preventDefault();
        $.ajax({
            type: 'GET',
            url: '/api/data/' + $('#webs').attr('data-user') + '/webs/generate-password',
            headers: authHeaders,
            data: {
                big: function () {return $('.bigLetters').is(':checked') ? 1 : 0},
                sym: function () {return $('.symbols').is(':checked') ? 1 : 0},
                count: function () {return $('.passwordLength').val()},
            },
        }).then((response) => {
            $('.passwordModalAdd').focus();
            $('.passwordModalAdd').val(response);
            $('.passwordModalAdd').blur();
        })
    })
    //Додавання пароля


    $('#passwordModalAdd').on('keyup focus', function () {
        var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
        var mediumRegex = new RegExp("^(?=.{8,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
        var enoughRegex = new RegExp("(?=.{8,}).*", "g");

        if (false == enoughRegex.test($(this).val())) {
            $('#passstrength').removeClass().addClass('alert-danger ');
            $('#passstrengthAddResource').removeClass().addClass('alert-danger ');
            $('.passstrengthPolosa').css("width", "15%")
            $('.passstrengthPolosa').attr('aria-valuenow', '15');
            $('.passstrengthSpan').html(' ');
            $('.passstrengthSpan').html('Не меньше 8 символів!');
        }  else if (strongRegex.test($(this).val())) {
            $('#passstrength').removeClass().addClass('alert-success');
            $('#passstrengthAddResource').removeClass().addClass('alert-success');
            $('.passstrengthPolosa').css("width", "100%")
            $('.passstrengthPolosa').attr('aria-valuenow', '100')
            $('.passstrengthSpan').html(' ');
            $('.passstrengthSpan').html('Сильний пароль!');
        } else if (mediumRegex.test($(this).val())) {
            $('#passstrength').removeClass().addClass('alert-warning');
            $('#passstrengthAddResource').removeClass().addClass('alert-warning');
            $('.passstrengthPolosa').css("width", '75%')
                $('.passstrengthPolosa').attr('aria-valuenow', '75');
            $('.passstrengthSpan').html(' ');
            $('.passstrengthSpan').html('Средній пароль!');
        } else {
            $('#passstrength').removeClass().addClass('alert-danger');
            $('#passstrengthAddResource').removeClass().addClass('alert-danger');
            $('.passstrengthPolosa').css("width", "45%")
            $('.passstrengthPolosa').attr('aria-valuenow', '45');
            $('.passstrengthSpan').html(' ');
            $('.passstrengthSpan').html('Слабкий пароль!');
        }
        return true;
    })


});