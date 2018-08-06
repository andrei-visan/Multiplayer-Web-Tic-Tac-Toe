$( document ).ready(function() {

    var messages_container = $('.messages_container');
    var last_index = 1;

    function add_message(message) {
        var new_message = $('<div>').addClass('chat_message');
        new_message.append('<b>' + message[0] + '</b>');
        new_message.append('<p>' + message[1] + '</p>');

        var new_msg_time = $('<span>').addClass('time-right');
        new_msg_time.append(message[2]);
        new_message.append(new_msg_time);

        messages_container.append(new_message);
    }

    // initialise chat
    $.get("scripts/get_messages.php", function(data) {
        messages = JSON.parse(data);

        var i;
        for (i = last_index; i <= Object.keys(messages).length; i++) {
            add_message(messages[i]);
            last_index = i + 1;            
        }
        
        messages_container.animate({
            scrollTop: messages_container.get(0).scrollHeight}, 1000);
        
        // refresh chat every 5s
        var refresh = setInterval(function() {
            $.get("scripts/get_messages.php", function(data) {
                messages = JSON.parse(data);
                
                for (var i = last_index; i <= Object.keys(messages).length; i++) {
                    add_message(messages[i]);
                    last_index = i + 1;
                }

                messages_container.animate({
                    scrollTop: messages_container.get(0).scrollHeight}, 1000);
            });
        }
        ,1000);
    });
    
    $('#message_post_button').click(function() {
        $.get("scripts/add_message.php",
            { 'message':  $('.chat_new_message_text'). val()}
        );

        $('.chat_new_message_text').val('');
    })
    
    $('.chat_new_message_text').keyup(function(e) {
        if (e.keyCode === 13) {
            $("#message_post_button").click();
        }
    });

});