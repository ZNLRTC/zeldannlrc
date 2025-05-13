// $('#update_profile').on('submit', function(e){
//     e.preventDefault();
//     console.log('asdasd');
//     var data = $('#update_profile').serialize();
//     var url = $(this).prop('action') + 'profile/update';

//     $.ajax({
//         url: url,
//         method: 'POST',
//         data: data,
//         dataType: 'JSON',

//         beforeSend: function () {

//         },

//         success: function (data) {
//             if(data['user'] == 1){
//                 $('#profUpdate').removeClass('d-none');

//                 setTimeout(function () {
//                     $('#profUpdate').addClass('d-none');
//                 }, 5000);

//             }else{
//             }
//         }
//     });
// });

//Update Personal Data 
$('#form-personal-data, #form-passport-information, #form-address, #form-spouse, #form-child').on('submit', function(e){
    e.preventDefault();
    
    var form = $(this);
    var btn = form.find('button');

    switch(form.attr('id')){
        case 'form-personal-data':
            var action = 'personal_info';
        break;

        case 'form-passport-information':
            var action = 'passport_info';
        break;

        case 'form-address':
            var action = 'address_info';
        break;

        case 'form-spouse':
            var action = 'spouse_info';
        break;

        case 'form-child':
            var action = 'child_info';
        break;
    }

    $.ajax({
        url: form.attr('action') + 'profile/update_info',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize() + '&action=' + action,

        beforeSend: function(){
            switch(action){
                case 'personal_info':
                    $('#form-personal-data').find('.alert-danger').removeClass('alert-danger');
                break;

                case 'passport_info':
                    $('#form-passport-information').find('.alert-danger').removeClass('alert-danger');
                break;

                case 'address_info':
                    $('#form-address').find('.alert-danger').removeClass('alert-danger');
                break;

                case 'spouse_info':
                    $('#form-spouse').find('.alert-danger').removeClass('alert-danger');
                break;

                case 'child_info':
                    $('#form-child').find('.alert-danger').removeClass('alert-danger');
                break;
            }
        },

        success: function(response){
            var dialog = bootbox.dialog({
                message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Update Successfull</p>',
                closeButton: false
            });

            dialog.init(function () {
                setTimeout(function () {
                    if(action == 'child_info'){
                        window.location.reload();
                    }else{
                        dialog.modal('hide');
                    } 
                }, 2000);
            });
        }

    });
});

$(document).on('click', '.request-update-znlrc-info-btn', function(e){
    e.preventDefault();
    
    var modal = $('#znlrc-info-update-modal');
    var userId = $(this).data('user-id');
    modal.find('[name="user-id"]').val(userId);
    modal.modal('show');
});


$(document).on('click', '.logoutApp', function (s) {

    s.preventDefault();

    var pageURL = $(location).attr("href");

    var url = $(this).attr("url");

    var url2 = $(this).attr("href");

    bootbox.confirm({

        closeButton: false,

        message: "Are you sure to logout?",

        buttons: {

            confirm: {

                label: 'Yes',

                className: 'btn-success'

            },

            cancel: {

                label: 'No',

                className: 'btn-danger'

            }

        },

        callback: function (result) {

            if (result) {

                $.ajax({

                    url: url,

                    method: 'POST',

                    beforeSend: function () {

                    },

                    success: function (data) {

                        console.log(data)

                        if(data){

                            var dialog = bootbox.dialog({

                                message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',

                                closeButton: false

                            });

                            dialog.init(function () {

                                setTimeout(function () {

                                    dialog.modal('hide');

                                }, 2000);

                                window.location.replace(url2);

                            });

                        }else{

                            console.log("error")

                        }

                       

                    }

                });

                

            } else {

                console.log('no action')

            }

        }

    });

});





