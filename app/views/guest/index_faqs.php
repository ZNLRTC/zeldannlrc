<section class="banner-section-faqs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mt-md-5">
                    <h1 class="text-white fw-normal mb-4 mt-3">
                        Frequently Asked Questions
                    </h1>

                    <p class="mb-4 font-18 text-white">Discover the answers you need in our comprehensive FAQ section. We believe in empowering you with knowledge and have gathered essential information. Our FAQ is regularly updated to provide the most accurate and up-to-date answers.</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="text-md-end mt-3 mt-md-0 mobile-hide">
                    <img src="<?php echo BASE_URL_ASSETS; ?>/images/banner-faq-image.webp" alt="Banner for FAQ's" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="faq-section mt-5 mb-5">
    <div class="container">
        <div class="row align-items-center">

            <div class="accordion" id="faq-accordion">
                <?php foreach($faqs as $faq): ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-<?= $faq['id'] ?>" data-accordion-id="<?= $faq['id'] ?>">
                            <button class="accordion-button ab-<?= $faq['id'] ?> collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $faq['id'] ?>" aria-expanded="true" aria-controls="collapse-<?= $faq['id'] ?>"><?= $faq['question'] ?></button>
                        </h2>
                        <div id="collapses-<?=$faq['id'] ?>" class="accordion-collapse collapse" aria-labelledby="heading-<?= $faq['id'] ?>" data-bs-parent="#faq-accordion">
                            <div class="accordion-body"><?= nl2br($faq['answer']) ?></div>
                        </div>
                    </div>
                <?php endforeach ?>
                
                <h4 class="d-block text-center">Feel free to <a href="#contact-us" class="text-primary">contact us</a> if you have questions that are not listed above.</h4>
            </div>

        </div>
    </div>
</section>