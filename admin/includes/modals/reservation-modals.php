<div class="modal fade" id="manage-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add Service Option</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-end mb-2">
                    <div class="text-bg-yellow badge text-dark fw-light">Status: <span id="status-text" class="">Pending</span></div>
                </div>

                <p class="my-1 fw-bold"><small>Service:</small></p>
                <p class="my-1"><span id="service-name">Party Organizer</span></p>
                <p class="my-1"><span id="option-label">1st Class - 1500</span></p>
                <div class="mt-3">
                    <p class="my-1"><span>Date:</span> <span id="reservation-date">02-28-23</span></p>
                    <p class="my-1"><span>Time:</span> <span id="reservation-time">10:30 PM</span></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm me-auto btn-c-secondary" data-bs-dismiss="modal">Close</button>

                <a href="update-reservation-status.php?status=Declined" id="danger-btn" class="btn btn-sm btn-c-danger">Decline</a>
                <a href="update-reservation-status.php?status=Approved" id="success-btn" class="btn btn-sm btn-c-success">Approve</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="details-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Details</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="add-service-option.php" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div class="text-end mb-2">
                        <div class="text-bg-yellow badge text-dark fw-light">Status: <span id="status-text" class="">Pending</span></div>
                    </div>

                    <p class="my-1 fw-bold"><small>Service:</small></p>
                    <p class="my-1"><span id="service-name">Party Organizer</span></p>
                    <p class="my-1"><span id="option-label">1st Class - 1500</span></p>
                    <div class="mt-3">
                        <p class="my-1"><span>Date:</span> <span id="reservation-date">02-28-23</span></p>
                        <p class="my-1"><span>Time:</span> <span id="reservation-time">10:30 PM</span></p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
            </form>

        </div>
    </div>
</div>