(function() {

  

    'use strict';

  

    $('.input-file').each(function() {

      var $input = $(this),

          $label = $input.next('.js-labelFile'),

          labelVal = $label.html();

      

     $input.on('change', function(element) {

        var fileName = '';

        var filesw = this.files[0];

         var fileType = filesw.type;

        if (element.target.value) fileName = element.target.value.split('\\').pop();

        fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);



        var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office'];

        if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) )){

            $('.statusMsg').html('<p class="alert alert-danger">Sorry, only PDF files are allowed to upload.</p>');

            $('#form')[0].reset();

            $('.submitBtn').attr("disabled","disabled");

            return false;

        }else{

            $('.submitBtn').attr("disabled",false);

            $('.statusMsg').html('');



        }

     });

    });

  

  })();







  

  

  $(document).ready(function(e){

    // Submit form data via Ajax

    $("#form").on('submit', function(e){

        e.preventDefault();

      



        var url = $(this).attr('action');

        var file = $('#file').prop("files")[0];

        var form = new FormData(this);

        

        form.append("image", file);

        $.ajax({

            type: 'POST',

            url: url,

            data: form,

            dataType: 'json',

            contentType: false,

            cache: false,

            processData:false,

            beforeSend: function(){

                $('.submitBtn').attr("disabled","disabled");

                $('#form').css("opacity",".5");

            },

            success: function(response){

                $('.statusMsg').html('');

                if(response['upload'] == 2){

                    $('#form')[0].reset();

                    $('.statusMsg').html('');

                    bootbox.alert({

                        closeButton: false,

                        message: '<p class="alert alert-success"><i class="icon fa fa-check"></i> Uploaded!</p>',

                        callback: function () {

                            $('.js-fileName').html('Choose File!'); 

                            $('.js-labelFile').removeClass('has-file'); 

                            window.location.reload();

                        }

                        });

                }else if(response['upload'] == 3){

                    $('.statusMsg').html('<p class="alert alert-warning"><i class="icon fa fa-check"></i> Cannot Upload the file!</p>');

                    

                }else if(response['upload'] == 4){

                    $('.statusMsg').html('<p class="alert alert-warning"><i class="icon fa fa-check"></i> Invalid File!</p>');

                }else if(response['upload'] == 5){

                    $('.statusMsg').html('<p class="alert alert-warning"><i class="dripicons-wrong"></i> Please Select File!</p>');

                }

                else if(response['upload'] == 1){

                    $('.statusMsg').html('<p class="alert alert-warning"><i class="dripicons-wrong"></i> You have reach the maximum upload limit!</p>');

                }

                $('#form').css("opacity","");

                $(".submitBtn").removeAttr("disabled");

                

            }

        });

    });

    // $(document).on('submit', '#form', function(e){
    //     e.preventDefault();

    //     var url = 'profile/upload_document';
    //     var fileInput = $('#file');
    //     var file = fileInput.files[0];
    //     var formData = new FormData();
    //     formData.append('file', file);

    //     var xhr = new XMLHttpRequest();
    //     xhr.open('POST', url, true);

    //     xhr.upload.onprogress = function(event){
    //         if(event.lengthComputable){
    //             var 
    //         }
    //     }
    // });

});











  //upload avatar

  (function() {

  

    'use strict';

  

    $('.input-fileava').each(function() {

      var $input = $(this),

          $label = $input.next('.js-labelFileava'),

          labelVal = $label.html();

      

     $input.on('change', function(element) {

        var fileName = '';

        var filesw = this.files[0];

         var fileType = filesw.type;

         console.log(fileType)

        if (element.target.value) fileName = element.target.value.split('\\').pop();

        fileName ? $label.addClass('has-fileava').find('.js-fileNameava').html(fileName) : $label.removeClass('has-fileNameava').html(labelVal);



        var match = ['image/jpeg','image/jpg','image/png'];

        if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) )){

            $('.statusMsg').html('<p class="alert alert-danger">Sorry, only  JPG, JPEG, & PNG files are allowed to upload.</p>');

            $('#form')[0].reset();

            $('.submitBtnava').attr("disabled","disabled");

            return false;

        }else{

            $('.submitBtnava').attr("disabled",false);

            $('.statusMsg').html('');



        }

     });

    });

  

  })();

