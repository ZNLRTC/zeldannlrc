<style>
/* Modal styling */
#pdfModal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

#pdfModal .modal-content {
    background-color: white;
    margin: 3% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

#pdfModal .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

#pdfModal .close:hover,
#pdfModal .close:focus {
    color: black;
    cursor: pointer;
}
</style>

<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

        <!-- Begin page -->

        <div class="wrapper">

            <!-- ========== Left Sidebar Start ========== -->

            <?php include __DIR__ . '/../admin_leftsidebar.php'; ?>

            <!-- ============================================================== -->

            <!-- Start Page Content here -->

            <!-- ============================================================== -->



            <div class="content-page">

                <div class="content">

                    <!-- Topbar Start -->

                    <?php include __DIR__ . '/../admin_topbar.php'; ?>

                    

                    

                    <!-- Start Content-->

                    <div id="applicants-view" class="container-fluid">



                        <!-- start page title -->

                           <!-- start page title -->

                        <div class="row">

                            <div class="col-12">

                                <div class="page-title-box">

                                    <div class="page-title-right">

                                        <ol class="breadcrumb m-0">

                                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>admin/dashboard">Dashboard</a></li>

                                            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>admin/applicants">Applicants</a></li>

                                            <li class="breadcrumb-item active">View</li>

                                        </ol>

                                    </div>

                                    <h4 class="page-title"> Applicant's Profile</h4>

                                </div>

                            </div>

                        </div> 

                        <!-- end page title --> 



                        <div class="row">

                            <div class="col-xl-4 col-lg-5">

                                <div class="card text-center">

                                    <div class="card-body">

                                        <?php
                                            switch($appli['flag_status']){
                                                case 'active':
                                                    $bg_status = 'bg-success';
                                                break;

                                                case 'inactive':
                                                    $bg_status = 'bg-warning';
                                                break;

                                                case 'on-hold':
                                                    $bg_status = 'bg-orange';
                                                break;

                                                case 'quit':
                                                    $bg_status = 'bg-red';
                                                break;

                                                case 'deployed':
                                                    $bg_status = 'bg-info';
                                                break;
                                            }
                                        ?>

                                        <img src="<?php echo BASE_URL_ASSETS; ?>images/users/<?php echo $appli['avatar']?>" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                        <h4 class="mb-0 mt-2"><?php echo $appli['first_name'] ?> <?php echo $appli['last_name']?></h4>
                                        <hr>
                                        <div class="text-start mt-3">
                                            <h4 class="font-13 text-uppercase mb-3">Flag Status:</h4>
                                            <p class="text-muted mb-2 font-13"><strong>Status:</strong> <span class="ms-2 "><small class="<?= $bg_status ?> rounded-pill px-2 py-1 text-white"><?= ucwords($appli['flag_status']) ?></small></span></p>
                                            <?php if($appli['flag_status'] == 'deployed'): ?>
                                                <div class="d-flex">
                                                    <p class="text-muted mb-2 font-13 me-3"><strong>Deployment Date:</strong> <span class="ms-2 "><?= $appli['deployment_date'] != null ? date('M d, Y', strtotime($appli['deployment_date'])) : 'Date not set' ?></span></p>
                                                    <i title="Edit Deployment Date" class="fas fa-pen pointer edit-deployment-date-btn" data-user-id = "<?= $appli['id'] ?>"></i>
                                                </div>
                                            <?php endif ?>
                                            <hr>

                                            <h4 class="font-13 text-uppercase">Personal Data:</h4>
                                            <p class="text-muted mb-2 font-13"><strong>Full Name:</strong> <span class="ms-2"><?= ucwords($appli['first_name'])." ".ucwords($appli['middlename'])." ".ucwords($appli['last_name'])  ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Mobile:</strong><span class="ms-2"><?= $appli['telephone_number']?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Email:</strong> <span class="ms-2 "><?= $appli['email']?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Discord Username:</strong> <span class="ms-2 "><?= $appli['discord']?></span></p>
                                            <p class="text-muted mb-1 font-13"><strong>Address:</strong> <span class="ms-2">
                                                <?php
                                                    if($appli['street_address'] == NULL ||$appli['postal_code'] == NULL || $appli['country'] == NULL){
                                                        echo "";
                                                    }else{
                                                        echo ucwords($appli['street_address']).", ".ucwords($appli['postal_code']).", ".ucwords($appli['country']);
                                                    }
                                                ?>
                                            </span></p>

                                            <p class="text-muted mb-2 font-13"><strong>Citizenship:</strong> <span class="ms-2 "><?= ucwords($appli['citizenship']) ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Gender:</strong> <span class="ms-2 "><?= ucwords($appli['gender']) ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Date of Birth:</strong> <span class="ms-2 "><?= $appli['birthdate'] ? date('M d, Y', strtotime($appli['birthdate'])) : '' ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Place of Birth:</strong> <span class="ms-2 "><?= ucwords($appli['birthplace']) ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Marital Status:</strong> <span class="ms-2 "><?= $appli['marital_status'] == 'lip' ? 'Live-in Partner / Common-law Partner' : ucwords($appli['marital_status']) ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Occupation/Training:</strong> <span class="ms-2 "><?= ucwords($appli['occupation']) ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Mother Tongue:</strong> <span class="ms-2 "><?= ucwords($appli['mother_tongue']) ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Destination:</strong> <span class="ms-2 "><?= $appli['name']?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Batch:</strong> <span class="ms-2 text-uppercase"><?= $appli['batch'] .' '. $appli['batch_number']?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Education:</strong> <span class="ms-2 text-uppercase"><?= $appli['education']?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Passed with more than 600 hours:</strong> <span class="ms-2"><?= $appli['passed'] != NULL ? $appli['passed'] == 1 ? 'Passed' : 'Failed' : '' ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Field of Work:</strong> <span class="ms-2"><?= ucwords($appli['field_of_work']) ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Work experience:</strong> <span class="ms-2"><?= $appli['years_work_experience'] != NULL ? $appli['years_work_experience'] != 0 ? $appli['years_work_experience'] .' Years' : 'No work experience' : '' ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Date of Applied:</strong> <span class="ms-2"><?= $appli['date_applied'] != NULL ? $appli['date_applied'] != '0000-00-00' ? date('M d, Y', strtotime($appli['date_applied'])) : '' : '' ?></span></p>

                                            <hr>

                                            <h4 class="font-13 text-uppercase">ZNLRC Needed Info:</h4>
                                            <p class="text-muted mb-2 font-13"><strong>Batch:</strong> <span class="ms-2 text-uppercase"><?= $appli['batch'] .' '. $appli['batch_number'] ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Education:</strong> <span class="ms-2 text-uppercase"><?= $appli['education'] ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Passed 600 hours:</strong> <span class="ms-2"><?= $appli['passed'] != NULL ? $appli['passed'] == 1 ? 'Passed' : 'Failed' : ''  ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Application date:</strong> <span class="ms-2"><?= $appli['date_applied'] != NULL ? $appli['date_applied'] != '0000-00-00' ? date('M d, Y', strtotime($appli['date_applied'])) : '' : '' ?></span></p>

                                            <hr>

                                            <h4 class="font-13 text-uppercase">Information On Passport:</h4>
                                            <p class="text-muted mb-2 font-13"><strong>Number:</strong> <span class="ms-2 "><?= ucwords($appli['passport_number']) ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Issued Country:</strong> <span class="ms-2 "><?= ucwords($appli['passport_issued_country']) ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Expiration:</strong> <span class="ms-2 "><?= ($appli['passport_date_from'] != NULL && $appli['passport_date_to'] != NULL) ? date("M d, Y", strtotime($appli['passport_date_from'])) .' - ' . date("M d, Y", strtotime($appli['passport_date_to'])) : '' ?></span></p>

                                            <hr>

                                            <h4 class="font-13 text-uppercase">Address:</h4>
                                            <p class="text-muted mb-2 font-13"><strong>Street Address:</strong> <span class="ms-2 "><?= ucwords($appli['street_address']) ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>City/Town, Postal Code:</strong> <span class="ms-2 "><?= ucwords($appli['postal_code']) ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Country:</strong> <span class="ms-2 "><?= ucwords($appli['country']) ?></span></p>

                                            <hr>
                                            <?php if(!empty($appli['spouse'])): 
                                               
                                                $spouse_former_name = $appli['spouse']['former_name'] != NULL ? "(" . ucwords($appli['spouse']['former_name']) .")" : '';
                                                $spouse_name = ucwords($appli['spouse']['first_name']) ." ". ucwords($appli['spouse']['last_name']) ." ". $spouse_former_name;
                                                $spouse_gender = ucwords($appli['spouse']['gender']);
                                                $spouse_birthdate = date('M d, Y', strtotime($appli['spouse']['birthdate']));
                                                $spouse_birthplace = ucwords($appli['spouse']['birth_place']);
                                                $spouse_citizenship = ucwords($appli['spouse']['citizenship']);
                                                $spouse_application = $appli['spouse']['move_to_finland'] == 1 ? 'Yes' : 'No (At this moment).';
                                            ?>

                                                <h4 class="font-13 text-uppercase">Spouse Information</h4>
                                                <p class="text-muted mb-2 font-13"><strong>Name:</strong> <span class="ms-2 "><?= $spouse_name ?></span></p>
                                                <p class="text-muted mb-2 font-13"><strong>Gender:</strong> <span class="ms-2 "><?= $spouse_gender ?></span></p>
                                                <p class="text-muted mb-2 font-13"><strong>Date of Birth:</strong> <span class="ms-2 "><?= $spouse_birthdate ?></span></p>
                                                <p class="text-muted mb-2 font-13"><strong>Place of Birth:</strong> <span class="ms-2 "><?= $spouse_birthplace ?></span></p>
                                                <p class="text-muted mb-2 font-13"><strong>Citizenship:</strong> <span class="ms-2 "><?= $spouse_citizenship ?></span></p>
                                                <p class="text-muted mb-2 font-13"><strong>Spouse will move to Finland?:</strong> <span class="ms-2 "><?= $spouse_application ?></span></p>
                                                <hr>
                                            <?php endif ?>

                                            <?php if(!empty($appli['children'])): ?>
                                                <h4 class="font-13 text-uppercase">Children Information</h4>

                                                <?php foreach($appli['children'] as $child):
                                                    $child_name = ucwords($child['first_name']) .' '. ucwords($child['last_name']);
                                                    $child_gender = ucwords($child['gender']);
                                                    $child_birthdate = date('M d, Y', strtotime($child['birthdate']));
                                                    $child_citizenship = ucwords($child['citizenship']);
                                                    $child_application_to_finland = $child['application'] == 1 ? 'Yes' : 'No (At this moment)'; 
                                                ?> 
                                                    <p class="text-muted mb-2 font-13"><strong>Name:</strong> <span class="ms-2 "><?= $child_name ?></span></p>
                                                    <p class="text-muted mb-2 font-13"><strong>Gender:</strong> <span class="ms-2 "><?= $child_gender ?></span></p>
                                                    <p class="text-muted mb-2 font-13"><strong>Date of Birth:</strong> <span class="ms-2 "><?= $child_birthdate ?></span></p>
                                                    <p class="text-muted mb-2 font-13"><strong>Citizenship:</strong> <span class="ms-2 "><?= $child_citizenship ?></span></p>
                                                    <p class="text-muted mb-4 font-13"><strong>Application To Finland?:</strong> <span class="ms-2 "><?= $child_application_to_finland ?></span></p>
                                                    
                                                <?php endforeach ?>
                                                <hr>
                                            <?php endif ?>

                                        </div>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col-->


                            <div class="col-xl-8 col-lg-7">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="bg-llight p-3 rounded">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="text-uppercase"><i class="dripicons-dloocument"></i> Trainee Additional Info</h5>
                                                <a href="messages?uid=<?= $appli['id'] ?>" class="btn btn-primary">Messages</a>
                                                
                                            </div>
                                            <hr>
                                            <?php if(count($info_update_requests) > 0): ?>
                                                <?php foreach($info_update_requests as $request): ?>
                                                    <span class="alert alert-warning text-dark d-block mb-1">Request Message: <b><?= $request['message'] ?></b></span>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                            <form id="trainee-additional-info" class="mt-3" action="<?= BASE_URL ?>" data-trainee-id="<?= $appli['id'] ?>">
                                                <div class="d-flex">
                                                    <div class="mb-3 col-md-6 <?= $appli['batch'] == NULL ? 'alert-danger' : '' ?>">
                                                        <label for="trainee-batch" class="form-label ">Batch *</label>
                                                        <select class="form-select" name="trainee-batch">
                                                            <option value="na" <?= $appli['batch'] == NULL ? 'selected' : '' ?> disabled>--Select Batch--</option>
                                                            <?php foreach($batches as $batch): ?>
                                                                <option data-batch-id="<?= $batch['id'] ?>" value="<?= $batch['name'] ?>" <?= $appli['batch'] ==  $batch['name'] ? 'selected' : '' ?>><?= strtoupper($batch['name']) ?></option>
                                                            <?php endforeach ?>
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="mb-3 col-md-6 <?= $appli['batch_number'] == NULL ? 'alert-danger' : '' ?>">
                                                        <label for="trainee-batch-number" class="form-label ">Number *</label>
                                                        <select class="form-select" name="trainee-batch-number" required>

                                                            <?php foreach($batches as $batch): ?>
                                                                <?php if($batch['name'] == $appli['batch']): ?>
                                                                    <?php foreach($batch['batch_numbers'] as $num): ?>
                                                                        <option class="batch-num-<?= $num['id'] ?>" value="<?= $num['batch_number'] ?>" <?= $num['batch_number'] == $appli['batch_number'] ? 'selected' : '' ?>><?= $num['batch_number'] ?></option>
                                                                    <?php endforeach ?>
                                                                <?php endif ?>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="mb-3 <?= $appli['education'] == NULL ? 'alert-danger' : '' ?>">
                                                    <label for="trainee-education" class="form-label ">Education *</label>
                                                    <select class="form-select" name="trainee-education">
                                                        <option value="na" <?= $appli['education'] == NULL ? 'selected' : '' ?> disabled>--Select Education--</option>
                                                        <option value="cg" <?= $appli['education'] == 'cg' ? 'selected' : '' ?>>Caregiver</option>
                                                        <option value="bsn" <?= $appli['education'] == 'bsn' ? 'selected' : '' ?>>Bachelor of Science in Nursing</option>
                                                        <option value="rn" <?= $appli['education'] == 'rn' ? 'selected' : '' ?>>Registered Nurse</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3 <?= $appli['passed'] == NULL ? 'alert-danger' : '' ?>">
                                                    <label for="trainee-passed" class="form-label ">Passed with more than 600 hours *</label>
                                                    <select class="form-select" name="trainee-passed" id="trainee-passed">
                                                        <option value="na" <?= $appli['passed'] == NULL ? 'selected' : '' ?> disabled>--Select Option--</option>
                                                        <option value="1" <?= $appli['passed'] == '1' ? 'selected' : '' ?>>Passed</option>
                                                        <option value="0" <?= $appli['passed'] == '0' ? 'selected' : '' ?>>Failed</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3 <?= ($appli['date_applied'] == NULL) ? 'alert-danger' : '' ?>">
                                                    <label for="trainee-application-date" class="form-label ">Application date *</label>
                                                    <input type="date" class="form-control" id="trainee-application-date" name="trainee-application-date" value="<?= ($appli['date_applied'] != NULL) ? $appli['date_applied'] : '' ?>">
                                                </div>

                                                <div class="col-md-12 d-flex justify-content-end mb-3">
                                                    <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="bg-llight p-3 rounded">
                                            <h5 class="text-uppercase"><i class="dripicons-dloocument"></i> Documents</h5>
                                            <hr>
                                            <div class="timeline-alt pb-0">

                                                <table id="ss" class="table dt-responsive nowrap w-100 table-striped">
                                                    <thead>
                                                        <th class="col-3">Type</th>
                                                        <th class="col-5">Title</th>
                                                        <th class="col-1">File size</th>
                                                        <th class="col-3">Action</th>
                                                    </thead>

                                                    <tbody>
                                                        <?php foreach($userDocu as $key => $doki): ?>
                                                            <?php if(($appli['batch'] == 'fin' && ($doki['document_type_id'] == '17' || $doki['document_type_id'] == '18')) || ($appli['batch'] == 'kokki' && ($doki['document_type_id'] == '6' || $doki['document_type_id'] == '7'))): ?>
                                                                <tr>
                                                                    <td><?= $doki['description'] ?></td>
                                                                    <td><i><small class="text-muted px-1 alert-danger rounded-pill">Document hidden from trainee</small></i></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                            <?php else: ?>
                                                                <tr>
                                                                    <td><?= $doki['description'] ?></td>
                                                                    <td><?= count($doki) > 2 ? $doki['path'] : '' ?></td>
                                                                    <td><?= count($doki) > 2 ? $doki['size'].'Kb' : '' ?></td>
                                                                    <td>
                                                                        <?php if(count($doki) > 2 ):  ?>
                                                                            <a title="View Document" class="btn btn-primary" href="#" onclick="openPdfViewer('<?= BASE_URL_ASSETS ?>documents/<?= $doki['path'] ?>'); return false;">
                                                                                <i class="fas fa-eye"></i>
                                                                            </a>

                                                                            <?php if($doki['request_edit'] == 1): ?>
                                                                                <a title="Approve Request" class="btn btn-warning approve-document-request-btn" data-document-id="<?= $doki['id'] ?>"><i class="fas fa-thumbs-up text-light"></i></a>
                                                                            <?php endif ?>
                                                                        <?php endif ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endif ?>
                                                        <?php endforeach ?>
                                                    </tbody>
                                                </table>  
                                            </div>
                                        </div>
                                        <!-- end about me section content -->
                                    </div> <!-- end card body -->

                                    <div class="card-body">
                                        <div class="bg-llight p-3 rounded">
                                            <h5 class="text-uppercase">Application Status History</h5>
                                            <hr>
                                            <div class="timeline-alt history-table-container pb-0">

                                                <table id="status-history-table" class="table dt-responsive nowrap w-100 table-striped">
                                                    <thead>
                                                        <th>Updated By</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                    </thead>

                                                    <tbody>
                                                        <?php foreach($status_history as $history): ?>
                                                            <tr>
                                                                <td><?= ucwords($history['admin_fname']) .' '. ucwords($history['admin_lname']) ?></td>
                                                                <td><?= ucwords($history['flag_status']) ?></td>
                                                                <td><?= date('M d, Y', strtotime($history['date_created'])) ?></td>
                                                            </tr>
                                                        <?php endforeach ?>
                                                    </tbody>
                                                </table>  
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="bg-llight p-3 rounded">
                                            <h5 class="text-uppercase">Approval History</h5>
                                            <hr>
                                            <div class="timeline-alt history-table-container pb-0">

                                                <table id="status-history-table" class="table dt-responsive nowrap w-100 table-striped">
                                                    <thead>
                                                        <th>Approved By</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                    </thead>

                                                    <tbody>
                                                        <?php foreach($approval_logs as $log): ?>
                                                            <tr>
                                                                <td><?= ucwords($log['admin_fname']) .' '. ucwords($log['admin_lname']) ?></td>
                                                                <td><?= ucwords($log['approval_status']) ?></td>
                                                                <td><?= date('M d, Y', strtotime($log['date_created'])) ?></td>
                                                            </tr>
                                                        <?php endforeach ?>
                                                    </tbody>
                                                </table>  
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="bg-llight p-3 rounded">
                                            <h5 class="text-uppercase">Batch History</h5>
                                            <hr>
                                            <div class="timeline-alt history-table-container pb-0">

                                                <table id="status-history-table" class="table dt-responsive nowrap w-100 table-striped">
                                                    <thead>
                                                        <th>Trainee</th>
                                                        <th>Updated By</th>
                                                        <th>Batch</th>
                                                        <th>Number</th>
                                                        <th>Date</th>
                                                    </thead>

                                                    <tbody>
                                                        <?php foreach($batch_history as $hist): ?>
                                                            <tr>
                                                                <td><?= ucwords($hist['trainee_fname']) .' '. ucwords($hist['trainee_lname']) ?></td>
                                                                <td><?= ucwords($hist['admin_fname']) .' '. ucwords($hist['admin_lname']) ?></td>
                                                                <td><?= strtoupper($hist['batch']) ?></td>
                                                                <td><?= $hist['batch_number'] ?></td>
                                                                <td><?= date('M d, Y', strtotime($hist['date_created'])) ?></td>
                                                            </tr>
                                                        <?php endforeach ?>
                                                    </tbody>
                                                </table>  
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end mt-3">
                                            <a class="btn btn-primary" href="#applicants-view"><i class="fas fa-arrow-up"></i> Back to Top</a>
                                        </div>
                                    </div>
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->
                    </div>
                    <!-- container -->
                </div>
                <!-- content -->



                <!-- Footer Start -->

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> © ZNLRC
                            </div>

                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none">
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
        </div>

