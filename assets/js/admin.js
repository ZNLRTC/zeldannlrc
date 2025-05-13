





$(document).ready(function () {

    let employeeTable = $('#employeeData').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "columnDefs": [
            {
                "targets": [0, 3,4],
                "orderable": false
            }
        ],

        "lengthMenu": [[10, 25, 50], [10, 25, 50]],

        'ajax': {
            'url': 'employeeDatatable'
        },

        'select': {
            'style': 'single'
        },

        'columns': [
            { data: 'id' },
            { data: 'last_name' },
            { data: 'email' },
            { data: 'contact_number' },
            { data: 'action' },
        ]
    });

    $(document).on('keyup', '#employeeData-search', function(){
        employeeTable.search($(this).val()).draw();
    });

});


$(document).ready(function () {
    var url = new URL(window.location.href);
    var batch = url.searchParams.get('batch') || '0-0';
    var batStatus = url.searchParams.get('status') || '0';
    var upcoming = url.searchParams.get('upcoming') !== null ? 1 : 0;
    var year = url.searchParams.get('year') || '0';
    var month = url.searchParams.get('month') || '0';

    var paramArr = batch.split('-');
    paramArr.push(batStatus, upcoming, year, month);

    console.log(paramArr);

    $.fn.DataTable.ext.pager.numbers_length = 10;

    $.fn.DataTable.ext.pager.simple_numbers_extended = function(page, pages) {
        var numbers = [];
        var buttons = $.fn.DataTable.ext.pager.numbers_length;
        var half = Math.floor(buttons / 2);
        var start = page > half ? Math.max(Math.min(page - half, pages - buttons), 0) : 0;
        var end = page > half ? Math.min(page + half + (buttons % 2), pages) : Math.min(buttons, pages);

        // Include "Previous" button
        numbers.push('previous');

        // Add ellipsis and first page number if necessary
        if (start > 0) {
            numbers.push(0);  // First page number
            if (start > 1) {
                numbers.push('ellipsis');
            }
        }

        // Generate the page numbers
        for (var i = start; i < end; i++) {
            numbers.push(i);
        }

        // Add ellipsis and last page number if necessary
        if (end < pages) {
            if (end < pages - 1) {
                numbers.push('ellipsis');
            }
            numbers.push(pages - 1);  // Last page number
        }

        // Include "Next" button
        numbers.push('next');

        return numbers;
    };

    let applicantsDataAll = $('#applicantsData').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "pagingType": "simple_numbers_extended",
        "columnDefs": [
            {
                "targets": [0, 3, 5],
                "orderable": false
            }
        ],
        "lengthMenu": [[25, 50, 100, 200], [25, 50, 100, 200]],
        'ajax': {
            'url': 'applicantsDatatable',
            'data': {'batch-name': paramArr[0], 'batch-number': paramArr[1], 'batch-status': paramArr[2], 'upcoming': paramArr[3], 'year': paramArr[4], 'month': paramArr[5]},
        },
        'select': {
            'style': 'single'
        },
        'columns': [
            { data: 'id' },
            { data: 'last_name' },
            { data: 'email' },
            { data: 'batch' },
            { data: 'contact_number' },
            { data: 'status' },
            { data: 'action' }
        ]
    });

    let applicantsDataApproved = $('#applicantsData1').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "pagingType": "simple_numbers_extended",
        "columnDefs": [
            {
                "targets": [0, 3,5],
                "orderable": false
            }

        ],

        "lengthMenu": [[25, 50, 100, 200], [25, 50, 100, 200]],

        /*"select": true,*/

        'ajax': {
            'url': 'applicantsDatatableApproved',
            'data' : {'batch-name' : paramArr[0], 'batch-number' : paramArr[1], 'batch-status': paramArr[2], 'upcoming': paramArr[3], 'year': paramArr[4], 'month': paramArr[5]},
        },

        'select': {
            'style': 'single'
        },

        'columns': [
            { data: 'id' },
            { data: 'last_name' },
            { data: 'email' },
            { data: 'batch'},
            { data: 'contact_number' },
            { data: 'status' },
            { data: 'action' },
        ]
    });

    let applicantsDataDisapproved = $('#applicantsData2').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "pagingType": "simple_numbers_extended",
        "columnDefs": [
            {
                "targets": [0, 3,5],
                "orderable": false
            }

        ],

        "lengthMenu": [[25, 50, 100, 200], [25, 50, 100, 200]],

        /*"select": true,*/

        'ajax': {
            'url': 'applicantsDatatabledisapproved',
            'data' : {'batch-name' : paramArr[0], 'batch-number' : paramArr[1], 'batch-status': paramArr[2], 'upcoming': paramArr[3], 'year': paramArr[4], 'month': paramArr[5]},
        },

        'select': {
            'style': 'single'
        },

        'columns': [
            { data: 'id' },
            { data: 'last_name' },
            { data: 'email' },
            { data: 'batch'},
            { data: 'contact_number' },
            { data: 'status' },
            { data: 'action' },
        ]
    });

    let applicantsDataPending = $('#applicantsData3').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "pagingType": "simple_numbers_extended",
        "columnDefs": [
            {
                "targets": [0, 3,5],
                "orderable": false
            }

        ],

        "lengthMenu": [[25, 50, 100, 200], [25, 50, 100, 200]],

        /*"select": true,*/

        'ajax': {
            'url': 'applicantsDatatablepending',
            'data' : {'batch-name' : paramArr[0], 'batch-number' : paramArr[1], 'batch-status': paramArr[2], 'upcoming': paramArr[3], 'year': paramArr[4], 'month': paramArr[5]},
        },
        'select': {
            'style': 'single'
        },

        'columns': [
            { data: 'id' },
            { data: 'last_name' },
            { data: 'email' },
            { data: 'batch'},
            { data: 'contact_number' },
            { data: 'status' },
            { data: 'action' },
        ]
    });

    $('#documentsList').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "bDestroy": true,
        "columnDefs": [
            {
                "targets": [0, 2],
                "orderable": false
            }

        ],

        "lengthMenu": [[10, 25, 50], [10, 25, 50]],

        /*"select": true,*/

        'ajax': {
            'url': 'documentList'
        },

        'select': {
            'style': 'single'
        },

        'columns': [
            { data: 'id' },
            { data: 'typename' },
            { data: 'action' },

        ]

    });

    $(document).on('keyup', '.applicants-table-search-all', function(){
        applicantsDataAll.search($(this).val()).draw();
    });

    $(document).on('keyup', '.applicants-table-search-1', function(){
        applicantsDataApproved.search($(this).val()).draw();
    });

    $(document).on('keyup', '.applicants-table-search-2', function(){
        applicantsDataDisapproved.search($(this).val()).draw();
    });

    $(document).on('keyup', '.applicants-table-search-3', function(){
        applicantsDataPending.search($(this).val()).draw();
    });
});





//change password



