
            <div class="leftside-menu">

    

                <!-- LOGO -->

                <a href="<?php echo BASE_URL; ?>admin/dashboard" class="logo text-center logo-light">

                    <span class="logo-lg">

                        <img src="<?php echo BASE_URL_ASSETS; ?>images/logo.png" alt="" height="50">

                    </span>

                    <span class="logo-sm">

                        <img src="<?php echo BASE_URL_ASSETS; ?>images/logo.png" alt="" height="16">

                    </span>

                </a>



                <!-- LOGO -->

                <a href="<?php echo BASE_URL; ?>admin/dashboard" class="logo text-center logo-dark">

                    <span class="logo-lg">
                        <img src="<?php echo BASE_URL_ASSETS; ?>/images/logo-dark.png" alt="" height="50">
                    </span>

                    <span class="logo-sm">
                        <img src="assets/images/logo_sm_dark.png" alt="" height="16">
                    </span>
                </a>

    

                <div class="h-100" id="leftside-menu-container" data-simplebar="">
                    <ul class="side-nav pe-1">
                        <li class="side-nav-title side-nav-item">Navigation</li>

                        <?php if($user['id'] != 8729): ?>

                            <li class="side-nav-item">
                                <a href="<?php echo BASE_URL; ?>admin/dashboard" class="side-nav-link">
                                    <i class="uil-home-alt"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>

                            <li class="side-nav-item">
                                <a href="<?php echo BASE_URL; ?>admin/settings" class="side-nav-link">
                                    <i class="uil uil-file-edit-alt"></i>
                                    <span> Documents </span>
                                </a>
                            </li>

                            <li class="side-nav-item">
                                <a href="<?php echo BASE_URL; ?>admin/batch" class="side-nav-link">
                                    <i class="uil-object-group"></i>
                                    <span> Batch </span>
                                </a>
                            </li>


                            <li class="side-nav-item">

                                <a href="<?php echo BASE_URL; ?>admin/applicants" class="side-nav-link">
                                    <i class="dripicons-user-group"></i>
                                    <span> Trainees </span>
                                </a>

                                <ul class="ms-3">
                                    <li class="side-nav-item li-document-requests mb-2">
                                        <a href="documentRequests" class="">
                                            <i class="fas fa-file-pdf me-2"></i> 
                                            Document Requests 
                                            <?= isset($pending_document_request_count) ? '<small class="bg-danger text-white rounded-1-25 px-1">'.$pending_document_request_count.'</small>' : ''; ?>
                                        </a>
                                    </li>
                                    
                                    <li class="side-nav-item li-document-requests mb-2"><a href="infoRequests"><i class="fas fa-info-circle me-2"></i> User Info Requests <?= isset($info_pending_requests) ? '<small class="bg-danger text-white rounded-1-25 px-1">'.$info_pending_requests.'</small>' : ''; ?> </a></li>
                                    <li class="side-nav-item li-document-requests mb-2"><a href="userMessages"><i class="fas fa-envelope me-2"></i> Messages <small class="bg-success text-white rounded-1-25 px-1"><?= $count_active_tickets ?> </small></a></li>
                                </ul>
                            </li>

                        <?php endif ?>

                        <li class="side-nav-item">
                            <a href="<?php echo BASE_URL; ?>admin/testimonials" class="side-nav-link">
                                <i class="uil uil-envelope-question"></i>
                                <span> Testimonials </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="<?php echo BASE_URL; ?>admin/messages_faqs" class="side-nav-link">
                                <i class="uil uil-envelope-question"></i>
                                <span> Messages FAQ's </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="<?php echo BASE_URL; ?>admin/blogs" class="side-nav-link">
                                <i class="uil uil-newspaper"></i>
                                <span> Blogs </span>
                            </a>
                        </li>

                        <hr>

                        <?php if($user['is_superuser'] == 1): ?>
                            <li class="side-nav-item">
                                <a href="request_access" class="side-nav-link">
                                <i class="fas fa-door-open"></i>
                                    <span>Request Access </span>
                                </a>
                            </li>

                            <li class="side-nav-item">
                                <a href="<?php echo BASE_URL; ?>admin/departments" class="side-nav-link">
                                    <i class="uil uil-building"></i>
                                    <span> Departments </span>
                                </a>
                            </li>

                            <li class="side-nav-item">
                                <a href="<?php echo BASE_URL; ?>admin/employees" class="side-nav-link">
                                    <i class="uil-user"></i>
                                    <span> Employees </span>
                                </a>
                            </li>

                            <li class="side-nav-item">
                                <a href="messages_faqs_keywords" class="side-nav-link">
                                    <i class="fas fa-key me-2"></i> 
                                    <span>Keywords </span>
                                </a>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>