$(document).ready(function(){
    tinymce.init({
        selector: '#blog-textarea',
        plugins: [
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount', 'code',
            'checklist', 'mediaembed', 'a11ychecker', 'advtable', 'editimage'
        ],
        toolbar: 'undo redo | bold italic underline | link image media | align lineheight | checklist numlist bullist',
        
        // Add the image upload handler here
        image_title: true,
        automatic_uploads: true,
        file_picker_types: 'image media',  // Allow image and media selection
        
        // File picker for the image dialog
        file_picker_callback: function (callback, value, meta) {
            let input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function () {
                let file = this.files[0];
                let reader = new FileReader();
                reader.onload = function () {
                    callback(reader.result, {
                        alt: file.name
                    });
                };
                reader.readAsDataURL(file);
            };
            input.click();
        }
    });

    $('#add-new-blog-modal').on('hidden.bs.modal', function() {
        var form = $('#blog-add-edit-form');
        form.find('.text-warning').addClass('d-none');
        form[0].reset();
    });
})
    

$(document).on('click', '.add-new-blog', function(){
    var modal = $('#add-new-blog-modal');
    modal.modal('show');
});

$(document).on('click', '.save-blog-btn', function(){
    var form = $('#blog-add-edit-form');
    var title = form.find('[name="b-title"]').val();
    var content = tinymce.activeEditor.getContent();
    var image = $('[name="b-image"]').prop('files')[0]; //pagkuha ng file
    var action = $('[name="action"]').val();
    var id = $('[name="b-id"]').val();
    var form = $('#blog-add-edit-form');
    var modal = $('#add-new-blog-modal');

    //lalagay natin sa formData yung mga info na needed, para yun ang ipapasa sa php file
    var formData = new FormData(form[0]);
    formData.append('title', title);
    formData.append('content', content);
    formData.append('image', image);
    formData.append('action', action);
    formData.append('id', id);

    if(action == 'add'){
        saveBlog(formData, form, modal);
    }else{
        //deletePreviousImage(formData, id, form, modal, action)
        //saveTestimonial(formData, id, form, modal, action);
        if(image){
            $.ajax({
                url: 'delete_blog_image',
                method: 'POST',
                dataType: 'JSON',
                data: {id: id},
    
                success: function(response){
                    switch(response.status){
                        case 'success':
                            saveBlog(formData, form, modal);
                        break;
                    }
                }
            })
        }else{
            saveBlog(formData, form, modal);
        }
        
    }
})

function saveBlog(formData, form, modal){
    $.ajax({
        url: 'save_blog',
        method: 'POST',
        dataType: 'JSON',
        data: formData,
        contentType: false,
        processData: false,

        beforeSend: function(){
            $('.save-blog-btn').html('<i class="fas fa-spinner fa-spin"></i> Saving').addClass('disabled');
        },

        success: function(response){
            switch(response.status){
                case 'success':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Updated Successfully.</p>',
                        closeButton: false
                    });

                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                break;
            }
        }
    })
}

$(document).on('click', '.view-blog', function(){
    window.location.href = $(this).data('url');
})

$(document).on('click', '.edit-blog', function(){
    var modal = $('#add-new-blog-modal');
    var id = $(this).closest('[data-blog-id]').data('blog-id');

    $.ajax({
        url: 'fetch_blog',
        method: 'POST',
        dataType: 'JSON',
        data: {id : id},

        success: function(response){
            switch(response.status){
                case 'success':
                    var form = $('#blog-add-edit-form');
                    var content = tinymce.activeEditor.getContent();
                    form.find('[name="b-id"]').val(response.data.id);
                    form.find('[name="action"]').val('edit');
                    form.find('[name="b-title"]').val(response.data.title);
                    tinymce.activeEditor.setContent(response.data.content);
                    form.find('.text-warning').removeClass('d-none');
                    modal.modal('show');
                break;
            }
        }
    })
});

$(document).on('click', '.delete-blog-btn', function(){
    var id = $(this).closest('[data-blog-id]').data('blog-id');
    var modal = $('#confirm-delete-blog-modal');
    modal.find('form').find('[name="id"]').val(id);
    modal.modal('show');
});

$(document).on('click', '.confirm-delete-blog-btn', function(){
    var form = $('#confirm-delete-blog-form');
    var id = form.find('[name="id"]').val();
    var modal = $('#confirm-delete-blog-modal');

    $.ajax({
        url: 'delete_blog_image',
        method: 'POST',
        dataType: 'JSON',
        data: {id: id},

        success: function(response){
            switch(response.status){
                case 'success':
                    $.ajax({
                        url: 'delete_blog',
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
                
                                    $('#blog-' + id).parent().fadeOut('slow', function(){
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