$(document).ready(function()

{

$('#adminNewPass').keyup(function()

{

$('#strength_message_admin').html(checkStrength($('#adminNewPass').val()))

}) 

function checkStrength(password)

{

var strength = 0

if (password.length < 6) { 

$('#strength_message_admin').removeClass()

$('#strength_message_admin').addClass('alert-danger fw-bold')

$('#admin_Changepassbtn').prop('disabled',true)

return 'Too short' 



}



if (password.length > 7) strength += 1

if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1

if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 

if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1

if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1

if (strength < 2 )

{

$('#strength_message_admin').removeClass()

$('#strength_message_admin').addClass('alert-warning fw-bold')

$('#admin_Changepassbtn').prop('disabled',true)

return 'Weak'   

}

else if (strength == 2 )

{

$('#strength_message_admin').removeClass()

$('#strength_message_admin').addClass('alert-success fw-bold')

$('#admin_Changepassbtn').prop('disabled',false)



return 'Good'  

}

else

{

$('#strength_message_admin').removeClass()

$('#strength_message_admin').addClass('alert-success fw-bold')

$('#admin_Changepassbtn').prop('disabled',false)



return 'Strong'

}

}

});



$(document).on('submit','#adminChangePassword',function(s){

    s.preventDefault();

        var data = $('#adminChangePassword').serialize();

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

                if(data['adminChangepas'] == 1){

                    var dialog = bootbox.dialog({

                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',

                        closeButton: false

                    });

                    dialog.init(function () {

                        setTimeout(function () {

                            dialog.modal('hide');

                        }, 2000);

                        setTimeout(function () {

                            window.location.href = 'dashboard';

                        }, 3000);

                    });

                }else if(data['adminChangepas'] == 2){

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





















$(document).on('submit','#adminProfile',function(e){

    e.preventDefault()

    var data = $('#adminProfile').serialize();

    var url = $(this).prop('action');



    $.ajax({

        url: url,

        method: 'POST',

        data: data,

        dataType: 'JSON',

        beforeSend: function () {

        },

        success: function (data) {

            if(data['user'] == 1){

                $('.toast').toast('show');

            }else{



            }

        }

    });



});



//delete user



$(document).on('click', '#del_user', function (s) {

    s.preventDefault();

    var userID = $(this).attr('user-id');



    bootbox.confirm({

        closeButton: false,

        message: "Are you sure to delete this Employee?",

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

                    url: 'delete_employee',

                    method: 'POST',

                    data:  { userID: userID },

                    dataType: 'JSON',

                    beforeSend: function () {

                    },

                    success: function (data) {

                        console.log(data)

                        if(data['delete'] == 1){

                            var dialog = bootbox.dialog({

                                message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',

                                closeButton: false

                            });

                            dialog.init(function () {

                                setTimeout(function () {

                                    dialog.modal('hide');

                                }, 2000);

                            });

                            $('#employeeData').DataTable().ajax.reload();

                        }else{

                            console.log("error")

                        }

                       

                    }

                });

                $('#employeeData').DataTable().ajax.reload();

            } else {

                console.log('no action')

            }

        }

    });

});



//delete applicant

$(document).on('click', '#del_Appli', function (s) {

    s.preventDefault();

    var userID = $(this).attr('user-id');



    bootbox.confirm({

        closeButton: false,

        message: "Are you sure to delete this Trainee?",

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

                    url: 'delet_apli',

                    method: 'POST',

                    data:  { userID: userID },

                    dataType: 'JSON',

                    beforeSend: function () {

                    },

                    success: function (data) {

                        console.log(data)

                        if(data == 2){

                            var dialog = bootbox.dialog({

                                message: '<p class="text-center mb-0" style="color:red;"><i class="fa fa-wrong"></i> You are not allowed to delete.</p>',

                                closeButton: false

                            });

                            dialog.init(function () {

                                setTimeout(function () {

                                    dialog.modal('hide');

                                }, 2000);

                            });

                        }else{

                            if(data['delete'] == 1){

                                var dialog = bootbox.dialog({

                                    message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',

                                    closeButton: false

                                });

                                dialog.init(function () {

                                    setTimeout(function () {

                                        dialog.modal('hide');

                                    }, 2000);

                                });

                                $('#applicantsData').DataTable().ajax.reload();

                            }else{

                                console.log("error")

                            }

                        }

                        

                       

                    }

                });

                $('#applicantsData').DataTable().ajax.reload();

            } else {

                console.log('no action')

            }

        }

    });

});



//suspend

$(document).on('click', '#user_suspend', function (s) {

    s.preventDefault();

    var userID = $(this).attr('user-id');

    bootbox.confirm({
        closeButton: false,
        message: "Are you sure to suspend this employee?",

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
                    url: 'suspendUser',
                    method: 'POST',
                    data:  { userID: userID },
                    dataType: 'JSON',

                    success: function (data) {
                        console.log(data)
                        if(data['suspend_user'] == 1){
                            var dialog = bootbox.dialog({
                                message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',
                                closeButton: false
                            });

                            dialog.init(function () {
                                setTimeout(function () {
                                    dialog.modal('hide');
                                }, 2000);
                            });
                            $('#usersDatatable').DataTable().ajax.reload();
                        }else{
                            console.log("error")
                        }
                    }
                });
                $('#employeeData').DataTable().ajax.reload();
            } else {
                console.log('no action')
            }
        }
    });
});



$(document).on('click', '#logoutAd', function (s) {

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

//activate

$(document).on('click', '#user_active', function (s) {

    s.preventDefault();

    var userID = $(this).attr('user-id');



    bootbox.confirm({

        closeButton: false,

        message: "Are you sure to activate this employee?",

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

                    url: 'activateUser',

                    method: 'POST',

                    data:  { userID: userID },

                    dataType: 'JSON',

                    beforeSend: function () {

                    },

                    success: function (data) {

                        console.log(data)

                        if(data['activate_user'] == 1){

                            var dialog = bootbox.dialog({

                                message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',

                                closeButton: false

                            });

                            dialog.init(function () {

                                setTimeout(function () {

                                    dialog.modal('hide');

                                }, 2000);

                            });

                            $('#usersDatatable').DataTable().ajax.reload();

                        }else{

                            console.log("error")

                        }

                       

                    }

                });

                $('#employeeData').DataTable().ajax.reload();

            } else {

                console.log('no action')

            }

        }

    });

});

$(function(){

    $("input[name='contact_number']").on('input', function (e) {

      $(this).val($(this).val().replace(/[^0-9]/g, ''));

    });

  });



