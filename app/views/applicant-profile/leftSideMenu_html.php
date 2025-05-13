<div class="leftside-menu">

    

    <!-- LOGO -->

    <a href="<?php echo BASE_URL; ?>profile/dashboard" class="logo text-center logo-light">

        <span class="logo-lg">

            <img src="<?php echo BASE_URL_ASSETS; ?>images/logo.png" alt="" height="50">

        </span>

        <span class="logo-sm">

            <img src="<?php echo BASE_URL_ASSETS; ?>images/logo.png" alt="" height="16">

        </span>

    </a>



    <!-- LOGO -->

    <a href="<?php echo BASE_URL; ?>profile/dashboard" class="logo text-center logo-dark">

        <span class="logo-lg">

            <img src="<?php echo BASE_URL_ASSETS; ?>/images/logo-dark.png" alt="" height="50">

        </span>

        <span class="logo-sm">

            <img src="assets/images/logo_sm_dark.png" alt="" height="70">

        </span>

    </a>



    <div class="h-100" id="leftside-menu-container" data-simplebar="">



        <!--- Sidemenu -->

        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
                <a  href="<?php echo BASE_URL; ?>profile/dashboard" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="<?php echo BASE_URL; ?>profile/view" class="side-nav-link">
                    <i class="mdi mdi-account-circle me-1"></i>
                    <span> Profile </span>
                </a>
            </li>
            <?php if(!in_array($batch, ['ken', 'intw', 'intn'])): ?>
                <li class="side-nav-item">
                    <a id="file-manager-btn" href="<?= BASE_URL ?>profile/filemanager" class="side-nav-link">
                        <i class="uil-folder-plus"></i>
                        <span> Documents </span>
                        <span style="color:red;" class="d-none float-end" id="request_doci"><i class='dripicons-warning' style='color:red;'> </i></span>
                    </a>
                </li>
            <?php endif ?>

            <li class="side-nav-item">
                <a href="messages" class="side-nav-link">
                    <i class="mdi mdi-email-outline"></i>
                    <span> Messages </span> <?= $convo_active_count != 0 ? '<small class="px-2 bg-red rounded-pill text-white">' .$convo_active_count. '</small>' : '' ?>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="<?php echo BASE_URL; ?>profile/messages_faqs" class="side-nav-link">
                    <i class="mdi mdi-comment-question-outline"></i>
                    <span> FAQs </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="<?php echo BASE_URL; ?>logout" url = "<?php echo BASE_URL; ?>profile/out" class="side-nav-link logoutApp">
                    <i class="mdi mdi-logout me-1"></i>
                    <span> Logout </span>
                </a>
            </li>

        </ul>
    </div>
</div>