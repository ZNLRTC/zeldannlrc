$(document).on('click', '.edit-deployment-date-btn', function(){
    var modal = $('#update-deployment-date-modal');
    var userId = $(this).data('user-id');
    modal.find('[name="user-id"]').val(userId);
    modal.modal('show');
})

$(document).on('submit', '#update-deployment-date-form', function(e){
    e.preventDefault();
    var form = $(this);

    $.ajax({
        url: 'update_trainee_deployment_date',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        beforeSend: function(){},

        success:function(response){
            if(response.status == 'success'){
                var dialog = bootbox.dialog({
                    message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> '+response.message+'</p>',
                    closeButton: false
                });
    
                dialog.init(function () {
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                });
            }
        }
    })
})