$(document).ready(function(e){

    // Submit form data via Ajax

    $("#formavatar").on('submit', function(e){

        e.preventDefault();

      



        var url = $(this).attr('action');

        var file = $('#fileavat').prop("files")[0];

        var form = new FormData(this);

        form.append("image", file);

        $.ajax({

            type: 'POST',

            url: url,

            data: form,

            dataType: 'json',

            contentType: false,

            cache: false,

            processData:false,

            beforeSend: function(){

                $('.submitBtnava').attr("disabled","disabled");

                $('#formavatar').css("opacity",".5");

            },

            success: function(response){

                $('.statusMsg').html('');

                if(response['uploadavatar'] == 2){

                    $('#formavatar')[0].reset();

                    $('.statusMsg').html('');

                    bootbox.alert({

                        closeButton: false,

                        message: '<p class="alert alert-success"><i class="icon fa fa-check"></i> Uploaded!</p>',

                        callback: function () {

                            $('#formavatar')[0].reset();

                            $('.js-fileNameava').html('Choose File!'); 

                            $('.js-labelFileava').removeClass('has-file'); 

                        }

                        });

                        setTimeout(function () {

                           location.reload();

                        }, 1000);

                }else if(response['uploadavatar'] == 3){

                    $('#formavatar')[0].reset();

                    $('.statusMsg').html('<p class="alert alert-warning"><i class="icon fa fa-check"></i> Cannot Upload the Image!</p>');

                    

                }else if(response['uploadavatar'] == 4){

                    $('#formavatar')[0].reset();

                    $('.statusMsg').html('<p class="alert alert-warning"><i class="icon fa fa-check"></i> Invalid Image!</p>');

                }else if(response['uploadavatar'] == 5){

                    $('#formavatar')[0].reset();

                    $('.statusMsg').html('<p class="alert alert-warning"><i class="dripicons-wrong"></i> Please Select Image!</p>');

                }

                $('#formavatar').css("opacity","");

                $(".submitBtnava").removeAttr("disabled");

            }

        });

    });

});





$(document).on('click','#update-document-btn',function(s){
    s.preventDefault();
    $('#request-update-document-modal').modal('show');
});



$(document).on('submit','#changePassword',function(s){

s.preventDefault();

    var data = $('#changePassword').serialize();

    var url = $(this).prop('action');

    $.ajax({

        url: url,

        method: 'POST',

        data: data,

        dataType: 'json',

        beforeSend: function () {

        },

        success: function (data) {

            console.log(data)

            if(data['userChangePass'] == 1){

                var dialog = bootbox.dialog({

                    message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',

                    closeButton: false

                });

                dialog.init(function () {

                    setTimeout(function () {

                        dialog.modal('hide');

                    }, 2000);

                    setTimeout(function () {

                        window.location.reload();

                    }, 3000);

                });

            }else if(data['userChangePass'] == 2){

                $('#alertPass').removeClass('d-none');

                setTimeout(function () {

                    $('#alertPass').addClass('d-none');

                }, 2000);

                console.log(data)

            }

            else{

                console.log("error")

            }

           

        }

    });



});





// $(document).on('click', '#prof_viewdoc', function () {

//     var user_id = $(this).attr('user_id');

//     var document_name = $(this).attr('document_name');

//     var url = $(this).data('dir');

//     window.open(url, '_blank');

//     $.ajax({

//         method: 'POST',

//         data: { user_id: user_id,document_name:document_name },

//         beforeSend: function () {

//         },

//         success: function (d) {

//             let form = '<form action="viewDocument?' + document_name +'" method="post" id="view_docus" target="_blank">';

//             form += '<input type="hidden" id="user_ed" name="file-name" value="' + document_name + '">';

