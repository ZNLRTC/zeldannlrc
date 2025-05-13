<section id="expired-password-reset-link" data-layout-config='{"darkMode":false}'>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                
                <div class="error-container col-lg-4 offset-lg-4 col-md-6 offset-md-3">
                    <div class="text-center text-white">
                        <h1>Oops!</h1>
                        <h4>The link has expired.</h4>
                        <hr>
                        <p class="mb-4">Kindly request a new one, or you may use the 'Forgot Password' feature from the login page for further assistance.</p>

                        <a href="<?= BASE_URL . 'login' ?>" class="text-white d-block mb-1"><u><b><i class="fas fa-reply"></i> Go to Login</b></u></a>
                        <a href="#modal-forgot-password" data-bs-toggle="modal" data-target="#modal-forgot-password" class="text-white">Request for password reset</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
</section>

<footer class="footer footer-alt">
    &copy;<?= date('Y') ?> All rights reserved
</footer>
