<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

        <!-- Begin page -->

        <div class="wrapper">

            <!-- ========== Left Sidebar Start ========== -->

            <div class="leftside-menu">

    

            <?php include 'admin_leftsidebar.php'?>



            </div>

            <!-- Left Sidebar End -->



            <!-- ============================================================== -->

            <!-- Start Page Content here -->

            <!-- ============================================================== -->



            <div class="content-page">

                <div class="content">

                <?php include 'admin_topbar.php'?>

                    <!-- end Topbar -->



                    <!-- Start Content-->

                    <div class="container-fluid">

                        

                        <!-- start page title -->

                        <div class="row">

                            <div class="col-12">

                                <div class="page-title-box">

                                    <div class="page-title-right">

                                        <ol class="breadcrumb m-0">

                                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>admin/dashboard">Dashboard</a></li>

                                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>admin/employees">Employees</a></li>

                                            <li class="breadcrumb-item active">Add</li>

                                        </ol>

                                    </div>

                                    <h4 class="page-title">Add Employees</h4>

                                </div>

                            </div>

                        </div>     

                        <!-- end page title --> 

                        <div class="row">

                            <form action = "<?php echo BASE_URL; ?>admin/saveEmployee" method="POST" id="adminInsertEmp">
                                <div class="row g-2">
                                    <div class="col-md-4 offset-md-4">
                                        <div class="mb-3">
                                            <label for="ainputEmail4" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="ainputEmail4" placeholder="Email" required>
                                        </div>

                                        <div class="mb-3">
                                            <input type="hidden" class="form-control" name="password" id="passwordemp" value="znlrcadmin" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-2">
                                    <div class="col-md-4 offset-md-4">
                                        <div class="mb-3">
                                            <label for="ainputfirst_name" class="form-label">Firstname</label>
                                            <input type="text" class="form-control" name="first_name" id="ainputfirst_name" placeholder="Firstname" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="ainputmiddlename" class="form-label">Middlename</label>
                                            <input type="text" class="form-control" name="middlename" id="ainputmiddlename" placeholder="Middlename">
                                        </div>

                                        <div class="mb-3">
                                            <label for="ainputlast_name" class="form-label">Lastname</label>
                                            <input type="text" class="form-control" name="last_name" id="ainputlast_name" placeholder="Lastname" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-2">
                                    <div class="mb-3 col-md-4 offset-md-4">
                                        <label for="ainputcontact_number" class="form-label">Contact Number</label>
                                        <input type="tel"  class="form-control" name="contact_number" id="ainputcontact_number" placeholder="Contact Number" required>
                                    </div>
                                </div>

                                
                                <div class="row g-2">
                                    <div class="mb-3 col-md-4 offset-md-4">
                                        <label for="ainputcontact_number" class="form-label" >Type</label>
                                        <select class="form-select "  name="empType" required>
                                            <option selected>Choose</option>
                                            <option value="1">NLRC</option>
                                            <option value="2">Topmake</option>
                                        </select>  
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 offset-md-4 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                            <div class="toast position-fixed bottom-0 end-0 bg-primary text-white" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <i class="dripicons-checkmark"></i>
                                    <strong class="me-auto">Saved</strong>
                                    <small class="text-muted">just now</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>

                                <div class="toast-body">Saved Successfully!</div>
                        </div>
                        <!-- end row -->
                    </div> <!-- container -->
                </div> <!-- content -->
            </div>



            <!-- ============================================================== -->

            <!-- End Page content -->

            <!-- ============================================================== -->





        </div>

        <!-- END wrapper -->

        

    </body>