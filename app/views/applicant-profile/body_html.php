

    

<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false}'>

    <div class="wrapper">

        <?php 
            $batch = $batch;
            $count_active_convo = $convo_active_count;
            include 'leftSideMenu_html.php';
        ?>
            <div class="content-page">
                <div class="content">

                    <?php 
                        $count_active_convo = $convo_active_count;
                        include 'topbar_html.php'
                    ?>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="py-3 col-md-7 offset-md-1">
                                <h1>Welcome <?= $user['first_name'] ?>!</h1>
                            </div>

                            <div class="col-md-7 offset-md-1 announcements-container">
                                
                                <h4>Announcements</h4>

                                <div class="card">
                                    <div class="news-img-container rounded-3">
                                        <img class="mw-100 rounded-top" src="<?= BASE_URL_ASSETS . 'images/news_images/importance_of_documents.jpg' ?>" alt="The importance of providing your document photo">
                                    </div>

                                    <div class="card-body p-2">
                                        <div class="news-text-container">
                                            <h4 class="mb-3">Why Your Documents Are Essential: Exploring the Reasons Behind the Request</h4>

                                            <div id="news-3" style="display: none;">
                                                <p>Please be informed that all applicants currently enrolled in language training programs with the Zeldan Nordic Language Review Training Center, OPC are required to complete the registration available on the NLRC's official website.</p>

                                                <p><b><i>Important Points to Note:</i></b></p>
                                                <p><b>Registration Requirement:</b> Completing the registration form is mandatory for all participants, regardless of NLRC's employment status. </p>
                                                <p><b>Purpose:</b> The registration helps in maintaining accurate records and ensures compliance with training protocols which includes data to be used for your training certificates required by employers.</p>
                                                <p><b>Privacy Assurance:</b> Rest assured that all personal information provided will be kept confidential and used solely for administrative purposes.</p>
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <div class="card-footer d-flex">
                                        <div data-news-id = "3" id="more-info-btn-1" class="pointer px-0 text-info w-100 text-center news-more-info"><i class="uil uil-angle-double-down"></i> See more!</div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="news-img-container rounded-3">
                                        <img class="mw-100 rounded-top" src="<?= BASE_URL_ASSETS . 'images/news_images/documents_not_required.jpg' ?>" alt="Documents Not Required">
                                    </div>

                                    <div class="card-body p-2">
                                        <div class="news-text-container">
                                            <h4 class="mb-3">Important Notice: Batches KEN, INTW, and INTN Exempted from Document Upload Requirements!</h4>

                                            <div id="news-1" style="display: none;">
                                                <p>To all participants enrolled in batches <b> KEN, INTW, and INTN: A special announcement regarding document submission procedures!</b></p>

                                                <p>Effective immediately, individuals belonging to these batches are kindly advised to streamline their document submission process by directly sending the required documents to their respective partner agencies. This streamlined approach ensures a more efficient and expedited handling of your documentation, eliminating the need for uploading through this platform. By adhering to this directive, participants can expect a smoother and more seamless experience in fulfilling their documentation requirements. </p>

                                                <p>We appreciate your cooperation in this matter and encourage prompt action to facilitate the necessary document transfers. Should you require any assistance or clarification regarding this process, do not hesitate to reach out to our support team for guidance. Thank you for your attention to this important update, and we look forward to your continued engagement with our program.</p>
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <div class="card-footer d-flex">
                                        <div data-news-id = "1" id="more-info-btn-1" class="pointer px-0 text-info w-100 text-center news-more-info"><i class="uil uil-angle-double-down"></i> See more!</div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="news-img-container rounded-3">
                                        <img class="mw-100 rounded-top" src="<?= BASE_URL_ASSETS . 'images/news_images/update_information_upload_documents.jpg' ?>" alt="Update information and upload documents">
                                    </div>

                                    <div class="card-body p-2">
                                        <div class="news-text-container">
                                            <h4 class="mb-3">Personal Information and Documents Need to Be Filled in As Soon As Possible</h4>

                                            <div id="news-2" style="display: none;">
                                                <p>We request all users to promptly fill-in their personal information and upload the necessary documents. Timely completion ensures smooth processing of applications and compliance with regulatory requirements. Please take immediate action to fill in the required details and submit the necessary documents to facilitate the process efficiently.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer d-flex">
                                        <div data-news-id = "2" id="more-info-btn-2" class="pointer px-0 text-info w-100 text-center news-more-info"><i class="uil uil-angle-double-down"></i> See more!</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                
                                <h4>Featured </h4>
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="ratio ratio-16x9">
                                            <iframe width="1280" height="720" src="https://www.youtube.com/embed/0H8QUuJdOJo" title="Can Nordic Countries Understand Each Other (Danish, Swedish, Norwegian)" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>

                                <h4>Frequently asked questions</h4>
                                <div class="card">
                                    <div class="card-body">
                                        <p><a class="text-info" href="messages_faqs#faq-<?= $faqs[0]['id'] ?>"><u><?= $faqs[0]['question'] ?></u></a></p>
                                        <?php if($faqs[0]['sub_faq']): ?>
                                            <?php foreach($faqs[0]['sub_faq'] as $sf): ?>
                                                <p><a class="text-info" href="messages_faqs#sub_faq-<?= $sf['id'] ?>"><u><?= $sf['question'] ?></u></a></p>
                                            <?php endforeach ?>
                                        <?php endif; ?>
                                        
                                        <div class="w-100 text-center mt-4">
                                            <a href="messages_faqs" class="btn btn-info rounded-pill">View More</a>
                                        </div>
                                    </div>
                                </div>

                                <h4>What our students say?</h4>
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="d-flex w-100 justify-content-center">
                                            <div class="image-container">
                                                <?php 
                                                    if($testimony['image'] != NULL){
                                                        $image = $testimony['image'];
                                                    }else{
                                                        $image = 'testimonial-fallback-image.png';
                                                    }
                                                ?>
                                                <img class="w-100" src="<?= BASE_URL_ASSETS . 'images/testimonials-profiles/' . $image ?>" alt="Testimonial Photo" />
                                            </div>
                                        </div>
                                        
                                        <br>
                                        <b><?= nl2br($testimony['name']) ?></b>
                                        <hr>
                                        <p><i><?= nl2br($testimony['testimonial']) ?></i></p>
                                        <hr>
                                        <div class="w-100 text-center">
                                            <a href="<?= BASE_URL . 'guest/testimonials' ?> " class="btn btn-info rounded-pill" target="_blank">View More</a>
                                        </div>
                                    </div>
                                </div>

                                <h4>Explore our blogs</h4>
                                <div class="card">
                                    <div class="text-left">
                                        <div class="d-flex w-100 justify-content-center">
                                            <div class="">
                                                <?php 
                                                    if($blog['image'] != NULL){
                                                        $image = $blog['image'];
                                                    }else{
                                                        $image = 'blogs-fall-back-image.jpg';
                                                    }
                                                ?>
                                                <img class="w-100" src="<?= BASE_URL_ASSETS . 'images/blogs/' . $image ?>" alt="Testimonial Photo" />
                                            </div>
                                        </div>
                                        
                                        <div class="py-3 px-2"><a href="<?= BASE_URL ?>blogs/blog?id=<?= $blog['id'] ?>"><b><?= nl2br($blog['title']) ?></b></a></div>

                                        <div class="card-footer text-center">
                                            <a href="<?= BASE_URL . 'blogs' ?> " class="btn btn-info rounded-pill" target="_blank">View More</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <?= date('Y') ?> © ZNLRTC
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
</body>