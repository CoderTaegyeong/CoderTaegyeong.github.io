$(function () {
    // init the validator
    $('#contact-form').validator();

    // when the form is submitted
    $('#contact-form').on('submit', function (e) {
        // if the validator does not prevent form submit
        if(!e.isDefaultPrevented()) {
            var url = "contact.php";

            // Post values in the background the script URL
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (data)
                {
                    // data = JSON object that contact.php returns
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;

                    // Bootstrap alert box
                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    
                    // If we have messageAlert and messageText
                    if(messageAlert && messageText) {
                        // inject the alert to .messages div in our form
                        $('#contact-form').find('.messages').html(alertBox);
                        //empty the form
                        $('#contact-form')[0].reset();
                    }
                }
            });
            return false;
        }
    })
});