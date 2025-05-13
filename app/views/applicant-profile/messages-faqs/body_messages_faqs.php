<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false}'>


  <div class="wrapper">
    <?php $count_active_convo = $convo_active_count; include __DIR__ . '/../leftSideMenu_html.php'; ?>

          <div class="content-page">
              <div class="content">

              <?php include __DIR__ . '/../topbar_html.php'; ?>
                  <div class="container-fluid">

                        <div class="row">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="page-title-box">
                                    <h4 class="page-title">Frequestly Asked Questions</h4>
                                </div>
                            </div>

                            <?php foreach($faq_parents as $faq): ?>                       
                                <div id="faq-<?= $faq['id'] ?>" class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 id="question-<?= $faq['id'] ?>" class="card-title card-body-question-btn pointer" data-faq-id="<?= $faq['id'] ?>"><?= $faq['question'] ?> <i><u>Click to show details</u></i></h5>
                                            <p id="answer-<?= $faq['id'] ?>" class="card-text" style="display: none"><?= nl2br($faq['answer']) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php foreach($faq['sub_faq'] as $sf): ?>
                                    <div id="sub_faq-<?= $sf['id'] ?>" class="col-md-11 offset-md-1">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 id="question-<?= $sf['id'] ?>" class="card-title card-body-question-btn pointer" data-faq-id="<?= $sf['id'] ?>"><span class="text-muted"><?= $faq['question'] ?> <i class="uil uil-angle-double-right"></i> </span> <?= $sf['question'] ?> <i><u>Click to show details</u></i></h5>
                                                <p id="answer-<?= $sf['id'] ?>" class="card-text" style="display: none"><?= nl2br($sf['answer']) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            <?php endforeach ?>
                        </div>


                  </div>
              </div>

          </div>
      </div>
</body>