<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-11">
                <div class="page-title">
                    <h3><?php echo $view_household['hh_code']?></h3>
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
                    <div class="alert alert-warning d-none" role="alert" id="hh_warning">
                        Please fill out all fields!
                    </div>
                    <div class="alert alert-success d-none" role="alert" id="updatehh_notif">
                        Data has been updated successfully!
                    </div>

                    <div class="col-md-4">
                        <form id="udpate_hh" method="post" action="<?php echo BASE_URL; ?>form/update_hhController">
                            <label for="site-title" class="form-label">Sitio </label>
                            <input type="text" name="sitio" class="form-control" id="sitio" placeholder="Sitio" required
                                value="<?php echo $view_household['sitio']?>">
                    </div>
                    <div class="col-md-4">
                        <label for="site-title" class="form-label">Barangay</label>
                        <select name="brgy_name" class="form-control" required id="brgy_id">
                            <?php
                            
                                                foreach($barangay as $brgy){
                                                    if($brgy['id'] == $view_household['id']){
                                                        echo  '<option value="'.$brgy['id'].'" selected>'.$brgy['barangay'].'</option>';

                                                    }else{
                                                        echo  '<option value="'.$brgy['id'].'">'.$brgy['barangay'].'</option>';

                                                    }
                                                }
                                                ?>
                        </select>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-4">
                        <label for="site-title" class="form-label">&nbsp;</label>
                        <br>
                        <button class="btn btn-success" type="submit"><i class="fas fa-check"></i>
                            Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo BASE_URL_ASSETS; ?>js/form.js"></script>
