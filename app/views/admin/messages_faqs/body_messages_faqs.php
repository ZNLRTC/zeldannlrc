<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="wrapper">

        <?php include __DIR__ . '/../admin_leftsidebar.php'; ?>

        <div class="content-page">
            <div class="content">

                <?php include __DIR__ . '/../admin_topbar.php'; ?>

                <div class="container-fluid">
                    <div class="row">

                        <div class="d-flex align-items-center justify-content-between">
                            <div class="page-title-box">
                                <h4 class="page-title">Frequestly Asked Questions</h4>
                            </div>

                            <div class="d-flex">
                                <!-- <div class="me-1">
                                    <select class="form-select">
                                        <option value=0 selected disabled>Select Department</option> 
                                        <?php foreach($departments as $dept): ?>
                                            <option value="<?= $dept['id'] ?>"><?= ucwords($dept['description']) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div> -->
                                
                                <div>
                                    <button class="btn btn-success add-messages-faqs-btn"><i class="fas fa-plus"></i> Add New</button>
                                </div>
                                
                            </div>
                        </div>
                        <?php foreach($faq_parents as $faq): ?>                       
                            <div id="faq-<?= $faq['id'] ?>" class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $faq['question'] ?></h5>
                                        <h6 class="card-subtitle mb-2 text-muted"><?= $faq['description'] ?></h6>
                                        <p class="card-text"><?= nl2br($faq['answer']) ?></p>
                                    </div>

                                    <div class="card-footer">
                                        <button class="btn btn-sm btn-primary edit-faq-btn" data-faq-id=<?= $faq['id'] ?> data-faq-question=<?= $faq['question'] ?>><i class="fas fa-pen"></i> Edit</button>
                                        <button class="btn btn-sm btn-danger delete-faq-btn" data-faq-id=<?= $faq['id'] ?> data-faq-question="<?= $faq['question'] ?>"><i class="fas fa-trash-alt"></i> Delete</button>
                                    </div>
                                </div>
                            </div>
                            <?php foreach($faq['sub_faq'] as $sf): ?>
                                <div id="sub_faq-<?= $sf['id'] ?>" class="col-md-11 offset-md-1">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title"><span class="text-muted"><?= $faq['question'] ?> <i class="uil uil-angle-double-right"></i> </span> <?= $sf['question'] ?></h5>
                                            <h6 class="card-subtitle mb-2 text-muted"><?= $sf['description'] ?></h6>
                                            <p class="card-text"><?= nl2br($sf['answer']) ?></p>
                                        </div>

                                        <div class="card-footer">
                                            <button class="btn btn-sm btn-primary edit-faq-btn" data-faq-id=<?= $sf['faq_id'] ?>><i class="fas fa-pen"></i> Edit</button>
                                            <button class="btn btn-sm btn-danger delete-faq-btn" data-faq-id=<?= $sf['faq_id'] ?> data-faq-question="<?= $sf['question'] ?>"><i class="fas fa-trash-alt"></i> Delete</button>
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


