<link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>css/blogs/desktop_blogs.css">
<link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>css/blogs/tablet_blogs.css">
<link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>css/blogs/mobile_blogs.css">

<!-- <section class="banner-section-blogs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mt-md-5">
                    <h1 class="text-white fw-normal mb-4 mt-3">
                        Blogs
                    </h1>

                    <p class="mb-4 font-18 text-white">Welcome to our blogs</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="text-md-end mt-3 mt-md-0">
                    <img src="<?php echo BASE_URL_ASSETS; ?>/images/banner-faq-image.png" alt="Banner for FAQ's" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="blog-section mt-3">
    <div class="container">
        <div class="row align-items-center">

            <?php if(empty($blogs)): ?>
                <div class="text-center d-block">
                    <h2 class="opacity-25">Contents coming soon...</h2>
                </div>
            <?php else: ?>
                <?php foreach($blogs as $blog): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
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
                            
                            <a class="px-2 pb-2  text-primary" href="blogs/blog?id=<?= $blog['id'] ?>">See More >></a>
                        </div>
                        
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</section>