<!-- checkout modal -->
<div class="modal fade" id="checkout-modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="add-category.php" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div class="mb-2 text-center">
                        <img src="" id="category-photo" class="img-fluid" alt="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Photo</label>
                        <input type="file" name="photo" class="form-control form-control-sm file-input" data-img-preview="#category-photo">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control">
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