<div class="content">
    <div class="container">
        <div class="page-title">
            <h3>Forms</h3>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="houshold_tab" data-bs-toggle="tab" href="#hh" role="tab"
                            aria-controls="hh" aria-selected="true">Barangay </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="system-tab" data-bs-toggle="tab" href="#system" role="tab"
                            aria-controls="system" aria-selected="false">Households</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="fam-tab" data-bs-toggle="tab" href="#fam" role="tab" aria-controls="fam"
                            aria-selected="false">Residents</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="upload_res" data-bs-toggle="tab" href="#res" role="tab"
                            aria-controls="fam" aria-selected="false">Upload Residents</a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" id="attributions-tab" data-bs-toggle="tab" href="#attributions" role="tab"
                            aria-controls="attributions" aria-selected="false">Attributions</a>
                    </li>-->
                </ul>











                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="hh" role="tabpanel" aria-labelledby="houshold_tab">
                        <div class="col-lg-12">

                            <div class="row">

                                <div class="alert alert-warning d-none" role="alert" id="brgy_warning">
                                    Please fill out all fields!
                                </div>
                                <div class="alert alert-success d-none" role="alert" id="brgy_notif">
                                    Data has been added successfully
                                </div>

                                <div class="col-md-4">
                                    <form id="add_brgy" method="post"
                                        action="<?php echo BASE_URL; ?>form/add_brgyController">
                                        <label for="site-title" class="form-label">Barangay Name </label>
                                        <input type="text" name="bname" class="form-control" id="add_brgy"
                                            placeholder="Name" required>
                                </div>

                                <div class="col-4">
                                    <label for="site-title" class="form-label">&nbsp;</label>
                                    <br>
                                    <button class="btn btn-success" type="submit"><i class="fas fa-plus"></i>
                                        Add</button>
                                </div>
                                </form>
                            </div>

                            <hr class="mt-3 mb-3" />

                            <table class="table table-hover" id="brgy_Table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Barangay</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>



                        </div>
                    </div>









                    <div class="tab-pane fade" id="system" role="tabpanel" aria-labelledby="system-tab">
                        <div class="col-lg-12">

                            <div class="row">
                                <div class="alert alert-warning d-none" role="alert" id="hh_warning">
                                    Please fill out all fields!
                                </div>
                                <div class="alert alert-success d-none" role="alert" id="add_notif">
                                    Data has been added successfully
                                </div>

                                <div class="col-md-4">
                                    <form id="add_hh" method="post"
                                        action="<?php echo BASE_URL; ?>form/add_hhController">
                                        <label for="site-title" class="form-label">Sitio </label>
                                        <input type="text" name="sitio" class="form-control" id="sitio"
                                            placeholder="Sitio" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="site-title" class="form-label">Barangay</label>
                                    <select name="brgy_name" class="form-control" required id="brgy_id">
                                        <option value="0">Choose...</option>
                                        <?php
                                                foreach($barangay as $brgy){
                                                    echo  '<option value="'.$brgy['id'].'">'.$brgy['barangay'].'</option>';
                                                }
                                                ?>
                                    </select>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-4">
                                    <label for="site-title" class="form-label">&nbsp;</label>
                                    <br>
                                    <button class="btn btn-success" type="submit"><i class="fas fa-plus"></i>
                                        Add</button>
                                </div>
                                </form>
                            </div>

                            <hr class="mt-3 mb-3" />

                            <table class="table table-hover" id="hh_Table" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Household No.</th>
                                        <th>Sitio</th>
                                        <th>Barangay</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>



                        </div>
                    </div>






                    <div class="tab-pane fade" id="fam" role="tabpanel" aria-labelledby="fam-tab">
                        <div class="col-lg-12">
                            <div class="col-4">
                                <label for="site-title" class="form-label">&nbsp;</label>
                                <br>
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                    title="Add Residents" id="modal_resi">
                                    <i class="fas fa-plus" style="color: #fff"></i> Add
                                </button>
                            </div>


                            <hr class="mt-3 mb-3" />

                            <table class="table table-hover" id="res_Table" width="100%">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Igorot Name</th>
                                        <th>Civil Status</th>
                                        <th>DOB</th>
                                        <th>POB</th>
                                        <th>Address</th>
                                        <th>Contact #</th>
                                        <th>Occupation</th>
                                        <th>POE</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>



                        </div>
                    </div>

                    <div class="tab-pane fade" id="res" role="tabpanel" aria-labelledby="res_upload">
                        <div class="col-lg-12">
                            <div class="container d-flex ">
                                <div class="col-md-12">
                                    <form class="" action="<?php echo BASE_URL; ?>php_actions/upload_residents.php"
                                        method="post" enctype="multipart/form-data">
                                        <h2> FILE UPLOAD</h2>

                                        <div class="file-drop-area">
                                            <span class="choose-file-button">Choose files</span>
                                            <span class="file-message">or drag and drop files here</span>
                                            <input class="file-input" type="file" name="excel">
                                        </div>
                                        <hr>
                                        <button type="submit" name="import" class="btn btn-primary">Save</button>
                                    </form>


                                </div>

                            </div>


                        </div>


                        <hr class="mt-3 mb-3" />





                    </div>
                </div>












            </div>
        </div>
    </div>
