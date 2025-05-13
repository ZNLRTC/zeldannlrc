$(document).on('click', '.close-ticket-btn', function(e){
    e.preventDefault();

    var ticketId = $(this).data('ticket-id');
    var modal = $('#close-ticket-modal');

    $('#close-ticket-form').find('[name="ticket-id"]').val(ticketId);
    modal.modal('show');
    
});

$(document).on('submit', '#close-ticket-form', function(e){
    e.preventDefault();
    
    var form = $(this);

    $.ajax({
        url: 'close_ticket',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        success: function(response){
            switch(response.status){
                case 'success':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Closed Successfully.</p>',
                        closeButton: false
                    });

                    dialog.init(function () {
                        setTimeout(function () {
                            dialog.modal('hide');
                            window.location.reload();
                        }, 2000);
                    });
                break;

                case 'error':
                    alert('Something went wrong. Please contact IT administrator.');
                break;
            }
        }
    });
});

$(document).on('click', '.open-ticket-btn', function(e){
    e.preventDefault();

    var ticketId = $(this).data('ticket-id');
    var modal = $('#open-ticket-modal');

    $('#open-ticket-form').find('[name="ticket-id"]').val(ticketId);
    modal.modal('show');
    
});

$(document).on('submit', '#open-ticket-form', function(e){
    e.preventDefault();
    
    var form = $(this);

    $.ajax({
        url: 'open_ticket',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        success: function(response){
            switch(response.status){
                case 'success':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Opened Successfully.</p>',
                        closeButton: false
                    });

                    dialog.init(function () {
                        setTimeout(function () {
                            dialog.modal('hide');
                            window.location.reload();
                        }, 2000);
                    });
                break;

                case 'error':
                    alert('Something went wrong. Please contact IT administrator.');
                break;
            }
        }
    });
});

$(document).on('click', '.view-user-btn', function () {
    var user_ed = $(this).attr('user-id');
    $.ajax({
        method: 'POST',
        data: { user_ed: user_ed },

        success: function (d) {
            let form = '<form action="view?' + user_ed +'" method="post" id="view_app" >';
            form += '<input type="hidden" id="user_ed" name="user" value="' + user_ed + '">';
            form += '</form>';
            $('body').append(form);
            $('#view_app').submit();
        }
    });
});
