<!-- Modal Header -->
  <div class="modal-header">
    <h4 class="modal-title">Best price on the product</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
  </div>

<form method="POST" id="negotiation-form" onSubmit="event.preventDefault();">
 <?php echo csrf_field(); ?>    
  <div class="modal-body">
  
  <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>" />
  
  <div class="container">
   <div class="row">
    <div class="col-lg-5 col-sm-12">
    <img src="<?php echo e(showImage($product->image,'uploaded_files/product')); ?>" class="img-thumbnail" width="100%" />    
    </div>   
    <div class="col-lg-7 col-sm-12">
      
      <div class="col-lg-12 mb-3">
       <label><strong>Email Address</strong></label>      
       <input type="text" class="form-control" name="email" placeholder="Enter Email Address" />      
      </div>
      
      <div class="col-lg-12 mb-3">
       <label><strong>Mobile No</strong></label>      
       <input type="text" class="form-control" name="mobile" placeholder="Enter Mobile No" maxlength="10" />      
      </div>
      
      <div class="col-lg-12 mb-3">
       <label><strong>Where you found this product at a lower price</strong></label>      
       <input type="text" class="form-control" name="product_found_on" placeholder="Enter Where you found this product at a lower price." />
      </div>
      
      <div class="col-lg-12 mb-3">
       <label><strong>Lower Price</strong></label>      
       <input type="number" class="form-control" name="price" placeholder="Enter Lower Price" min="1" />      
      </div>
      
    </div>
   </div>      
  </div>
  
  </div>

  <div class="modal-footer">
   <button type="submit" class="btn btn-danger ajax-btn" onClick="submitProductNegotiation();">Submit</button>
  </div>
</form>  <?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/ajax/product-negotiation.blade.php ENDPATH**/ ?>