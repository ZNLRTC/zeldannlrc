$(document).ready(function(){
    let = userMessagesTable = $('#user-messages-table').DataTable({

        "order": [[1, 'desc']],
        "pageLength": 25,
        "columnDefs": [
            {
                "target": 1,
                "visible": false
            }
        ]
    });

    $(document).on('keyup', '#user-messages-table-search', function(){
        userMessagesTable.search($(this).val()).draw();
    });

});

$(document).on('click', '#view_user, .view-user-btn', function () {
    var user_ed = $(this).attr('user-id');
    $.ajax({
        method: 'POST',
        data: { user_ed: user_ed },
        success: function (d) {
            let form = '<form action="view?' + user_ed +'" method="post" id="view_app" >';
            form += '<input type="hidden" id="user_ed" name="user" value="' + user_ed + '">';
            form += '</form>';
            $('body').append(form);
            $('#view_app').submit();
        }
    });
});

$(document).on('click', '.transfer-message-btn', function() {
    var ticket = $(this).data('ticket');
    var adminId = $(this).data('transferred-by');
    var department = $(this).data('current-department');
    var modal = $('#transfer-message-modal');

    $.ajax({
        url: 'get_all_keywords',
        method: 'POST',
        dataType: 'JSON',
        success: function(response) {
            switch(response.status) {
                case 'success':
                    var htmlArr = [];
                    var data = response.data;
                    
                    for (let i = 0; i < data.length; i++) {
                        var html = `<div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body p-1 px-3 pointer transfer-keyword" data-keyword-id="${data[i].id}">
                                                <h4>${data[i].icon} ${data[i].description}</h3>
                                            </div>
                                        </div>
                                    </div>`;
                        htmlArr.push(html);
                    }
                    $('.keywords-container').html(htmlArr.join(''));

                    modal.find('[name="ticket"]').val(ticket);
                    modal.find('[name="admin-id"]').val(adminId);
                    modal.find('[name="current-deparment"]').val(department);
                    modal.modal('show');
                break;
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data:', error);
        }
    });
});

$(document).on('click', '.transfer-keyword', function(){
    $('.transfer-keyword').removeClass('bg-lblue');
    $(this).addClass('bg-lblue');
    var id = $(this).data('keyword-id');
    var form = $('#form-transfer-message');
    form.find('[name="keyword-id"]').val(id);
});

$(document).on('submit', '#form-transfer-message', function(e){
    e.preventDefault();

    var form = $(this);

    $.ajax({
        url: 'transfer_message',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),

        success: function(response){
            switch(response.status) {
                case 'no-keyword':
                    bootbox.alert({
                        message: '<p class="text-center mb-0" style="color:red;"><i class="fa fa-times"></i> Please select transfer keyword.</p>',
                        closeButton: false
                    });
                break;

                case 'no-message':
                    bootbox.alert({
                        message: '<p class="text-center mb-0" style="color:red;"><i class="fa fa-times"></i> Please enter reason for transfer.</p>',
                        closeButton: false
                    });
                break;

                case 'success':
                    var dialog = bootbox.dialog({
                        message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Transferred Successfully.</p>',
                        closeButton: false
                    });

                    dialog.init(function () {
                        setTimeout(function () {
                            dialog.modal('hide');
                            window.location.reload();
                        }, 1000);
                    });
                break;

                case 'error':
                    alert('Something went wrong. Please contact IT Administrator.');
                break;
            }
        }
    })
});