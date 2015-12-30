$('#password, #passconfirm').on('keyup', function () {
    if ($('#password').val() == $('#passconfirm').val()) {
        $('#message').html('Matching').css('color', 'green');
    } else 
        $('#message').html('Not Matching').css('color', 'red');
});