$(document).on('submit', '#adminInsertEmp', function (s) {

    s.preventDefault();

   

    var data = $('#adminInsertEmp').serialize();

    var url = $(this).prop('action');

    bootbox.confirm({

        closeButton: false,

        message: "Are you sure to add this as Employee?",

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

                    data: data,

                    dataType: 'JSON',

                    beforeSend: function () {

                    },

                    success: function (data) {

                        console.log(data)

                        if(data['user'] == 1){

                            var dialog = bootbox.dialog({

                                message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',

                                closeButton: false

                            });

                            dialog.init(function () {

                                setTimeout(function () {

                                    dialog.modal('hide');

                                }, 2000);

                            });

                        }else{

                            console.log("error")

                        }

                       

                    }

                });

                $('#adminInsertEmp')[0].reset();

            } else {

                console.log('no action')

            }

        }

    });



});



$(document).on('submit', '#adminInsertDocu', function (s) {

    s.preventDefault();

   
    var action = $('#docuBtn').data('action');
    var data = $('#adminInsertDocu').serialize() + '&action=' + action;
    var url = $(this).prop('action');

    if(action == 'add'){
        var message = "Are you sure to add "+$('#inputDocu').val() +"?";
    }else{
        var message = "Are you sure to edit "+$('#inputDocu').val() +"?";
    }

    bootbox.confirm({

        closeButton: false,

        message: message,

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

                    data: data,

                    dataType: 'JSON',

                    beforeSend: function () {

                        

                    },

                    success: function (data) {

                        console.log(data)

                        if(data['inserted'] == 1){

                            var dialog = bootbox.dialog({

                                message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',

                                closeButton: false

                            });

                            dialog.init(function () {

                                setTimeout(function () {

                                    dialog.modal('hide');

                                }, 2000);

                            });

                        }else{

                            console.log("error")

                        }

                       

                    }

                });

                $('#adminInsertDocu')[0].reset();

                $('#documentsList').DataTable().ajax.reload();

            } else {

                $('#adminInsertDocu')[0].reset();

                console.log('no action')

            }

        }

    });



});





$(document).on('click','#editDocuList',function(){

    var id = $(this).attr('editDocuList_id');
    var name = $(this).data('name');
    var description = $(this).data('description');

    $('#docuBtn').text('Save').prop('disabled', false).attr('data-action', 'edit');

    $('[name="docu-list-id"]').val(id);
    $('[name="docu-list-name"]').val(name);
    $('[name="docu-list-description"]').val(description);
});

$(document).on('click', '.archive-document-btn', function(e){
    e.preventDefault();

    var id = $(this).data('docu-id');
    var name = $(this).data('docu-name');
    var action = $(this).data('action');

    if(action == 'archive'){
        var message = "Are you sure to "+action+" <b>"+name+"</b>?<small class='d-block text-warning mt-2'> <b>Note:</b> This action will not delete the document from the system. You can still re-activate this document when you change your mind."
    }else{
        var message = "Are you sure to "+action+" <b>"+name+"</b>?<small class='d-block text-warning mt-2'> <b>Note:</b> This action will re-activate "+name+" document."
    }

    bootbox.confirm({
        closeButton: false,
        message: message,
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
                    url: 'archive_docu_list',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {id: id, action: action},
                    
                    success: function(response){
                        var dialog = bootbox.dialog({
                            message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',
                            closeButton: false

                        });

                        dialog.init(function () {
                            setTimeout(function () {
                                dialog.modal('hide');
                            }, 2000);
                        });

                        $('#documentsList').DataTable().ajax.reload();
                    }
                });
            }
        }
    });

    
});

//save edited document

$(document).on('submit','#formSaveEditDocu',function(e){

    e.preventDefault(e);

    var formSaveEditDocu = $('#formSaveEditDocu').serialize();

    $.ajax({

        url: 'saveEditDocList',

        method: 'POST',

        data:   formSaveEditDocu ,

        dataType: 'JSON',

        beforeSend: function () {

        },

        success: function (data) {

            console.log(data)

            if(data['updateDocuLis'] == 1){

                var dialog = bootbox.dialog({

                    message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',

                    closeButton: false

                });

                dialog.init(function () {

                    setTimeout(function () {

                        dialog.modal('hide');

                    }, 1000);

                });

                setTimeout(function () {

                    location.reload();

                }, 1000);

            }else{

                console.log("error")

            }

           

        }

    });

});



$(document).on('click','#cancelEdit',function(){

location.reload();

});



$(document).on('click', '#delDocuList', function (s) {

    s.preventDefault();

    var delDocuList = $(this).attr('delDocuList_id');



    bootbox.confirm({

        closeButton: false,

        message: "Are you sure to delete this? <br> <p style='font-style: italic'> Note: Deleting this data will cause the data lose of applicant  uploaded documents.</p>",

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

                    url: 'deleteDocuLists',

                    method: 'POST',

                    data:  { delDocuList: delDocuList },

                    dataType: 'JSON',

                    beforeSend: function () {

                    },

                    success: function (data) {

                        console.log(data)

                        if(data['delete'] == 1){

                            var dialog = bootbox.dialog({

                                message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',

                                closeButton: false

                            });

                            dialog.init(function () {

                                setTimeout(function () {

                                    dialog.modal('hide');

                                }, 2000);

                            });

                            $('#documentsList').DataTable().ajax.reload();

                        }else{

                            console.log("error")

                        }

                       

                    }

                });

                $('#employeeData').DataTable().ajax.reload();

            } else {

                console.log('no action')

            }

        }

    });

});





$(document).on('keyup','#inputDocu',function(){

    $('#docuBtn').prop('disabled',false);

    $('#saveEditDocu').prop('disabled',false);



});





(function() {

  

    'use strict';

  

    $('.input-filemed').each(function() {

      var $input = $(this),

          $label = $input.next('.js-labelFiled'),

          labelVal = $label.html();

      

     $input.on('change', function(element) {

        var fileName = '';

        var filesw = this.files[0];

         var fileType = filesw.type;

        if (element.target.value) fileName = element.target.value.split('\\').pop();

        fileName ? $label.addClass('has-file').find('.js-fileNamed').html(fileName) : $label.removeClass('has-file').html(labelVal);



        var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office'];

        if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) )){

            $('.statusMsgmed').html('<p class="alert alert-danger">Sorry, only PDF files are allowed to upload.</p>');

            $('#formMedCert')[0].reset();

            $('.submitBtnmed').attr("disabled","disabled");

            return false;

        }else{

            $('.submitBtnmed').attr("disabled",false);

            $('.statusMsgmed').html('');



        }

     });

    });

  

  })();







  

  

  $(document).ready(function(e){

    // Submit form data via Ajax

    $("#formMedCert").on('submit', function(e){

        e.preventDefault();



        var url = $(this).attr('action');

        var file = $('#filemed').prop("files")[0];

        var formmed = new FormData(this);

        

        formmed.append("image", file);

        $.ajax({

            type: 'POST',

            url: url,

            data: formmed,

            dataType: 'json',

            contentType: false,

            cache: false,

            processData:false,

            beforeSend: function(){

                $('.submitBtnmed').attr("disabled","disabled");

                $('#formMedCert').css("opacity",".5");

            },

            success: function(response){

                $('.statusMsg').html('');

                if(response['upload'] == 2){

                    $('#formMedCert')[0].reset();

                    $('.statusMsgmed').html('');

                    bootbox.alert({

                        closeButton: false,

                        message: '<p class="alert alert-success"><i class="icon fa fa-check"></i> Uploaded!</p>',

                        callback: function () {

                            $('.js-fileNamed').html('Choose File!'); 

                            $('.js-labelFiled').removeClass('has-file'); 

                            window.location.reload();

                        }

                        });

                }else if(response['upload'] == 3){

                    $('.statusMsgmed').html('<p class="alert alert-warning"><i class="icon fa fa-check"></i> Cannot Upload the file!</p>');

                    

                }else if(response['upload'] == 4){

                    $('.statusMsgmed').html('<p class="alert alert-warning"><i class="icon fa fa-check"></i> Invalid File!</p>');

                }else if(response['upload'] == 5){

                    $('.statusMsgmed').html('<p class="alert alert-warning"><i class="dripicons-wrong"></i> Please Select File!</p>');

                }

                else if(response['upload'] == 1){

                    $('.statusMsgmed').html('<p class="alert alert-warning"><i class="dripicons-wrong"></i> You have reach the maximum upload limit!</p>');

                }

                $('#formMedCert').css("opacity","");

                $(".submitBtnmed").removeAttr("disabled");

                

            }

        });

    });

});





