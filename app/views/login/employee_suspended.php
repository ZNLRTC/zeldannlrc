<section id="login-page" >
    <div class="container">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-4 offset-md-4 login-side-container">
                    <div class="login-form-container">
                        <div class="text-center">
                            <h1 class="text-white mb-0 pb-0">Your account has been suspended!</h1>
                            <hr class="text-white">
                            <button class="btn btn-danger request-access-btn" data-employee-email="<?= $email ?>">Request for System Access</button>
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