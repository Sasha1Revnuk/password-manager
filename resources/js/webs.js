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

    $('.changeTypePassword').on('click', function () {
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

    $('#url').focusout( function () {
        $(this).attr('readonly');
        $(this).removeAttr('readonly')
    })
    $('#url').keyup($.debounce(250, function(e) {
        table.ajax.reload();
    }));


    $('#generatePassword').click(function () {
        $.ajax({
            type: 'GET',
            url: '/api/data/' + $('#webs').attr('data-user') + '/webs/generate-password',
            headers: authHeaders,
            data: {
                big: function () {return $('#bigLetters').is(':checked') ? 1 : 0},
                sym: function () {return $('#symbols').is(':checked') ? 1 : 0},
                count: function () {return $('#passwordLength').val()},
            },
        }).then((response) => {
            $('#passwordModalAdd').val('');
            $('#passwordModalAdd').val(response);
        })
    })

    $('#addToModal').click(function () {
        $.ajax({
            type: 'GET',
            url: '/api/data/' + $('#webs').attr('data-user') + '/webs/add',
            headers: authHeaders,
            data: {
                url: function () {return $('#urlModalAdd').val()},
                login: function () {return $('#loginModalAdd').val()},
                password: function () {return $('#passwordModalAdd').val()},
            },
        }).then((response) => {

        })
    })


});