//             form += '</form>';

//             $('body').append(form);

//             $('#view_docus').submit();



//         }

//     });



// });

  





//upload documents



$(document).on('click','.uploadingDocu',function(){

    var docu_name = $(this).attr('docuname');

    var document_id=$(this).attr('this_id');

    var user_id = $(this).attr('user_id');



    $('#docuName').html(docu_name);

    $('#uploadmodal').modal('show')

    $("#us_id").val(function() {

        return user_id;

    });

    $("#docu_id").val(function() {

        return document_id;

    });

});

$(document).on('click', '.upload-document-btn', function(e){
    e.preventDefault();

    var docuType = $(this).data('docu-type');
    var userName = $(this).data('user-name');
    var userId = $(this).attr('user_id');
    var form = $('#form-upload-document');
    form.find('[name="document-type"]').val(docuType);
    form.find('[name="user-id"]').val(userId);
    form.find('[name="user-name"]').val(userName);

    $('#upload-document-modal').modal('show');
});

$(document).on('submit', '#form-upload-document', function(e){
    e.preventDefault();

    var form = $(this);
    var userId = form.find('[name="user-id"]').val();
    var userName = form.find('[name="user-name"]').val();
    var docuType = form.find('[name="document-type"]').val();

    var fileInput = document.getElementById('document-file');
    var file = fileInput.files[0];
    var formData = new FormData();
    formData.append('document-file', file);
    formData.append('user-id', userId);
    formData.append('user-name', userName);
    formData.append('document-type', docuType);

    $.ajax({
        url: 'upload_documents',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,

        beforeSend:function(){
            form.find('button').html('<i class="fas fa-spinner fa-spin"></i> Uploading').addClass('disabled');
        },

        success: function(response) {

            console.log(response);

            switch(response.status){
                case 'success':
                    $('#upload-document-modal').modal('hide');
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Upload Successful</p>',
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
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:red;">'+response.message+'</p>',
                        closeButton: false
                    });
        
                    dialog.init(function () {
                        setTimeout(function () {
                            dialog.modal('hide');
                            window.location.reload();
                        }, 2000);
                    });
                break;
            }
            
        },
    });
});



$(document).on('click','#prof_request',function(s){

    s.preventDefault();
    var this_id = $(this).attr('this_id');
    var reqId = $(this).data('request-status');
    var form = $('#form-request-removal-document');
    var modal = $('#request-removal-document-modal');

    if(reqId == 1){
        $('.approval-pending').removeClass('d-none');
        form.addClass('d-none');
        modal.modal('show');
    }else if(reqId == 2){
        deleteDocument(this_id);
    }else{
        $('.approval-pending').addClass('d-none');
        form.removeClass('d-none');
        form.find('[name="document-id"]').val(this_id);
        modal.modal('show');
    }

});

$(document).on('submit', '#form-request-removal-document', function(e){
    e.preventDefault();

    $.ajax({
        url: 'request_to_delete',
        method: 'POST',
        data: $(this).serialize(),
        dataType: 'json',

        success: function (data) {
            $('#request-removal-document-modal').modal('hide');
            if(data['request'] == 1){
                var dialog = bootbox.dialog({
                    message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',
                    closeButton: false
                });

                dialog.init(function () {
                    setTimeout(function () {
                        dialog.modal('hide');
                        window.location.reload();
                    }, 2000);
                });

            }else{
                console.log("error")
            }
        }
    });
});