$(document).on('click','.uploadingMedCert',function(){

    $('#uploadmodalMedcert').modal('show')

});



//approve applicant

$(document).on('click', '#user_approve', function (s) {

    s.preventDefault();

    var userID = $(this).attr('user-id');
    var base_url = $(this).data('url');

    bootbox.confirm({

        closeButton: false,

        message: "Are you sure to approve this applicant?",

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
                var dir = base_url + 'app/views/admin/controller/ajax_admin_send_email_approved_account.php';
                var sendingDialog;

                $.ajax({ //get user info -- Added by migs
                    url: 'getUserInfo',
                    method: 'POST',
                    dataType: 'JSON',
                    data: { userID: userID },

                    success: function(data){
                        
                        $.ajax({ //send email to account -- Added by migs
                            url: dir,
                            method: 'POST',
                            dataType: 'JSON',
                            data: {email : data.userInfo.email, name: data.userInfo.first_name, url: base_url},

                            beforeSend: function(){
                                sendingDialog = bootbox.dialog({
                                    message: '<p class="text-center mb-0" style="color:green;"><i class="fas fa-spinner fa-spin"></i> Sending Email. Pease wait.</p>',
                                    closeButton: false
                                });
                            },

                            success: function(response){
                                switch(response.status){
                                    case 'success':
                                        $.ajax({ //approve accont

                                            url: 'approveApplicant',
                                            method: 'POST',
                                            data:  { userID: userID, action: 'approve' },
                                            dataType: 'JSON',
                                            
                                            beforeSend: function () {
                                            },
                        
                                            success: function (data) {

                                                if(data == 2){
                        
                                                    var dialog = bootbox.dialog({
                                                        message: '<p class="text-center mb-0" style="color:red;"><i class="fa fa-wrong"></i> Your are not allowed to do this.</p>',
                                                        closeButton: false
                                                    });
                        
                                                    dialog.init(function () {
                                                        setTimeout(function () {
                                                            dialog.modal('hide');
                                                        }, 3000);
                                                    });
                                                }else{
                        
                                                    if(data['approve_applicant'] == 1){

                                                        sendingDialog.modal('hide');
                        
                                                        var dialog = bootbox.dialog({
                                                            message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',
                                                            closeButton: false
                                                        });
                        
                                                        dialog.init(function () {
                                                            setTimeout(function () {
                                                                dialog.modal('hide');
                                                            }, 2000);
                                                        });
                        
                                                        $('#applicantsData').DataTable().ajax.reload();
                                                        $('#applicantsData1').DataTable().ajax.reload();
                                                        $('#applicantsData2').DataTable().ajax.reload();
                                                        $('#applicantsData3').DataTable().ajax.reload();
                                                    }else{
                                                        console.log("error")
                                                    }
                                                }
                                            }
                                        });
                                    break;
                                }
                            }
                        });
                    }
                });

                $('#employeeData').DataTable().ajax.reload();
            } else {
                console.log('no action')
            }

        }

    });

});



$(document).on('click', '#disapprove', function (s) {

    s.preventDefault();

    var userID = $(this).attr('user-id');



    bootbox.confirm({

        closeButton: false,

        message: "Are you sure to disapprove this trainee?",

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

                    url: 'disapproveApplicant',

                    method: 'POST',

                    data:  { userID: userID, action: 'disapprove' },

                    dataType: 'JSON',

                    beforeSend: function () {

                    },

                    success: function (data) {

                        console.log(data)



                        if(data == 2){

                            var dialog = bootbox.dialog({

                                message: '<p class="text-center mb-0" style="color:red;"><i class="fa fa-wrong"></i> Your are not allowed to do this.</p>',

                                closeButton: false

                            });

                            dialog.init(function () {

                                setTimeout(function () {

                                    dialog.modal('hide');

                                }, 3000);

                            });

                        }else{

                            if(data['disapproved_applicant'] == 1){

                                var dialog = bootbox.dialog({

                                    message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',

                                    closeButton: false

                                });

                                dialog.init(function () {

                                    setTimeout(function () {

                                        dialog.modal('hide');

                                    }, 2000);

                                });

                                $('#applicantsData').DataTable().ajax.reload();

                                $('#applicantsData2').DataTable().ajax.reload();

                                $('#applicantsData1').DataTable().ajax.reload();

                                $('#applicantsData3').DataTable().ajax.reload();

                            }else{

                                console.log("error")

                            }

                        }



                        

                       

                    }

                });

                $('#employeeData').DataTable().ajax.reload();

            } else {

                console.log('no action')

            }

        }

    });

});





