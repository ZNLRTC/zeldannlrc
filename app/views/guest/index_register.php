<section class="banner-section-registration">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5">
                <div class="mt-md-4">
                    <h1 class="text-white fw-normal mb-4 mt-3">
                        Register Now!
                    </h1>

                    <p class="mb-4 font-18 text-white">Start your journey to Finnish fluency today! Our program focuses on practical language skills that will equip you for everyday life in Finland. Learn to communicate confidently in various settings, from the workplace to social interactions.</p>
                </div>
            </div>

            <div class="col-md-7 mobile-hide">
                <div class="text-md-end mt-3 mt-md-0 d-flex align-items-center justify-content-center">
                    <img class="registration-banner-image" src="<?php echo BASE_URL_ASSETS; ?>/images/banner-registration-image.webp" alt="Banner for Registration" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="registration-section my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">

                <h2 class="teal d-block text-center mb-5">Registration Form</h2>

                <form method="post" id="register_guest" action="<?php echo BASE_URL?>guest/save_guest"   >
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Last Name</label>
                        <input class="form-control" type="text" name="lname" id="fullname" placeholder="Enter your last name" required="">
                    </div>

                    <div class="mb-3">
                        <label for="fullname" class="form-label">First Name</label>
                        <input class="form-control" type="text" name="fname" id="fullname2" placeholder="Enter your first name" required="">
                    </div>

                    <div class="mb-3">
                        <label for="fullname" class="form-label">Middle Name (Optional)</label>
                        <input class="form-control" type="text" name="mname" id="fullname3" placeholder="Enter your middle name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label mb-0">Batch</label><br>
                        <small><i><b>Note:</b> Make sure the batch you are to select is correct.</i></small>
                        <div class="row">
                            <div class="col-md-6">
                                <select class="form-select" name="register-batch-names" required>
                                    <option value="" selected disabled>Select Batch</option>
                                    <?php foreach($batch_names as $name): ?>
                                        <option value="<?= $name['name'] ?>" class="batch-<?= $name['name'] ?> text-uppercase"><?= $name['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select" name="register-batch-numbers" required>
                                    <option value="" selected disabled>Select Batch Number</option>
                                    <?php foreach($batch_numbers as $num): ?>
                                        <option value="<?= $num['batch_number'] ?>" class="bat-<?= $num['name'] ?> d-none"><?= $num['batch_number'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="emailaddress" class="form-label mb-0">Email address</label><br>
                        <small><i>(<b>Note:</b> Make sure to use the same email that you used in previous forms.)</i></small>
                        <input class="form-control" type="email" name="email" id="emailaddress" required placeholder="Enter your email" value="<?= $email ?>">
                        <div id="mailExist"></div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label mb-0">Password</label><br>
                        <small><i>(<b>Note:</b> Make sure your password meets the "Good" criteria)</i>     </small>
                        <input class="form-control" type="password" name="pass" required="" id="pwd" placeholder="Enter your password" minlength="8" maxlength="40">
            
                        <div id="strength_message"></div>
                    </div>

                    <input type="hidden" name="submit_frm" value="1">
                    <div id="capchaError"></div>

                    <div class="mb-3 row align-items-center">
                        <div class="form-check col-md-9">
                            <input type="checkbox" class="form-check-input" id="checkbox-signup" required>
                            <label class="form-check-label" for="checkbox-signup">I accept <a href="#" class="text-muted">Terms and Conditions</a> and <a href="javascript: void(0);" class="text-muted">Privacy Policy.</a></label>
                            <div  id="agree_chk_error"></div>
                        </div>

                        <div class="mb-0 d-grid text-center col-md-3">
                            <button class="btn btn-teal-rounded white"  id="regbtn" ><i class="mdi mdi-account-circle"></i> Register </button>
                        </div>
                    </div>

                </form>
            </div>
            
        </div>
    </div>
</section>



<!-- <div class="auth-fluid">

    <div class="auth-fluid-form-box">
        <div class="align-items-center d-flex h-100">
            <div class="card-body">
                <br>
               
                <div class="auth-brand text-center text-lg-start bg-primary">
                    <a href="<?php echo BASE_URL; ?>" class="logo-dark">
                        <span><img src="<?php echo BASE_URL_ASSETS; ?>images/logo.png" alt="" height="70"></span>
                    </a>
                </div>
                <br>
                <br>

                
                <h4 class="mt-0">Application form!</h4>
                <p class="text-muted mb-4"></p>

                
                <form method="post" id="register_guest" action="<?php echo BASE_URL?>guest/save_guest"   >
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Last Name</label>
                        <input class="form-control" type="text" name="lname" id="fullname" placeholder="Enter your last name" required="">
                    </div>

                    <div class="mb-3">
                        <label for="fullname" class="form-label">First Name</label>
                        <input class="form-control" type="text" name="fname" id="fullname2" placeholder="Enter your first name" required="">
                    </div>

                    <div class="mb-3">
                        <label for="fullname" class="form-label">Middle Name</label>
                        <input class="form-control" type="text" name="mname" id="fullname3" placeholder="Enter your middle name" required="">
                    </div>

                    <div class="mb-3">
                        <label for="emailaddress" class="form-label">Email address</label>
                        <input class="form-control" type="email" name="email" id="emailaddress" required="" placeholder="Enter your email">
                        <div id="mailExist"></div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control" type="password" name="pass" required="" id="pwd" placeholder="Enter your password" minlength="8" maxlength="40">
                        <div id="strength_message"></div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkbox-signup">
                            <label class="form-check-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-muted">Terms and Conditions</a> and <a href="javascript: void(0);" class="text-muted">Privacy Policy.</a></label>
                            <div  id="agree_chk_error"></div>
                        </div>
                    </div>

                    <input type="hidden" name="submit_frm" value="1">
                    <div id="capchaError"></div>
                    <div class="mb-0 d-grid text-center">
                        <button class="btn btn-primary "   id="regbtn" ><i class="mdi mdi-account-circle"></i> Submit </button>
                    </div>
                    
                </form>
                        <br>

            </div>

        </div> 
    </div>







    <div class="auth-fluid-right text-center">
        <div class="auth-user-testimonial">
            <h2 class="mb-3">Dreams come true!</h2>
            <p class="lead"><i class="mdi mdi-format-quote-open"></i> Work Hard! . <i class="mdi mdi-format-quote-close"></i>
            </p>
        </div> 
    </div>

</div>


</body> -->