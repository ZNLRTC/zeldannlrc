<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

    <!-- Begin page -->

    <div class="wrapper">

        <!-- ========== Left Sidebar Start ========== -->

        <?php include __DIR__ . '/../admin_leftsidebar.php'; ?>



        <!-- ============================================================== -->

        <!-- Start Page Content here -->

        <!-- ============================================================== -->



        <div class="content-page">
            <div class="content">
            <?php include __DIR__ . '/../admin_topbar.php'; ?>

                <!-- Start Content-->

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <div>
                                    <h4 class="page-title">Conversations</h4>
                                </div>
                                <div>
                                    <input id="user-messages-table-search" class="form-control" type="search" placeholder="Search">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <table id="user-messages-table" class="table table-striped">
                                <thead>
                                   <th>Messages</th> 
                                   <th>Date</th> 
                                </thead>

                                <tbody>
                                    <?php foreach($message_tickets as $msg):  ?>
                                        <?php if(count($msg['chats']) != 0): ?>
                                            <?php $chat_to = $msg['chats'][count($msg['chats']) - 1]['chat_to'];  ?>
                                            <tr class="<?= (in_array($chat_to, $employee_ids) && $msg['status'] == 'active')  ? 'fw-bold' : 'fw-light' ?>">
                                                <td>
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <?php if(!empty($msg['transfers'])): ?><i title="Transferred" class="fas fa-long-arrow-alt-right text-danger"></i><?php endif ?> <?= $msg['ticket'] ?>
                                                        </div>

                                                        <div class="col-6">
                                                            <div>
                                                                <?= !in_array($chat_to, $employee_ids) ? '<small class="bg-lblue rounded-pill px-1">Replied</small> <small class="bg-lblue rounded-pill px-1 me-1"> ' .ucwords($msg['chats'][count($msg['chats']) - 1]['from_fname']). '</small> ': '<small class="bg-lblue rounded-pill px-1 view-user-btn pointer" user-id="'.$msg['trainee_info']['id'].'">'.ucwords($msg['chats'][count($msg['chats']) - 1]['from_fname']).'</small>' ?>
                                                                <a class="text-dark" href="conversation?ticket=<?= $msg['ticket'] ?>"><?= $msg['chats'][count($msg['chats']) - 1]['message'] == '' ? '<small class="text-muted"><i>Blank Message...</i></small>' : $msg['chats'][count($msg['chats']) - 1]['message'] ?></a>
                                                            </div>
                                                        </div>

                                                        <div class="col-2 text-end">
                                                            <small class="alert-info px-2 rounded-pill py-1"><?= $msg['tag'] ?></small>
                                                        </div>

                                                        <div class="col-1">
                                                            <small class="alert-<?= $msg['status'] == 'active' ? 'success' : 'danger' ?> px-2 rounded-pill py-1"><?= ucwords($msg['status']) ?></small>
                                                        </div>

                                                        <div class="col-1 text-start">
                                                            <?php if($msg['status'] == 'active'): ?>
                                                                <small class="text-primary pointer transfer-message-btn" data-current-department="<?= $msg['department'] ?>" data-ticket="<?= $msg['ticket'] ?>" data-transferred-by="<?= $user['id'] ?>">Transfer <i class="fas fa-long-arrow-alt-right"></i></small>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?= $msg['chats'][count($msg['chats']) - 1]['date_created'] ?></td>
                                            </tr>
                                        <?php else: ?>
                                            <tr>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-2">Empty ticket</div>
                                                        <span class="col-2"><?= $msg['ticket'] ?></span>
                                                        <div class="col-5">No Chats</a></div>
                                                        <div class="col-2">
                                                            <small class="alert-info px-2 rounded-pill py-1"><?= $msg['tag'] ?></small>
                                                        </div>
                                                        <div class="col-1">
                                                            <small class="alert-<?= $msg['status'] == 'active' ? 'success' : 'danger' ?> px-2 rounded-pill py-1"><?= ucwords($msg['status']) ?></small>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif ?>
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