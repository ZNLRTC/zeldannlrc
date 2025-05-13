$(document).on('click', '.add-messages-faqs-btn', function(e){
    e.preventDefault();

    var modal = $('#add-message-faq-modal');
    modal.modal('show');
});

$(document).on('change', '#messages-faqs-checkbox', function(){
    $('.parent-question-container').toggleClass('d-none');

    if($(this).is(':checked')){
        $('[name="question-parent"]').prop('required', true);
    }else{
        $('[name="question-parent"]').prop('required', false);
    }
});

$(document).on('submit', '#add-message-faqs-form', function(e){
    e.preventDefault();

    var form = $(this);
    
    $.ajax({
        url: 'add_message_faq',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        success: function(response){
            switch(response.status){
                case 'success':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Added Successfully.</p>',
                        closeButton: false
                    });

                    form[0].reset();

                    dialog.init(function () {
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    });
                break;
            }
        }
    })
});

$(document).on('click', '.delete-faq-btn', function(e){
    e.preventDefault();

    var id = $(this).data('faq-id');
    var question = $(this).data('faq-question');
    var modal = $('#delete-message-faq-modal');
    modal.find('.faq-name').text(question);
    modal.find('[name="faq-id"]').val(id);

    modal.modal('show');

});

$(document).on('submit', '#delete-message-faqs-form', function(e){
    e.preventDefault();

    var form = $(this);

    $.ajax({
        url: 'delete_faq',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        success: function(response){
            switch(response.status){
                case 'success':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Deleted Successfully.</p>',
                        closeButton: false
                    });

                    $('#faq-'+response.id).fadeOut('slow', function(){
                        $(this).remove();
                    });

                    dialog.init(function () {
                        setTimeout(function () {
                            $('#delete-message-faq-modal').modal('hide');
                            dialog.modal('hide');
                        }, 1000);
                    });
                break;

                case 'is_faq_parent':
                    var dialog = bootbox.alert({
                        message: '<p class="text-center mb-0" style="color:red;">Cannot delete question, move or delete questions under selected question</p>',
                        closeButton: false
                    });

                break;

                case 'error':
                    alert('Something went wrong. Please contact IT Administrator.');
                break;
            }
        }
    })
});

$(document).on('click', '.edit-faq-btn', function(e){
    e.preventDefault();

    var id = $(this).data('faq-id');
    var modal = $('#add-message-faq-modal');

    $.ajax({
        url: 'get_faq_info',
        method: 'POST',
        dataType: 'JSON',
        data: {id : id},

        success: function(response){
            switch(response.status){
                case 'success':
                    modal.find('form').attr('id', 'edit-message-faqs-form');
                    modal.find('.checkbox-container, .parent-question-container').addClass('d-none');
                    modal.find('[name="question-parent"]').prop('required', false);
                    modal.find('#faq-modal-dept-'+response.data.department).prop('selected', true);
                    modal.find('[name="question"]').val(response.data.question);
                    modal.find('[name="answer"]').val(response.data.answer);
                    modal.find('form').prepend('<input type="hidden" name="faq-id" value="'+response.data.id+'">');
                    

                break;
            }
        }
    })

    modal.find('.modal-title').text('Edit Message');
    modal.find('[type="submit"]').html('<i class="fas fa-check"></i> Save');

    modal.modal('show');
});

$(document).on('hidden.bs.modal', '#add-message-faq-modal', function(){
    var modal = $(this);
    var form = modal.find('form');
    form.attr('id', 'add-message-faqs-form')
    form[0].reset();

    modal.find('.modal-title').text('Add Message');
    modal.find('[type="submit"]').html('<i class="fas fa-plus"></i> Add');
    modal.find('[name="faq-id"]').remove();
    modal.find('.checkbox-container, .parent-question-container').removeClass('d-none');
});

$(document).on('submit', '#edit-message-faqs-form', function(e){
    e.preventDefault();

    var form = $(this);

    $.ajax({
        url: 'edit_message_faq',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        success: function(response){
            switch(response.status){
                case 'success':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Updated Successfully.</p>',
                        closeButton: false
                    });

                    dialog.init(function () {
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    });
                break;

                case 'error':
                    alert('Something went wrong. Please contact IT Administrator.');
                break;
            }
        }
    });
});

$(document).on('click', '.add-faq-keyword-btn', function(e){
    e.preventDefault();
    var modal = $('#add-faq-keyword-modal');

    modal.modal('show');
});

$(document).on('submit', '#add-faq-keyword-form', function(e){
    e.preventDefault();

    var form = $(this);

    $.ajax({
        url: 'add_faq_keyword',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        success: function(response){
            switch(response.status){
                case 'success':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Added Successfully.</p>',
                        closeButton: false
                    });

                    dialog.init(function () {
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    });
                break;
            }
        }
    })
});



