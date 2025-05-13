<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

    <!-- Begin page -->

    <div class="wrapper">

        <?php include __DIR__ . '/../admin_leftsidebar.php'; ?>

        <div class="content-page">
            <div class="content">
            <?php include __DIR__ . '/../admin_topbar.php'; ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right"></div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <h4 class="page-title me-3"><?= ucwords($chats['trainee']['first_name'] .' '. $chats['trainee']['last_name']) ?></h4>
                                        <span class="view-user-btn pointer text-primary me-3" user-id="<?= $chats['trainee']['id'] ?>"><i class="fas fa-user"></i> View profile</span>
                                    </div>
                                    <div >
                                        <span class="me-3">Ticket No.: <b><?= $chats['ticket'] ?></b></span>
                                        <?php if($chats['status'] == 'active'): ?>
                                            <button class="btn btn-danger close-ticket-btn" data-ticket-id="<?= $chats['id'] ?>"><i class="fas fa-lock"></i> Close this ticket</button>
                                        <?php else: ?>
                                            <button class="btn btn-success open-ticket-btn" data-ticket-id="<?= $chats['id'] ?>"><i class="fas fa-unlock"></i> Open this ticket</button>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">

                            <div class="messaging-container p-3">
                                    
                                <div class="conversation">
                                    <?php foreach($chats['chats'] as $chat): ?>
                                        <div class="message <?= in_array($chat['chat_to'], $employee_ids) ? 'received' : 'sent' ?>">
                                            <div class="message-text"> <?= nl2br($chat['message']) ?> </div>
                                            <span class="time"><?= date('M d, Y (D) h:i A', strtotime($chat['date_created'])) ?></span>
                                        </div>
                                    <?php endforeach ?>
                                    
                                </div>
                                
                                <?php if($chats['status'] == 'active'): ?>
                                    <div class="pt-3">
                                        <textarea class="form-control me-1" rows="4" id="msg-content" name="msg-content" placeholder="Write message here"></textarea>
                                    </div>

                                    <div class="py-3 d-flex justify-content-end align-items-center">
                                        <button class="btn btn-success send-chat-btn disabled" data-convo-id="<?= $chats['id'] ?>" data-chat-from="<?= $user['id'] ?>" data-chat-to="<?= $chats['trainee']['id'] ?>">Send</button>
                                    </div>
                                <?php else: ?>
                                    <div class="d-block text-center">
                                        <h5 class="text-muted"><i class="fas fa-lock"></i> This conversation is already closed. You can no longer reply.</h5>
                                    </div>
                                <?php endif ?>
                                
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <h4 class="mb-3 text-center">Ticket history <i>(Latest on Top)</i></h4>
                            <table class="table ">
                                <thead>
                                    <th>Update By</th>
                                    <th>Action</th>
                                    <th>Date</th>
                                </thead>

                                <tbody>
                                    <?php if($ticket_history): ?>
                                        <?php foreach($ticket_history as $th): ?>
                                            <tr>
                                                <td><?= ucwords($th['first_name'] .' '. $th['last_name']) ?></td>
                                                <td><small class="<?= $th['status'] == 'active' ? 'alert-success' : 'alert-danger' ?> px-2 py-1 rounded-pill"><?= $th['status'] == 'active' ? 'Opened' : ucwords($th['status']) ?></small></td>
                                                <td><small><?= date('M d, Y h:i A', strtotime($th['date_created'])) ?></small</td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                    
                                </tbody>
                            </table>
                            
                        </div>

                        <div class="col-md-8 bg-white rounded p-3 pt-0">
                            <h4 class="mb-3 text-center">Transfer History <i>(Latest on Top)</i></h4>
                            <table class="table table-striped ">
                                <thead>
                                    <th class="col-2">Transferred By</th>
                                    <th class="col-2">From</th>
                                    <th class="col-2">To</th>
                                    <th class="col-4">Reason</th>
                                    <th class="col-2">Date & Time</th>
                                </thead>

                                <tbody>
                                    <?php foreach($chats['transfer_history'] as $ch): ?>
                                        <tr>
                                            <td><?= ucwords($ch['first_name']." ".$ch['last_name']) ?></td>
                                            <td><?= ucwords($ch['from_desc']) ?></td>
                                            <td><?= ucwords($ch['to_desc']) ?></td>
                                            <td><?= ucwords($ch['transfer_reason']) ?></td>
                                            <td><small><?= date('M d, Y h:i A', strtotime($ch['date_created'])) ?></small></td>
                                        </tr>
                                    <?php endforeach ?>
                                    
                                </tbody>
                            </table>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<div class="modal fade" id="modal-send-message" tabindex="-1" aria-labelledby="send-message-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="send-message-label">Send Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="send-message-form" action="<?= BASE_URL ?>">
                    <div class="form-group mb-3">
                        <label class="form-label" for="msg-to">To:</label>
                        <input type="email" class="form-control me-1" id="msg-to" name="msg-to" required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="msg-content">Message:</label>
                        <textarea class="form-control me-1" id="msg-content" name="msg-content" placeholder="Write message here"></textarea>
                    </div>
                    
                    <div class="w-100 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>