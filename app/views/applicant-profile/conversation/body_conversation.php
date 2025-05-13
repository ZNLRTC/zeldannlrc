<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false}'>


  <div class="wrapper">
    <?php $count_active_convo = $convo_active_count; include __DIR__ . '/../leftSideMenu_html.php'; ?>

          <div class="content-page">
              <div class="content">

              <?php include __DIR__ . '/../topbar_html.php'; ?>
                  <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <div class="page-title-box d-flex align-items-center">
                                    <small class="alert-<?= $chats['status'] == 'active' ? 'success' : 'danger' ?> rounded-pill p-1 px-2 me-2"><b><?= ucwords($chats['status']) ?></b></small>
                                    <h4 class="page-title">Ticket No: <?= $chats['ticket'] ?> </h4>
                                    
                                </div>

                                <div class="messaging-container p-3">
                                    
                                    <div class="conversation">
                                        <?php foreach($chats['chats'] as $chat): ?>
                                            <div class="message <?= $chat['chat_from'] == $user['id'] ? 'sent' : 'received' ?>">
                                                <div class="message-text"> <?= nl2br($chat['message']) ?> </div>
                                                <span class="time"><?= date('M d, Y (D) h:i A', strtotime($chat['date_created'])) ?></span>
                                            </div>
                                        <?php endforeach ?>
                                        
                                    </div>
                                    
                                    <?php if($chats['status'] == 'active'): ?>
                                        <div class="pt-3">
                                            <textarea class="form-control me-1" rows="4" id="msg-content" name="msg-content" placeholder="Write message here"></textarea>
                                        </div>

                                        <div class="py-3 d-flex justify-content-end">
                                            <button class="btn btn-success send-chat-btn disabled" data-convo-id="<?= $chats['id'] ?>" data-chat-from="<?= $user['id'] ?>" data-chat-to="1">Send</button>
                                        </div>
                                    <?php else: ?>
                                        <div class="d-block text-center">
                                            <h5 class="text-muted"><i class="fas fa-lock"></i> This conversation is already closed. You can no longer reply.</h5>
                                        </div>
                                    <?php endif ?>
                                    
                                </div>

                            </div>
                        </div>
                  </div>
              </div>

          </div>
      </div>
</body>