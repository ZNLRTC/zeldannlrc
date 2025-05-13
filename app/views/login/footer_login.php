<div id="system-access-time-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Please select time of request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="system-access-time-form">
                    <input type="hidden" name="user-email">
                    <p class="text-danger"><i>This request is only valid for today. Please select a time range below.</i></p>

                    <div class="response"></div>
                
                    <div class="row">
                        <div class="col-md-6 form-group">
                                <label for="" class="form-label">
                                    From
                                </label>
                                <input type="time" class="form-control" name="access-from" required>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                                <label for="" class="form-label">
                                    To:
                                </label>
                                <input type="time" class="form-control" name="access-to" required>
                        </div>

                        <div class="col-md-12 form-group">
                                <label for="" class="form-label">
                                    Purpose:
                                </label>
                                <textarea name="access-purpose" class="form-control" rows="5" required></textarea>
                        </div>
                    </div>
                    
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success system-access-time-modal-submit-btn">Request</button>
                <button class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL_ASSETS; ?>js/login.min.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/vendor.min.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/app.min.js"></script>