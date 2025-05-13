<div id="transfer-message-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Transfer Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "form-transfer-message">
                    <input type="hidden" name="current-deparment">
                    <input type="hidden" name="ticket">
                    <input type="hidden" name="admin-id">
                    <input type="hidden" name="keyword-id">

                    <h5 class="mb-3">Select where you want to transfer</h5>
                    <div class="keywords-container row"></div>

                    <textarea class="form-control" name="transfer-message-reason" placeholder="Enter reason for transfer here" rows="5"></textarea>

                    <div class="form-group d-flex justify-content-end mt-3">
                        <button class="btn btn-success me-2" type="submit"><i class="fas fa-long-arrow-alt-right"></i> Transfer</button>
                        <a href="#" class="btn btn-danger" data-bs-dismiss="modal">No</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script  src="<?php echo BASE_URL_ASSETS; ?>js/admin/admin_userMessages.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/vendor.min.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/app.min.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.all.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.locales.js"></script>