<div id="add-batch-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Add Batch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "form-add-batch">
                    <div class="form-group mb-3">
                        <label class="form-label">Batch Name</label>
                        <input type="text" class="form-control" name="batch-name" required>
                    </div>

                    <div class="form-group d-flex justify-content-end">
                        <button class="btn btn-success me-2" type="submit" data-action="add"><i class="fas fa-plus"></i> Add</button>
                        <a href="#" class="btn btn-danger" data-bs-dismiss="modal">Close</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="add-batch-number-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Add Batch Number</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "form-add-batch-number">
                    <label class="form-label" for="batch-id">Choose batch</label>
                    <select class="form-select mb-3" name="batch-id" id="batch-id">
                        <option value="n/a" selected disabled>--Select batch--</option>
                        <?php foreach($batch_names as $batch): ?>
                            <option class="text-uppercase" value="<?= $batch['id'] ?>"><?= $batch['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    
                    <label class="form-label">Enter Batch Number</label>
                    <input type="number" class="form-control mb-3" name="batch-number" required>

                    <div class="form-group d-flex justify-content-end">
                        <button class="btn btn-success me-2" type="submit">+ Add</button>
                        <a href="#" class="btn btn-danger" data-bs-dismiss="modal">Close</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="edit-batch-number-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Edit Batch Number</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "form-edit-batch-number">
                    <input type="hidden" name="batch-num-id">
                    <label class="form-label" for="batch-id">Choose batch</label>
                    <select class="form-select mb-3" name="batch-id" id="batch-id">
                        <option value="n/a" selected disabled>--Select batch--</option>
                        <?php foreach($batch_names as $batch): ?>
                            <option class="text-uppercase bat-<?= $batch['name'] ?>" value="<?= $batch['id'] ?>"><?= $batch['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    
                    <label class="form-label">Enter Batch Number</label>
                    <input type="number" class="form-control mb-3" name="batch-number" required>

                    <div class="form-group d-flex justify-content-end">
                        <button class="btn btn-success me-2" type="submit"><i class="fas fa-check"></i> Save</button>
                        <a href="#" class="btn btn-danger" data-bs-dismiss="modal">Close</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="delete-batch-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Delete Batch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "form-delete-batch">
                    <input type="hidden" name="batch-id">
                    <p class="mb-1">Are you sure you want to delete <b><span class="batch-name"></span></b> permanently?</p>
                    <small class="text-warning"><i class="fas fa-info-circle"></i> This action cannot be reverted.</small>

                    <div class="form-group d-flex justify-content-end mt-3">
                        <button class="btn btn-danger me-2" type="submit"><i class="fas fa-check"></i> Yes</button>
                        <a href="#" class="btn btn-success" data-bs-dismiss="modal">No</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="delete-batch-number-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Delete Batch Number</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "form-delete-batch">
                    <input type="hidden" name="batch-number-id">
                    <p class="mb-1">Are you sure you want to delete <b><span class="batch-name"></span></b> permanently?</p>
                    <small class="text-warning"><i class="fas fa-info-circle"></i> This action cannot be reverted.</small>

                    <div class="form-group d-flex justify-content-end mt-3">
                        <button class="btn btn-danger me-2" type="submit"><i class="fas fa-check"></i> Yes</button>
                        <a href="#" class="btn btn-success" data-bs-dismiss="modal">No</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="move-applicants-batch-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Move applicant batch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "form-move-applicant-batch">
                    <table id="applicants-move-batch-table" class="w-100 table table-striped">
                        <thead class="">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Current Batch</th>
                            <th>Action</th>
                        </thead>

                        <tbody></tbody>
                    </table>

                    <hr>
                    
                    <label class="form-label">Move to batch</label>
                    <div class="d-flex">
                        <select class="form-select me-1" name="batches">
                            <option disabled selected>Select batch</option>
                        </select>
                        <select class="form-select" name="batch-numbers"></select>
                    </div>

                    <div class="form-group d-flex justify-content-end mt-3">
                        <a href="#" class="btn btn-danger me-2" data-bs-dismiss="modal">No</a>
                        <button class="btn btn-success move-batch-btn" type="submit"><i class="fas fa-long-arrow-alt-right"></i> Move</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="add-new-testimonial-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Add new testimonial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="testimonial-add-edit-form">
                    <input type="hidden" name="t-id">
                    <input type="hidden" name="action" value="add">
                    <div class="row form-group mb-3">
                        <div class='col-6'>
                            <label class="form-label">Name:</label>
                            <input type ="text" class= "form-control" name="t-name" placeholder="Enter name here">
                            </input>
                        </div>
                        <div class='col-6'>
                            <label class="form-label">Image</label>
                            <input type ="file" class= "form-control" name="t-image" placeholder="Place your image here">
                            </input>
                            <small class="text-warning d-none">Leave blank too keep current image.</small>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="form-label">Testimonial</label>
                        <textarea id="testimonial-textarea" name="t-testimonial" row="12" class="form-control" placeholder="Enter testimonial here"></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success save-testimonial-btn">Save</button>
                <button class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div id="confirm-delete-testimonial-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Please Confirm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="confirm-delete-testimonial-form">
                    <input type="hidden" name="t-id">
                    <h5>Are you sure you want to delete <span class="testimonial-name"></span>?</h5>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success confirm-delete-testimonial-btn">Yes</button>
                <button class="btn btn-danger" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<div id="delete-user-info-request-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Please Confirm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="delete-user-info-request-form">
                    <input type="hidden" name="id">
                    <h5>Are you sure you want to delete this request?</h5>
                    <div class="response"></div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success confirm-delete-uir-btn">Yes</button>
                <button class="btn btn-danger" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<div id="add-trainee-success-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Added Successfully!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <h5>Copy link below to set new password for trainee.</h5>
                <textarea class="form-control" rows="4"></textarea>
            </div>

            <div class="modal-footer">
                <a href="add_trainee" class="btn btn-success">Add new trainee</a>
                <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Footer Start -->
<script  src="<?php echo BASE_URL_ASSETS; ?>js/admin.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/admin/admin_testimonials.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/chatMessages.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/vendor.min.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/app.min.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.all.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.locales.js"></script>