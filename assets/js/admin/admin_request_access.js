$(document).on('click', '.approve-access-request', function(){
    var reqId = $(this).data('request-id');

    bootbox.confirm({
        closeButton: false,
        message: "Approve request?",
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
                    url: 'approve_access_request',
                    method: 'POST',
                    dataType: 'JSON',
                    data:  { reqId: reqId },
                    
                    beforeSend: function () {
                    },

                    success: function (response) {
                        if(response.status == 'success'){
                            window.location.reload();
                        }
                    }
                });

            }else {
                console.log('no action')
            }

        }

    });
})