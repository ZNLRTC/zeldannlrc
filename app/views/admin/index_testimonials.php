<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

    <!-- Begin page -->

    <div class="wrapper">
        <?php include 'admin_leftsidebar.php'?>
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <?php include 'admin_topbar.php'?>

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <button class="btn btn-success add-new-testimonial">Add New</button>
                                </div>

                                <h4 class="page-title">Testimonials</h4>
                            </div>
                        </div>

                        <div id="testimonials-container">
                            <?php foreach($testimonials as $t):  ?>
                                <div id="testimonial-<?= $t['id'] ?>" class="card" >
                                    <div class="card-body">
                                        <div class="row align-items-center mb-3">
                                            <div class="col-md-1 image-container">
                                                <?php $image = $t['image'] == null ? BASE_URL_ASSETS . 'images/testimonials-profiles/testimonial-fallback-image.png' : BASE_URL_ASSETS . 'images/testimonials-profiles/' . $t['image'] ?>
                                                <img class="w-100" src="<?= $image ?>" alt="<?= $t['image'] ?>">
                                            </div>
                                            <div class="col-md-11">
                                                <h5 class="card-title mb-0"><?= ucwords($t['name']) ?></h5>
                                            </div>
                                        </div>
                                        <p class="card-text"><?= $t['testimonial'] ?></p>
                                    </div>

                                    <div class="card-footer" data-testimonial-id="<?= $t['id'] ?>">
                                        <button class="btn btn-sm btn-primary edit-testimonial-btn" ><i class="fas fa-pen"></i> Edit</button>
                                        <button class="btn btn-sm btn-danger delete-testimonial-btn"><i class="fas fa-trash-alt"></i> Delete</button>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
    