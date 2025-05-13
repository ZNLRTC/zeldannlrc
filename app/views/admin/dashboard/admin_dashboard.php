<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

    <!-- Begin page -->

    <div class="wrapper">
        <?php include __DIR__ . '/../admin_leftsidebar.php'; ?>

        <div class="content-page">
            <div class="content">
            <?php include __DIR__ . '/../admin_topbar.php'; ?>
                <!-- Start Content-->

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right"></div>
                                <h4 class="page-title">Dashboard</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-10 offset-lg-1 col-md-10 offset-md-1 d-flex align-items-start status-card-parent-container">
                            <a href="<?= 'applicants?status=active' ?>" class="status-card-container bg-success">
                                <h4 class="fas fa-users text-light status-icon"></h4>
                                <div class="count-container">
                                    <h4>Active</h4>
                                    <h3><?= $countActiveAppli ?></h3>
                                </div>
                            </a>

                            <a href="<?= 'applicants?status=inactive' ?>" class="status-card-container bg-warning">
                                <h4 class="fas fa-bed text-light status-icon"></h4>
                                <div class="count-container">
                                    <h4>Inactive</h4>
                                    <h3><?= $countInactiveAppli ?></h3>
                                </div>
                            </a>

                            <a href="<?= 'applicants?status=on-hold' ?>" class="status-card-container bg-orange">
                                <h4 class="fas fa-user-alt-slash text-light status-icon"></h4>
                                <div class="count-container">
                                    <h4>On-hold</h4>
                                    <h3><?= $countOnholdAppli ?></h3>
                                </div>
                            </a>

                            <a href="<?= 'applicants?status=quit' ?>" class="status-card-container bg-red">
                                <h4 class="fas fa-user-times text-light status-icon"></h4>
                                <div class="count-container">
                                    <h4>Quit</h4>
                                    <h3><?php echo $countQuitAppli;?></h3>
                                </div>
                            </a>

                            <a href="<?= 'applicants?status=deployed' ?>" class="status-card-container bg-info">
                                <h4 class="fa fa-plane text-light status-icon"></h4>
                                <div class="count-container">
                                    <h4>Deployed</h4>
                                    <h3><?= $countDeployedAppli - $countDeployedUpcoming;?></h3>
                                    <p>Upcoming: <b><?= $countDeployedUpcoming ?></b></p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row"><!-- Start Middle Panel-->
                        <div class="col-md-10 offset-md-1"><!-- Start Middle Left Panel-->
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="card tilebox-one">
                                        <div class="card-body">
                                            <i class="fas fa-users float-end"></i>
                                            <h6 class="text-uppercase mt-0">Active Employees</h6>
                                            <h3 class="my-2" id="active-users-count"><?php echo count($countStaff);?></h3>
                                            <p class="mb-0 text-muted"></p>
                                        </div>
                                        <div class="card-footer bg-primary">
                                            <a class="text-white" href="<?= BASE_URL . 'admin/employees' ?>"> + View More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card tilebox-one">
                                        <div class="card-body">
                                            <i class="fas fa-users float-end"></i>
                                            <h6 class="text-uppercase mt-0">Applicants (Pending / All)</h6>
                                            <h3 class="my-2" id="active-views-count"><?= count($countPending) .' / '. count($countAppli);?></h3>
                                            <p class="mb-0 text-muted"></p>
                                        </div>
                                        <div class="card-footer bg-primary">
                                            <a class="text-white" href="<?= BASE_URL . 'admin/applicants' ?>"> + View More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card tilebox-one">
                                        <div class="card-body">
                                            <i class="fas fa-users float-end"></i>
                                            <h6 class="text-uppercase mt-0">Document Requests</h6>
                                            <h3 class="my-2"><?= $pending_document_request_count != 0 ? $pending_document_request_count : '0' ?></h3>
                                            <p class="mb-0 text-muted"></p>
                                        </div>
                                        <div class="card-footer bg-primary">
                                            <a class="text-white" href="<?= BASE_URL . 'admin/documentRequests' ?>"> + View More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card tilebox-one">
                                        <div class="card-body">
                                            <i class="fas fa-users float-end"></i>
                                            <h6 class="text-uppercase mt-0">User Information Requests</h6>
                                            <h3 class="my-2"><?= $info_pending_requests ? $info_pending_requests : '0' ?></h3>
                                            <p class="mb-0 text-muted"></p>
                                        </div>
                                        <div class="card-footer bg-primary">
                                            <a class="text-white" href="<?= BASE_URL . 'admin/infoRequests' ?>"> + View More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Middle Left Panel-->
                        
                    </div> <!-- End Middle Panel-->
                    <div class="row">
                        <div class="col-md-5 offset-md-1"><!-- Start Middle Right Panel-->
                            <div class="card">
                                <div class="card-body">
                                    <div class="row text-center">
                                        <p><?= date('Y') . ' Deployments' ?></p>
                                    </div>
                                    <div class="row">
                                    <canvas id="deployed-chart" ></canvas>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Middle Right Panel-->

                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row text-center mb-0">
                                        <p><?='Week '. date('W') . ' Transfers' ?></p>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-sm-6">
                                            <p class="text-muted mb-0">Current Week</p>
                                            <h5 class="fw-normal mb-0 mt-0">
                                                <span><?php echo $total_count_current_week ?></span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-6">
                                        <p class="text-muted mb-0">Previous Week</p>
                                            <h5 class="fw-normal mb-0 mt-0">
                                                <span><?php echo $total_count_previous_week ?></span>
                                            </h5>
                                        </div>
                                    </div>
                                    <canvas id="daily-batch-transfers-per-week-chart" ></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>