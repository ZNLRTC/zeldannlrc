<!-- Topbar Start -->



<div class="navbar-custom">
    
    <ul class="list-unstyled topbar-menu mb-0">
        <li class="dropdown notification-list">
            <a href="messages">Active Messages <?= $convo_active_count != 0 ? '<small class="bg-danger px-2 rounded-pill text-white">' .$convo_active_count. '</small>' : '' ?></a>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <span class="account-user-avatar"> 
                    <img src="<?php echo BASE_URL_ASSETS; ?>images/users/<?php echo $user['avatar']?>" alt="user-image" class="rounded-circle">
                </span>

                <span>
                    <span class="account-user-name"><?php echo $user['first_name']?></span>
                    <span class="account-position"><?php echo $user['last_name']?></span>
                    <span class="account-position">Active</span>
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>

                <!-- item-->
                <a href="<?php echo BASE_URL; ?>profile/view" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle me-1"></i>
                    <span>My Account</span>
                </a>

                <a id="" href="<?php echo BASE_URL; ?>logout" url = "<?php echo BASE_URL; ?>profile/out" class="dropdown-item notify-item logoutApp">
                    <i  class="mdi mdi-logout me-1"></i>
                    <span>Logout</span>
                </a>
            </div>
        </li>
    </ul>

    <button class="button-menu-mobile open-left">
        <i class="mdi mdi-menu"></i>
    </button>

</div>

<!-- end Topbar -->