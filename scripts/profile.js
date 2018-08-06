$( document ).ready(function() {
    
    $('#editBio').click(function () { 
        $('input:text').attr('readonly', false);
        $('input:text').css('background-color', '#FFFFFF',);
    });

    $('#saveBio').click(function () {
        $('input:text').attr('readonly', true);

        $('input:text').css('background-color', '#DDDDDD',);

        var request = $.post("scripts/save_profile_info.php", 
            {
                bioText: $('#bioText').val(),
                name: $('#name').val(),
                email: $('#email').val(),
                country: $('#country').val()
            }
        );
    });

    $('#uploadButton').on('click', function() {
        $.ajax({
            url: 'scripts/save_profile_picture.php',
            type: 'POST',
            data: new FormData($('form')[0]),
            cache: false,
            contentType: false,
            processData: false,
        });
        location.reload();
    });

});