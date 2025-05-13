<!-- Topbar Start -->

<div class="navbar-custom">

                        <ul class="list-unstyled topbar-menu float-end mb-0">

                            

                            <li class="dropdown notification-list">

                                <a class="nav-link dropdown-toggle nav-user arrow-none me-0 d-flex align-items-center" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">

                                    <div class="account-user-avatar"> 
                                        <img src="<?php echo BASE_URL_ASSETS; ?>images/users/<?php echo $user['avatar']?>" alt="user-image" class="rounded-circle">
                                    </div>

                                    <div class="me-2">
                                        <span class="account-user-name"><?php echo $user['first_name']?></span>
                                        <span class="account-position"><?php echo $user['last_name']?></span>
                                    </div>

                                    <div>
                                        <span title="<?= ucwords($user['flag_status']) ?>" class="bg-success rounded-pill px-1 py-0 text-success">.</span>
                                    </div>

                                </a>

                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">

                                    <!-- item-->

                                    <div class=" dropdown-header noti-title">

                                        <h6 class="text-overflow m-0">Welcome !</h6>

                                    </div>



                                    <!-- item-->

                                    <a href="<?php echo BASE_URL; ?>admin/profile" class="dropdown-item notify-item">

                                        <i class="mdi mdi-account-circle me-1"></i>

                                        <span>My Account</span>

                                    </a>

                                    <a href="<?php echo BASE_URL; ?>admin/changepassword" class="dropdown-item notify-item">

                                    <i class="dripicons-lock"></i> 

                                        <span>Change password</span>

                                    </a>                   

                                    <a href="<?php echo BASE_URL; ?>admin/settings" class="dropdown-item notify-item">

                                    <i class="dripicons-gear"></i> 

                                        <span>Settings</span>

                                    </a>                     

                                                            



                                    <!-- item-->

                                    <a id="logoutAd" href="<?php echo BASE_URL; ?>logout" url = "<?php echo BASE_URL; ?>admin/out" class="dropdown-item notify-item">

                                        <i class="mdi mdi-logout me-1"></i>

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





 