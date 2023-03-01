 <!-- propterty modal -->
 <div class="modal fade" id="property-modal" tabindex="-1">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header py-2">
                 <p class="my-0 modal-title">Add Property</p>
                 <button type="button" class="btn btn-default btn-sm text-center btn-no-outline" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                 </button>
             </div>
             <form action="add-property.php" method="post">
                <input type="hidden" name="product_id" id="input-id" value="<?php echo $product['id'] ?>">
                 <div class="modal-body">
                     <div class="mb-3">
                         <label for="" class="form-label"><small>Property name</small></label>
                         <input type="text" class="form-control" name="property_name" id="add-property">
                        <p class="my-1 form-text">
                            <small>Give this property a name, like size, color or weight</small>
                        </p>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-sm btn-light border" data-bs-dismiss="modal"><small>Cancel</small></button>
                     <button type="submit" class="btn btn-sm btn-orange"><small>Save</small></button>
                 </div>
             </form>

         </div>
     </div>
 </div>