$(document).on('click', '.logoutAd', function (s) {

    s.preventDefault();

    var pageURL = $(location).attr("href");

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

                    url: '../logout',

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

                                window.location.replace("logout");

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











$(document).on('click', '#view_user, .view-user-btn', function () {

    var user_ed = $(this).attr('user-id');

    $.ajax({

        method: 'POST',

        data: { user_ed: user_ed },

        beforeSend: function () {

        },

        success: function (d) {

            let form = '<form action="view?' + user_ed +'" method="post" id="view_app" >';

            form += '<input type="hidden" id="user_ed" name="user" value="' + user_ed + '">';

            form += '</form>';

            $('body').append(form);

            $('#view_app').submit();



        }

    });



});



// $(document).on('click', '#viewdocu', function () {

//     var applicant_id = $(this).attr('applicant-id');

//     var document_name = $(this).attr('document_name');

//     $.ajax({

//         method: 'POST',

//         data: { applicant_id: applicant_id,document_name:document_name },

//         beforeSend: function () {

            

//         },

//         success: function (d) {

//             let form = '<form action="viewdocument?' + document_name +'" method="post" id="view_doc" target="_blank">';

//             form += '<input type="hidden" id="user_ed" name="file-name" value="' + document_name + '">';

//             form += '</form>';

//             $('body').append(form);

//             $('#view_doc').submit();



//         }

//     });



// });



$(document).on('click', '#viewdocumed', function () {

    var applicant_id = $(this).attr('this_user_id');

    var document_name = $(this).attr('document_name');

    $.ajax({

        method: 'POST',

        data: { applicant_id: applicant_id,document_name:document_name },

        beforeSend: function () {

        },

        success: function (d) {

            let form = '<form action="view_med?' + document_name +'" method="post" id="view_docs_med" target="_blank">';

            form += '<input type="hidden" id="user_eds" name="file-name" value="' + document_name + '">';

            form += '</form>';

            $('body').append(form);

            $('#view_docs_med').submit();



        }

    });



});



$(document).on('click', '#downloaddocu', function () {

    var applicant_id = $(this).attr('applicant-id');

    var document_name2 = $(this).attr('document_name');

    $.ajax({

        method: 'POST',

        data: { applicant_id: applicant_id,document_name2:document_name2 },

        beforeSend: function () {

        },

        success: function (d) {

            if(data == 2){



            }else{

                let form2 = '<form action="downloadDocumet?' + document_name2 +'" method="post" id="dl_doc" target="_blank">';

                form2 += '<input type="hidden" id="user_ed" name="file-name" value="' + document_name2 + '">';

                form2 += '</form>';

                $('body').append(form2);

                $('#dl_doc').submit();   

            }

          



        }

    });



});





function table(){

return ' <table id="applicantsData" class="table dt-responsive nowrap w-100"><thead><th>#</th><th>Name</th> <th>Email</th> <th>Contact Number</th><th>Status</th> <th>Action</th></thead></table>';

}



$(document).on('change','#select_applic',function(){

    let val = $(this).val();

    $('#appli_content, #appli_content1, #appli_content2, #appli_content3, .applicants-table-search-all, .applicants-table-search-1, .applicants-table-search-2, .applicants-table-search-3').addClass('d-none');

    if(val > 0){
        $('#appli_content' + val + ', .applicants-table-search-' + val).removeClass('d-none');
    }else{
        $('#appli_content, .applicants-table-search-all').removeClass('d-none');
    }

});





$(document).on('click','#approveEdit',function(s){

    s.preventDefault();

    var user_id = $(this).attr('user_id');
    var this_id = $(this).attr('this_id');
    var url = $(this).attr("href");

    bootbox.confirm({
        closeButton: false,
        message: "Approve to change this document?",

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
                    data: {user_id:user_id,this_id:this_id},
                    dataType: 'json',

                    success: function (data) {

                        if(data['delDocs'] == 1 || data['approveEdit'] == 1){
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
            } else {
                console.log('no action')
            }
        }
    });
});

/*Start -- Added by migs */


$(document).ready(function(){
    $('#document-requests-table, #update-info-requests-table').DataTable({
        "pageLength": 25
    });

    let = userMessagesTable = $('#user-messages-table').DataTable({
        "order": [[0, 'desc']],
        "pageLength": 25
    });

    let applicantBatch = $('#applicant-batches').DataTable();
    let applicantBatchNumber = $('#applicant-batch-number').DataTable({
        "pageLength": 25
    });

    $(document).on('keyup', '#applicant-batches-search', function(){
        applicantBatch.search($(this).val()).draw();
    });

    $(document).on('keyup', '#applicant-batch-number-search', function(){
        applicantBatchNumber.search($(this).val()).draw();
    });

    $(document).on('keyup', '#user-messages-table-search', function(){
        userMessagesTable.search($(this).val()).draw();
    });
});



$(document).on('click', '.send-message-btn', function(e){
    e.preventDefault();

    var btn = $(this);
    var email = $(this).data('user-email');
    var base_url = $(this).data('url');
    var message = $('#msg-content').val();
    var dir = base_url + 'app/views/admin/controller/ajax_admin_send_message.php';

    $.ajax({
        url: dir,
        method: 'POST',
        dataType: 'JSON',
        data: {email: email, message: message},

        beforeSend: function(){
            btn.html('<i class="fas fa-spinner fa-spin"></i> Sending...');
        },

        success: function(response){
            switch(response.status){
                case 'success':
                    btn.html('Send');

                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Message Sent!</p>',
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

$(document).on('click', '.approve-document-request-btn', function(e){
    e.preventDefault();

    var id = $(this).data('document-id');
    var modal = $('#approve-document-request-modal');

    $.ajax({
        url: 'fetch_docu_info',
        method: 'POST',
        dataType: 'JSON',
        data: {id: id},

        success: function(response){
            if(response.status == 'success'){
                modal.find('.doc-type').text(response.data.description);
                modal.find('.doc-path').text(response.data.path);
                modal.find('.doc-message').text(response.data.message);
                modal.find('[name="document-id"]').val(id);
                modal.modal('show');
            }
        }
    });
});


$(document).on('click', '.request-approve-action-btn', function(e){
    e.preventDefault();

    var action = $(this).data('action');
    var id = $('#approve-document-request-modal').find('[name="document-id"]').val();

    actionDocumentRequestEdit(id, action)
    
});

$(document).on('click', '.edit-document-request-btn', function(e){
    e.preventDefault();

    var id = $(this).data('document-id');
    var action = $(this).data('action');

    if(action == 'approve'){
        var bootMessage = "Are you sure you want to approve the request?";
    }else{
        var bootMessage = "Are you sure you want to deny the request?";
    }

    bootbox.confirm({
        closeButton: false,
        message: bootMessage,

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
                actionDocumentRequestEdit(id, action);
            }
        }
    }); 
});

function actionDocumentRequestEdit(id, action){
    $.ajax({
        url: 'document_request_status_action',
        method: 'POST',
        dataType: 'JSON',
        data: {id: id, action: action},

        success: function(response){
            if(response.status == 'success'){
                $('#approve-document-request-modal').modal('hide');
                
                var dialog = bootbox.dialog({
                    message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',
                    closeButton: false
                });
    
                dialog.init(function () {
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                });
            }
        }
    });
}

$(document).on('change', '[name="trainee-flag-status"]', function(){

    var flagStatus = $(this).val();
    var traineeId = $(this).data('user-id');
    
    var form = $('#update-flag-status-date-form');
    form.find('[name="trainee-id"]').val(traineeId);
    form.find('[name="flag-status"]').val(flagStatus);

    if(flagStatus == 'deployed'){
        var modal = $('#update-flag-status-date-modal');
        modal.modal('show');
    }else{
        var deploymentDate = null;
        updateApplicantFlagStatus(flagStatus, traineeId, deploymentDate);
    }
});

$(document).on('click', '.confirm-flag-status-date-btn', function(){
    var form = $('#update-flag-status-date-form');
    var flagStatus = form.find('[name="flag-status"]').val();
    var traineeId = form.find('[name="trainee-id"]').val();
    var deploymentDate = form.find('[name="flag-deployment-date"]').val();
    updateApplicantFlagStatus(flagStatus, traineeId, deploymentDate);
})

function updateApplicantFlagStatus(flagStatus, traineeId, deploymentDate){
    $.ajax({
        url: 'update_applicant_flag_status',
        method: 'POST',
        dataType: 'JSON',
        data: {'flag-status': flagStatus, 'trainee-id': traineeId, 'deployment-date': deploymentDate},

        success:function(response){
            switch(response.status){
                case 'success':
                    var urlString = window.location.href;
                    var url = new URL(urlString);
                    var param = url.searchParams.get('batch');
                    var batStatus = url.searchParams.get('status');

                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',
                        closeButton: false
                    });

                    $('select[name="trainee-flag-status"][data-user-id="'+traineeId+'"]').find('option.status-'+flagStatus).prop('selected', true);
                    if(param != null && batStatus != null){
                        $('select[name="trainee-flag-status"][data-user-id="'+traineeId+'"]').parent().parent().fadeOut('slow', function(){
                            $(this).remove();
                        })
                    }
        
                    dialog.init(function () {
                        setTimeout(function () {
                            var modal = $('#update-flag-status-date-modal');
                            modal.modal('hide');
                            dialog.modal('hide');
                        }, 1000);
                    });
                break;

                case 'error':
                    alert('Something went wrong. Kindly contact IT administrator');
                break;
            }
        }

    });
}

$(document).on('click', '.confirm-flag-status-date-btn', function(){
    var flagStatus = $(this).val();
    var traineeId = $(this).data('user-id');
})

$(document).on('click', '.add-batch-btn', function(e){
    e.preventDefault();

    var modal = $('#add-batch-modal');
    var form = modal.find('form');
    form[0].reset();
    modal.find('.modal-title').text('Add batch name');
    modal.find('[type="submit"]').attr('data-action', 'add');
    modal.find('[type="submit"]').html('<i class="fas fa-plus"></i> Add ');
    modal.modal('show');
});

$(document).on('click', '.add-batch-number-btn', function(e){
    e.preventDefault();

    var modal = $('#add-batch-number-modal');
    var form = modal.find('form');
    form[0].reset();
    modal.modal('show');
});

$(document).on('submit', '#form-add-batch', function(e){
    e.preventDefault();
    var form = $(this);
    var action = $('[type="submit"]').data('action');

    $.ajax({
        url: 'check_batch_name',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        success: function(response){
            switch(response.status){
                case 'already-exist':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:red;"><i class="fa fa-check"></i> Batch name already exists. Please select a different name.</p>',
                        closeButton: false
                    });
        
                    dialog.init(function () {
                        setTimeout(function () {
                            dialog.modal('hide');
                        }, 5000);
                    });
                break;

                case 'proceed-to-add':
                    $.ajax({
                        url: 'add_batch',
                        method: 'POST',
                        dataType: 'JSON',
                        data: form.serialize() + '&action=' + action,
                
                        success:function(response){
                            switch(response.status){
                                case 'success':
                                
                                    var dialog = bootbox.dialog({
                                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',
                                        closeButton: false
                                    });
                
                                    dialog.init(function () {
                                        setTimeout(function () {
                                            window.location.reload();
                                        }, 2000);
                                    });
                                    
                                break;
                
                                case 'error':
                                    alert(response.status);
                                break;
                            }
                        }
                    });
                break;
            }
        }
    });
    
    
});

$(document).on('click', '.batch-edit-btn', function(e){
    e.preventDefault();
    var modal = $('#add-batch-modal');
    var id = $(this).data('batch-id');
    var name = $(this).data('batch-name');
    modal.find('.modal-title').text('Edit batch name');
    modal.find('form [name="batch-id"]').remove();
    modal.find('form').prepend('<input type="hidden" name="batch-id" value="'+id+'">');
    modal.find('[name="batch-name"]').val(name);
    modal.find('[type="submit"]').attr('data-action', 'edit');
    modal.find('[type="submit"]').html('<i class="fas fa-check"></i> Save');
    modal.modal('show');

});

$(document).on('click', '.batch-delete-btn', function(e){
    e.preventDefault();
    var modal = $('#delete-batch-modal');
    var id = $(this).data('batch-id');
    var name = $(this).data('batch-name');

    $.ajax({
        url: 'check_batch',
        method: 'POST',
        dataType: 'JSON',
        data: {id: id},

        success: function(response){
            switch(response.status){
                case 'success':
                    modal.find('.batch-name').text(name);
                    modal.find('[name="batch-id"]').val(id);
                    modal.modal('show');
                break;

                case 'error':
                    var dialog = bootbox.alert({
                        message: '<p class="text-center mb-0" style="color:red;"><i class="fa fa-times"></i> Request denied. There are batch numbers under the selected batch.</p>',
                        closeButton: false
                    });
                break;
            }
        }
    })

    
});

$(document).on('submit', '#form-delete-batch', function(e){
    e.preventDefault();

    var form = $(this);

    $.ajax({
        url: 'delete_batch',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        success: function(response){
            switch(response.status){
                case 'success':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',
                        closeButton: false
                    });

                    dialog.init(function () {
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    });
                break;

                case 'error':
                    alert('Something went wrong. Please contact IT Administrator.');
                break;
            }
        }
    });
});

