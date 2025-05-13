function checkStrength(password){
    var strength = 0
    if (password.length < 6) { 
        $('#strength_message_0').removeClass()
        $('#strength_message_0').addClass('alert-danger fw-bold')
        $('#regbtn').prop('disabled',true)
        return 'Too short' 
    }

    if (password.length > 7) strength += 1
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
    if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
    if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
    if (strength < 2 ){
        $('#strength_message_0').removeClass()
        $('#strength_message_0').addClass('alert-warning fw-bold')
        $('#regbtn').prop('disabled',true)
        return 'Weak'   
    }else if (strength == 2 ){
        $('#strength_message_0').removeClass()
        $('#strength_message_0').addClass('alert-success fw-bold')
        $('#regbtn').prop('disabled',false)

        return 'Good'  
    }else{
        $('#strength_message_0').removeClass()
        $('#strength_message_0').addClass('alert-success fw-bold')
        $('#regbtn').prop('disabled',false)

        return 'Strong'
    }
}

$('[name="reset-password"], [name="confirm-reset-password"]').on('keyup', function(){

    var status = checkStrength($('[name="reset-password"]').val());
    var confirmStatus = checkStrength($('[name="confirm-reset-password"]').val());
 
    //remove disabled to confirm password if password is not empty
    if($('[name="reset-password"]').val() != '' && status == 'Strong'){
        $('[name="confirm-reset-password"]').prop('disabled', false);
    }else{
        $('[name="confirm-reset-password"]').prop('disabled', true);
    }

    if($('[name="confirm-reset-password"]').val() != ''){
        $('.reset-password-btn').prop('disabled', false);
    }else{
        $('.reset-password-btn').prop('disabled', true);
    }

    //show password strength
    if($(this).val() != ''){
        $('#strength_message_0').html(checkStrength($(this).val()));
    }else{
        $('#strength_message_0').html('');
    }

});

$('[name="confirm-reset-password"]').on('focus', function(){
    if($(this).val() == ''){
        $('#strength_message_0').html('');
    }
});

$('#reset_passrword').on('submit', function(e){
    e.preventDefault();
    
    var form = $(this);
    var dir = form.prop('action');

    $.ajax({
        url: 'resetpassword/change_password',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        success: function(response){
            switch(response.status){
                case 'input-match-error':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:red;"><i class="fas fa-times"></i> Password did not match!</p>',
                        closeButton: false
                    });

                    dialog.init(function () {
                        setTimeout(function () {
                            dialog.modal('hide');
                        }, 3000);
                    });
                break;
                
                case 'success':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Change Password Successfull</p>',
                        closeButton: false
                    });

                    dialog.init(function () {
                        setTimeout(function () {
                            window.location.href =  dir + 'login';
                        }, 3000);
                    });

                break;
                
            }
        }
    });

});