<!-- Login modal -->


<div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mt-2 mb-4">
                    <a href="index.html" class="text-success">
                        <span><img src="assets/images/logo-dark.png" alt="" height="18"></span>
                    </a>
                </div>



                <form id = "changePassword" action="<?php echo BASE_URL; ?>profile/changePassword" class="ps-3 pe-3">
                    <div class="alert alert-danger d-none alert-dismissible align-items-center fade show" id="alertPass">
                        <i class="bi-check-circle-fill"></i>
                        <strong class="mx-2">Error!</strong> Password do not match!
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>                          

                    <div class="mb-3">
                        <label for="password1" class="form-label">Password</label>
                        <input class="form-control" type="password" name = "pass1" id="password1" required="" placeholder="Enter new password">
                        <input class="form-control" type="hidden" id="user_pass" name="uid" value="<?php echo $user['id'] ?>" placeholder="Enter new password">
                    </div>

                    <div class="mb-3">
                        <label for="password1" class="form-label">Confirm Password</label>
                        <input class="form-control" type="password" name="pass2" required="" id="password2" placeholder="Confirm your new password">
                    </div>

                    <div class="mb-3 text-center">
                        <button class="btn btn-rounded btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="pdfModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closePdfViewer()">&times;</span>
        <iframe id="pdfFrame" style="width: 100%; height: 80vh;" src=""></iframe>
    </div>
</div>


<script>
    function openPdfViewer(pdfUrl) {
        const iframe = document.getElementById("pdfFrame");
        iframe.src = pdfUrl + "#toolbar=0"; // Disabling PDF viewer toolbar
        document.getElementById("pdfModal").style.display = "block";

        // Disable right-click only within the iframe content
        iframe.contentWindow.document.addEventListener("contextmenu", function(e) {
            e.preventDefault();
        });
    }

    function closePdfViewer() {
        document.getElementById("pdfModal").style.display = "none";
        document.getElementById("pdfFrame").src = ""; // Clear iframe src to stop loading PDF
    }
</script>


</body>