$(document).on('submit', '#form-add-batch-number', function(e){
    e.preventDefault();

    var form = $(this);

    $.ajax({
        url: 'check_batch_number',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        success: function(response){
            switch(response.status){
                case 'success':
                    $.ajax({
                        url: 'add_batch_number',
                        method: 'POST',
                        dataType: 'JSON',
                        data: form.serialize(),
                
                        success: function(response){
                            switch(response.status){
                                case 'success':
                                    var dialog = bootbox.dialog({
                                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',
                                        closeButton: false
                                    });
                
                                    dialog.init(function () {
                                        setTimeout(function () {
                                            window.location.reload();
                                        }, 2000);
                                    });
                                break;
                
                                case 'error':
                                    alert('Something went wrong. Please contact IT Administrator.');
                                break;
                
                            }
                        }
                    });
                break;

                case 'error':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:red;"><i class="fa fa-times"></i> Batch number already exists, please try again.</p>',
                        closeButton: false
                    });

                    dialog.init(function () {
                        setTimeout(function () {
                            dialog.modal('hide');
                        }, 3000);
                    });
                break;
            }
        }
    })

    
});

$(document).on('click', '.batch-number-edit-btn', function(e){
    e.preventDefault();

    var batchId = $(this).data('batch-id');
    var batchName = $(this).data('batch-name');
    var batchNumber = $(this).data('batch-number');
    var modal = $('#edit-batch-number-modal');
    
    $('[name="batch-num-id"]').val(batchId);
    $('[name="batch-id"] option.bat-'+batchName).prop('selected', true);
    $('[name="batch-number"]').val(batchNumber);

    modal.modal('show');
    
});

