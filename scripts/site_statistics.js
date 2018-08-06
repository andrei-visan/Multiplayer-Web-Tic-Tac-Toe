$( document ).ready(function() {

    var table = $('#mouse_pos_table');

    $.get("scripts/get_mouse_pos.php", function(data) {
        var mouse_pos = JSON.parse(data);
        var max_intensity = 0;

        // value of cell with maximum intensity (will have pure white color)
        for (var i = 0; i < 400; i++)
            if (mouse_pos[i] > max_intensity)
                max_intensity = i;

        for (var row = 0; row < 20; row++) {
            var new_row = $('<tr></tr>');
            for (var col = 0; col < 20; col++) {
                var new_cell = $('<td>&emsp;&ensp;</td>')
                var intensity = Math.floor(mouse_pos[row * 20 + col] / max_intensity * 255);

                var color = 'rgb(' + intensity + ',' + intensity + ',' + intensity + ')';

                new_cell.css('background-color', color);
                new_row.append(new_cell);
            }
            table.append(new_row);
        }
    });

    $.get("scripts/get_player_scores.php", function(data) {
        var players = JSON.parse(data);
        var players_arr = [];
        for (var player in players) {
            players_arr.push([player, players[player]]);
        }

        var player_table = $('#player_table');

        players_arr.sort(function(a, b) { return parseFloat(b[1]) - parseFloat(a[1]) });

        for (var i = 0; i < players_arr.length && i < 10; i++) {

            var cell1 = $('<td>'+(i + 1)+'. '+players_arr[i][0]+'</td>');
            var cell2 = $('<td>'+players_arr[i][1]+'</td>');
            cell1.css('font-size', '20px');
            cell2.css('font-size', '20px');

            var new_row = $('<tr></tr>');
            new_row.append(cell1);
            new_row.append(cell2);

            player_table.append(new_row);
        }
    });
});