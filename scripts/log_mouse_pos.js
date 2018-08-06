$(document).ready(function() {

    var intervals = 20;

    var posX = -1,
        posY = -1,
        mouse_pos_array = new Array(intervals * intervals).fill(0),
        row, col;    

    $(document).mousemove(function(e) {
        posX = e.clientX;
        posY = e.clientY;
    });

    var log_pos = setInterval(function() {
        if (posX >= 0) {
            row = Math.floor(posY / $(window).innerHeight() * intervals);
            col = Math.floor(posX / $(window).innerWidth() * intervals);
            mouse_pos_array[row * intervals + col] += 1;
        }
    }, 100);

    var send_log = setInterval(function() {
        $.get("scripts/log_mouse_pos.php",
            { 'mouse_pos': mouse_pos_array});
    }, 5000);

});