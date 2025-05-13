$(document).on('submit', '#form-forgot-password', function(e){
    e.preventDefault();

    var $form = $(this);
    var url = $form.find('button').data('url');
    var dir = url + 'app/views/login/controller/send_reset_password_link.php';

    $.ajax({
        url: url + 'login/validate_user_email',
        method: 'POST',
        data: $form.serialize(),
        dataType: 'JSON',

        success: function(response){
            if(response.status == 'invalid-email'){
                $form.prepend(`<div class="alert alert-danger">Email does not exist in the system. Make sure you are registered to change your password.</div>`);
                exit;
            }else if(response.status == 'success'){
                $.ajax({
                    url: dir,
                    dataType: 'JSON',
                    method: 'POST',
                    data: {email: response.data.email, date: response.data.updated_at},

                    beforeSend: function(){
                        $form.find('.alert').remove();
                        $form.find('button').html('<i class="fas fa-spinner fa-spin"></i> Sending Email...').prop('disabled', true);
                    },

                    success: function(){
                        $form.prepend(`<div class="alert alert-success">Message sent, kindly check your email within the next 5 minutes.</div>`);
                        $form.find('button').html('Request').prop('disabled', false);
                        
                        setTimeout(function(){
                            window.location.reload();
                        }, 3000);
                    }
                });
            }
        }
    });
});