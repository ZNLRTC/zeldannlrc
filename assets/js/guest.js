
//on click mobile nav menu
function myFunction() {
    var x = document.getElementById("myLinks");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}

// save registered guest
$(document).ready(function(){
    $('#pwd').keyup(function(){ 
        $('#strength_message').html(checkStrength($('#pwd').val()))
    });

    function checkStrength(password)
    {
    var strength = 0
    if (password.length < 6) { 
    $('#strength_message').removeClass()
    $('#strength_message').addClass('alert-danger fw-bold')
    $('#regbtn').prop('disabled',true)
    return 'Too short' 

    }



    if (password.length > 7) strength += 1
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
    if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
    if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
    if (strength < 2 )

    {
    $('#strength_message').removeClass()
    $('#strength_message').addClass('alert-warning fw-bold')
    $('#regbtn').prop('disabled',true)
    return 'Weak'   
    }

    else if (strength == 2 )
    {
    $('#strength_message').removeClass()
    $('#strength_message').addClass('alert-success fw-bold')
    $('#regbtn').prop('disabled',false)

    return 'Good'  
    }
    else
    {
    $('#strength_message').removeClass()
    $('#strength_message').addClass('alert-success fw-bold')
    $('#regbtn').prop('disabled',false)

    return 'Strong'
    }
    }
});

$(document).on('submit','#register_guest',function(e){
    e.preventDefault()
    if(!$("#checkbox-signup").prop("checked"))
    {
        $('#agree_chk_error').html('Please check that you have read and agree to the Terms and Conditions and Privacy Policy.')
        $("#agree_chk_error").addClass('alert-danger fw-bold');
        $('#regbtn').prop('disabled',true)

        setTimeout(function () {
            $("#agree_chk_error").removeClass();
            $('#agree_chk_error').html('');
            $('#regbtn').prop('disabled',false)
        }, 4000);
    }
    else
    {
        $("#agree_chk_error").removeClass();
        var data = $('form#register_guest').serialize();
        var url = $(this).prop('action');

        $.ajax({
            url: url,
            method:'post',
            data: data,
            dataType:'JSON',

            beforeSend: function(){
            },

            success: function (data){
                console.log(data)
                if(data['user_insrted'] == 1){
                     $('#mailExist').html('The email you have entered already exists. Please proceed to login.');
                     $("#mailExist").addClass('alert-danger fw-bold');
                     setTimeout(function () {
                        $("#mailExist").removeClass();
                        $('#mailExist').html('');
                        }, 4000);
                }else{
                    window.location.replace("guest_doneRegister")
                }
            }
        });
    }

    return false;
});

$(document).on('submit', '.form-contact-us', function(e){
    e.preventDefault();

    var form = $('.form-contact-us');
    var responseDiv = form.find('.response-div');
    var url = form.prop('action') + 'app/views/guest/partials/ajax_send_email_contact_us.php';
    var btn = $('.form-contact-us-submit');

    $.ajax({
        url: url,
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        beforeSend: function(){
            btn.html('Sending...');
        },

        success: function(response){
            switch(response.status){
                case 'success':
                    var html = `<div class="alert alert-success font-14">Your message has been sent! We will respond to your email within 24 hours.</div>`;
                    responseDiv.html(html);
                    form[0].reset();

                    setTimeout(function(){
                        responseDiv.find('.alert').remove();
                    }, 5000);
                break;

                case 'error':
                    var html = `<div class="alert alert-danger font-14">Sending email failed. You may send an email directly to support@nlrc.com. Thanks!</div>`;
                    responseDiv.html(html);
                    form[0].reset();

                    setTimeout(function(){
                        responseDiv.find('.alert').remove();
                    }, 5000);
                break;
            }
        }
    }).always(function(){
        btn.html('Send');
    });
});

$(document).on('change', '[name="register-batch-names"]', function(){
    var batch = $(this).val();
    $('[name="register-batch-numbers"] option').addClass('d-none');
    $('[name="register-batch-numbers"] option.bat-'+batch).removeClass('d-none');
});

$(document).on('click', '.accordion-header', function(){
    var id = $(this).data('accordion-id');
    //$('.accordion-collapse').slideUp();
    if($('#faq-accordion #collapses-'+id).hasClass('show')){
        $('#faq-accordion #collapses-'+id).slideUp();
        $('#faq-accordion .ab-'+id).addClass('collapsed');
        $('#faq-accordion #collapses-'+id).removeClass('show');
    }else{
        $('#faq-accordion #collapses-'+id).slideDown();
        $('#faq-accordion .ab-'+id).removeClass('collapsed');
        $('#faq-accordion #collapses-'+id).addClass('show');
    }
    
})

