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