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

<!-- checkout modal -->
<div class="modal fade" id="instruction-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title my-0">Instructions</h6>
                <button type="button" class="btn btn-light btn-no-outline" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <form action="add-category.php" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <p class="my-1 text-secondary">Instructions:</p>
                    <p id="instructions-text"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>