$(document).on('submit', '#form-edit-batch-number', function(e){
    e.preventDefault();

    var form = $(this);

    $.ajax({
        url: 'check_batch_number',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        success: function(response){
            switch(response.status){
                case 'success':
                    $.ajax({
                        url: 'edit_batch_number',
                        mehod: 'POST',
                        dataType: 'JSON',
                        data: form.serialize(),
                
                        success: function(response){
                            switch(response.status){
                                case 'success':
                                    var dialog = bootbox.dialog({
                                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',
                                        closeButton: false
                                    });
                
                                    dialog.init(function () {
                                        setTimeout(function () {
                                            window.location.reload();
                                        }, 2000);
                                    });
                                break;
                
                                case 'error':
                                    alert('Something went wrong. Please contact IT Administrator.');
                                break;
                            }
                        }
                    });
                break;

                case 'error':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:red;"><i class="fa fa-times"></i> Batch number already exists, please try again.</p>',
                        closeButton: false
                    });

                    dialog.init(function () {
                        setTimeout(function () {
                            dialog.modal('hide');
                        }, 3000);
                    });
                break;
            }
        }
    });
});

$(document).on('click', '.batch-number-delete-btn', function(e){
    e.preventDefault();
    var batchNumber = $(this).data('batch-number-id');

    $.ajax({
        url: 'check_batch_number_content',
        method: 'POST',
        dataType: 'JSON',
        data: { id: batchNumber },

        success: function(response){
            switch(response.status){
                case 'success':

                bootbox.confirm({
                    closeButton: false,
                    message: "Are you sure to delete selected Batch number?",
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
                                url: 'delete_batch_number',
                                method: 'POST',
                                dataType: 'JSON',
                                data: {data: response.data},
        
                                success: function(response){
                                    switch(response.status){
                                        case 'success':
                                            var dialog = bootbox.dialog({
                                                message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Deleted Successfully.</p>',
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
                        }else {
                            console.log('no action')
                        }
                    }
                });

                    
                break;

                case 'error':
                    var dialog = bootbox.alert({
                        message: '<p class="text-center mb-0" style="color:red;"><i class="fa fa-times"></i> Request denied. There are trainees under the selected batch.</p>',
                        closeButton: false
                    });
                break;
            }
        }
    })
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

$(document).on('change', '[name="applicants-checkbox-all"]', function(){
    let tableId = $(this).data('table');
    let table = $('#' + tableId);

    if($(this).is(':checked')){
        table.find('[name="applicants-checkbox"]').prop('checked', true);
    }else{
        table.find('[name="applicants-checkbox"]').prop('checked', false);
    }

    let countApplicantsChecked = table.find('[name="applicants-checkbox"]:checked').length;

    if(countApplicantsChecked != 0){
        $('.move-to-batch-btn, .mass-change-status-btn').removeClass('d-none');
    }else{
        $('.move-to-batch-btn, .mass-change-status-btn').addClass('d-none');
    }
});

$(document).on('change', '[name="applicants-checkbox"]', function(){

    let countApplicantsChecked = $('[name="applicants-checkbox"]:checked').length;
    if(countApplicantsChecked != 0){
        $('.move-to-batch-btn, .mass-change-status-btn').removeClass('d-none');
    }else{
        $('.move-to-batch-btn, .mass-change-status-btn').addClass('d-none');
    }
});

$(document).on('click', '.mass-change-status-btn', function(){
    var getApplicantsChecked = [];
    var modal = $('#change-applicants-status-modal');

    $('[name="applicants-checkbox"]:checked').each(function(){
        let id = $(this).val();
        let name = $(this).data('trainee-name');
        let email = $(this).data('trainee-email');
        let status = $(this).data('current-status');

        let tableRowHtml = `<tr class="applicant-id-${id}" data-trainee-id="${id}">
                                <td>${name}</td>
                                <td>${email}</td>
                                <td>${status.toUpperCase()}</td>
                                <td><button class="btn bg-none btn-sm text-danger cancel-trainee-change-status-btn" ><i class="fas fa-times"></i> Cancel</button></td>
                            </tr>`;

        getApplicantsChecked.push(tableRowHtml);
        modal.find('#applicants-mass-change-status-table tbody').html(getApplicantsChecked.join(' '));

    });

    modal.modal('show');
});

$(document).on('submit', '#form-mass-change-applicant-status', function(e){
    e.preventDefault();

    var form = $(this);
    var table = $('#applicants-mass-change-status-table');
    var countTr = table.find('tbody tr').length;
    var traineeIdsArr = [];
    var status = form.find('[name="new-app-status"]:checked').val();
    var deploymentDate = form.find('[name="flag-deployment-date"]').val();

    for(let i = 1; i <= countTr; i++){
        var id = table.find('tbody tr:nth-child('+i+')').data('trainee-id');
        traineeIdsArr.push(id);
    }

    $.ajax({
        url: 'mass_change_trainee_status',
        method: 'POST',
        dataType: 'JSON',
        data: {ids: traineeIdsArr, status: status, deploymentDate},

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
                        }, 2000);
                    });
                break;

                case 'error':
                    alert('Something went wrong. Please contact IT administrator.');
                break;
            }
        }
    })
});

$(document).on('click', '.cancel-trainee-change-status-btn', function(e){
    e.preventDefault();
    
    var traineeId = $(this).parent().parent().data('trainee-id');
    
    $('#applicants-mass-change-status-table').find('tr.applicant-id-'+traineeId).fadeOut('slow', function(){
        $(this).remove();
    });

    var tr = $('#applicants-mass-change-status-table').find('tbody tr').length - 1;

    if(tr == 0){
        $('.mass-change-status-btn').addClass('disabled');
    }else{
        $('.mass-change-status-btn').removeClass('disabled');
    }

    
});

