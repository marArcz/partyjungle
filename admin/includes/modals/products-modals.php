<div class="modal fade" id="add-modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="add-product.php" enctype="multipart/form-data" method="post">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="../assets/data/default.png" id="image-preview" class="img-fluid mb-3" alt="">
                            <div class="text-center">
                                <button class="btn btn-orange file-input-toggler" data-target="#file-input" type="button">Choose Image</button>
                            </div>
                        </div>
                        <div class="col-md">
                            <input type="file" data-img-preview="#image-preview" name="photo" class="d-none" id="file-input">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Name:</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Category:</label>
                                <select name="category_id" id="" class="form-select">
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
                                <input type="number" name="price" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Stocks:</label>
                                <input type="number" name="stocks" class="form-control">
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


<!-- status modal -->
<div class="modal fade" id="category-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Product Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="products.php" method="get">

                <div class="modal-body">
                    <label for="" class="form-label">Category</label>
                    <select name="category" class="form-select" id="select-order-status">
                        <?php 
                            $query = mysqli_query($con,"SELECT * FROM categories");
                            while($row = $query->fetch_assoc()){
                                ?>
                                <option value="<?php echo $row['id'] ?>" <?php echo $row['id'] == $category_id?"selected":"" ?>>
                                    <?php echo $row['category_name'] ?>
                                </option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-orange">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>