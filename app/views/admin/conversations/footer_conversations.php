<div id="close-ticket-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Close Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "close-ticket-form">
                    <input type="hidden" name="ticket-id">
                    
                    <p class="mb-0">Are you sure you want to close this ticket?</p>

                    <div class="d-flex w-100 justify-content-end mt-3">
                        <button type="submit" class="btn btn-success me-2"><i class="fas fa-check"></i> Yes</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="open-ticket-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Open Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "open-ticket-form">
                    <input type="hidden" name="ticket-id">
                    
                    <p class="mb-0">Are you sure you want to open this ticket again?</p>

                    <div class="d-flex w-100 justify-content-end mt-3">
                        <button type="submit" class="btn btn-success me-2"><i class="fas fa-check"></i> Yes</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="open-text-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Message Content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            </div>

            <div class="modal-footer">
                <div class="d-flex w-100 justify-content-end mt-3">
                    <button type="submit" class="btn btn-success me-2"><i class="fas fa-check"></i> Yes</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script  src="<?php echo BASE_URL_ASSETS; ?>js/admin/admin_conversation.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/chatMessages.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/vendor.min.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/app.min.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.all.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.locales.js"></script>