$( document ).ready(function() {

    $.get("scripts/get_game_rooms.php", function(data) {

        var games = JSON.parse(data);

        for(var game in games)
            $('#game_rooms')
            .append(
                $('<li></li>')
                .text(String(games[game]) + ' game room')
                .addClass('game_link')
            );

        $('.game_link').click(function(){
            var linkStr = $(this).text();
            $.get(
                "scripts/join_game_room.php",
                {player1: linkStr.substr(0,linkStr.indexOf(' '))},
                function(data) {
                    if (data == 'success')
                        window.location.replace('game.php');
                    else
                        console.log('Error joining room');
                });
        })
    });

    

});