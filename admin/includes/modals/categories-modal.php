<!-- status modal -->
<div class="modal fade" id="edit-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="edit-category.php" enctype="multipart/form-data" method="post">
                <input type="hidden" name="id" id="id-input">
                <div class="modal-body">
                    <div class="mb-2 text-center">
                        <img src="" id="photo" class="img-fluid" alt="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Photo</label>
                        <input type="file" name="photo" class="form-control form-control-sm file-input" data-img-preview="#photo">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="delete-category.php" id="delete-btn" class="btn btn-danger me-auto"><i class="bx bx-trash"></i></a>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-orange">Save Changes</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- status modal -->
<div class="modal fade" id="add-modal" tabindex="-1">
    <div class="modal-dialog">
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