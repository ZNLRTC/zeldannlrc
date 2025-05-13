<section class="banner-section-testimonials">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5">
                <div class="mt-md-4">
                    <h1 class="text-white fw-normal mb-4 mt-3">
                        Real Stories, Real Impact: What our students say
                    </h1>
                    <p class="mb-4 font-18 text-white">Discover the Impact of Our Free Training Programs: Testimonials from Our Students</p>
                </div>
            </div>

            <div class="col-md-7">
                <div class="text-md-end mt-3 mt-md-0 mobile-hide">
                    <img src="<?php echo BASE_URL_ASSETS; ?>/images/testimonial-banner.webp" alt="Testimonial Banner" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonials-cards">
    <div class="container">
        <div class="row mt-5">
            
            <div class="col-lg-4">

                <?php 
                foreach($testimonials as $index => $i): 
                if($index % 3 == 0):
                ?>
                <div class="row card">
                    <div class="col-md-12 row align-items-center justify-content-center">
                        <div class="col-md-3 mb-3 image-container">
                            <img class = "w-100" src = <?= $i['image'] == null ? BASE_URL_ASSETS . 'images/testimonials-profiles/testimonial-fallback-image.png' : BASE_URL_ASSETS . 'images/testimonials-profiles/' . $i['image'] ?>>
                        </div>
                        <div class="col-md-9 mb-3">
                            <h5 class="card-title mb-0"><?= $i['name']?></h5>
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                        <div class="testimonials">
                            <p class="card-text"><?= $i['testimonial']?></p>
                        </div>
                    </div>
                </div>
                <?php 
                    endif;
                endforeach 
                ?>
            </div>

            <div class="col-lg-4">

                <?php 
                foreach($testimonials as $index => $i): 
                if($index % 3 == 1):
                ?>
                <div class="row card">
                    <div class="col-md-12 row align-items-center justify-content-center">
                        <div class="col-md-3 mb-3 image-container">
                            <img class = "w-100" src = <?= $i['image'] == null ? BASE_URL_ASSETS . 'images/testimonials-profiles/testimonial-fallback-image.png' : BASE_URL_ASSETS . 'images/testimonials-profiles/' . $i['image'] ?>>
                        </div>
                        <div class="col-md-9 mb-3">
                            <h5 class="card-title mb-0"><?= $i['name']?></h5>
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                        <div class="testimonials">
                            <p class="card-text"><?= $i['testimonial']?></p>
                        </div>
                    </div>
                </div>
                <?php 
                    endif;
                endforeach 
                ?>
            </div>

            <div class="col-lg-4">

                <?php 
                foreach($testimonials as $index => $i): 
                if($index % 3 == 2):
                ?>
                <div class="row card">
                    <div class="col-md-12 row align-items-center justify-content-center">
                        <div class="col-md-3 mb-3 image-container">
                            <img class = "w-100" src = <?= $i['image'] == null ? BASE_URL_ASSETS . 'images/testimonials-profiles/testimonial-fallback-image.png' : BASE_URL_ASSETS . 'images/testimonials-profiles/' . $i['image'] ?>>
                        </div>
                        <div class="col-md-9 mb-3">
                            <h5 class="card-title mb-0"><?= $i['name']?></h5>
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                        <div class="testimonials">
                            <p class="card-text"><?= $i['testimonial']?></p>
                        </div>
                    </div>
                </div>
                <?php 
                    endif;
                endforeach 
                ?>
            </div>

        </div>
    </div>
</section>