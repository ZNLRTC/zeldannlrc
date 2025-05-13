$(document).on('click', '.add-new-testimonial', function(){
    var modal = $('#add-new-testimonial-modal');
    modal.find('small').addClass('d-none');
    modal.modal('show');
})

$(document).on('click', '.edit-testimonial-btn', function(){
    var id = $(this).parent().data('testimonial-id');
    var modal = $('#add-new-testimonial-modal');

    $.ajax({
        url: 'fetch_testimonial',
        method: 'POST',
        dataType: 'JSON',
        data: {id : id},

        success: function(response){
            switch(response.status){
                case 'success':
                    var form = $('#testimonial-add-edit-form');
                    form.find('[name="t-id"]').val(id);
                    form.find('[name="action"]').val('edit');
                    form.find('[name="t-name"]').val(response.data.name);
                    form.find('[name="t-testimonial"]').val(response.data.testimonial);
                    form.find('small').removeClass('d-none');
                    modal.modal('show');
                break;
            }
        }
    })

})

$(document).on('click', '.save-testimonial-btn', function(){
    var name = $('[name="t-name"]').val(); //pag kuha ng name
    var testimonial = $('[name="t-testimonial"]').val(); //pag kuha ng testimonial
    var image = $('[name="t-image"]').prop('files')[0]; //pagkuha ng file
    var action = $('[name="action"]').val();
    var id = $('[name="t-id"]').val();
    var form = $('#testimonial-add-edit-form');
    var modal = $('#add-new-testimonial-modal');

    //lalagay natin sa formData yung mga info na needed, para yun ang ipapasa sa php file
    var formData = new FormData(form[0]);
    formData.append('name', name);
    formData.append('testimonial', testimonial);
    formData.append('image', image);
    formData.append('action', action);
    formData.append('id', id);

    if(action == 'add' || action == 'edit'){
        saveTestimonial(formData, id, form, modal, action);
    }else{
        deletePreviousImage(formData, id, form, modal, action)
        //saveTestimonial(formData, id, form, modal, action);
    }

})

function deletePreviousImage(formData, id, form, modal, action){
    
    $.ajax({
        url: 'delete_previous_image',
        method: 'POST',
        dataType: 'JSON',
        data: {id: id},

        success: function(response){
            switch(response.status){
                case 'success':
                    saveTestimonial(formData, id, form, modal, action);
                break;
            }
        }
    })
}

function saveTestimonial(formData, id, form, modal, action){
    $.ajax({
        url: 'save_testimonial',
        method: 'POST',
        dataType: 'JSON',
        data: formData,
        contentType: false,
        processData: false,

        success: function(response){
            switch(response.status){
                case 'success':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Updated Successfully.</p>',
                        closeButton: false
                    });

                    if(action == 'edit'){
                        var card = $('#testimonial-' + id);
                        card.find('img').attr('src', response.url + '' + response.testimonial.image);
                        card.find('h5').text(response.testimonial.name);
                        card.find('.card-text').text(response.testimonial.testimonial);
                    }else{
                        var html = `<div id="testimonial-${response.testimonial.id}" class="card" >
                                        <div class="card-body">
                                            <div class="row align-items-center mb-3">
                                                <div class="col-md-1">
                                                    <img class="w-100" src="${response.url +''+ response.testimonial.image}" alt="${response.testimonial.image}">
                                                </div>
                                                <div class="col-md-11">
                                                    <h5 class="card-title mb-0">${response.testimonial.name}</h5>
                                                </div>
                                            </div>
                                            <p class="card-text">${response.testimonial.testimonial}</p>
                                        </div>

                                        <div class="card-footer" data-testimonial-id="${response.testimonial.id}">
                                            <button class="btn btn-sm btn-primary edit-testimonial-btn" ><i class="fas fa-pen"></i> Edit</button>
                                            <button class="btn btn-sm btn-danger delete-testimonial-btn"><i class="fas fa-trash-alt"></i> Delete</button>
                                        </div>
                                    </div>`;

                        var container = $('#testimonials-container');
                        container.prepend(html);
                    }

                    setTimeout(function(){
                        dialog.modal('hide');
                        form[0].reset();
                        modal.modal('hide');
                    }, 2000);
                break;
            }
        }
    })
}

$(document).on('click', '.delete-testimonial-btn', function(){
    var id = $(this).parent().data('testimonial-id');
    var modal = $('#confirm-delete-testimonial-modal');
    modal.find('form').find('[name="t-id"]').val(id);
    modal.modal('show');
});

$(document).on('click', '.confirm-delete-testimonial-btn', function(){
    var form = $('#confirm-delete-testimonial-form');
    var id = form.find('[name="t-id"]').val();
    var modal = $('#confirm-delete-testimonial-modal');

    $.ajax({
        url: 'delete_previous_image',
        method: 'POST',
        dataType: 'JSON',
        data: {id: id},

        success: function(response){
            switch(response.status){
                case 'success':
                    $.ajax({
                        url: 'delete_testimonial',
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
                
                                    $('#testimonial-' + id).fadeOut('slow', function(){
                                        $(this).remove();
                                    });
                
                                    modal.modal('hide');
                
                                    setTimeout(function(){
                                        dialog.modal('hide');    
                                    }, 2000)
                                break;
                            }
                        }
                    });
                break;
            }
        }
    })
});


$(document).ready(function(){
    $('#add-new-testimonial-modal').on('hidden.bs.modal', function(){
        var form = $('#testimonial-add-edit-form');
        form[0].reset();
        form.find('[name="action"]').val('add');
    })
})
