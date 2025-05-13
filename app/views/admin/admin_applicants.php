<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="wrapper">
        <?php include 'admin_leftsidebar.php'?>
        <div class="content-page">
            <div class="content">
            <?php include 'admin_topbar.php'?>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-2">
                            <div class="page-title-box">
                                <h4 class="page-title">Applicants</h4>
                            </div>
                        </div>

                        <div class="col-10 d-flex align-items-center justify-content-end">
                            <div class="me-1" >
                                <a href="add_trainee" class="btn btn-success">Add Trainee</a>
                                <button class="btn bg-none text-primary mass-change-status-btn d-none">Change status <i class="fas fa-long-arrow-alt-right"></i></button>
                                <button class="btn bg-none text-primary move-to-batch-btn d-none">Move to batch <i class="fas fa-long-arrow-alt-right"></i></button>
                            </div>

                            <div class="me-1">
                                <select class="form-select" id="select-status-view">
                                    <option selected disabled>Select Status</option>
                                    <option value="all">All</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="on-hold">On-hold</option>
                                    <option value="quit">Quit</option>
                                    <option value="deployed">Deployed</option>
                                    <option value="upcoming">Upcoming</option>
                                </select> 
                            </div>

                            <div class="me-1">
                                <select class="form-select" id="select_applic">
                                    <option selected disabled>Select View</option>
                                    <option id="all_appli">All</option>
                                    <option value="3" id="pending_appli" >Pending</option>
                                    <option value="1" id="approved_appli" >Approved</option>
                                    <option value="2" id="disapproved_appli">Disapproved</option>
                                </select> 
                            </div>


                            <div id="applicants-table-search-inputs">
                                <input type="search" class="form-control applicants-table-search-all" placeholder="Search from all">
                                <input type="search" class="form-control d-none applicants-table-search-3" placeholder="Search from pending">
                                <input type="search" class="form-control d-none applicants-table-search-1" placeholder="Search from approved">
                                <input type="search" class="form-control d-none applicants-table-search-2" placeholder="Search from disapproved">
                            </div>
                        </div>
                    </div>

                    <hr class="mt-0">
                    <div class="row " id = "appli_content">
                        <table id="applicantsData" class="table dt-responsive nowrap w-100">
                            <thead>
                                <th><input class="pointer" type="checkbox" name="applicants-checkbox-all" data-table="applicantsData"></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Batch</th>
                                <th>Deployment Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                        </table>   
                    </div>

                    <div class="row d-none" id = "appli_content1">
                        <table id="applicantsData1" class="table dt-responsive nowrap w-100">
                        <thead>
                                <th><input class="pointer" type="checkbox" name="applicants-checkbox-all" data-table="applicantsData1"></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Batch</th>
                                <th>Deployment Date</th>
                                <th>Status</th>
                                <th>Action</th>
                        </thead>
                        </table>   
                    </div>

                    <div class="row d-none" id = "appli_content2">
                        <table id="applicantsData2" class="table dt-responsive nowrap w-100">
                            <thead>
                                    <th><input class="pointer" type="checkbox" name="applicants-checkbox-all" data-table="applicantsData2"></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Batch</th>
                                    <th>Deployment Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                            </thead>
                        </table>   
                    </div>

                    <div class="row d-none" id = "appli_content3">
                        <table id="applicantsData3" class="table dt-responsive nowrap w-100">
                            <thead>
                                    <th><input class="pointer" type="checkbox" name="applicants-checkbox-all" data-table="applicantsData3"></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Batch</th>
                                    <th>Deployment Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                            </thead>
                        </table>  
                    </div><!-- end row -->
                </div><!-- container -->
            </div><!-- content -->
        </div>
    </div><!-- END wrapper -->
</body>

<div id="update-flag-status-date-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Status Date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="update-flag-status-date-form">
                    <input type="hidden" name="flag-status">
                    <input type="hidden" name="trainee-id">
                    <div class="form-group">
                        <label class="form-label">Enter Deployed Date</label>
                        <input type="date" name="flag-deployment-date" class="form-control">
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success confirm-flag-status-date-btn">Save</button>
                <button class="btn btn-danger" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<div id="change-applicants-status-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Change applicant status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "form-mass-change-applicant-status">
                    <table id="applicants-mass-change-status-table" class="w-100 table table-striped">
                        <thead class="">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Current Status</th>
                            <th>Action</th>
                        </thead>

                        <tbody></tbody>
                    </table>

                    <hr>
                    
                    <label class="form-label">Change status</label>
                    <div class="d-flex justify-content-between mb-3">
                        <div class="form-groud me-1 d-flex align-items-center">
                            <input id="status-active" class="me-1" type="radio" name="new-app-status" value="active" checked>
                            <label for="status-active" class="form-label pointer mb-0">Active</label>
                        </div>

                        <div class="form-groud me-1 d-flex align-items-center">
                            <input id="status-inactive" class="me-1" type="radio" name="new-app-status" value="inactive">
                            <label for="status-inactive" class="form-label pointer mb-0">Inactive</label>
                        </div>

                        <div class="form-groud me-1 d-flex align-items-center">
                            <input id="status-on-hold" class="me-1" type="radio" name="new-app-status" value="on-hold">
                            <label for="status-on-hold" class="form-label pointer mb-0">On-hold</label>
                        </div>

                        <div class="form-groud me-1 d-flex align-items-center">
                            <input id="status-quit" class="me-1" type="radio" name="new-app-status" value="quit">
                            <label for="status-quit" class="form-label pointer mb-0">Quit</label>
                        </div>

                        <div class="form-groud me-1 d-flex align-items-center">
                            <input id="status-deployed" class="me-1" type="radio" name="new-app-status" value="deployed">
                            <label for="status-deployed" class="form-label pointer mb-0">Deployed</label>
                        </div>
                    </div>
                    <div class="form-group deployment-container d-none">
                        <label>Enter Deployment Date:</label>
                        <input type="date" name="flag-deployment-date" class="form-control">
                    </div>

                    <div class="form-group d-flex justify-content-end mt-3">
                        <a href="#" class="btn btn-danger me-2" data-bs-dismiss="modal">No</a>
                        <button class="btn btn-success move-batch-btn" type="submit"><i class="fas fa-check"></i> Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>