<!-- checkout modal -->
<div class="modal fade " id="address-modal" tabindex="-1">
    <div class="modal-dialog centered ">
        <div class="modal-content rounded-0">
            <!-- <div class="modal-header">
                <h5 class="modal-title fw-bold">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> -->
            <form id="add-address-form">
                <input type="hidden" name="id" value="" id="add-id">
                <div class="modal-body">
                    <h6>New Address</h6>
                    <hr>
                    <div class="mb-3">
                        <div class="row gy-3">
                            <div class="col-md">
                                <label for="" class="form-label text-secondary fw-light mb-1"><small>Fullname</small></label>
                                <input required type="text" name="fullname" id="add-fullname" class="form-control form-control-sm" placeholder="Full Name">
                            </div>
                            <div class="col-md">
                                <label for="" class="form-label text-secondary fw-light mb-1"><small>Phone</small></label>
                                <input required type="number" name="phone" maxlength="11" id="add-phone" class="form-control form-control-sm" placeholder="Phone Number">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label for="" class="form-label text-secondary fw-light mb-1"><small>Region</small></label>
                                <select required name="region" class="form-select form-select-sm" id="add-region">
                                    <option value="">Select</option>
                                </select>
                                <input type="hidden" id="region-code">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label text-secondary fw-light mb-1"><small>Province</small></label>
                                <select required name="province" class="form-select form-select-sm" id="add-province">
                                    <option value="">Select</option>
                                </select>
                                <input type="hidden" id="province-code">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label text-secondary fw-light mb-1"><small>City</small></label>
                                <select required name="city" class="form-select form-select-sm" id="add-city">
                                    <option value="">Select</option>
                                </select>
                                <input type="hidden" id="city-code">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label text-secondary fw-light mb-1"><small>Barangay</small></label>
                                <select required name="barangay" class="form-select form-select-sm" id="add-barangay">
                                    <option value="">Select</option>
                                </select>
                                <input type="hidden" id="barangay-code">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label text-secondary fw-light">
                            <small>Zip Code:</small>
                        </label>
                        <input type="number" required class="form-control form-control-sm" id="add-zip-code">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-secondary fw-light">
                            <small>Street:</small>
                        </label>
                        <input type="text" required class="form-control form-control-sm" id="add-street-name">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-secondary fw-light">
                            <small>House No:</small>
                        </label>
                        <input type="text" required class="form-control form-control-sm" id="add-house-no">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default rounded-1 me-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-orange rounded-1">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>