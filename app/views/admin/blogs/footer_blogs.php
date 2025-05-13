<div id="add-new-blog-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Add new blog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="blog-add-edit-form">
                    <input type="hidden" name="b-id">
                    <input type="hidden" name="action" value="add">
                    <div class="row form-group mb-3">
                        <div class='col-12 mb-3'>
                            <label class="form-label">Image</label>
                            <input type ="file" class= "form-control" name="b-image" placeholder="Place your image here">
                            </input>
                            <small class="text-warning d-none">Leave blank too keep current image.</small>
                        </div>
                        <div class='col-12'>
                            <label class="form-label">Title:</label>
                            <input type ="text" class= "form-control" name="b-title" placeholder="Enter title here">
                            </input>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Content</label>
                        <textarea id="blog-textarea" name="b-content"></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success save-blog-btn">Save</button>
                <button class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div id="confirm-delete-blog-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Please Confirm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="confirm-delete-blog-form">
                    <input type="hidden" name="id">
                    <h5>Are you sure you want to delete blog post?</h5>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success confirm-delete-blog-btn">Yes</button>
                <button class="btn btn-danger" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<script  src="<?php echo BASE_URL_ASSETS; ?>js/admin/admin_blogs.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/vendor.min.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/app.min.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.all.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.locales.js"></script>