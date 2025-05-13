$(document).on('click','.delete-inforeq-btn', function () {
    var id = $(this).attr('inforeq-id');
    var name = $(this).data('name');

    var modal = $('#confirm-delete-inforeq-modal');
    modal.find('form').find('[name="inforeq_id"]').val(id);
    modal.find('form').find('.inforeq-name').text(name);
    modal.modal('show')
        
});


$(document).on('click','.confirm-delete-inforeq-btn', function () {
    var modal = $('#confirm-delete-inforeq-modal');
    var form = $('#confirm-delete-inforeq-form');
    var id = form.find('[name="inforeq_id"]').val();

    $.ajax({
        url: 'delete_inforeq',
        method: 'POST',
        dataType: 'JSON',
        data: {id : id},

        success: function(response){
            switch(response.status){
                case 'success':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Deleted Successfully.</p>',
                        closeButton: false
                    });

                    $('#table-' + id).fadeOut( "slow", function() {
                        $(this).remove();
                      });
                    modal.modal('hide');
                    setTimeout(function(){
                        dialog.modal('hide');

                    }, 2000);
                break;
            }
        }
    })

});