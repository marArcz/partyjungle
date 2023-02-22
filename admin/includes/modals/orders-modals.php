<!-- status modal -->
<div class="modal fade" id="status-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Filter Orders</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="orders.php" method="get">

                <div class="modal-body">
                    <label for="" class="form-label">Order Status:</label>
                    <select name="status" class="form-select" id="select-order-status">
                        <option value="-1"><?php echo OrderStatus::getStringStatus(-1) ?></option>
                        <option value="-2"><?php echo OrderStatus::getStringStatus(-2) ?></option>
                        <?php
                        for ($x = 0; $x < count(OrderStatus::getStatusList()); $x++) {
                            //get number of orders with the corresponding status
                            $query = mysqli_query($con, "SELECT * FROM orders WHERE status = $x");
                        ?>
                            <option value="<?php echo $x ?>">
                                <span><?php echo OrderStatus::getStringStatus($x) ?></span>
                                <span style="font-size:12px" class="badge text-bg-orange px-2 py-1 rounded-pill ms-2">
                                    <small>(<?php echo $query->num_rows ?>)</small>
                                </span>
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

<!-- status modal -->
<div class="modal fade" id="update-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title ">Update Status</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p class="fw-bold">Confirm action to update order status?</p>
                <p class="mt-3 text-secondary">Order status will be set to <strong><span class="text-dark" id="status-txt">STATUS</span></strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="update-order-status.php" id="confirm-btn" class="btn btn-sm btn-orange">Confirm</a>
            </div>
        </div>
    </div>
</div>