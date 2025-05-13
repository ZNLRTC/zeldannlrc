<link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>css/blogs/desktop_blogs.css">
<link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>css/blogs/tablet_blogs.css">
<link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>css/blogs/mobile_blogs.css">

<section class="blog-section mt-3">
    <div class="container">
        <div class="row align-items-start">
            <div class="mb-3">
                <a class="text-primary d-flex" href="<?= BASE_URL . 'blogs' ?>"><h3><i class="fas fa-long-arrow-alt-left"></i> <u>Go back to blogs</u></h3></a>
            </div>
            
            <div class="col-md-8">
                <div class="thumb-container">
                    <?php if($blog['image'] != NULL): ?>
                        <img class="w-100" src="<?= BASE_URL_ASSETS . 'images/blogs/' . $blog['image'] ?>" alt="<?= $blog['image'] ?>">
                    <?php else: ?>
                        <img class="w-100" src="<?= BASE_URL_ASSETS . 'images/blogs/blogs-fall-back-image.jpg' ?>" alt="Blog fall-back image">
                    <?php endif ?>
                </div>

                <div class="title-container py-3">
                    <h2><?= $blog['title'] ?></h2>
                </div>
                
                <div class="blog-content-container">
                    <?= $blog['content'] ?>
                </div>
            </div>

            <div class="col-md-4">
                <h4>Other topics you might find interesting:</h4>
                <ul class="ps-2">
                    <?php foreach($blogs as $bl): ?>
                        <?php if($bl['id'] != $blog['id']): ?>
                            <li class="blog-link"><a href="blog?id=<?= $bl['id'] ?>"><?= $bl['title'] ?></a></li>
                        <?php endif ?>
                    <?php endforeach ?>
                </ul>
            </div>

        </div>
    </div>
</section>