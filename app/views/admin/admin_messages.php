<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

    <!-- Begin page -->

    <div class="wrapper">

        <!-- ========== Left Sidebar Start ========== -->

        <?php include 'admin_leftsidebar.php'?>



        <!-- ============================================================== -->

        <!-- Start Page Content here -->

        <!-- ============================================================== -->



        <div class="content-page">
            <div class="content">
            <?php include 'admin_topbar.php'?>

                <!-- Start Content-->

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="page-title"><?= ucwords($trainee_info['first_name'] .' '. $trainee_info['last_name']) ?> Messages</h4>
                            </div>
                            <div class="">
                                <button class="btn btn-success new-message-btn"><i class="fas fa-plus"></i> New Message</button>
                            </div>
                        </div>

                        <div class="row faq-keyword-items" style="display: none"> <!-- Need dito mag style para gumana yung js -->
                            <div class="text-center d-block mb-3">
                                <h2 class="">Select topic message</h2>
                            </div>

                            <?php foreach($keywords as $key): ?>
                                <div class="col-md-3">
                                    <div class="card message-keywords admin-key-btn" data-admin-id="<?= $user['id'] ?>" data-user-id="<?= $trainee_info['id'] ?>" data-tag="<?= $key['description'] ?>" data-department-id="<?= $key['department'] ?>">
                                        <div class="card-header text-center pointer"><h1><?= $key['icon'] ?></h1> <h5><?= $key['description'] ?></h5></div>
                                    </div>
                                </div>
                            <?php endforeach ?>

                            <div class="col-md-3">
                                <div class="card message-keywords">
                                    <div class="card-header text-center pointer"><h1><i class="fas fa-plus"></i></h1> <h5>Others</div>
                                </div>
                            </div>
                        </div>

                        <div class="list-of-conversations">
                            <?php foreach($conversation_history as $con): ?>
                                <div class="conversation-container d-flex align-items-center justify-content-between p-2 ps-3 rounded-pill border mb-1">
                                    <?php $message = $con['chats'][count($con['chats']) - 1]; ?>
                                    <a class="<?= ($message['chat_to'] == $user['id'] && $con['status'] == 'active' ) ? 'text-dark' : 'text-muted'  ?>" href="conversation?ticket=<?= $con['ticket'] ?>"><b><?= $message['message'] ?></b></a>

                                    <div >
                                        <small><?= ucwords($con['tag']) ?></small>
                                        <small class="alert-<?= $con['status'] == 'active' ? 'success' : 'danger' ?> py-1 px-2 rounded-pill"><?= ucwords($con['status']) ?></small>
                                        
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
