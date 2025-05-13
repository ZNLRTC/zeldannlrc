$(document).on('submit', '#login_admin', function (e) {

    e.preventDefault()

    var login_data = $('#login_admin').serialize();

    var url = $(this).prop('action');

    $.ajax({

        url: url,

        method: 'POST',

        data: login_data,

        dataType: 'JSON',

        beforeSend: function () {

        }, 

        success: function (data) {

            switch(data[1]) {
                case 0:
                    window.location.href = base_url + 'profile/dashboard';
                    break;
            
                case 1:
                    $('#login_error').removeClass('d-none');
                    setTimeout(function () {
                        $('#login_error').addClass('d-none');
                    }, 5000);
                    break;
            
                case 2:
                    $('#login_error2').removeClass('d-none');
                    setTimeout(function () {
                        $('#login_error2').addClass('d-none');
                    }, 5000);
                    break;
            
                case 3:
                    window.location.href = base_url + 'login/validating';
                    break;
            
                case 4:
                    $('#login_error3').removeClass('d-none');
                    setTimeout(function () {
                        $('#login_error3').addClass('d-none');
                    }, 5000);
                    break;
            
                case 5:
                    window.location.href = base_url + 'admin/dashboard';
                    break;
            
                case 6:
                    window.location.href =  base_url + 'login/disapproved';
                    break;
            
                case 7:
                    window.location.href = base_url + 'login/employee_suspended?email='+data[2];
                    break;
            
                default:
                    console.log('Unhandled case');
            }
        }
    });
});


$(document).on('click', '.password-toggle-eye', function() {
    var form = $('#login_admin');

    if($(this).hasClass('fa-eye-slash')){
        $(this).removeClass('fa-eye-slash').addClass('fa-eye');
        form.find('#password').attr('type', 'text');
    }else{
        $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        form.find('#password').attr('type', 'password');
    }
});



$(function() {

    if (localStorage.chkbx && localStorage.chkbx != '') {
        $('#remember_me').attr('checked', 'checked');
        $('#emailaddress').val(localStorage.usrname);
        $('#password').val(localStorage.pass);
    } else {
        $('#remember_me').removeAttr('checked');
        $('#emailaddress').val('');
        $('#password').val('');
    }



    $('#remember_me').click(function() {

        if ($('#remember_me').is(':checked')) {
            // save username and password
            localStorage.usrname = $('#emailaddress').val();
            localStorage.pass = $('#password').val();
            localStorage.chkbx = $('#remember_me').val();
        } else {
            localStorage.usrname = '';
            localStorage.pass = '';
            localStorage.chkbx = '';
        }
    });
});


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
                        $form.find('button').html('<i class="fas fa-spinner fa-spin"></i> Sending Email...');
                    },

                    success: function(){
                        $form.prepend(`<div class="alert alert-success">Message sent, kindly check your email within the next 5 minutes.</div>`);
                        
                        setTimeout(function(){
                            window.location.reload();
                        }, 3000);
                    }
                });
            }
        }
    });
});

$(document).on('keyup', '#emailaddress', function(){
    if($(this).val() == 'it_administrator'){
        $('#emailaddress').attr('type', 'text');
    }else{
        $('#emailaddress').attr('type', 'email');
    }
});

$(document).on('click', '.request-access-btn', function(e){
    e.preventDefault();

    var email = $(this).data('employee-email');

    if(email != ''){
        var modal = $('#system-access-time-modal');
        modal.find('[name="user-email"]').val(email);
        modal.modal('show');
    }else{
        window.location.href = './';
    }
})

$(document).on('click', '.system-access-time-modal-submit-btn', function(){
    var form = $('#system-access-time-form');
    var from = form.find('[name="access-from"]').val();
    var to = form.find('[name="access-to"]').val();
    var email = form.find('[name="user-email"]').val();
    var purpose = form.find('[name="access-purpose"]').val();

    $.ajax({
        url: 'save_system_request_access',
        method: 'POST',
        dataType: 'JSON',
        data: {email: email, from: from, to: to, purpose: purpose},

        beforeSend: function(){},

        success:function(response){
            switch(response.status){
                case 'success':
                    var modal = $('#system-access-time-modal');
                    var html = '<div class="alert alert-success">'+response.message+'</div>';
                    var responseDiv = modal.find('.response');
                    responseDiv.append(html);

                    setTimeout(function(){
                        window.location.href = './';
                    }, 2000);
                break;
            }
        }
    })
})