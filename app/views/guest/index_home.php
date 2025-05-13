<section class="banner-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 banner-info-left">
                <div class="">
                    <h1 class="text-white fw-normal mb-4">
                        Learn Finnish, Unlock Opportunities: Your Journey to Fluency Starts Here
                    </h1>

                    <!-- <p class="mb-4 font-18 text-white">
                        Learn Finnish, Unlock Opportunities: Your Journey to Fluency Starts Here
                    </p> -->
                    <!-- <a href="<?php echo BASE_URL; ?>guest/register" target="_blank" class="btn btn-success text-uppercase btn-teal-rounded font-18 mb-3">Register Now <i class="mdi mdi-arrow-right ms-1"></i></a> -->
                </div>
            </div>

            <div class="col-md-7">
                <div class="text-md-end mt-3 mt-md-0 mobile-hide">
                    <img src="<?php echo BASE_URL_ASSETS; ?>/images/banner-image.webp" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-section">
    <div class="container-fluid mb-5">
        <div class="container">
            <div class="row">
                <div class="text-center">
                    <h2 class="primary pb-4 pt-5">Who we are</h2>
                </div>

                <div class="col-md-6">
                    <img class="w-100" src="<?= BASE_URL_ASSETS . 'images/smiling-businessman-raising-hand-conference.webp' ?>" alt="znlrtc-who-we-are-section-photo" loading="lazy">
                </div>

                <div class="col-md-6 text-center d-flex justify-content-center flex-column">
                    <h2 class="mb-4 text-center text-secondary text-container">Discover how our Finnish language program equips you with practical skills for everyday life and opens doors to new opportunities in Finland.</h2>

                    <div>
                        <a href="<?= BASE_URL . 'guest/about' ?>"><span class="view-more-btn-primary">+ Find more about us</span></a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonials-section">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="secondary pb-3 pt-5">What our students say</h2>
                </div>

                <div class="col-md-12 text-center">
                    
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                        <?php 
                            $arr_img = array(
                                "christian-talamor",
                                "joseph-andre-ramirez",
                                "andreo-sartorio",
                                "jan-patrick-perez",
                                "jeaneette-langreo"
                            ); 

                            $arr_name = array(
                                'Christian Talamor',
                                'Joseph Andre Ramirez',
                                'Andreo Sartorio',
                                'Jan Patrick Perez',
                                'Jeaneette Langreo'
                            );

                            $arr_testimonials = array(
                                "<p>I was in the midst of a Midlife crisis before my application in the ZNLRC happened. I deactivated all my social media accounts to avoid stressing myself. after  a year I tried to open my facebook, May 22, 2022. When I saw the Topmake International post, <q>Hiring Caregiver in Finland</q> I am hesitant at first but I still tried. June 10, 2022. I received a message from the ZNLRC, <q>Good day! This is the ZNLRC. We will be handling your language training for topmake.</q> That's when everything started. ZNLRC opened a new chapter of my life. During my study, I felt mixed emotions, Nervousness, Excitement and Joy because your dream is slowly coming true. <q>In order to be able to make it, you have to put aside the fear of failing and the desire of succeeding.</q> The ZNLRC and the staff helped me a lot during my application. To those Filipinos who are planning to apply, If i made it, you can make it too. Now I’m Living in the happiest country in the world for almost 6 months. If it's for you, the Lord will give it to you. It's all worth it in the end.</p>",
                                
                                "<p>I'm Joseph Andre Ramirez, originally from Nueva Ecija, Philippines. My journey in Finland began in May 2023 while I was still employed as a tech support in Malaysia. Drawing from my experience as a caregiver and having the necessary qualifications, I opted to apply as a nursing assistant. Following the recruitment interview, I received access to Moodle for language training. Initially, learning Finnish proved challenging, particularly while balancing full-time work. However, with the guidance of our instructors and ZNLRC staff, I successfully passed weekly quizzes and assessments. Dedication to daily study played a significant role, and I feel fortunate to have had helpful tools and learning materials provided by the ZNLRC. Now in Finland, embarking on a new chapter, I'm confident that the language skills acquired will not only facilitate communication but also enable me to share knowledge with others.</p>",
                                
                                "<p>Working with you fills me with immense pride and honor. I feel extremely fortunate to be in Finland right now thanks to ZNLRC, a fantastic organization run by wonderful people. I was able to have an amazing and easy experience with you throughout our entire application process for jobs in Finland.</p><p>I had this dream as a child, and with your assistance, it came true. Words cannot express how much I appreciate you, but ZNLRC, thank you very much. God bless you and your organization... Mabuhay!!!..</p><p><q>No journey is too great when one finds what he seeks..</q></p>",
                                
                                "<p>Amidst the hustle of my demanding job in the UAE and the financial challenges I faced, ZNLRC training language  emerged as a beacon of support and guidance on my journey to becoming a nurse in Finland. Their unwavering assistance provided me with the resources and flexibility I needed to pursue my dream. Through their personalized approach and dedicated faculty, I was able to navigate through obstacles and stay on track despite the odds. ZNLRC training language  not only equipped me with the necessary knowledge and skills but also instilled in me the resilience and determination to overcome any hurdle. Today, as I fulfill my dream of working as a nurse in Finland, I am forever grateful for the invaluable support and encouragement provided by ZNLRC training language, proving that with their assistance, no challenge is insurmountable.</p>",
                                
                                "<p>ZNLRC’s program seamlessly integrates language vital to our role as practical nurses here in Finland equipping us with the skills necessary to communicate confidently and effectively from A1 to A2 language level , Offering flexible schedule  and chances to fit on our time. Studying while working is not easy, but no matter what you do consistency is the key! Diligently following ZNLRC’s language training plan while weaving in some extra language learning tips will guarantee your success. You can do it if you are determined! Especially that finnish language is very important to communicate with Finns, it is hard to work here if you don't know their language. ZNLRC books are the best tools to read to understand the basic language, you will need it still no matter how many years you are here in Finland. Thank you so much ZNLRC staff and teachers for your patience on me and for giving me chance to be included on 2023 Finland journey!</p>"
                            );
                        ?>

                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="3000">
                                <div class="row align-items-center">
                                    <div class="col-md-3 offset-md-1">
                                        <img src="<?= BASE_URL_ASSETS . 'images/testimonials-profiles/'.$arr_img[0].'.webp' ?>" alt="<?= $arr_img[0] . ' Photo' ?>" loading="lazy">
                                        <p class="text-center d-block mt-3 text-white"><b><?= $arr_name[0] ?></b></p>
                                    </div>

                                    <div class="col-md-6 offset-md-1 text-column">
                                        <div class="text-column-div"><i class="fas fa-quote-left text-warning"></i><?= $arr_testimonials[0] ?></div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php for($i = 1; $i < count($arr_img); $i++): ?>
                                <div class="carousel-item" data-bs-interval="3000">
                                    <div class="row align-items-center">
                                        <div class="col-md-3 offset-md-1">
                                            <img src="<?= BASE_URL_ASSETS . 'images/testimonials-profiles/'.$arr_img[$i].'.webp' ?>" alt="<?= $arr_img[$i] . ' Photo' ?>" loading="lazy">
                                            <p  class="text-center d-block mt-3 text-white"><b><?= $arr_name[$i] ?></b></p>
                                        </div>
                                        <div class="col-md-6 offset-md-1 text-column">
                                            <div class="text-column-div"><i class="fas fa-quote-left text-warning"></i><?= $arr_testimonials[$i] ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor ?>

                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    <a href="<?= BASE_URL . 'guest/testimonials' ?>"><span class="view-more-btn-white">+ View More Stories</span></a>

                </div>
            </div>
        </div>
    </div>