function deleteDocument(id){
    bootbox.confirm({
        closeButton: false,
        message: "Are you sure you want to permanently delete document?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 
                'btn-success'
            },

            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },

        callback: function (result) {
            if (result) {
                $.ajax({
                    url: 'delete_document_from_storage',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {id: id},

                    success: function(response){
                        switch(response.status){
                            case 'success':
                                $.ajax({
                                    url: 'delete_document',
                                    method: 'POST',
                                    dataType: 'JSON',
                                    data: {id: id},
                
                                    success: function (data) {
                                        if(data.status == 'success'){
                                            var dialog = bootbox.dialog({
                                                message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',
                                                closeButton: false
                                            });
                
                                            dialog.init(function () {
                                                setTimeout(function () {
                                                    dialog.modal('hide');
                                                    window.location.reload();
                                                }, 2000);
                                            });
                                        }else{
                                            console.log("error")
                                        }
                                    }
                                });
                            break;

                            case 'error':
                                $.ajax({
                                    url: 'delete_document',
                                    method: 'POST',
                                    dataType: 'JSON',
                                    data: {id: id},
                
                                    success: function (data) {
                                        if(data.status == 'success'){
                                            var dialog = bootbox.dialog({
                                                message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',
                                                closeButton: false
                                            });
                
                                            dialog.init(function () {
                                                setTimeout(function () {
                                                    dialog.modal('hide');
                                                    window.location.reload();
                                                }, 2000);
                                            });
                                        }else{
                                            console.log("error")
                                        }
                                    }
                                });
                            break;
                        }
                    }
                }) 
            } else {
                console.log('no action')
            }
        }
    });
}





// $(document).on('click', '#prof_download', function () {
//     var user_id = $(this).attr('user_id')
//     var document_name3 = $(this).attr('document_name');
//     $.ajax({
//         method: 'POST',
//         data: { user_id: user_id,document_name3:document_name3 },
//         beforeSend: function () {
//         },

//         success: function (d) {
//             let form2 = '<form action="downloadDocumets?' + document_name3 +'" method="post" id="dl_doc" target="_blank">';
//             form2 += '<input type="hidden" id="user_ed" name="file-name" value="' + document_name3 + '">';
//             form2 += '</form>';
//             $('body').append(form2);
//             $('#dl_doc').submit();
//         }
//     });
// });

//Personal data form on clicks

//Spouse
$(document).on('change', '[name="spouse"]', function(){
    var form = $('#form-spouse');
    var check = $(this);

    if($(this).is(':checked')){
        $.ajax({
            url: $(this).data('url') + 'profile/update_spouse',
            method: 'POST',
            dataType: 'JSON',
            data: {action : '0'},
    
            success: function(){
                $('.spouse-info-con').addClass('d-none');
                form.find('[name="spouse-last-name"], [name="spouse-first-name"], [name="spouse-former-name"], [name="spouse-birthdate"], [name="spouse-birth-place"], [name="spouse-citizenship"], [name="spouse-gender"], [name="spouse-move-to-finland"]').attr('required', false);
            }
        });
    }else{
        $.ajax({
            url: $(this).data('url') + 'profile/update_spouse',
            method: 'POST',
            dataType: 'JSON',
            data: {action : '1'},
    
            success: function(){
                $('.spouse-info-con').removeClass('d-none');
                form.find('[name="spouse-last-name"], [name="spouse-first-name"], [name="spouse-former-name"], [name="spouse-birthdate"], [name="spouse-birth-place"], [name="spouse-citizenship"], [name="spouse-gender"], [name="spouse-move-to-finland"]').attr('required', true);
            }
        });
    }
});

//Child checkbox
$(document).on('change', '[name="child-check"]', function(){
    if($(this).is(':checked')){

        $.ajax({
            url: $(this).data('url') + 'profile/update_child',
            method: 'POST',
            dataType: 'JSON',
            data: {action: '0'},

            success: function(){
                $('.child-info-container, .add-child-btn-container').addClass('d-none');
            }
        });
    }else{

        $.ajax({
            url: $(this).data('url') + 'profile/update_child',
            method: 'POST',
            dataType: 'JSON',
            data: {action: '1'},

            success: function(){
                $('.child-info-container, .add-child-btn-container').removeClass('d-none');
            }
        });
        
    }
});

