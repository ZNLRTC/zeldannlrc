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
                    <!-- Topbar Start -->
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Profile</a></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> Profile</h4>
                                </div>
                            </div>
                        </div>    

                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-xl-4 col-lg-5">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <img src="<?php echo BASE_URL_ASSETS; ?>images/users/<?php echo $user['avatar']?>" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                        <h4 class="mb-0 mt-2"><?php echo $user['first_name'] ?> <?php echo $user['last_name']?></h4>
                                        <a type="button" href="<?php echo BASE_URL; ?>profile/avatar" class="btn btn-primary btn-sm mb-2">Update Avatar</a>

                                        <hr>

                                        <div class="text-start mt-3">

                                            <?php 
                                                $former_name = ($user['former_name'] != null) ? '('.ucwords($user['former_name']).')' : '';
                                                switch($user['education']){
                                                    case 'cg':
                                                        $education = 'Caregiver';
                                                    break;
                                                    case 'bsn':
                                                        $education = 'Bachelor of Science in Nursing';
                                                    break;
                                                    case 'rg':
                                                        $education = 'Registered Nurse';
                                                    break;
                                                    default: 
                                                        $education = 'Our admin will update your education field.';
                                                    break;
                                                }

                                                if($user['passed'] == '1'){
                                                    $passed = 'Passed';
                                                }else{
                                                    $passed = 'Failed';
                                                }

                                                switch($user['years_work_experience']){
                                                    case '0':
                                                        $exp = 'No work experience';
                                                    break;
                                                    case '1':
                                                        $exp = '1 to 3 years work experience';
                                                    break;
                                                    case '2':
                                                        $exp = 'More than 3 years of work experience';
                                                    break;
                                                    default: 
                                                        $exp = 'No work experience';
                                                    break;
                                                }

                                                $batch = ($user['batch'] != NULL) ? $user['batch'] : '';
                                                $batch_no = ($user['batch_number'] != NULL) ? $user['batch_number'] : '';

                                                if($user['education'] != NULL){
                                                    switch($user['education']){
                                                        case 'cg':
                                                            $education = 'Care Giver';
                                                        break;

                                                        case 'bsn':
                                                            $education = 'Bachelor of Science in Nursing';
                                                        break;

                                                        case 'rn': 
                                                            $education = 'Registered Nurse';
                                                        break;

                                                        case 'chef':
                                                            $education = 'Chef';
                                                        break;

                                                        default:
                                                            $education = 'Please update education field.';
                                                        break;
                                                    }
                                                }else{
                                                    $education = 'Please update education field.';
                                                }
                                                
                                            ?>

                                            <h4 class="font-13 text-uppercase">Personal Data</h4>
                                            <p class="text-muted mb-2 font-13"><strong>Name:</strong> <span class="ms-2"><?= $user['first_name']." ".$user['middlename']." ".$user['last_name']." ".$former_name  ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Email:</strong> <span class="ms-2"><?= $user['email'] ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Discord Username:</strong><span class="ms-2"><?= $user['discord'] != NULL ? $user['discord'] : '' ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Gender:</strong><span class="ms-2"><?= $user['gender'] != NULL ? $user['gender'] : 'Please update gender field.' ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Citizenship:</strong><span class="ms-2"><?= $user['citizenship'] != NULL ? $user['citizenship'] : 'Please update citizenship field.' ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Date of Birth:</strong><span class="ms-2"><?= $user['birthdate'] != NULL ? date('M d, Y', strtotime($user['birthdate'])) : 'Please update date of birth field.' ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Place of Birth:</strong><span class="ms-2"><?= $user['birthplace'] != NULL ? ucwords($user['birthplace']) : 'Please update place of birth field.' ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Marital Status:</strong><span class="ms-2"><?= $user['marital_status'] != NULL ? $user['marital_status'] == 'lip' ? 'Live-in Partner / Common-law Partner' : ucwords($user['marital_status']) : 'Please marital status field.' ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Occupation:</strong><span class="ms-2"><?= $user['occupation'] != NULL ? ucwords($user['occupation']) : 'Please occupation field.' ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Mother Tongue:</strong><span class="ms-2"><?= $user['mother_tongue'] != NULL ? ucwords($user['mother_tongue']) : 'Please update mother tongue field.' ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Batch:</strong><span class="ms-2 <?= $user['batch'] != NULL ? 'text-uppercase' : '' ?>"><?= $batch .' '. $batch_no ?></span></p>
                                            
                                            <hr>

                                            <h4 class="font-13 text-uppercase">ZNLRC Information</h4>
                                            <p class="text-muted mb-2 font-13"><strong>Batch:</strong><span class="ms-2 text-uppercase"><?= ($user['batch'] != NULL && $user['batch_number'] != NULL) ? $user['batch'] .' '. $user['batch_number'] : 'Please update batch number field.' ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Education:</strong><span class="ms-2 "><?= $education ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>600 Hours:</strong><span class="ms-2 "><?= $user['passed'] != NULL ? $user['passed'] == 1 ? 'Passed' : 'Failed' : 'Please update this field.' ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Application Date:</strong><span class="ms-2 "><?= $user['date_applied'] != NULL ? date('M d, Y', strtotime($user['date_applied'])) : 'Please update Application date field.' ?></span></p>
                                            <hr>

                                            <h4 class="font-13 text-uppercase">Information on Passport</h4>
                                            <p class="text-muted mb-2 font-13"><strong>Number:</strong><span class="ms-2 "><?= $user['passport_number'] != NULL ? ucwords($user['passport_number']) : 'Please update passport number field.' ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Country and authority of issue:</strong><span class="ms-2 "><?= $user['passport_issued_country'] != NULL ? ucwords($user['passport_issued_country']) : 'Please update passport issued country field.' ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Date of expiry:</strong><span class="ms-2 "><?= ($user['passport_date_from'] != NULL && $user['passport_date_to'] != NULL) ? date('M d, Y', strtotime($user['passport_date_from'])) .' - '. date('M d, Y', strtotime($user['passport_date_to'])) : 'Please update passport expiry date field.' ?></span></p>
                                            <hr>

                                            <h4 class="font-13 text-uppercase">Address</h4>
                                            <p class="text-muted mb-2 font-13"><strong>Street Address:</strong><span class="ms-2 "><?= $user['street_address'] != NULL ? ucwords($user['street_address']) : 'Please update street address field.' ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>City/Town, Postal Code:</strong><span class="ms-2 "><?= $user['postal_code'] != NULL ? ucwords($user['postal_code']) : 'Please update city/town, postal code field.' ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Country:</strong><span class="ms-2 "><?= $user['country'] != NULL ? ucwords($user['country']) : 'Please update country field.' ?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Telephone Number:</strong><span class="ms-2 "><?= $user['telephone_number'] != NULL ? ucwords($user['telephone_number']) : 'Please update telephone number field.' ?></span></p>
                                            <hr>

                                            <?php 
                                                if(!empty($user['spouse'])):
                                                    $spouse_name = $user['spouse']['first_name'] .' '. $user['spouse']['last_name'] .' '. ($user['spouse']['former_name'] != NULL ? '('.$user['spouse']['former_name'].')' : '');
                                                    $spouse_gender = $user['spouse']['gender'];
                                                    $spouse_birthdate = date('M d, Y', strtotime($user['spouse']['birthdate']));
                                                    $spouse_birthplace = ucwords($user['spouse']['birth_place']);
                                                    $spouse_citizenship = ucwords($user['spouse']['citizenship']);
                                                    $spouse_move = ($user['spouse']['move_to_finland']) == 1 ? 'Yes' : 'No (At this point)';
                                            ?>
                                                <h4 class="font-13 text-uppercase">Spouse Information</h4>
                                                <p class="text-muted mb-2 font-13"><strong>Name:</strong><span class="ms-2 "><?= $spouse_name ?></span></p>
                                                <p class="text-muted mb-2 font-13"><strong>Gender:</strong><span class="ms-2 "><?= $spouse_gender ?></span></p>
                                                <p class="text-muted mb-2 font-13"><strong>Date of Birth:</strong><span class="ms-2 "><?= $spouse_birthdate ?></span></p>
                                                <p class="text-muted mb-2 font-13"><strong>Place of Birth:</strong><span class="ms-2 "><?= $spouse_birthplace ?></span></p>
                                                <p class="text-muted mb-2 font-13"><strong>Citizenship:</strong><span class="ms-2 "><?= $spouse_citizenship ?></span></p>
                                                <p class="text-muted mb-2 font-13"><strong>Move to Finland:</strong><span class="ms-2 "><?= $spouse_move ?></span></p>
                                                <hr>
                                            <?php endif ?>

                                            <?php if(!empty($user['children'])): ?>
                                                <h4 class="font-13 text-uppercase">Children Information</h4>
                                                <?php foreach($user['children'] as $child): 
                                                    $child_name = ucwords($child['first_name']) .' '. ucwords($child['last_name']);
                                                    $child_gender = ucwords($child['gender']);
                                                    $child_birthdate = date('M d,Y', strtotime($child['birthdate']));
                                                    $child_citizenship = ucwords($child['citizenship']);
                                                    $child_application = $child['application'] == 1 ? 'Yes' : 'No (At this point)';
                                                ?>

                                                <p class="text-muted mb-2 font-13"><strong>Name:</strong><span class="ms-2 "><?= $child_name ?></span></p>
                                                <p class="text-muted mb-2 font-13"><strong>Gender:</strong><span class="ms-2 "><?= $child_gender ?></span></p>
                                                <p class="text-muted mb-2 font-13"><strong>Date of Birth:</strong><span class="ms-2 "><?= $child_birthdate ?></span></p>
                                                <p class="text-muted mb-2 font-13"><strong>Citizenship:</strong><span class="ms-2 "><?= $child_citizenship ?></span></p>
                                                <p class="text-muted mb-2 font-13"><strong>Move to Finaland:</strong><span class="ms-2 "><?= $child_application ?></span></p>
                                                <hr>

                                                <?php endforeach ?>
                                            <?php endif ?>
                                            
                                        </div>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col-->



                            <div class="col-xl-8 col-lg-7">
                                <div class="card">
                                    <div class="card-body">
                                        <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">

                                            <li class="nav-item">
                                                <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">Settings</a>
                                            </li>
                                        </ul>

                                        <div class="tab-pane show active" id="settings"> 
                                            <form id="form-personal-data" action=<?= BASE_URL ?>>
                                                <div class="row">
                                                    <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle me-1"></i> Personal Data</h5>
                                                    <div class="response"></div>

                                                    <div class="col-md-6 ">
                                                        <div class="mb-3 <?= $user['first_name'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label for="firstname" class="form-label ">First Name *</label>
                                                            <input type="text" value="<?= ucwords($user['first_name']) ?>" name="firstname" class="form-control" id="firstname" placeholder="Enter first name">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="middlename" class="form-label">Middle Name (Otional)</label>
                                                            <input type="text" value="<?= ucwords($user['middlename']) ?>" name="middlename" class="form-control" id="middlename" placeholder="Enter middle name">
                                                        </div>

                                                    </div> 

                                                    <div class="col-md-6">
                                                        <div class="mb-3 <?= $user['last_name'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label for="lastname" class="form-label">Last Name *</label>
                                                            <input type="text" value="<?= ucwords($user['last_name']) ?>" name="lastname" class="form-control" id="lastname" placeholder="Enter last name" required>
                                                        </div>

                                                    </div> 

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="formername" class="form-label">Former Name (Optional)</label>
                                                            <input type="text" value="<?= ucwords($user['former_name']) ?>" name="formername" class="form-control" id="formername" placeholder="Enter former name">
                                                        </div>
                                                    </div> 

                                                    <div class="col-md-6">
                                                        <div class="mb-3 <?= $user['gender'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label for="gender" class="form-label">Gender *</label>
                                                            <select class="form-select" name="gender" required>
                                                                <option disabled value="na">--Select gender--</option>
                                                                <option value="male" <?= $user['gender'] == 'male' ? 'selected' : '' ?>>Male</option>
                                                                <option value="female" <?= $user['gender'] == 'female' ? 'selected' : '' ?>>Female</option>
                                                            </select>
                                                        </div>
                                                    </div> 

                                                    <div class="col-md-6">
                                                        <div class="mb-3 <?= $user['citizenship'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label for="lastname" class="form-label">Current Citizenship *</label>
                                                            <input type="text" value="<?= ucwords($user['citizenship']) ?>" name="citizenship" class="form-control" placeholder="Enter Citizenship" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3 <?= $user['birthdate'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label for="birthdate" class="form-label">Date of Birth *</label>
                                                            <input type="date" value="<?= $user['birthdate'] ?>" name="birthdate" class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3 <?= $user['birthplace'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label for="lastname" class="form-label">Country and Place of Birth *</label>
                                                            <input type="text" value="<?= ucwords($user['birthplace']) ?>" name="country-birth-place" class="form-control" placeholder="Country, city and region" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3 <?= $user['marital_status'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label for="lastname" class="form-label">Marital Status *</label>
                                                            <select class="form-select" name="marital-status" required>
                                                                <option disabled value="na">--Select marital status--</option>
                                                                <option value="single" <?= $user['marital_status'] == 'single' ? 'selected' : '' ?>>Single</option>
                                                                <option value="married" <?= $user['marital_status'] == 'married' ? 'selected' : '' ?>>Married</option>
                                                                <option value="lip" <?= $user['marital_status'] == 'lip' ? 'selected' : '' ?>>Live-in Partner / Common-law Partner</option>
                                                                <option value="divorced" <?= $user['marital_status'] == 'divorced' ? 'selected' : '' ?>>Divorced</option>
                                                                <option value="widowed" <?= $user['marital_status'] == 'widowed' ? 'selected' : '' ?>>Widowed</option>
                                                                <option value="others" <?= $user['marital_status'] == 'others' ? 'selected' : '' ?>>Others</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3 <?= $user['occupation'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label for="lastname" class="form-label">Occupation and/or Training *</label>
                                                            <input type="text" value="<?= ucwords($user['occupation']) ?>" name="occupation" class="form-control" placeholder="Enter occupation" required>
                                                        </div>
                                                    </div> <!-- end col -->

                                                    <div class="col-md-6">
                                                        <div class="mb-3 <?= $user['mother_tongue'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label for="lastname" class="form-label">Mother Tongue *</label>
                                                            <input type="text" value="<?= ucwords($user['mother_tongue']) ?>" name="mother-tongue" class="form-control" placeholder="Enter mother tongue" required>
                                                        </div>
                                                    </div> <!-- end col -->

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="discord" class="form-label">Discord Username</label>
                                                            <input type="text" value="<?= $user['discord'] ?>" name="discord" class="form-control" placeholder="Enter discord username">
                                                        </div>
                                                    </div> 

                                                    <div class="col-md-6">
                                                        <div class="<?= $user['field_of_work'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label for="field_of_work" class="form-label">Field Of Work *</label>
                                                            <input type="text" value="<?= $user['field_of_work'] ?>" name="field_of_work" class="form-control" placeholder="Enter field of work" required>
                                                        </div>
                                                    </div> 

                                                    <div class="col-md-6">
                                                        <div class="<?= $user['years_work_experience'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label class="form-label" for="years-work-experience">Work experience in years *</label>
                                                            <select name="years-work-experience" class="form-select">
                                                                <option value="na" <?= $user['years_work_experience'] == NULL ? 'selected' : '' ?>>--Select years of work exprience--</option>
                                                                <option value="0" <?= $user['years_work_experience'] == '0' ? 'selected' : '' ?>>No work experience</option>
                                                                <option value="1" <?= $user['years_work_experience'] == '1' ? 'selected' : '' ?>>1 to 3 years</option>
                                                                <option value="2" <?= $user['years_work_experience'] == '2' ? 'selected' : '' ?>>More than 3 years</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 d-flex justify-content-end mb-3">
                                                        <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Update Personal Data</button>
                                                    </div>
                                                </div> <!-- end row -->
                                            </form>

                                            <form id="trainee-additional-info" action="<?= BASE_URL ?>" data-trainee-id="<?= $user['id'] ?>">
                                                <h5 class="text-uppercase bg-light p-2"><i class="mdi mdi-account-circle me-1"></i> Zeldan Nordic Language & Review Center Information</h5>
                                                <div class="response"></div>
                                                
                                                <?php if($user['education'] == NULL && $user['passed'] == NULL && $user['date_applied'] == NULL): ?>
                                                    <small class="d-block mb-4 text-warning"><i class="fas fa-info-circle"></i> Please ensure that all information provided here is correct. This section can only be filled out once. </small>

                                                    <div class="d-flex">
                                                        <div class="mb-3 col-md-6 <?= $user['batch'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label for="trainee-batch" class="form-label ">Batch *</label>
                                                            <input class="form-control disabled" name="trainee-batch" value="<?= strtoupper($user['batch']) ?>" >
                                                        </div>
                                                        <div class="mb-3 col-md-6 <?= $user['batch_number'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label for="trainee-batch-number" class="form-label ">Number *</label>
                                                            <input class="form-control" name="trainee-batch-number" value="<?= $user['batch_number'] ?>" >
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 <?= $user['education'] == NULL ? 'alert-danger' : '' ?>">
                                                        <label for="trainee-education" class="form-label ">Education *</label>
                                                        <select class="form-select" name="trainee-education" required>
                                                            <option value="na" <?= $user['education'] == NULL ? 'selected' : '' ?> disabled>--Select Education--</option>
                                                            <option value="cg" <?= $user['education'] == 'cg' ? 'selected' : '' ?>>Caregiver</option>
                                                            <option value="bsn" <?= $user['education'] == 'bsn' ? 'selected' : '' ?>>Bachelor of Science in Nursing</option>
                                                            <option value="rn" <?= $user['education'] == 'rn' ? 'selected' : '' ?>>Registered Nurse</option>
                                                            <option value="chef" <?= $user['education'] == 'chef' ? 'selected' : '' ?>>Chef</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3 <?= $user['passed'] == NULL ? 'alert-danger' : '' ?>">
                                                        <label for="trainee-passed" class="form-label ">Passed with more than 600 hours *</label>
                                                        <select class="form-select" name="trainee-passed" id="trainee-passed" required>
                                                            <option value="na" <?= $user['passed'] == NULL ? 'selected' : '' ?> disabled>--Select Option--</option>
                                                            <option value="1" <?= $user['passed'] == '1' ? 'selected' : '' ?>>Passed</option>
                                                            <option value="0" <?= $user['passed'] == '0' ? 'selected' : '' ?>>Failed</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3 <?= ($user['date_applied'] == NULL) ? 'alert-danger' : '' ?>">
                                                        <label for="trainee-application-date" class="form-label ">Application date (Date of first orientation)*</label>
                                                        <input type="date" class="form-control" id="trainee-application-date" name="trainee-application-date" value="<?= ($user['date_applied'] != NULL) ? $user['date_applied'] : '' ?>" required>
                                                    </div>

                                                    <div class="col-md-12 d-flex justify-content-end mb-3">
                                                        <button type="submit" class="btn btn-success mt-2"><i class="fas fa-check"></i> Submit</button>
                                                    </div>
                                                <?php else: ?>
                                                    <small class="d-block mb-4 text-warning"><i class="fas fa-info-circle"></i> You have already submitted your information in this section. Only the administrator can edit this information. If you require any changes, kindly click the button below and provide the necessary modifications. Thank you. </small>

                                                    <div class="col-md-12 mb-3">
                                                        <a href="request-update" data-user-id="<?= $user['id'] ?>" class="mt-2 request-update-znlrc-info-btn pointer"><u>Request for update</u></a>
                                                    </div>
                                                <?php endif ?>
                                            </form>
                                            
                                            <form id="form-passport-information" action="<?= BASE_URL ?>">
                                                <div class="row">
                                                    <div class="w-100">
                                                        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="fas fa-passport"></i> Information on Passport </h5>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3 <?= $user['passport_number'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label for="passport-no" class="form-label ">Passport Number *</label>
                                                            <input type="text" value="<?= $user['passport_number'] ?>" id="passport-no" name="passport-no" class="form-control" placeholder="Enter passport number">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3 <?= $user['passport_issued_country'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label for="passport-issued-country" class="form-label ">Country and authority of issue *</label>
                                                            <input type="text" value="<?= ucwords($user['passport_issued_country']) ?>" id="passport-issued-country" name="passport-issued-country" class="form-control" placeholder="Enter passport issued country">
                                                        </div>
                                                    </div>

                                                    <label class="form-label w-100">Date of Expiry *</label>
                                                    <div class="col-md-6">
                                                        <div class="<?= $user['passport_date_from'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label for="expiry-from" class="form-label ">From</label>
                                                            <input type="date" value="<?= $user['passport_date_from'] ?>" id="expiry-from" name="expiry-from" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="<?= $user['passport_date_to'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label for="expiry-to" class="form-label ">To</label>
                                                            <input type="date" value="<?= $user['passport_date_to'] ?>" id="expiry-to" name="expiry-to" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 d-flex justify-content-end mb-3">
                                                        <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Update Passport Information</button>
                                                    </div>
                                                </div>
                                            </form>

                                            <form id="form-address" action="<?= BASE_URL ?>">
                                                <div class="row"> <!-- Address container -->
                                                    <h5 class="mb-3 text-uppercase bg-light p-2"><i class="fas fa-home"></i> Address </h5>
                                                    <div class="address-response"></div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="mb-3 <?= $user['street_address'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label for="street-address" class="form-label">Street Address *</label>
                                                            <input type="text" value="<?= $user['street_address'] ?>" class="form-control" name="street-address" id="street-address" placeholder="Enter street address" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3 <?= $user['postal_code'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label for="postal-code" class="form-label">City/Town, Postal Code *</label>
                                                            <input type="text" value="<?= $user['postal_code'] ?>" class="form-control" name="postal-code" id="postal-code" placeholder="Enter postal code" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="<?= $user['country'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label for="country" class="form-label">Country *</label>
                                                            <input type="text" value="<?= $user['country'] ?>" class="form-control" name="country" id="country" placeholder="Enter country" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="<?= $user['telephone_number'] == NULL ? 'alert-danger' : '' ?>">
                                                            <label for="tel-no" class="form-label">Telephone Number *</label>
                                                            <input type="num" value="<?= $user['telephone_number'] ?>" class="form-control" name="tel-no" id="tel-no" placeholder="Enter telephone number" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 d-flex justify-content-end mb-3">
                                                        <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Update Address</button>
                                                    </div>
                                                </div>
                                            </form>

                                            <div> <!-- Information on family members -->
                                                <div class="w-100">
                                                    <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-map-marker-check me-1"></i> Information on Family Members </h5>
                                                </div>
                                                <div class="family-members-response"></div>

                                                <div class="w-100 mb-3">
                                                    <b class="d-block mb-2">Spouse Information: </b>
                                                    <div class="form-check me-3">
                                                        <input class="form-check-input" type="checkbox" name="spouse" id="spouse-check" data-url="<?= BASE_URL ?>" <?= $user['has_spouse'] == 0 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="spouse-check">No Spouse (Check if no spouse)</label>
                                                    </div>
                                                </div>

                                                <form id="form-spouse" action="<?= BASE_URL ?>">
                                                    <div class="row spouse-info-con <?= $user['has_spouse'] == 0 ? 'd-none' : '' ?>">
                                                        <div class="col-md-6">
                                                            <div class="mb-3 <?= !empty($user['spouse']) ? $user['spouse']['last_name'] == NULL ? 'alert-danger' : '' : 'alert-danger' ?>">
                                                                <label for="spouse-last-name" class="form-label">Last Name *</label>
                                                                <input type="text" value="<?= !empty($user['spouse']) ? ucwords($user['spouse']['last_name']) : '' ?>" class="form-control" name="spouse-last-name" id="spouse-last-name" placeholder="Enter spouse's last name" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="mb-3 <?= !empty($user['spouse']) ? $user['spouse']['last_name'] == NULL ? 'alert-danger' : '' : 'alert-danger' ?>">
                                                                <label for="spouse-first-name" class="form-label">First Name *</label>
                                                                <input type="text" value="<?= !empty($user['spouse']) ? ucwords($user['spouse']['first_name']) : '' ?>" class="form-control" name="spouse-first-name" id="spouse-first-name" placeholder="Enter spouse's first name" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="spouse-former-name" class="form-label">Former Name (Optional)</label>
                                                                <input type="text" value="<?= !empty($user['spouse']) ? ucwords($user['spouse']['former_name']) : '' ?>" class="form-control" name="spouse-former-name" id="spouse-former-name" placeholder="Enter spouse's former name">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="mb-3 <?= !empty($user['spouse']) ? $user['spouse']['gender'] == NULL ? 'alert-danger' : '' : 'alert-danger' ?>">
                                                                <label for="spouse-first-name" class="form-label">Gender *</label>
                                                                <select name="spouse-gender" class="form-select" required>
                                                                    <option value="na" <?= !empty($user['spouse']) ? $user['spouse']['gender'] == NULL ? 'selected' : '' : 'selected' ?> disabled>--Select Gender--</option>
                                                                    <option value="male" <?= !empty($user['spouse']) ? $user['spouse']['gender'] == 'male' ? 'selected' : '' : '' ?>>Male</option>
                                                                    <option value="female" <?= !empty($user['spouse']) ? $user['spouse']['gender'] == 'female' ? 'selected' : '' : '' ?>>Female</option>
                                                                </select> 
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="mb-3 <?= !empty($user['spouse']) ? $user['spouse']['birthdate'] == NULL ? 'alert-danger' : '' : 'alert-danger' ?>">
                                                                <label for="spouse-birthdate" class="form-label">Date of Birth *</label>
                                                                <input type="date" value="<?= !empty($user['spouse']) ? ucwords($user['spouse']['birthdate']) : '' ?>" class="form-control" name="spouse-birthdate" id="spouse-birthdate"  required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <div class="mb-3 <?= !empty($user['spouse']) ? $user['spouse']['birth_place'] == NULL ? 'alert-danger' : '' : 'alert-danger' ?>">
                                                                <label for="spouse-birth-place" class="form-label">Place of Birth *</label>
                                                                <input type="text" value="<?= !empty($user['spouse']) ? ucwords($user['spouse']['birth_place']) : '' ?>" class="form-control" name="spouse-birth-place" id="spouse-birth-place" placeholder="Enter spouse's place of birth" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="<?= !empty($user['spouse']) ? $user['spouse']['citizenship'] == NULL ? 'alert-danger' : '' : 'alert-danger' ?>">
                                                                <label for="spouse-citizenship" class="form-label">Citizenship *</label>
                                                                <input type="text" value="<?= !empty($user['spouse']) ? ucwords($user['spouse']['citizenship']) : '' ?>" class="form-control" name="spouse-citizenship" id="spouse-citizenship" placeholder="Enter spouse's citizenship" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="<?= !empty($user['spouse']) ? $user['spouse']['move_to_finland'] == NULL ? 'alert-danger' : '' : 'alert-danger' ?>">
                                                                <label for="spouse-move" class="form-label"><i>My spouse will move to Finland</i> *</label>
                                                                <select name="spouse-move-to-finland" class="form-select" id="spouse-move" required>
                                                                    <option value="1" <?= !empty($user['spouse']) ? $user['spouse']['move_to_finland'] == '1' ? 'selected' : '' : '' ?>>Yes</option>
                                                                    <option value="0" <?= !empty($user['spouse']) ? $user['spouse']['move_to_finland'] == '0' ? 'selected' : '' : '' ?>>No (At this point)</option>
                                                                </select> 
                                                            </div>
                                                        </div>

                                                        <div class="d-flex justify-content-end mb-3">
                                                            <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Update Spouse Information</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                
                                                <div class="w-100 mb-3">
                                                    <b class="d-block mb-2">Children Information: </b>
                                                    <div class="form-check me-3">
                                                        <input class="form-check-input" type="checkbox" name="child-check" id="child-check" data-url="<?= BASE_URL ?>" <?= $user['has_children'] == 0 ? 'checked' : '' ?> <?= !empty($user['children']) ? 'disabled' : '' ?>>
                                                        <label class="form-check-label" for="child-check">No Child (Check if no child)</label>

                                                    </div>
                                                </div>

                                                
                                                <form id="form-child" action="<?= BASE_URL ?>">
                                                    <div class="w-100 child-info-container">
                                                        <input type="hidden" name="child-count" value="<?= !empty($user['children']) ? count($user['children']) : '0' ?>">
                                                        

                                                            <?php if(!empty($user['children'])): $i = -1 ?>
                                                                <?php foreach($user['children'] as $child): $i++;  ?>
                                                                    <div class="row child-info-container-<?= $i ?>">
                                                                        <div class="w-100 text-danger d-flex justify-content-end">
                                                                            <a class="btn-danger btn child-con-close-btn" data-url="<?= BASE_URL ?>" data-btn-id="<?= $i ?>" data-child-id="<?= $child['id'] ?>"><i class="fas fa-window-close"></i> <b>Delete</b></a>
                                                                        </div>

                                                                        <input type="hidden" name="child-id-<?= $i ?>" value="<?= $child['id'] ?>">

                                                                        <div class="col-md-6 mb-3 child-count">
                                                                            <label for="child-last-name-<?= $i ?>" class="form-label">Last Name *</label>
                                                                            <input type="text" value="<?= ucwords($child['last_name']) ?>" class="form-control" name="child-last-name-<?= $i ?>" id="child-last-name-<?= $i ?>" placeholder="Enter child's last name" required>
                                                                        </div>

                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="child-first-name-<?= $i ?>" class="form-label">First Name *</label>
                                                                            <input type="text" value="<?= ucwords($child['first_name']) ?>" class="form-control" name="child-first-name-<?= $i ?>" id="child-first-name-<?= $i ?>" placeholder="Enter child's first name" required>
                                                                        </div>

                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="child-gender-<?= $i ?>" class="form-label">Gender *</label>
                                                                            <select class="form-select" name="child-gender-<?= $i ?>" id="child-gender-<?= $i ?>">
                                                                                <option value="na" <?= $child['gender'] == NULL ? 'selected' : '' ?> disabled>--Select Gender--</option>
                                                                                <option value="male" <?= $child['gender'] == 'male' ? 'selected' : '' ?>>Male</option>
                                                                                <option valie="female" <?= $child['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="child-birthdate-<?= $i ?>" class="form-label">Date of Birth *</label>
                                                                            <input type="date" value="<?= $child['birthdate'] ?>" class="form-control" name="child-birthdate-<?= $i ?>" id="child-birthdate-<?= $i ?>" required>
                                                                        </div>

                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="child-citizenship-<?= $i ?>" class="form-label">Citizenship *</label>
                                                                            <input type="text" value="<?= ucwords($child['citizenship']) ?>" class="form-control" name="child-citizenship-<?= $i ?>" id="child-citizenship-<?= $i ?>" placeholder="Enter child's citizenship" required>
                                                                        </div>

                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="child-simultaneous-application-<?= $i ?>" class="form-label">Simultaneous application *</label>
                                                                            <select class="form-select" name="child-simultaneous-application-<?= $i ?>" id="child-simultaneous-application-<?= $i ?>">
                                                                                <option value="na" <?= $child['application'] == NULL ? 'selected' : '' ?> disabled>--Select option--</option>
                                                                                <option value="1" <?= $child['application'] == '1' ? 'selected' : '' ?>>Yes</option>
                                                                                <option valie="0" <?= $child['application'] == '0' ? 'selected' : '' ?>>No (At this point)</option>
                                                                            </select>
                                                                        </div><hr>
                                                                    </div>
                                                                <?php endforeach ?>
                                                            <?php endif ?>
                                                        
                                                    </div>

                                                    <div class="w-100 add-child-btn-container <?= $user['has_children'] == 0 ? 'd-none' : '' ?>">
                                                        <a class="btn bg-light py-2 border-0 w-100 add-child-btn" data-url="<?= BASE_URL ?>">+ Add child information</a>

                                                        <div class="col-md-12 d-flex justify-content-end mb-3">
                                                            <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Update Child Information</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="row">
                                                <!-- <div class="col-md-6">
                                                    <div class="mb-3 <?php echo ($user['c_barangay'] == '' || $user['c_barangay'] == null)?'alert-danger':'' ?>">
                                                        <label for="companyname" class="form-label ">Barangay *</label>
                                                        <input type="text" value="<?php echo $user['c_barangay']?>" name="brgy" class="form-control" id="brg" placeholder="Enter Barangay" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3 <?php echo ($user['c_municipality'] == '' || $user['c_municipality'] == null)?'alert-danger':'' ?>">
                                                        <label for="cwebsite" class="form-label">City/Municipality *</label>
                                                        <input type="text" value="<?php echo $user['c_municipality']?>" name="municipality" class="form-control" id="muni" placeholder="Enter Municipality" required>
                                                    </div>
                                                </div>  -->

                                            </div>

                                            <div class="row">
                                                <!-- <div class="col-md-6">
                                                    <div class="mb-3 <?php echo ($user['c_province'] == '' || $user['c_province'] == null)?'alert-danger':'' ?>">
                                                        <label for="companyname" class="form-label">Province *</label>
                                                        <input type="text" value="<?php echo $user['c_province']?>" name="prov" class="form-control" id="companyname" placeholder="Enter Province" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3 <?php echo ($user['region'] == '' || $user['region'] == null)?'alert-danger':'' ?>">
                                                        <label for="cwebsite" class="form-label">Region *</label>
                                                        <input type="text" value="<?php echo $user['region']?>" name="region" class="form-control" id="cwebsite" placeholder="Enter Region" required>
                                                    </div>
                                                </div> -->

                                            </div>

                                            <div class="row">

                                                <!-- <div class="col-md-6">
                                                    <div class="mb-3 <?php echo ($user['region'] == '' || $user['region'] == null)?'alert-danger':'' ?>">
                                                        <label for="companyname" class="form-label">Country *</label>
                                                        <input type="text" value="<?php echo $user['country']?>" name="country" class="form-control" id="companyname" placeholder="Enter Country" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3 <?php echo ($user['contact_number'] == '' || $user['contact_number'] == null)?'alert-danger':'' ?>">
                                                        <label for="lastname" class="form-label">Contact Number *</label>
                                                        <input type="number" value="<?php echo $user['contact_number']?>" name="contact_number" class="form-control" id="contact" placeholder="Enter Contact Number" required>
                                                    </div>
                                                </div> -->

                                            </div>

                                            <div class="row">
                                                <div class="w-100">
                                                    <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-map-marker-check me-1"></i> Account Informatiion </h5>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3 ">
                                                        <label for="useremail" class="form-label ">Email Address</label>
                                                        <input type="email" value="<?php echo $user['email']?>" name="email" class="form-control" id="useremail" placeholder="Enter email" disabled>
                                                        <span class="form-text text-muted"><small>Email cannot be changed!</small></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="userpassword" class="form-label">Password</label>
                                                        <input type="password" value="<?php echo $user['contact_number']?>" name="pass" class="form-control" id="userpassword" placeholder="Enter password" disabled>
                                                        <span class="form-text text-muted"><small>If you want to change password please <a href="#"  data-bs-toggle="modal" data-bs-target="#login-modal" >click</a> here.</small></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div> <!-- end card body -->
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

<!-- Login modal -->



<div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mt-2 mb-4">
                    <a href="#" class="text-success">
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
                        <label for="emailaddress1" class="form-label">Password</label>
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



</body>