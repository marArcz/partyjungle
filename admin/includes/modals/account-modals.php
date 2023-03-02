<!-- checkout modal -->
<div class="modal fade" id="photo-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content rounded-1">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">Change Photo</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="change-account-photo.php" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div class="mb-2 text-center">
                        <!-- <img src="" id="account-photo-preview" class="img-fluid" alt=""> -->
                        <div class="div-image shadow-sm xl mx-auto rounded-circle border" id="account-photo-preview" data-image="../<?php echo empty($user['photo']) ? "assets/images/profile.jpg" : $user['photo'] ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Photo</label>
                        <input type="file" required name="photo" class="form-control form-control-sm file-input" data-div-preview="#account-photo-preview">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-outline-dark">Change Photo</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="info-modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-1">
            <div class="modal-header">
                <h6 class="modal-title">Update Information</h6>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <form action="update-account-info.php" enctype="multipart/form-data" method="post">
                <div class="modal-body" id="info-modal-body">
                    <p class="mb-2 text-danger" id="password-form-error"></p>
                    <div class="row">
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="" class="form-label fw-light">Firstname:</label>
                                <input id="info-firstname" type="text" class="form-control" required name="firstname">
                            </div>

                        </div>
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="" class="form-label fw-light">Middlename:</label>
                                <input id="info-middlename" type="text" class="form-control" required name="middlename">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="" class="form-label fw-light">Lastname:</label>
                                <input id="info-lastname" type="text" class="form-control" required name="lastname">
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="" class="form-label fw-light">Email:</label>
                                <input id="info-email" type="email" class="form-control" required name="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="" class="form-label">Username:</label>
                                <input id="info-username" type="text" class="form-control" required name="username">
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="" class="form-label fw-light">Contact:</label>
                                <input id="info-contact" type="number" class="form-control" required name="contact">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-outline-dark">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- password modal -->

<div class="modal fade" id="password-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content rounded-1">
            <div class="modal-header">
                <h6 class="modal-title">Change Password</h6>
            </div>
            <form id="password-form" action="change-account-photo.php" enctype="multipart/form-data" method="post">
                <div class="modal-body" id="password-modal-body">
                    <p class="text-center mb-2">
                        <i class='bx bxs-lock-alt bx-lg text-secondary'></i>
                    </p>
                    <p id="password-form-error" class="mt-1 mb-2 text-danger"></p>
                    <div class="mb-3">
                        <label for="" class="form-label fw-light">Current Password</label>
                        <input type="password" name="current_pass" required class="form-control" id="current-password">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-light">New Password</label>
                        <input type="password" name="new_pass" required class="form-control" id="new-password">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-light">Confirm Password</label>
                        <input type="password" required class="form-control" id="confirm-password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-outline-dark">Change Password</button>
                </div>
            </form>

        </div>
    </div>
</div>