$(document).ready(function(){
    setInterval(function(){
        //fetchMessage();
    }, 5000)
});

function fetchMessage(){
    console.log('Message');
}

function convertTime(datetimeStr){
    const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    const days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];

    const dateTime = new Date(datetimeStr);
    const month = months[dateTime.getMonth()];
    const day = dateTime.getDate();
    const year = dateTime.getFullYear();
    const dayOfWeek = days[dateTime.getDay()];
    let hours = dateTime.getHours();
    const minutes = ('0' + dateTime.getMinutes()).slice(-2);
    const amOrPm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12 || 12;

    const formattedDateTime = month + ' ' + day + ', ' + year + ' (' + dayOfWeek + ') at ' + ('0' + hours).slice(-2) + ':' + minutes + ' ' + amOrPm;
    return formattedDateTime;
}

// function sendAlertMessage($email){
//     $.ajax({
//         url: 
//     })
// }

function scrollToBottom(conversation) {
    return conversation.scrollTop = conversation.scrollHeight;
}

$(document).ready(function(){
    const conversation = document.querySelector('.conversation');
    scrollToBottom(conversation);
});

// $(document).on('click', '.send-chat-btn', function(e){
//     e.preventDefault();

//     var from = $(this).data('chat-from');
//     var to = $(this).data('chat-to');
//     var message = $('#msg-content').val();

//     $.ajax({
//         url: 'save_chat_message',
//         method: 'POST',
//         dataType: 'JSON',
//         data: {'chat-from': from, 'chat-to': to, 'message': message},

//         success: function(response){
//             switch(response.status){
//                 case 'success':
//                     var time = convertTime(response.data.date_created);
//                     var html = `<div class="message sent">
//                                     <span class="arrow"></span>
//                                     <span class="sender">${response.data.sender}</span>
//                                     <div>${message}</div>
//                                     <span class="time">${time}</span>
//                                 </div>`;

//                     $('#msg-content').val('');
//                     $('#conversation-'+from+'-'+to).append(html);
//                     scrollToBottom(document.querySelector('.conversation'));

//                 break;
//             }
//         }
//     });
// });

$(document).on('click', '.send-chat-btn', function(e){
    e.preventDefault();
    var convoId = $(this).data('convo-id');
    var chatFrom = $(this).data('chat-from');
    var chatTo = $(this).data('chat-to');
    var message = $('#msg-content').val();

    $.ajax({
        url: 'save_chat_message',
        method: 'POST',
        dataType: 'JSON',
        data: {
            convo_id: convoId,
            chat_from: chatFrom,
            chat_to: chatTo,
            message: message
        },

        success: function(response){
            switch(response.status){
                case 'success':
                    var time = convertTime(response.data.date_created);
                    var html = `<div class="message sent">
                                    <div class="message-text"> ${response.data.message} </div>
                                    <span class="time">${time}</span>
                                </div>`;
                    
                    $('#msg-content').val('');
                    $('.conversation').append(html);
                    scrollToBottom(document.querySelector('.conversation'));
                break;
            }
        }
    });
});

$(document).on('keyup', '#msg-content', function(){
    if($(this).val() != ''){
        $('.send-chat-btn').removeClass('disabled');
    }else{
        $('.send-chat-btn').addClass('disabled');
    }
})

$(document).on('click', '.key-btn', function(){
    var tag = $(this).data('tag');
    var deptId = $(this).data('department-id');
    var userId = $(this).data('user-id');

    $.ajax({
        url: 'start_conversation',
        method: 'POST',
        dataType: 'JSON',
        data: {
            tag: tag,
            dept_id: deptId,
            user_id: userId
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