//Add Child Container
$(document).on('click', '.add-child-btn', function(e){
    e.preventDefault();

    var countChild = $('.child-count').length;
    var url = $(this).data('url');
    $('[name="child-count"]').val(countChild + 1);

    var html = `<div class="row child-info-container-${countChild}">
                    <div class="w-100 text-danger d-flex justify-content-end">
                        <a class="btn-danger btn child-con-close-btn" data-url="${url}" data-btn-id="${countChild}" data-child-id="0"><i class="fas fa-window-close"></i> <b>Delete</b></a>
                    </div>

                    <input type="hidden" name="child-id-${countChild}" value="0">

                    <div class="col-md-6 mb-3 child-count">
                        <div class="alert-danger">
                            <label for="child-last-name-${countChild}" class="form-label">Last Name *</label>
                            <input type="text" value="" class="form-control" name="child-last-name-${countChild}" id="child-last-name-${countChild}" placeholder="Enter child's last name" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="alert-danger">
                            <label for="child-first-name-${countChild}" class="form-label">First Name *</label>
                            <input type="text" value="" class="form-control" name="child-first-name-${countChild}" id="child-first-name-${countChild}" placeholder="Enter child's first name" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="alert-danger">
                            <label for="child-gender-${countChild}" class="form-label">Gender *</label>
                            <select class="form-select" name="child-gender-${countChild}" id="child-gender-${countChild}">
                                <option value="na" selected disabled>--Select Gender--</option>
                                <option value="male">Male</option>
                                <option valie="female">Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="alert-danger">
                            <label for="child-birthdate-${countChild}" class="form-label">Date of Birth *</label>
                            <input type="date" value="" class="form-control" name="child-birthdate-${countChild}" id="child-birthdate-${countChild}" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="alert-danger">
                            <label for="child-citizenship-${countChild}" class="form-label">Citizenship *</label>
                            <input type="text" value="" class="form-control" name="child-citizenship-${countChild}" id="child-citizenship-${countChild}" placeholder="Enter child's citizenship" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="alert-danger">
                            <label for="child-simultaneous-application-${countChild}" class="form-label">Simultaneous application *</label>
                            <select class="form-select" name="child-simultaneous-application-${countChild}" id="child-simultaneous-application-${countChild}">
                                <option value="na" selected disabled>--Select option--</option>
                                <option value="1">Yes</option>
                                <option valie="0">No (At this point)</option>
                            </select>
                        </div>
                    </div><hr>
                </div>`;

    $('.child-info-container').append(html);
});

//Remove Child Container
$(document).on('click', '.child-con-close-btn', function(e){
    e.preventDefault();
    var childId = $(this).data('child-id');
    var url = $(this).data('url') + 'profile/delete_child';
    var btnId = $(this).data('btn-id');

    if(childId == 0){
        $(this).parent().parent().fadeOut('slow', function(){
            $(this).remove();
        });
    }else{
        
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'JSON',
            data: {id: childId},

            success: function(response){
                $('.child-info-container-'+btnId).fadeOut('slow', function(){
                    $(this).remove();
                });

                if(($('.child-count').length - 1) == 0){
                    $('[name="child-check"]').attr('disabled', false).parent().find('small').remove();;
                }
            }
        });
    }
    
});

$(document).on('submit', '#form-znlrc-request-update', function(e){
    e.preventDefault();

    var form = $(this);

    $.ajax({
        url: 'znlrcInfoRequestUpdate',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        success: function(response){

            switch(response.status){
                case 'success':
                    $('#znlrc-info-update-modal').modal('hide');

                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Request submitted.</p>',
                        closeButton: false
                    });
        
                    dialog.init(function () {
                        setTimeout(function () {
                            dialog.modal('hide');
                        }, 2000);
                    });
                break;

                case 'error':
                    $('#znlrc-info-update-modal').modal('hide');

                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:red;">Something went wrong. Please contact <a href="mailto:support@nlrc.ph">support@nlrc.ph</a> for updates. Thank you.</p>',
                        closeButton: true
                    });
                break;
            }
            
        }
    });
});

