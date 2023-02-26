<div class="modal fade" id="manage-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add Service Option</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="add-service-option.php" enctype="multipart/form-data" method="post">
                <input type="hidden" name="service_id" value="<?php echo $_GET['service_id'] ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Label:</label>
                        <input type="text" required name="label" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Price:</label>
                        <input type="number" required name="price" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-orange">Save Changes</button>
                </div>
            </form>

        </div>
    </div>
</div>