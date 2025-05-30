<!-- <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>



        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">

            <div class="container">

                <div class="row justify-content-center">

                    <div class="col-xxl-4 col-lg-5">

                        <div class="card">

                            <div class="card-header pt-4 pb-4 text-center bg-primary">

                                <a href="index.html">

                                    <span><img src="<?php echo BASE_URL_ASSETS; ?>/images/logo.jpg" alt="" height="90"></span>

                                </a>

                            </div>



                            <div class="card-body p-4">

                                

                                <div class="text-center w-75 m-auto">

                                    <h4 class="text-dark-50 text-center mt-0 fw-bold">See You Again !</h4>

                                    <p class="text-muted mb-4">You are now successfully signed out.</p>

                                </div>



                                <div class="logout-icon m-auto">

                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"

                                    viewBox="0 0 161.2 161.2" enable-background="new 0 0 161.2 161.2" xml:space="preserve">

                                        <path class="path" fill="none" stroke="#0acf97" stroke-miterlimit="10" d="M425.9,52.1L425.9,52.1c-2.2-2.6-6-2.6-8.3-0.1l-42.7,46.2l-14.3-16.4

                                            c-2.3-2.7-6.2-2.7-8.6-0.1c-1.9,2.1-2,5.6-0.1,7.7l17.6,20.3c0.2,0.3,0.4,0.6,0.6,0.9c1.8,2,4.4,2.5,6.6,1.4c0.7-0.3,1.4-0.8,2-1.5

                                            c0.3-0.3,0.5-0.6,0.7-0.9l46.3-50.1C427.7,57.5,427.7,54.2,425.9,52.1z"/>

                                        <circle class="path" fill="none" stroke="#0acf97" stroke-width="4" stroke-miterlimit="10" cx="80.6" cy="80.6" r="62.1"/>

                                        <polyline class="path" fill="none" stroke="#0acf97" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="113,52.8

                                            74.1,108.4 48.2,86.4 "/>



                                        <circle class="spin" fill="none" stroke="#0acf97" stroke-width="4" stroke-miterlimit="10" stroke-dasharray="12.2175,12.2175" cx="80.6" cy="80.6" r="73.9"/>

                                    </svg>

                                </div>
                            </div>
                        </div>



                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted">Back to <a href="<?php echo BASE_URL; ?>" class="text-muted ms-1"><b>Home</b></a> | <a href="<?php echo BASE_URL; ?>login" class="text-muted ms-1"><b>Log In</b></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body> -->

<section id="logout-page" >
    <div class="container">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-4 offset-md-4 login-side-container">
                    <div class="login-form-container">
                        <div class="text-center">
                            <h1 class="text-white mb-0 pb-0">Moi Moi!</h1>
                            <p class="text-white">You are successfully logged out!</p>
                            <i class="far fa-check-circle text-success"></i>
                            <hr class="text-white">
                            
                            <div>
                                <span class="mb-0 pb-0 text-white me-2">Go back to</span>
                                <a class="text-white me-1" href="<?= BASE_URL; ?>"><b><i class="fas fa-home"></i> Home</b></a> 
                                <span class="text-white">  |  </span> 
                                <a class="text-white ms-1" href="<?= BASE_URL . 'login' ?>"><b><i class="fas fa-user"></i> Login</b></a>
                            </div>
                            
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
    
</section>