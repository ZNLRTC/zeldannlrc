<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

        <!-- Begin page -->

        <div class="wrapper">

            <!-- ========== Left Sidebar Start ========== -->

            <?php $count_active_convo = $convo_active_count; include 'leftSideMenu_html.php'?>



            <!-- ============================================================== -->

            <!-- Start Page Content here -->

            <!-- ============================================================== -->



            <div class="content-page">

                <div class="content">

                    

                <?php include 'topbar_html.php'?>

                    <!-- Start Content-->

                    <div class="container-fluid">



                        <!-- start page title -->

                        <div class="row">

                            <div class="col-12">

                                <div class="page-title-box">

                                    <div class="page-title-right">

                                        <ol class="breadcrumb m-0">

                                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>profile/dashboard">Dashboard</a></li>

                                            <li class="breadcrumb-item">Upload avatar</li>

                                        </ol>

                                    </div>

                                    <h4 class="page-title">Upload Avatar</h4>

                                </div>

                            </div>

                        </div>

                        <!-- end page title -->



                        <div class="row">

 

                            <!-- Right Sidebar -->

                            <div class="col-12">

                                <p class="label">Note: Please choose image file only.</p>

                                <div class="card">

                                    <div class="card-body">

                                    <div class="statusMsg"></div>

                                    <form id="formavatar" action="<?php echo BASE_URL?>profile/uploadavatar" method="post" enctype="multipart/form-data">

                                        <div class="form-group">

                                                <input class="input-fileava" id="fileavat" type="file" accept="multipart/form-data" name="image" />

                                            <label for="fileavat" class="btn btn-tertiary js-labelFileava">

                                                <i class="icon fa fa-check"></i>

                                                <span class="js-fileNameava">Choose an image</span>

                                            </label>

                                        </div>

                                        <input class="btn btn-success submitBtnava" type="submit" value="Upload">



                                     </form>

   



                                        </div> 

                                        <!-- end inbox-rightbar-->

                                    </div>

                                    <!-- end card-body -->

                                    <div class="clearfix"></div>

                                </div> <!-- end card-box -->



                            </div> <!-- end Col -->

                        </div><!-- End row -->



                    </div> <!-- container -->



                </div> <!-- content -->



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