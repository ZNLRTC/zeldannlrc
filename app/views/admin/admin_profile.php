<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            <?php include 'admin_leftsidebar.php'?>

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                <?php include 'admin_topbar.php'?>
                    
                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                       
                                    </div>
                                    <h4 class="page-title">Profile</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                               <form action = "<?php echo BASE_URL; ?>admin/update" method="POST" id="adminProfile">
                                <div class="row g-2">
                                    <div class="mb-3 col-md-4">
                                        <label for="inputEmail4" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="Email" value="<?php echo $user['email']?>">
                                    </div>
                                   
                                </div>
                                        
                                <div class="row g-2">
                                    <div class="mb-3 col-md-4">
                                        <label for="inputfirst_name" class="form-label">Firstname</label>
                                        <input type="text" class="form-control" name="first_name" id="inputfirst_name" placeholder="1234 Main St" value="<?php echo $user['first_name']?>">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="inputmiddlename" class="form-label">Middlename</label>
                                        <input type="text" class="form-control" name="middlename" id="inputmiddlename" placeholder="1234 Main St" value="<?php echo $user['middlename']?>">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="inputlast_name" class="form-label">Lastname</label>
                                        <input type="text" class="form-control" name="last_name" id="inputlast_name" placeholder="1234 Main St" value="<?php echo $user['last_name']?>">
                                    </div>
                                   
                                </div>
                                <div class="row g-2">
                                    <div class="mb-3 col-md-4">
                                        <label for="inputcontact_number" class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" name="contact_number" id="inputcontact_number" placeholder="Contact Number" value="<?php echo $user['contact_number']?>">
                                    </div>
                                   
                                   
                                </div>
                               
                                            
                              

                               
                                            
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>

                            
                        </div>

                        
                            <div class="toast position-fixed bottom-0 end-0 bg-primary text-white" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                <i class="dripicons-checkmark"></i>
                                <strong class="me-auto">Saved</strong>
                                <small class="text-muted">just now</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body">
                                Updated Successfully!
                                </div>

                       

                        

                            

                            

                        </div>
                        <!-- end row -->

                    </div>
                    <!-- container -->

                </div>
                <!-- content -->

              
            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

       

      
    </body>