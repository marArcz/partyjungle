<div class="modal fade" id="add-modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="add-product.php" enctype="multipart/form-data" method="post">

                <div class="modal-body">
                    <div class="row gy-3">
                        <div class="col-md-4 text-center">
                            <img required src="../assets/data/default.png" id="image-preview" class="img-fluid mb-1" alt="">
                            <div class="text-center">
                                <p class=" text-secondary mt-1 mb-2">
                                    <small>Main Photo</small>
                                </p>
                                <button class="btn btn-orange file-input-toggler" data-target="#file-input" type="button">Choose Image</button>
                            </div>
                        </div>
                        <div class="col-md">
                            <input type="file" data-img-preview="#image-preview" name="photo" class="d-none" id="file-input">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Name:</label>
                                <input required type="text" class="form-control" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Category:</label>
                                <select required name="category_id" id="" class="form-select">
                                    <option value="">Select one</option>
                                    <?php
                                    $query = mysqli_query($con, "SELECT * FROM categories");
                                    while ($row = $query->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row['id'] ?>">
                                            <?php echo $row['category_name'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Price:</label>
                                <input required type="number" name="price" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Stocks:</label>
                                <input required type="number" name="stocks" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Product Description:</label>
                                <textarea name="description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-orange" name="submit">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="manage-modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manage Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="edit-product.php" enctype="multipart/form-data" method="post">
                <input type="hidden" name="id" class="id-input">
                <div class="modal-body">
                    <div class="row gy-3">
                        <div class="col-md-4 text-center">
                            <img src="../assets/data/default.png" id="edit-image-preview" class="img-fluid mb-1 img-thumbnail" alt="">
                            <div class="text-center">
                                <p class=" text-secondary mt-1 mb-2">
                                    <small>Main Photo</small>
                                </p>
                                <button class="btn btn-orange file-input-toggler" data-target="#edit-file-input" type="button">Change Image</button>
                            </div>
                        </div>
                        <div class="col-md">
                            <input type="file" required data-img-preview="#edit-image-preview" name="photo" class="d-none" id="edit-file-input">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Name:</label>
                                <input type="text" required class="form-control" name="name" id="edit-name">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Category:</label>
                                <select required name="category_id" class="form-select" id="edit-category">
                                    <option value="">Select one</option>
                                    <?php
                                    $query = mysqli_query($con, "SELECT * FROM categories");
                                    while ($row = $query->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row['id'] ?>">
                                            <?php echo $row['category_name'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Price:</label>
                                <input required type="number" name="price" id="edit-price" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Stocks:</label>
                                <input required type="number" name="stocks" class="form-control" id="edit-stocks">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Product Description:</label>
                                <textarea required name="description" class="form-control" rows="5" id="edit-description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="delete-product.php" id="delete-btn" class="btn btn-danger me-auto">
                        <i class="bx bx-trash"></i>
                    </a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-orange" name="submit">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>