</div>

<div class="urls">


</div>
<!-- MODALS -->

<div class="modal fade" id="modal_addhh_body" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-xl" data-backdrop="static" data-keyboard="false">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #045757">
                <h4 class="modal-title resTitle" style="color: yellow">Add Resident</h4>
                <button type="button" id="close_addModal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: red">X</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo BASE_URL; ?>form/save_residents" method="post" autocomplete="off"
                    enctype="multipart/form-data" id="insert_res">

                    <div class="row">
                        <div class="alert alert-success d-none" role="alert" id="add_notifs">
                            <strong>Success!</strong>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group res_id">
                                <label>Last Name</label>
                                <input type="text" name="reslname"
                                    class="form-control select2 select2-container select2-container--default"
                                    id="reslname" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="resfname"
                                    class="form-control select2 select2-container select2-container--default"
                                    id="resfname" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input type="text" name="resmname"
                                    class="form-control select2 select2-container select2-container--default"
                                    id="resmname" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label>Ext Name</label>
                                <input type="text" name="resextname"
                                    class="form-control select2 select2-container select2-container--default"
                                    id="resextname" placeholder="">
                            </div>
                        </div>
                        <!-- /.form-group -->
                    </div> <!-- /.row -->
                    <hr>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Igorot Name</label>
                                <input type="text" name="resigorotname"
                                    class="form-control select2 select2-container select2-container--default"
                                    id="resigorotname" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Sex</label>
                                <select class="form-select" aria-label="Default select example" name="sex" id="sex" required>
                                    <option selected id="chossex">Open this select menu</option>
                                    <option value="1" id="male">Male</option>
                                    <option value="0" id="fem">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="date" name="dob"
                                    class="form-control select2 select2-container select2-container--default" id="dob"
                                    placeholder="Resident ID" required>
                            </div>
                        </div>
                        <!-- /.form-group -->
                    </div> <!-- /.row -->
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Civil Status</label>
                                <select class="form-select" aria-label="Default select example" name="cstatus"
                                    id="cstatus" required>
                                    <option selected>Open this select menu</option>
                                    <option value="SINGLE">Single</option>
                                    <option value="MARRIED">Married</option>
                                    <option value="WIDOW">WIDOW</option>
                                    <option value="SEPARATED">SEPARATED</option>
                                    <option value="UNNULLED">UNNULLED</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="number" name="contact"
                                    class="form-control select2 select2-container select2-container--default"
                                    id="contact" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" name="email"
                                    class="form-control select2 select2-container select2-container--default" id="email"
                                    placeholder="">
                            </div>
                        </div>
                        <!-- /.form-group -->
                    </div> <!-- /.row -->
                    <hr>


                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Place of Birth</label>
                                <input type="text" name="pob"
                                    class="form-control select2 select2-container select2-container--default" id="pob"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Permanent Address</label>
                                <input type="text" name="peradd"
                                    class="form-control select2 select2-container select2-container--default"
                                    id="peradd" placeholder="">
                            </div>
                        </div>

                        <!-- /.form-group -->
                    </div> <!-- /.row -->
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Occupation</label>
                                <input type="text" name="occupation"
                                    class="form-control select2 select2-container select2-container--default"
                                    id="occupation" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Place of Employment</label>
                                <input type="text" name="poe"
                                    class="form-control select2 select2-container select2-container--default" id="poe"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Salary Average</label>
                                <input type="number" name="salaryave"
                                    class="form-control select2 select2-container select2-container--default"
                                    id="salaryave" placeholder="">
                            </div>
                        </div>

                        <!-- /.form-group -->
                    </div> <!-- /.row -->
                    <hr>
                    <div class="row">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Educational Attainment</label>
                                <input type="text" name="educ"
                                    class="form-control select2 select2-container select2-container--default" id="educ"
                                    placeholder="">

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Ethnicity</label>
                                <input type="text" name="ethnicity"
                                    class="form-control select2 select2-container select2-container--default" id="eth"
                                    placeholder="">

                            </div>
                        </div>

                        <!-- /.form-group -->
                    </div> <!-- /.row -->
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="site-title" class="form-label">&nbsp;</label>
                            <br>
                            <button type="submit" style="float: right;" class="btn btn-success" id="res_save"> <i
                                    class="fas fa-check" style="color: #fff"></i>
                                Save </button>
                        </div>
                    </div>

                    <!-- /.form-group -->
            </div> <!-- /.row -->
            </form>

            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</div>
</div>
</div>
</div>

<script src="<?php echo BASE_URL_ASSETS; ?>js/form.js"></script>
