<div id="approve-document-request-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Document Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="document-id">
                <p><b>Type:</b> <span class="doc-type"></span></p>
                <p><b>File name:</b> <span class="doc-path"></span></p>
                <p><b>Message:</b> <span class="doc-message"></span></p>

                <div class="d-flex w-100 justify-content-end">
                    <button class="btn btn-success me-2 request-approve-action-btn" data-action="approve">Approve</button>
                    <button class="btn btn-danger request-approve-action-btn" data-action="deny">Deny</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="update-deployment-date-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Update deployment date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="update-deployment-date-form">
                    <input type="hidden" name="user-id">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Enter Date:</label>
                        <input type="date" class="form-control" name="deployment-date">
                    </div>

                    <div class="d-flex w-100 justify-content-end">
                        <button class="btn btn-success me-2">Update</button>
                        <button class="btn btn-danger">Deny</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

<script  src="<?php echo BASE_URL_ASSETS; ?>js/admin.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/admin/admin_applicant_view.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/vendor.min.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/app.min.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.all.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.locales.js"></script>