$(document).on('submit', '#trainee-additional-info', function(e){
    e.preventDefault();

    var form = $(this);
    var base_url = form.attr('action');
    var traineeId = form.data('trainee-id');

    $.ajax({
        url: base_url + 'admin/submitTraineeAdditionalInfo',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize() + '&trainee-id=' + traineeId,

        success: function(response){
            var dialog = bootbox.dialog({
                message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',
                closeButton: false
            });

            dialog.init(function () {
                setTimeout(function () {
                    dialog.modal('hide');
                    window.location.reload();
                }, 2000);
                
            });
        }
    });
});

$(document).on('change', '[name="trainee-batch"]', function(){

    var id = $(this).find('option:selected').data('batch-id');

    $.ajax({
        url: 'get_batch_number_by_id',
        method: 'POST',
        dataType: 'JSON',
        data: {id: id},

        success: function(response){
            switch(response.status){
                case 'success':
                    $('[name="trainee-batch-number"] option').remove();
                    var optionHtml = [
                        `<option class="batch-num-na" value="na" disabled selected>--Select Batch Number--</option>`,
                    ];
                    for(let i = 0; i < response.data.length; i++){
                        let count = response.data;
                        let batNum = count[i]['batch_number']
                        let option = `<option class="batch-num-${batNum}" value="${batNum}">${batNum}</option>`;;
                        optionHtml.push(option);
                    }

                    $('[name="trainee-batch-number"]').html(optionHtml);
                    
                break;

                case 'error':
                    alert('Somethingh went wrong. Please contact IT Administrator');
                break;
            }
        }
    });
});

$(document).on('click', '.news-more-info', function(e){
    e.preventDefault();
    var id = $(this).data('news-id');

    if($('#news-'+id).is(':visible')){
        $('#news-'+id).slideUp();
        $('#more-info-btn-'+id).html('<i class="uil uil-angle-double-down"></i> See more!');
    } else {
        $('#news-'+id).slideDown();
        $('#more-info-btn-'+id).html('<i class="uil uil-angle-double-up"></i> See less!');
    }
});

$(document).on('click', '.new-message-btn', function(e){
    e.preventDefault();

    if($('.faq-keyword-items').is(':visible')){
        $('.faq-keyword-items').slideUp();
    }else{
        $('.faq-keyword-items').slideDown();
    }
});

$(document).on('click', '.card-body-question-btn', function(e){
    e.preventDefault();

    var id = $(this).data('faq-id');
    if($('#answer-'+id).is(':visible')){
        $('#answer-'+id).slideUp();
    }else{
        $('#answer-'+id).slideDown();
    }
});

$(document).on('click', '.priority-document-btn', function(e){
    e.preventDefault();

    var email = $(this).data('user-email');

    $.ajax({
        url: 'prioritizeLinkDocs',
        method: 'POST',
        dataType: 'JSON',
        data: {email : email},

        success:function(response){
            switch(response.status){
                case 'success':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',
                        closeButton: false
                    });
        
                    dialog.init(function () {
                        setTimeout(function () {
                            dialog.modal('hide');
                            window.location.reload();
                        }, 2000);
                        
                    });
                break;
            }
        }
    })

})

$(document).on('click', '.document-complete-btn', function(e){
    e.preventDefault();

    var email = $(this).data('user-email');

    $.ajax({
        url: 'documentCompletedBtn',
        method: 'POST',
        dataType: 'JSON',
        data: {email : email},

        success:function(response){
            switch(response.status){
                case 'success':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',
                        closeButton: false
                    });
        
                    dialog.init(function () {
                        setTimeout(function () {
                            dialog.modal('hide');
                            window.location.reload();
                        }, 2000);
                        
                    });
                break;
            }
        }
    })

})












