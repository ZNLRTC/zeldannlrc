<section class="footer-section" id="contact-us">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="secondary pb-4 pt-5">Contact Us</h2>
                </div>
            <div>

            <div class="row equal-height">
                <div class="col-md-6 col-sm-12 contact-inputs">
                    <form class="form-contact-us" action="<?= BASE_URL ?>" method="POST">
                        <div class="form-item">
                            <label>Name:</label>
                            <input type="text" name="name" placeholder="Type your name here" autocomplete="off" required>
                        </div>

                        <div class="form-item">
                            <label>Email: </label>
                            <input type="email" name="email" placeholder="Type your email here" autocomplete="off" required>
                        </div>

                        <div class="form-item">
                            <label>Subject:</label>
                            <input type="text" name="subject" placeholder="Type concern here" autocomplete="off" required>
                        </div>

                        <div class="form-item">
                            <label>Message:</label>
                            <textarea rows="4" name="message" placeholder="How can we help you with your concern?" autocomplete="off"></textarea>
                        </div>

                        <div class="check-item mb-3 row">
                            <div class="col-md-10">
                                <input id="form-check-verify" type="checkbox" class="me-1" required>
                                <label for="form-check-verify" class="pointer">By submitting this form, you acknowledge and agree to our privacy practices.</label>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="form-contact-us-submit btn" name="send">SEND</button>
                            </div>
                        </div>

                        <div class="response-div"></div>
                            
                    </form>
                </div>

                <div class="col-md-6 company-contact-info">
                    <div class="contact-info-item">
                        <span class="d-block">Phone:</span>
                        <span><a href="tel:+639178044475"><u>+63 917 804 4475</u></a> / <a href="tel:+0746651548"><u>+074 665 1548</u></a></span>
                    </div>

                    <div class="contact-info-item">
                        <span class="d-block">Email:</span>
                        <span>For general inquiries and matters, please email us at <a href="mailto:support@zeldannlrc.com"><u>support@zeldannlrc.com</u>.</a></span>
                    </div>

                    <div class="contact-info-item">
                        <span class="d-block">Address:</span>
                        <span>No. 50 2F Piao Yan Building Lower Bonifacio Street, Session Road Area Baguio City, Benguet, Cordillera Administrative Region (CAR), 2600</span>
                    </div>

                    <div class="contact-info-item">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3827.0949818041295!2d120.59496277589699!3d16.420001829950518!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3391a1ee7a5bf167%3A0x601047e922009b13!2sZeldan%20Nordic%20Language%20Review%20Training%20Center!5e0!3m2!1sen!2sph!4v1711418073064!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <span>© <?= date('Y') ?> Zeldan Nordic Language Review & Training Center. All rights Reserved.</span>
            </div>
        </div>
    </div>
</footer>


<script  src="<?php echo BASE_URL_ASSETS; ?>js/guest.min.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/vendor.min.js"></script>


       

       