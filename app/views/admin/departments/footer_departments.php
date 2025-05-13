<div id="add-department-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Add Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "add-department-form">
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <input class="form-control" type="text" placeholder="Enter description here" name="description">
                    </div>

                    <div class="d-flex w-100 justify-content-end">
                        <button type="submit" class="btn btn-success me-2"><i class="fas fa-check"></i> Add</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="edit-department-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Edit Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "edit-department-form">
                    <input type="hidden" name="department-id">
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <input class="form-control" type="text" placeholder="Enter description here" name="description">
                    </div>

                    <div class="d-flex w-100 justify-content-end">
                        <button type="submit" class="btn btn-success me-2"><i class="fas fa-check"></i> Save</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="delete-department-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Delete Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "delete-department-form">
                    <input type="hidden" name="department-id">
                    
                    <p class="mb-0">Are you sure you want to delete <b><span class="dept-desc"></span></b> department?</p>
                    <small class="text-warning"><i class="fas fa-info-circle"></i> This action cannot be reverted.</small>

                    <div class="d-flex w-100 justify-content-end mt-3">
                        <button type="submit" class="btn btn-success me-2"><i class="fas fa-trash-alt"></i> Delete</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="add-department-employee-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "add-department-employee-form">
                    <input type="hidden" name="department-id">
                    
                    <div class="form-group">
                        <label class="form-label">Select Employee</label>
                        <select class="form-control" name="employees" required>
                            <option value="" selected disabled>Select Employee</option>
                        </select>
                    </div>

                    <div class="d-flex w-100 justify-content-end mt-3">
                        <button type="submit" class="btn btn-success me-2"><i class="fas fa-check"></i> Add</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="delete-department-employee-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Remove employee from department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "delete-department-employee-form">
                    <input type="hidden" name="employee-id">
                    <input type="hidden" name="department-id">
                    <p class="mb-1">Are you sure you want to remove <b><span class="employee-name"></span></b> from <b><span class="employee-department"></span></b> permanently?</p>
                    <small class="text-warning"><i class="fas fa-info-circle"></i> This action cannot be reverted.</small>

                    <div class="d-flex w-100 justify-content-end mt-3">
                        <button type="submit" class="btn btn-success me-2"><i class="fas fa-check"></i> Yes</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Footer Start -->
<script  src="<?php echo BASE_URL_ASSETS; ?>js/admin/admin_departments.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/vendor.min.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/app.min.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.all.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.locales.js"></script>