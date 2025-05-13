<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false}'>


  <div class="wrapper">
    <?php $count_active_convo = $convo_active_count; include 'leftSideMenu_html.php'?>

          <div class="content-page">
              <div class="content">

              <?php include 'topbar_html.php'?>
                  <div class="container-fluid">

                      <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="page-title">Messages</h4>

                                    <div class="">
                                        <button class="btn btn-success new-message-btn"><i class="fas fa-plus"></i> New Message</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row faq-keyword-items" style="display: none"> <!-- Need dito mag style para gumana yung js -->
                                <div class="text-center d-block mb-3">
                                    <h2 class="">Select topic for your inquiry</h2>
                                    <a href="messages_faqs">You may also check our FAQs before contacting support.</a>
                                </div>

                                <?php foreach($keywords as $key): ?>
                                    <div class="col-md-3">
                                        <div class="card message-keywords key-btn" data-user-id="<?= $user['id'] ?>" data-tag="<?= $key['description'] ?>" data-department-id="<?= $key['department'] ?>">
                                            <div class="card-header text-center pointer"><h1><?= $key['icon'] ?></h1> <h5><?= $key['description'] ?></h5></div>
                                        </div>
                                    </div>
                                <?php endforeach ?>

                                <div class="col-md-3">
                                    <div class="card message-keywords key-btn" data-user-id="<?= $user['id'] ?>" data-tag="Others" data-department-id="10">
                                        <div class="card-header text-center pointer"><h1><i class="fas fa-plus"></i></h1> <h5>Others</div>
                                    </div>
                                </div>
                            </div>

                            <?php if(count($conversation_history) == 0): ?>
                                <div class="text-center">
                                    <h5 class="text-muted border-top border-bottom py-2">No conversations at the moment!</h5>
                                </div>
                            <?php endif ?>

                            <div class="list-of-conversations">
                                <?php foreach($conversation_history as $con): ?>
                                    <div class="conversation-container d-flex align-items-center justify-content-between p-2 ps-3 rounded-pill border mb-1">
                                        <?php $message = $con['chats'][count($con['chats']) - 1]; ?>
                                        <a class="col-10 <?= ($message['chat_to'] == $user['id'] && $con['status'] == 'active' ) ? 'text-dark' : 'text-muted'  ?>" href="conversation?ticket=<?= $con['ticket'] ?>"><b><?= $message['message'] ?></b></a>

                                        <div class="col-2 text-end">
                                            <small class="sm-hide"><?= ucwords($con['tag']) ?></small>
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