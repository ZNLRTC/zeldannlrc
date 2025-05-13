<div class="modal fade" id="modal-forgot-password" tabindex="-1" aria-labelledby="forgot-password-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="forgot-password-label">Forgot Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-forgot-password">
                    <div class="form-group">
                        <label class="form-label" for="fp-email">Email:</label>
                        <div class="d-flex justify-content-between">
                            <input type="text" class="form-control me-1" id="fp-email" name="fp-email" placeholder="Please enter your email here.">
                            <button type="submit" class="btn btn-success" data-url=<?= BASE_URL ?>>Request</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL_ASSETS; ?>js/error.js"></script>