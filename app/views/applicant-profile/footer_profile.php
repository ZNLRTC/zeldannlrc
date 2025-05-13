<div id="znlrc-info-update-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="send-message-label">Request for update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-znlrc-request-update" action="<?= BASE_URL ?>">
                    <input type="hidden" name="user-id">
                    <div class="form-group mb-3">
                        <label class="form-label" for="znlrc-request-update-info">Request details:</label>
                        <textarea rows="6" class="form-control me-1 mb-2" id="znlrc-request-update-info" name="znlrc-request-update-info" placeholder="Write your request details here." required></textarea>
                        <small class="text-warning"><i class="fas fa-info-circle"></i> You will receive an email once we are able to update your request.</small>
                    </div>
                    
                    <div class="w-100 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Send Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="upload-document-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Upload Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <small class="text-warning"><i class="fas fa-info-circle"></i> <b>Note:</b> Please make sure to upload the correct document. You will not have the option to update the document once uploaded.</small>
                <form id="form-upload-document" enctype="multiprt/form-data" class="mt-2">
                    <input type="file" name="document-file" id="document-file" class="form-control mb-3">
                    <input type="hidden" name="document-type">
                    <input type="hidden" name="user-id">
                    <input type="hidden" name="user-name">
                    <div class="w-100 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" data-trainee-id="">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="request-removal-document-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Request to remove document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="approval-pending d-none">Request has been submitted. Pending for approval.</p>
                <form id="form-request-removal-document">
                    <input type = "hidden" name="document-id">
                    <label class="form-label">Please provide us with more information regarding why you wish to remove this document.</label>
                    <textarea class="form-control" placeholder="Please write here" rows="6" name="request-removal-reason" required></textarea>

                    <div class="form-group mt-2 w-100 d-flex justify-content-end">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="request-update-document-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">How to update your document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><b>Note:</b> To update your document, you need to request its removal. This request will undergo review and approval by our team. Once approved, you will have the option to delete the document, enabling you to upload your new document with the correct information.</p>
            </div>
        </div>
    </div>
</div>

<div id="under-maintainance" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Please be patient with us.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h3>Page under maintainance. We are fixing some issues on this page. Please come back tomorrow. Thank you so much</h3>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL_ASSETS; ?>js/profile.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>js/chatMessages.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/vendor.min.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.all.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.locales.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/app.min.js"></script>
<script src="https://cdn.tiny.cloud/1/27zte4z85iy9ww256ti3nk9y087b8e2cb10eu4nwrv08ahsp/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

       