$(document).on('click', '.move-to-batch-btn', function(e){
    e.preventDefault();

    var getApplicantsChecked = [];
    var modal = $('#move-applicants-batch-modal');

    $('[name="applicants-checkbox"]:checked').each(function(){
        let id = $(this).val();
        let name = $(this).data('trainee-name');
        let email = $(this).data('trainee-email');
        let batch = $(this).data('trainee-batch');

        let tableRowHtml = `<tr class="move-applicant-id-${id}" data-trainee-id="${id}">
                                <td>${name}</td>
                                <td>${email}</td>
                                <td>${batch}</td>
                                <td><button class="btn bg-none btn-sm text-danger cancel-trainee-move-batch-btn" ><i class="fas fa-times"></i> Cancel</button></td>
                            </tr>`;

        getApplicantsChecked.push(tableRowHtml);

        modal.find('#applicants-move-batch-table tbody').html(getApplicantsChecked.join(' '));

    });

    $.ajax({
        url: 'get_applicants_batches',
        method: 'POST',
        dataType: 'JSON',

        success: function(response){
            switch(response.status){
                case 'success':
                    var options = ['<option selected disabled>Select Batch</option>'];
                    for(let i = 0; i < response.batches.length; i++){
                        var batch = response.batches[i];

                        option = `<option value="${batch.name}">${batch.name.toUpperCase()}</option>`;
                        options.push(option);
                    }

                    modal.find('[name="batches"]').html(options.join(''));

                    $(document).on('change', '[name="batches"]', function(){
                        var name = $(this).val();

                        $.ajax({
                            url: 'get_applicants_batch_numbers',
                            method: 'POST',
                            dataType: 'JSON',
                            data: {name : name},

                            success: function(response){
                                switch(response.status){
                                    case 'success':
                                        
                                        var numOptions = ['<option selected disabled>Select batch number</option>'];
                                        $('[name="batch-numbers"] option').remove();

                                        for(let i = 0; i < response.numbers.length; i++){
                                            var number = response.numbers[i];
                    
                                            option = `<option value="${number.batch_number}">${number.batch_number}</option>`;
                                            numOptions.push(option);
                                        }

                                        modal.find('[name="batch-numbers"]').html(numOptions.join(''));
                                    break;

                                    case 'error':
                                        alert('Something went wrong. Please contact IT administrator.');
                                    break;
                                }
                            }
                        });
                    });
                break;

                case 'error':
                    alert('Something went wrong. Please contact IT administrator.');
                break;
            }
        }
    })
    
    $('.move-batch-btn').removeClass('disabled');
    modal.modal('show');
 
});

$(document).on('click', '.cancel-trainee-move-batch-btn', function(e){
    e.preventDefault();
    
    var traineeId = $(this).parent().parent().data('trainee-id');
    
    $('#applicants-move-batch-table').find('tr.move-applicant-id-'+traineeId).fadeOut('slow', function(){
        $(this).remove();
    });

    var tr = $('#applicants-move-batch-table').find('tbody tr').length - 1;

    if(tr == 0){
        $('.move-batch-btn').addClass('disabled');
    }else{
        $('.move-batch-btn').removeClass('disabled');
    }

    
});

$(document).on('submit', '#form-move-applicant-batch', function(e){
    e.preventDefault();

    var table = $('#applicants-move-batch-table');
    var countTr = table.find('tbody tr').length;
    var traineeIdsArr = [];
    var batch = $('[name="batches"]').val();
    var batchNumber = $('[name="batch-numbers"]').val();

    for(let i = 1; i <= countTr; i++){
        var id = table.find('tbody tr:nth-child('+i+')').data('trainee-id');
        
        traineeIdsArr.push(id);
    }

    $.ajax({
        url: 'move_trainee_batch',
        method: 'POST',
        dataType: 'JSON',
        data: {ids: traineeIdsArr, batch: batch, batch_number: batchNumber},

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
                        }, 2000);
                    });
                break;

                case 'error':
                    alert('Something went wrong. Please contact IT administrator.');
                break;
            }
        }
    })
});

$(document).on('change', '#select-status-view', function(){
    var val = $(this).val();
    var urlString = window.location.href; 
    var url = new URL(urlString);
    url.searchParams.delete('upcoming');

    if (val === 'upcoming') {
        url.searchParams.set('status', 'deployed');
        url.searchParams.set('upcoming', '1');
    } else if (val !== 'all') {
        url.searchParams.set('status', val);
    } else {
        url.searchParams.delete('status');
    }

    window.location.href = url.href;
});

$(document).on('click', '.new-message-btn', function(e){
    e.preventDefault();

    if($('.faq-keyword-items').is(':visible')){
        $('.faq-keyword-items').slideUp();
    }else{
        $('.faq-keyword-items').slideDown();
    }
});

$(document).on('click', '.admin-key-btn', function(){
    var tag = $(this).data('tag');
    var deptId = $(this).data('department-id');
    var userId = $(this).data('user-id');
    var adminId = $(this).data('admin-id');

    $.ajax({
        url: 'admin_start_conversation',
        method: 'POST',
        dataType: 'JSON',
        data: {
            tag: tag,
            dept_id: deptId,
            user_id: userId,
            admin_id: adminId
        },

        success: function(response){
            switch(response.status){
                case 'success':
                    window.location.href = response.url;
                break;
            }
        }
    });
});

$(document).on('click', '.delete-inforeq-btn', function(){
    var id = $(this).data('inforeq-id');
    var modal = $('#delete-user-info-request-modal');
    var form = modal.find('form');
    form.find('[name="id"]').val(id);
    modal.modal('show');
});

$(document).on('click', '.confirm-delete-uir-btn', function(){
    var form = $('#delete-user-info-request-form');
    var id = form.find('[name="id"]').val();

    $.ajax({
        url: 'delete_inforeq',
        method: 'POST',
        dataType: 'JSON',
        data: {id : id},

        success: function(response){
            switch(response.status){
                case 'success':
                    var html = `<div class="alert alert-success">${response.message}</div>`;
                    var table = $('#update-info-requests-table');
                    form.find('.response').html(html);
                    table.find('#table-' + id).fadeOut('slow', function(){
                        $(this).remove();
                    })
                    
                    setTimeout(function(){
                        $('#delete-user-info-request-modal').modal('hide');
                    }, 2000);
                break;
            }
        }
    })
})

$(document).on('click', '[name="new-app-status"]', function(){
    if($(this).val() == 'deployed'){
        $('.deployment-container').removeClass('d-none');
        $('.deployment-container input').attr('required', true);
    }else{
        $('.deployment-container').addClass('d-none');
        $('.deployment-container input').attr('required', false);
    }
});

$(document).on('change', '[name="batch"]', function(){
    var batch = $(this).val();
    $('[name="batch-number"] option').addClass('d-none');
    $('[name="batch-number"] option.bat-'+batch).removeClass('d-none');
});

$(document).on('submit', '#add-trainee', function(e){
    e.preventDefault();

    var form = $(this);
    $.ajax({
        url: 'ajax_add_trainee',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        beforeSend: function(){
            form.find('button').addClass('disabled').html('<i class="fas fa-spinner fa-spin"></i> Please wait...');
            form.find('.email-in-use').addClass('d-none');
            form.find('[name="email"]').removeClass('border-danger');
        },

        success: function(response){
            switch(response.status){
                case 'success':
                    form.find('button').removeClass('disabled').html('Add');
                    var modal = $("#add-trainee-success-modal");
                    modal.find('textarea').val(response.link);
                    modal.modal('show');
                break;

                case 'email-already-exist':
                    form.find('button').removeClass('disabled').html('Add');
                    form.find('.email-in-use').removeClass('d-none');
                    form.find('[name="email"]').addClass('border-danger');
                break;
            }
        }
    })
})

/*End -- Added by migs */
