$( document ).ready(function() {

    var offset = 10;
    var canvas = document.getElementById('game_canvas');
    var context = canvas.getContext('2d');
    context.lineWidth = 10;
    context.strokeStyle = '#7354cb';
    var size = canvas.offsetWidth;

    context.beginPath();

    function drawSymbol(context, symbol, pos) {
        var col = pos % 3;
        var lin = Math.floor(pos / 3);
        if (symbol == 'x') {
            context.strokeStyle = '#39bc9b';

            context.beginPath();
            context.moveTo(col * size / 3 + 2 * offset, lin * size / 3 + 2 * offset);
            context.lineTo((col + 1) * size / 3 - 2 * offset, (lin + 1) * size / 3 - 2 * offset);
            context.stroke();

            context.beginPath();
            context.moveTo(col * size / 3 + 2 * offset, (lin + 1) * size / 3 - 2 * offset);
            context.lineTo((col + 1) * size / 3 - 2 * offset, lin * size / 3 + 2 * offset);
            context.stroke();
        }

        if (symbol == 'o') {
            context.strokeStyle = '#cd7c41';

            context.beginPath();
            context.arc(
                (2 * col + 1) * size / 6,
                (2 * lin + 1) * size / 6,
                size / 6 - 1.5 * offset,
                0,
                2 * Math.PI
            );
            context.stroke();
        }

    }

    function drawBoard(context, board) {
        for (var i = 0; i < 9; i++) {
            if (board[i] == 'x' || board[i] == 'o')
                drawSymbol(context, board[i], i);
        }
    }
    
    //draw initial board
    for (var i = 1; i <= 2; i++) {
        context.beginPath();
        context.moveTo(i * size / 3, 0 + offset);
        context.lineTo(i * size / 3, size - offset);
        context.stroke();

        context.beginPath();
        context.moveTo(0 + offset, i * size / 3);
        context.lineTo(size - offset, i * size / 3);
        context.stroke();
    }

    var game;

    var refresh = setInterval(function() {
        $.get("scripts/get_game_state.php", function(data) {
            game = JSON.parse(data);
            // $('#game_state').text(JSON.stringify(game));
            if (game.enemy != '' && game.enemy != null)
                $('#game_state').text('You are now playing ' + game.enemy);
            drawBoard(context, game.board);
            if (game.result != '') {
                clearInterval(refresh);
                $('#game_state').text('You ' + game.result);
                $.get("scripts/delete_game_room.php");
            }
        });
    }, 1000);

    $('#game_canvas').click(function(e){
        var x = e.pageX - this.offsetLeft;
        var y = e.pageY - this.offsetTop;

        var move = 3 * Math.floor(3 * y / size) + Math.floor(3 * x / size)

        if (game.turn)
            $.get(
            "scripts/get_game_state.php",
            { 'move': move },
            function(data) {
                game = JSON.parse(data);
                // $('#game_state').text(JSON.stringify(game));
                if (game.enemy != '' && game.enemy != null)
                    $('#game_state').text('You are now playing ' + game.enemy);
                drawBoard(context, game.board);
                if (game.result != '') {
                    clearInterval(refresh);
                    $('#game_state').text('You ' + game.result);
                }
            }
        )
    }); 


});