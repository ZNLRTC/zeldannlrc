

//BARANGAY CODE
$(document).ready(function () {
    $('#brgy_Table').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "columnDefs": [
            {
                "targets": [0, 2],
                "orderable": false
            }
        ],
        'ajax': {
            'url': './php_actions/formbrgy_datatable.php'
        },

        'columns': [
            { data: 'id' },
            { data: 'barangay' },
            { data: 'action' },
        ]
    });
});


$(document).on('click', '#view_brgy', function () {
    var id = $(this).attr('brgy-id');
    $.get("./form/barangay?id=" + id, function (data) {
        window.location.replace("./form/barangay?id=" + id);
    });
});

$(document).on('click', '#back_brgy', function (e) {
    window.location.replace("./");
});



/* add add_brgy*/
$(document).on('submit', '#add_brgy', function (e) {
    e.preventDefault()
    var data = $('#add_brgy').serialize();
    var url = $(this).prop('action');
    $.ajax({
        url: url,
        method: 'POST',
        data: data,
        dataType: 'JSON',
        beforeSend: function () {
            $('#loading').modal('show')
        },
        success: function (data) {
            $('#loading').modal('hide')
            $('#brgy_notif').removeClass('d-none');
            setTimeout(function () {
                $("#brgy_notif").addClass("d-none");
            }, 2000);
            $('#brgy_Table').DataTable().ajax.reload();
        }
    });

    $('#add_brgy')[0].reset();
});

/* delete brgy*/
$(document).on('click', '#del_brgy', function () {
    var b_id = $(this).attr('brgy-id');
    bootbox.confirm({
        closeButton: false,
        message: "Are you sure to delete this barangay?",
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
                    type: 'POST',
                    url: './form/deleteBarangay',
                    data: { b_id: b_id },
                    beforeSend: function () {
                    },
                    success: function (data) {
                        var dialog = bootbox.dialog({
                            message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',
                            closeButton: false
                        });
                        dialog.init(function () {
                            setTimeout(function () {
                                dialog.modal('hide');
                            }, 1000);
                        });
                        $('#brgy_Table').DataTable().ajax.reload();

                    }
                });
            } else {
                console.log('no action')
            }
        }
    });
});


//update barangay
$(document).on('submit', '#udpate_brgy', function (e) {
    e.preventDefault()
    var profData = $('#udpate_brgy').serialize();
    var url = $(this).prop('action');
    $.ajax({
        url: url,
        method: 'POST',
        data: profData,
        dataType: 'JSON',
        beforeSend: function () {
            $('#loading').modal('show')
        },
        success: function (data) {
            $('#loading').modal('hide')
            setInterval('location.reload()', 2000);
            $('#update_notif').removeClass('d-none');
            setTimeout(function () {
                $("#update_notif").fadeOut("slow");
            }, 4000);
        }
    });

});































//HOUSEHOLDS CODES

$(document).ready(function () {
    $('#hh_Table').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "columnDefs": [
            {
                "targets": [0, 4],
                "orderable": false
            }
        ],
        'ajax': {
            'url': './php_actions/formhh_datatable.php'
        },

        'columns': [
            { data: 'id' },
            { data: 'hh_code' },
            { data: 'sitio' },
            { data: 'barangay' },
            { data: 'action' },
        ]
    });
});






/* add button */
$(document).on('click', '#modal_addhh', function () {
    $('#modal-hh').modal('show')


});

$(document).on('click', '#close_modal', function () {
    $('#modal-hh').modal('hide')
});


/* add hh*/
$(document).on('submit', '#add_hh', function (e) {
    e.preventDefault()
    var data = $('#add_hh').serialize();
    var url = $(this).prop('action');
    $.ajax({
        url: url,
        method: 'POST',
        data: data,
        dataType: 'JSON',
        beforeSend: function () {
            $('#loading').modal('show')
        },
        success: function (data) {
            $('#loading').modal('hide')
            $('#add_notif').removeClass('d-none');
            setTimeout(function () {
                $("#add_notif").fadeOut("slow");
            }, 4000);
            $('#hh_Table').DataTable().ajax.reload();
        }
    });
    $('#add_hh')[0].reset();

});


/*DELETE HH

/* delete brgy*/
$(document).on('click', '#del_hh', function () {
    var h_id = $(this).attr('hh-id');
    bootbox.confirm({
        closeButton: false,
        message: "Are you sure to delete this Household?",
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
                    type: 'POST',
                    url: './form/deleteHousehold',
                    data: { h_id: h_id },
                    beforeSend: function () {
                    },
                    success: function (data) {
                        var dialog = bootbox.dialog({
                            message: '<p class="text-center mb-0" style="color:green;"><i class="fa fa-check"></i> Success</p>',
                            closeButton: false
                        });
                        dialog.init(function () {
                            setTimeout(function () {
                                dialog.modal('hide');
                            }, 1000);
                        });
                        $('#hh_Table').DataTable().ajax.reload();

                    }
                });
            } else {
                console.log('no action')
            }
        }
    });
});

$(document).on('click', '#view_hh', function () {
    var id = $(this).attr('hh-id');
    $.get("./form/household?id=" + id, function (data) {
        window.location.replace("./form/household?id=" + id);
    });
});

//update hh
$(document).on('submit', '#udpate_hh', function (e) {
    e.preventDefault()
    var profData = $('#udpate_hh').serialize();
    var url = $(this).prop('action');
    $.ajax({
        url: url,
        method: 'POST',
        data: profData,
        dataType: 'JSON',
        beforeSend: function () {
            $('#loading').modal('show')
        },
        success: function (data) {
            $('#loading').modal('hide')
            setInterval('location.reload()', 2000);
            $('#updatehh_notif').removeClass('d-none');
            setTimeout(function () {
                $("#updatehh_notif").fadeOut("slow");
            }, 4000);
        }
    });

});


