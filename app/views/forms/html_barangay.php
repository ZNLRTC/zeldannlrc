<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-11">
                <div class="page-title">
                    <h3>Barangays</h3>
                </div>
            </div>
            <div class="col-1">
                <br>
                <a class="btn btn-success" type="btn" id="back_brgy" href="<?php echo BASE_URL; ?>form"><i class=" fas
                    fa-backward"></i>
                    Back</a>

            </div>
        </div>


        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="alert alert-warning d-none" role="alert" id="updatebrgy_warning">
                        Please fill out all fields!
                    </div>
                    <div class="alert alert-success d-none" role="alert" id="update_notif">
                        Data has been updated successfully!
                    </div>

                    <div class="col-4">
                        <form id="udpate_brgy" method="post" action="<?php echo BASE_URL; ?>form/updateBarangay">
                            <label for="site-title" class="form-label">Barangay Name </label>
                            <input type="hidden" name="brgy_id" class="form-control" id="brgy_id" placeholder="Sitio"
                                required value="<?php echo $view_barangay['id']?>">
                            <input type="text" name="bgry_name" class="form-control" id="brgy_name" placeholder=""
                                required value="<?php echo $view_barangay['barangay']?>">
                    </div>

                    <div class="col-4">
                        <label for="site-title" class="form-label">&nbsp;</label>
                        <br>
                        <button class="btn btn-success" type="submit"><i class="fas fa-check"></i>
                            Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo BASE_URL_ASSETS; ?>js/form.js"></script>
