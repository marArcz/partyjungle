<!-- edit modal -->
<div class="modal fade" id="edit-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit Shipping Option</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="edit-shipping.php" enctype="multipart/form-data" method="post">
                <input type="hidden" name="id" id="id-input">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Description:</label>
                        <textarea name="description" required class="form-control" id="edit-description" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Price:</label>
                        <input type="number" required name="price" class="form-control" id="price">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-orange" name="submit">Save Changes</button>
                </div>
            </form>

        </div>
    </div>
</div>