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

                                    <h4 class="page-title"><i class="dripicons-lock"></i> Change Password</h4>

                                </div>

                            </div>

                        </div>

                        <!-- end page title -->



                        <div class="row">

                                <!--end card-->

                                    <div class="tilebox-one">

                                        <div class="card-body">

                                        <form action="<?php echo BASE_URL; ?>admin/passwordChange" id='adminChangePassword'>

                                        <div class="alert alert-danger d-none alert-dismissible align-items-center fade show" id="alertPass">

                                            <i class="bi-check-circle-fill"></i>

                                            <strong class="mx-2">Error!</strong> Password do not match!

                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

                                        </div>  

                                        <div class="row">
                                            <div class="col-md-4 offset-md-4">
                                                <div class="mb-3">
                                                    <label for="emailaddress" class="form-label">New password:</label>
                                                    <input name="newpass" class="form-control" type="password" id="adminNewPass"  placeholder="Enter your new password!" required>
                                                    <input name="uid" class="form-control" type="hidden" id="user" value = "<?php echo $user['id']?>"  required>
                                                    <div id="strength_message_admin"></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="emailaddress" class="form-label">Confirm new password:</label>
                                                    <input name="confirmpass" class="form-control" type="password" id="adminConfirmPass"  placeholder="Enter your password again!" required>
                                                </div>

                                                <div class="mb-0 text-center d-grid">
                                                    <button id="admin_Changepassbtn" class="btn btn-primary" type="submit"></i> Save </button>
                                                </div>
                                            </div>

                                        </div>

                                        </form>

                                        </div> <!-- end card-body-->

                                    </div>

                                    <!--end card-->

                             



                            

                        </div>



                        

                       



                       



                        



                            



                            



                        </div>

                        <!-- end row -->



                    </div>

                    <!-- container -->



                



                  <!-- Footer Start -->

                  <footer class="footer">

                    <div class="container-fluid">

                        <div class="row">

                            <div class="col-md-6">

                                <script>document.write(new Date().getFullYear())</script> © ZNLRC

                            </div>

                            <div class="col-md-6">

                                <div class="text-md-end footer-links d-none d-md-block">

                                    <a href="javascript: void(0);">About</a>

                                    <a href="javascript: void(0);">Support</a>

                                    <a href="javascript: void(0);">Contact Us</a>

                                </div>

                            </div>

                        </div>

                    </div>

                </footer>

                <!-- end Footer -->



 

            </div>



            <!-- ============================================================== -->

            <!-- End Page content -->

            <!-- ============================================================== -->





        </div>

        <!-- END wrapper -->



       



      

    </body>