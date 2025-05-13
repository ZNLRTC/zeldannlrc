<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="wrapper">
        <?php include __DIR__ . '/../admin_leftsidebar.php'; ?>
        <div class="content-page">
            <div class="content">
            <?php include __DIR__ . '/../admin_topbar.php'; ?>

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <button class="btn btn-success add-new-blog">Add New</button>
                            </div>

                            <h4 class="page-title">Blogs</h4>
                        </div>
                    </div>

                    <?php foreach($blogs as $blog): ?>
                        <div class="col-md-3">
                            <div id="blog-<?= $blog['id'] ?>" class="card">
                                <div class="view-blog pointer" data-url="<?= BASE_URL .'blogs/blog?id=' . $blog['id'] ?>">
                                    <div class="blog-thumb-container">
                                        <?php if($blog['image'] != NULL): ?>
                                            <img class="w-100" src="<?= BASE_URL_ASSETS . 'images/blogs/' . $blog['image'] ?>" alt="<?= $blog['image'] ?>">
                                        <?php else: ?>
                                            <img class="w-100" src="<?= BASE_URL_ASSETS . 'images/blogs/blogs-fall-back-image.jpg' ?>" alt="Blogs fall-back image">
                                        <?php endif ?>
                                    </div>

                                    <div class="title-container px-2">
                                        <h4 class="text-truncate"><?= $blog['title'] ?></h4>
                                    </div>
                                </div>
                                
                                    
                                <div class="card-footer d-flex px-2 pb-2 justify-content-end" data-blog-id=<?= $blog['id'] ?>>
                                    <button class="btn btn-sm btn-primary pointer me-1 edit-blog">Edit</button>
                                    <button class="btn btn-sm btn-danger pointer delete-blog-btn">Delete</button>
                                </div>
                                
                            </div>
                            
                        </div>
                    <?php endforeach ?>

                </div>
            </div>
        </div>
    </div>
</body>
