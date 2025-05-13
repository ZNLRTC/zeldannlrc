<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="wrapper">
        <?php include 'admin_leftsidebar.php'?>
        <div class="content-page">
            <div class="content">
                <?php include 'admin_topbar.php'?>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex justify-content-between align-items-center">
                                <h4 class="page-title">Employees</h4>
                                <div class="d-flex">
                                    <div class="me-1">
                                        <input id="employeeData-search" class="form-control" type="search" placeholder="Search">
                                    </div>

                                    <div>
                                        <a href="<?php echo BASE_URL; ?>admin/create" class="btn btn-info"><i class="dripicons-plus"></i> Add </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-0">

                    <div class="row">
                        <table id="employeeData" class="table dt-responsive nowrap w-100">
                            <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Action</th>
                            </thead>
                        </table>   
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>