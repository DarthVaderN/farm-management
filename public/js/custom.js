$(function () {

    function add() {
        $.ajax({
            url: '/clone',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('#yard' + data.yard).append(
                    `<div id="sheep +  data.sheep_id + " class="name">Овеечка № ` + data.sheep_id +`</div>`
                );
            }
        });
    }

    function sleep() {
        $.ajax({
            url: '/kill',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('#sheep' + data.sleep.id).hide();

                $('#sheep' + data.moved.id).appendTo('#yard' + data.moved.to);
            }
        });
    }

    $('input[type=submit]').on('click', function () {
        var cmd = $('select').val();

        if (cmd == 'add') {
            add();
        } else if (cmd == 'sleep') {
            sleep();
        }

        return false;
    });

    $('#delete').on('click', function () {
        $.ajax({
            url: '/delete',
            success: function () {

                window.location.reload();
            }
        });

        days(0);
        clearInterval(timer);
    });

    var timer = setInterval(function () {
        var day = localStorage.getItem('day') ? localStorage.getItem('day') : 0;
        day = parseInt(day) + 1;
        days(day);

        if (day % 1 == 0 && day > 0) {
            add();
        }

        if (day % 2 == 0 && day > 0) {
            sleep();
        }
    }, 10000);

    function days(day) {
        localStorage.setItem('day', day);
        $('#day').html(day);

    }


});