</section>  

<section class="faq-section">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-4">
                    <h2 class="primary pb-4 pt-5">Frequently asked questions</h2>

                    <div class="accordion" id="faq-accordion">
                        <?php 
                            $acc_arr_title = array(
                                "I cannot register, the error says, 'Email Already Exists'",
                                "I cannot login to my account, it says, 'Account Validation'",
                                "When can I officially start with the language training?",
                                "Who will I contact if I am unable to log in or access the beginner course in Moodle?",
                                "How do we know our group/batch number?"

                            );

                            $acc_arr_content = array(
                                "When you attempt to register and encounter an error message stating, <span class='text-danger'>'Email Already Exists'</span>, it simply indicates that you are already registered and do not need to re-register. Instead, you can <a class='text-primary' href='https://www.nlrc.ph/login'><u>log in</u></a> to update your profile and upload your documents.",
                                "When you attemp to login and you are redirected to a page that says, <span class='text-danger'>'Account Validation'</span>, it simply means that your account is still under validation process. An email confirmation will be sent to you once your account has been approved.",
                                "You can start with the language training after finishing the beginner course and after complying with the requirements being asked by your Recruitment Agency.",
                                "You can send an email to <a href='mailto:support@nlrc.ph' class='text-primary'>support@nlrc.ph</a> and our dedicated team will help you log in to Moodle or access the beginner course so you can start with your self-studies.",
                                "You can usually find this from the Google group mailing list/inbox you are part of. Otherwise, log in to your learning platform and from the course you have, it usually shows your group number there as well. If you are still unsure and can’t figure it out, just email <a href='mailto:support@nlrc.ph' class='text-primary'>support@nlrc.ph</a> and they’ll let you know."
                            );
                        ?>
                        
                        
                        <?php for($i = 0; $i < count($acc_arr_title); $i++): ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-<?= $i ?>">
                                    <button class="accordion-button <?= $i != 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $i ?>" aria-expanded="true" aria-controls="collapse-<?= $i ?>"><?= $acc_arr_title[$i] ?></button>
                                </h2>
                                <div id="collapse-<?=$i ?>" class="accordion-collapse collapse <?= $i == 0 ? 'show' : '' ?>" aria-labelledby="heading-<?= $i ?>" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body"><?= $acc_arr_content[$i] ?></div>
                                </div>
                            </div>
                        <?php endfor ?>

                    </div>

                    <a href="<?= BASE_URL . 'guest/faqs'?>"><span class="view-more-btn-primary">+ View More FAQs</span></a>

                </div>
            </div>
        </div>
    </div>
</section>
        