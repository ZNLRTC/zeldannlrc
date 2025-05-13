<link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>template/css/fonts.css">
<!-- <link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>css/app-dark.min.css" id="dark-style"> -->
<link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>css/app.min.css" id="light-style">
<link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>css/guest.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>css/guest_tablet.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>css/guest_mobile.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>template/css/master.css">


<!-- NAVBAR START -->

<div class="d-xl-block d-lg-block d-md-block d-none d-sm-none">
    <nav class="py-lg-3 navbar navbar-expand-lg ">
        <div class="container">
            <div class="row align-items-center">
                <!-- logo  -->
                <div class="col-md-3">
                    <a href="<?php echo BASE_URL; ?>/" class="navbar-brand me-lg-5">
                        <img src="<?php echo BASE_URL_ASSETS; ?>/images/nlrc-logo-white.png" alt="" class="logo-dark">
                    </a>
                </div>

                <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation" style="background-color:white">
                    <i class="dripicons-menu" >-</i>
                </button> -->

                <!-- menus -->
                <div class="col-md-9">
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item mx-lg-1">
                                <a class="nav-link active text-uppercase" href="<?= BASE_URL ?>">Home</a>
                            </li>

                            <li class="nav-item mx-lg-1">
                                <a class="nav-link active" href="<?= BASE_URL . 'guest/faqs'?>">FAQs</a>
                            </li>

                            <li class="nav-item mx-lg-1">
                                <a class="nav-link active text-uppercase" href="<?= BASE_URL . 'guest/testimonials' ?>">Testimonials</a>
                            </li>

                            <li class="nav-item mx-lg-1">
                                <a class="nav-link active text-uppercase" href="<?= BASE_URL . 'guest/about' ?>">About Us</a>
                            </li>

                            <li class="nav-item mx-lg-1">
                                <a class="nav-link active text-uppercase" href="<?= BASE_URL . 'blogs' ?>">Blogs</a>
                            </li>

                            <li class="nav-item mx-lg-1">
                                <a class="nav-link active text-uppercase" href="https://moodle.nlrc.ph/">Moodle</a>
                            </li>

                            <li class="nav-item mx-lg-1">
                                <a class="nav-link text-uppercase" href="<?= BASE_URL ?>login"> Login</a>
                            </li>

                            <!-- <li class="nav-item mx-lg-1">
                                <a class="nav-link active text-uppercase" href="<?= BASE_URL . 'guest/register' ?>">Register</a>
                            </li> -->

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="d-xl-none d-lg-none d-md-none d-block d-sm-block mobile-header">
    <div class="mobile-container">

        <div class="topnav">
            <a href="<?= BASE_URL ?>"><img src="<?php echo BASE_URL_ASSETS; ?>/images/logo-orig.png" alt="ZNLRC Logo"></a>

            <div id="myLinks">
                <a class="border-bottom border-top" href="<?= BASE_URL ?>" >Home</a>
                <a class="border-bottom" href="<?= BASE_URL . 'guest/faqs'?>">FAQs</a>
                <a class="border-bottom" href="<?= BASE_URL . 'guest/testimonials' ?>">Testimonials</a>
                <a class="border-bottom" href="<?= BASE_URL . 'guest/about'?>">About Us</a>
                <a class="border-bottom" href="<?= BASE_URL . 'blogs'?>">Blogs</a>
                <a class="border-bottom" href="#contact-us">Contact Us</a>
                <a class="border-bottom" href="<?= BASE_URL ?>login"> Login</a>
                <a class="border-bottom" href="<?= BASE_URL . 'guest/register' ?>">Register</a>
            </div>

            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>

        <!-- End smartphone / tablet look -->
        </div>
    </div>
</div>

<script>
function myFunction() {
  var x = document.getElementById("myLinks");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>

<!-- NAVBAR END -->

        

