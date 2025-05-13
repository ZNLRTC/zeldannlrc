$(document).ready(function(){
    let deptTable = $('#departments-table').DataTable();

    $(document).on('keyup', '#search-department-table', function(){
        deptTable.search($(this).val()).draw();
    });

    $.ajax({
        url: 'get_first_department',
        method: 'POST',
        dataType: 'JSON',

        success: function(response){
            switch(response.status){
                case 'success':
                    $('.multi-departments-container').addClass('d-none');
                    $('#dept-'+response.f_department.id).find('td:first-child [type="radio"]').prop('checked', true);
                    $('#department-'+response.f_department.id+'-container').removeClass('d-none');
                break;
            }
        }
    })
});

$(document).on('click', '.add-department-btn', function(e){
    e.preventDefault();
    var modal = $('#add-department-modal');
    modal.modal('show');
});

$(document).on('submit', '#add-department-form', function(e){
    e.preventDefault();

    var form = $(this);
    $.ajax({
        url: 'add_department',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        success: function(response){
            switch(response.status){
                case 'success':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Added Successfully.</p>',
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

                case 'form-incomplete':
                    var dialog = bootbox.alert({
                        message: '<p class="mb-0" style="color:red;"><i class="fa fa-times"></i> Description already exist. Enter another description.</p>',
                        closeButton: false
                    });
                break;
            }
        }
    });
});

$(document).on('click', '.edit-department-btn', function(e){
    e.preventDefault();

    var id = $(this).parent().parent().data('department-id');
    $.ajax({
        url: 'get_department_info',
        method: 'POST',
        dataType: 'JSON',
        data: {id:id},

        success: function(response){
            switch(response.status){
                case 'success':
                    var form = $('#edit-department-form');
                    var modal = $('#edit-department-modal');

                    form.find('[name="department-id"]').val(id);
                    form.find('[name="description"]').val(response.data.description);
                    modal.modal('show');

                break;
            }
        }
    })
});

$(document).on('submit', '#edit-department-form', function(e){
    e.preventDefault();

    var form = $(this);

    $.ajax({
        url: 'edit_department',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        success: function(response){
            switch(response.status){
                case 'success':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Updated Successfully.</p>',
                        closeButton: false
                    });

                    var id = form.find('[name="department-id"]').val();

                    $('#departments-table tr#dept-' + id + ' td:nth-child(2)').text(response.description);
                    $('#departments-table tr#dept-' + id + ' td:nth-child(3)').text(response.admin_name);
                    $('#departments-table tr#dept-' + id).attr('data-department-description', response.description);

                    dialog.init(function () {
                        setTimeout(function () {
                            dialog.modal('hide');
                            $('#edit-department-modal').modal('hide');
                        }, 2000);
                    });
                break;

                case 'form-incomplete':
                    var dialog = bootbox.alert({
                        message: '<p class="mb-0" style="color:red;"><i class="fa fa-times"></i> Description already exist. Enter another description.</p>',
                        closeButton: false
                    });
                break;

                case 'error':
                    alert('Something went wrong. Please contact IT administrator.');
                break;
            }
        }
    })
});

$(document).on('click', '.delete-department-btn', function(){
    var id = $(this).parent().parent().data('department-id');
    var desc = $(this).parent().parent().data('department-description');
    var modal = $('#delete-department-modal');

    $.ajax({
        url: 'check_department_content',
        method: 'POST',
        dataType: 'JSON',
        data: {id : id},

        success: function(response){
            switch(response.status){
                case 'success':
                    modal.find('.dept-desc').text(desc);
                    modal.find('form [name="department-id"]').val(id);
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
    });

    
});

$(document).on('submit', '#delete-department-form', function(e){
    e.preventDefault();

    var form = $(this);

    $.ajax({
        url: 'delete_department',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        success: function(response){
            switch(response.status){
                case 'success':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Deleted Successfully.</p>',
                        closeButton: false
                    });

                    $('#dept-'+response.id).fadeOut('slow', function(){
                        $(this).remove();
                    });

                    dialog.init(function () {
                        setTimeout(function () {
                            dialog.modal('hide');
                            $('#delete-department-modal').modal('hide');
                        }, 2000);
                    });
                break;

                case 'error':
                    alert('Something went wrong. Please contact IT administrator.');
                break;
            }
        }
    });
});

$(document).on('change', '[name="radio-department"]', function(){

    desc = $(this).val();

    $('.multi-departments-container').addClass('d-none');
    $('#department-'+desc+'-container').removeClass('d-none');
});

$(document).on('click', '.add-department-employee-btn', function(e){
    e.preventDefault();

    var deptId = $(this).data('department-id');
    var deptDesc = $(this).data('department-description');
    var modal = $('#add-department-employee-modal');

    modal.find('.modal-title').text('Add employee to ' + deptDesc);
    modal.find('[name="department-id"]').val(deptId);

    $.ajax({
        url: 'get_employees_with_no_department',
        method: 'POST',
        dataType: 'JSON',

        success: function(response){
            switch(response.status){
                case 'success':

                    var empOption = ['<option value="" selected disabled>Select Employee</option>'];

                    for(let i = 0; i < response.employees.length; i++){
                        var empArr = response.employees;
                        var option = '<option value="'+empArr[i]['id']+'">'+empArr[i]['first_name']+' '+empArr[i]['last_name']+'</option>';
                        empOption.push(option);
                    }

                    modal.find('form [name="employees"]').html(empOption);
                    modal.modal('show');
                break;
            }
        }

    });
});

$(document).on('submit', '#add-department-employee-form', function(e){
    e.preventDefault();

    var form = $(this);

    $.ajax({
        url: 'add_employee_department',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        success: function(response){
            switch(response.status){
                case 'success':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Added Successfully.</p>',
                        closeButton: false
                    });

                    dialog.init(function () {
                        setTimeout(function () {
                           window.location.reload();
                        }, 1000);
                    });
                break;

                case 'error':
                    alert('Something went wrong. Please contact IT administrator.');
                break;
            }
        }
    })
});

$(document).on('click', '.remove-employee-from-department-btn', function(e){
    e.preventDefault();

    var modal = $('#delete-department-employee-modal');
    var form = modal.find('form');
    var empId = $(this).parent().parent().data('employee-id');
    var empName = $(this).parent().parent().data('employee-name');
    var desc = $(this).parent().parent().data('employee-department');
    var deptId = $(this).parent().parent().data('department-id');

    form.find('[name="employee-id"]').val(empId);
    form.find('[name="department-id"]').val(deptId);
    form.find('.employee-name').text(empName);
    form.find('.employee-department').text(desc);

    modal.modal('show');
});

$(document).on('submit', '#delete-department-employee-form', function(e){
    e.preventDefault();

    var form = $(this);

    $.ajax({
        url: 'remove_employee_from_department',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        success: function(response){
            switch(response.status){
                case 'success':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Removed Successfully.</p>',
                        closeButton: false
                    });

                    $('#dept-employee-' + response.emp_id).fadeOut('slow', function(){
                        $(this).remove();
                    });

                    dialog.init(function () {
                        setTimeout(function () {
                            dialog.modal('hide');
                            $('#delete-department-employee-modal').modal('hide');
                        }, 1000);
                    });
                break;

                case 'error':
                    alert('Something went wrong. Please contact IT administrator.');
                break;
            }
        }
    })
});

