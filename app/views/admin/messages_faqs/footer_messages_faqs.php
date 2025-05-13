<div id="add-message-faq-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Add Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "add-message-faqs-form">

                    <div class="form-check form-check-inline checkbox-container mb-3">
                        <input class="form-check-input pointer" type="checkbox" name="messages-faqs-checkbox" id="messages-faqs-checkbox" checked>
                        <label class="form-check-label pointer" for="messages-faqs-checkbox">Check if question a sub category.</label>
                    </div>

                    <div class="form-group mb-3 parent-question-container">
                        <label class="form-label">Select parent question</label>
                        <select class="form-select" name="question-parent" required>
                            <option value="" disabled selected>Select parent</option>
                            <?php foreach($faq_parents as $par): ?>
                                <option id="faq-modal-question-<?= $par['id'] ?>" value="<?= $par['id'] ?>"><?= ucwords($par['question']) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Select department</label>
                        <select class="form-select" name="department" required>
                            <option value="" disabled selected>Select department</option>
                            <?php foreach($departments as $dept): ?>
                                <option id="faq-modal-dept-<?= $dept['id'] ?>" value="<?= $dept['id'] ?>"><?= ucwords($dept['description']) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Question</label>
                        <input class="form-control" name="question" type ="text" placeholder="Enter question here." required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label">Answer</label>
                        <textarea class="form-control" name="answer" rows="4" placeholder="Enter answer here" required></textarea>
                    </div>

                    <div class="d-flex w-100 justify-content-end mt-3">
                        <button type="submit" class="btn btn-success me-2"><i class="fas fa-plus"></i> Add</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="delete-message-faq-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Delete Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "delete-message-faqs-form">

                    <input type="hidden" name="faq-id">

                    <p class="mb-1">Are you sure you want to delete <b><span class="faq-name"></span></b> permanently?</p>
                    <small class="text-warning"><i class="fas fa-info-circle"></i> This action cannot be reverted.</small>

                    <div class="d-flex w-100 justify-content-end mt-3">
                        <button type="submit" class="btn btn-success me-2"><i class="fas fa-trash-alt"></i> Delete</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="add-faq-keyword-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Add FAQ Keyword</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "add-faq-keyword-form">
                    <div class="form-group mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="form-label">Icon</label>
                            <div>
                                <small class="text-warning w-100 d-block"><i class="fas fa-info-circle"></i> Get your icons from <a href="https://fontawesome.com/v5/search">https://fontawesome.com</a></small>
                            </div>
                        </div>
                        <input class="form-control" type="text" name="keyword-icon" placeholder="Enter icon script here">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Description</label>
                        <input class="form-control" type="text" name="keyword-description" placeholder="Enter description here">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Department</label>
                        <select class="form-select" name="keyword-department">
                            <option selected disabled>Select department</option>
                            <?php foreach($departments as $dept): ?>
                                <option value="<?= $dept['id'] ?>" id="keyword-dept-id-<?= $dept['id'] ?>"> <?= $dept['description'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="d-flex w-100 justify-content-end mt-3">
                        <button type="submit" class="btn btn-success me-2"><i class="fas fa-check"></i> Add</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script  src="<?php echo BASE_URL_ASSETS; ?>js/vendor.min.js"></script>
<script  src="<?php echo BASE_URL_ASSETS; ?>js/app.min.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.all.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>bootbox/bootbox.locales.js"></script>
<script src="<?php echo BASE_URL_ASSETS; ?>js/admin/admin_messages_faqs.js"></script>