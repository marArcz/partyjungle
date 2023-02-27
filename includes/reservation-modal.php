<div class="modal fade" id="details-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content rounded-1">
            <div class="modal-header">
                <h5 class="modal-title">Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="change-account-photo.php" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div class="mb-2 text-center">
                        <!-- <img src="" id="account-photo-preview" class="img-fluid" alt=""> -->
                        <div class="div-image shadow-sm xl mx-auto rounded-circle border" id="account-photo-preview" data-image="<?php echo empty($user['photo']) ? "./assets/images/profile.jpg" : $user['photo'] ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Photo</label>
                        <input type="file" required name="photo" class="form-control form-control-sm file-input" data-div-preview="#account-photo-preview">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary ms-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>
