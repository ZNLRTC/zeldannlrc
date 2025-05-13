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
                                            <li class="breadcrumb-item">Documents</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Documents</h4>
                                </div>
                            </div>
                        </div>

                        <!-- end page title -->

                        <div class="row">
                            <!-- Right Sidebar -->
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="">
                                            <div class="mt-3">

                                                <?php
                                                    $check_one_value = true;
                                                    foreach ($user_documents as $key => $values) {
                                                        if (count($values) != 1) {
                                                            $check_one_value = false;
                                                            break;
                                                        }
                                                    }
                                                ?>
                                                <?php if ($check_one_value): ?>
                                                    <div class="alert alert-warning">
                                                        <p><i class="fas fa-info-circle"></i> <b>Attention: System Issue Detected</b></p>
                                                        <p>We recently experienced a system issue affecting document file formatting for many applicants. While our technical team has successfully resolved this issue, it required us to delete all previously uploaded documents. This step ensures that newly uploaded documents are properly renamed and organized within our system.</p>
                                                        <p>We appreciate your patience and cooperation during this process. If you encounter any further issues or have any questions, please don't hesitate to contact <a href="mailto:support@zeldannlrc.com">support@zeldannlrc.com</a> or click the "Message" on your sidebar or navigation bar.</p> 
                                                        <p>Thank you for your understanding.</p>
                                                    </div>
                                                <?php endif ?>

                                                <h5 class="mb-2">Uploaded Files</h5>

                                                <hr>

                                                <div class="row">

                                                    <?php foreach($user_documents as $key => $docs): ?>
                                                        <?php if (!($user['batch'] == 'fin' && ($docs['doc_id'] == '17' || $docs['doc_id'] == '18'))): ?>
                                                            <?php if(!($user['batch'] == 'kokki' && ($docs['doc_id'] == '6' || $docs['doc_id'] == '7'))): ?>
                                                                <div class="col-md-6">
                                                                    <div class="card m-1 shadow-none border">
                                                                        <div class="p-1">
                                                                            <div class="row align-items-center">
                                                                                <div class="col-auto">
                                                                                    <div class="avatar-sm">
                                                                                        <span class="avatar-title bg-light text-secondary rounded">
                                                                                            <i class="mdi mdi-folder-zip font-16"></i>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col ps-0">
                                                                                    <span  class="text-muted fw-bold"><?= $docs['description'] ?></aspan>
                                                                                    <p class="mb-0 font-13"><?= count($docs) > 2 ? $docs['size'] : '0' ?>KB</p>
                                                                                </div>

                                                                                <?php if(count($docs) > 2 && $docs['path'] != ""): ?>
                                                                                    <?php 
                                                                                        switch($docs['request_edit']){
                                                                                            case '0':
                                                                                                $title = "Request for removal";
                                                                                                $color = "text-success";
                                                                                            break;

                                                                                            case '1':
                                                                                                $title = "Waiting for approval";
                                                                                                $color = "text-secondary";
                                                                                            break;

                                                                                            case '2':
                                                                                                $title = "Delete document";
                                                                                                $color = "text-danger";
                                                                                            break;
                                                                                        }    
                                                                                    ?>

                                                                                    <div class="col-auto" id="tooltip-container9">
                                                                                    
                                                                                        <a  href="<?= BASE_URL . 'assets/documents/' . $docs['path'] ?>" target="_blank" id="prof_viewdoc" title="View" class="btn btn-link text-primary btn-lg p-0" >
                                                                                            <i class="fas fa-eye"></i>
                                                                                        </a>&nbsp;

                                                                                        <a href="<?= BASE_URL . 'assets/documents/' . $docs['path'] ?>" download document_name="" id="prof_download"  this_id ="" user_id = ""  title="Download" class="btn btn-link text-success btn-lg p-0" >
                                                                                            <i class="fas fa-download"></i>
                                                                                        </a>&nbsp;
                                                                                        
                                                                                        <a href="#" document_name="" id="prof_request"  this_id ="<?= $docs['id'] ?>" data-request-status="<?= $docs['request_edit'] ?>" class="btn btn-link text-black btn-lg p-0">
                                                                                            <i title="<?= $title ?>" class="fas fa-trash-alt <?= $color ?>"></i>
                                                                                        </a>
                                                                                    
                                                                                        <button href=""  document_name="" id="update-document-btn"  this_id ="" user_id = ""  title="Request for Update" class="btn btn-link text-primary btn-lg p-0" >
                                                                                            <i class="fas fa-upload text-warning"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                <?php else: ?>
                                                                                    <div class="col-auto" id="tooltip-container9">  
                                                                                        <a id="upload-<?= $key ?>" data-docu-name="<?= $docs['description'] ?>"  data-docu-type="<?= $key ?>" user_id = "<?= $user['id'] ?>" data-user-name="<?= $user['first_name'].'_'.$user['last_name'] ?>" title="Upload File" class="btn btn-link text-primary btn-lg p-0 upload-document-btn" >
                                                                                            <i class="fas fa-upload text-primary"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                <?php endif ?>
                                                                            </div>
                                                                        </div> 
                                                                    </div> 
                                                                </div>
                                                            <?php endif ?>
                                                        <?php endif ?>
                                                    <?php endforeach ?>


                                                </div>

                                                

                                                <hr>

                                                <h5 class="mb-2 d-none">Medical Certificate</h5>

                                                <div class="col-xxl-6 col-lg-6 d-none">
                                                        <div class="card m-1 shadow-none border">
                                                            <div class="p-1">
                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <div class="avatar-sm">
                                                                            <span class="avatar-title bg-light text-secondary rounded">
                                                                                <i class="mdi mdi-folder-zip font-16"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col ps-0">

                                                                <span  class="text-muted fw-bold"><?php echo $medCert['med_cert'];?></aspan>

                                                                

                                                            </div>

                                                            <?php

                                                                if($medCert['med_cert'] == 0 || $medCert['med_cert'] == ''){

                                                                    ?>

                                                                        <div class="col-auto" id="tooltip-container9">

                                                                    No File!

                                                                </div>

                                                                </a>&nbsp;

                                                                    <?php

                                                                    

                                                                }else{

                                                                    

                                                               

                                                                ?>

                                                                <div class="col-auto" id="tooltip-container9">

                                                                <!-- Button -->

                                                                <a document_name="<?php echo  $medCert['med_cert'];?>" id="med_viewdoc"  this_id ="<?php echo  $medCert['user_id'];?>" user_id = "<?php echo $docs['user_id'];?>"  title="View" class="btn btn-link text-primary btn-lg p-0" >

                                                                <i class='dripicons-preview'></i>

                                                                </a>&nbsp;

                                                                <a document_name="<?php echo  $medCert['med_cert'];?>" id="med_download"  this_id ="<?php echo $ $medCert['user_id'];?>" user_id = "<?php echo $docs['user_id'];?>"  title="Download" class="btn btn-link text-success btn-lg p-0" >

                                                                <i class='dripicons-cloud-download'></i>

                                                                </a>&nbsp;

                                                                

                                                            </div>

                                                                            <?php

                                                               

                                                                }

                                                                

                                                                ?>

                                                                </div> <!-- end row -->

                                                            </div> <!-- end .p-2-->

                                                        </div> <!-- end col -->

                                                    </div> <!-- end col-->

                                                  </div>

       

                                                </div> <!-- end row-->

                                            </div> <!-- end .mt-3-->

    

    

                                            



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





                                                <!--MODAL-->

                                                <!-- Login modal -->



<div id="uploadmodal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

                <div class="row">

                    <p class="label">Note: You're about to upload your <span id="docuName"></span>.</p>
                    <div class="statusMsg"></div>
                        <form id="form" action="<?php echo BASE_URL?>profile/upload" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input class="input-file1" id="us_id" type="hidden"  name="user_iid"  />
                                <input class="input-file2" id="docu_id" type="hidden"  name="docuID"  />
                                <input class="input-file" id="file" type="file" accept="multipart/form-data" name="image" />

                                <label for="file" class="btn btn-tertiary js-labelFile">
                                    <i class="icon fa fa-check"></i>
                                    <span class="js-fileName">Choose a file</span>
                                </label>

                            </div>

                            <hr>

                            <input class="btn btn-success submitBtn" type="submit" value="Upload">
                        </form>
                    </div> 
                <div class="clearfix"></div>

                </div>
            </div>
        </div>
    </div>

</div>




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