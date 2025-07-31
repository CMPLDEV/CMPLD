<div class="modal-header">
<h4 class="modal-title">Return Request (#<?php echo e($order_detail->order_id); ?>)</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body rounded-0">
<form method="post" onSubmit="event.preventDefault()" id="ajax-form" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="order_detail_id" value="<?php echo e($order_detail->id); ?>" />

<div class="row">
 <div class="col-lg-4">
  <a href="<?php echo e(url($product->slug.'.html')); ?>" target="_blank">     
 <?php if(!empty($product)): ?>     
  <img src="<?php echo e(showImage($product->image,'uploaded_files/product')); ?>" width="200" />    
 <?php endif; ?>
  <p><?php echo e($order_detail->item_name); ?></p>
  </a>
 </div>    
 <div class="col-lg-8">
  <div class="row">
 
 <div class="col-lg-12">
  <h6>Why Returning?</h6>
 </div>
 
 <div class="col-lg-6">
  <input type="radio" name="reason" value="Item not as described" id="item_not_as_described" /> <label for="item_not_as_described">Item not as described</label>
 </div>
 
 <div class="col-lg-6">
  <input type="radio" name="reason" value="Damaged during shipping" id="damaged_during_shipping" /> <label for="damaged_during_shipping">Damaged during shipping</label>
 </div>
 
 <div class="col-lg-6">
  <input type="radio" name="reason" value="Defective or malfunctioning" id="defective_or_malfunctioning" /> <label for="defective_or_malfunctioning">Defective or malfunctioning</label>
 </div>
 
 <div class="col-lg-6">
  <input type="radio" name="reason" value="Missing parts or accessories" id="missing_parts_or_accessories" /> <label for="missing_parts_or_accessories">Missing parts or accessories</label>
 </div>
 
 <div class="col-lg-12 mt-3">
  <input type="file" name="image" class="form-control" />     
 </div>
 
 <div class="col-lg-12 mt-3">
  <textarea type="text" class="form-control" placeholder="Brief Description" name="description" rows="4"></textarea>     
 </div>
 
</div>   
 </div>
</div>


<div class="row mt-3">
 <div class="col-lg-12">
  <button type="submit" class="btn-dark cart-btn rounded-0 btn-right btn-sm ajax-btn float-end" onClick="submitReturnRequest();">Submit Request</button>
 </div> 
</div>
</form>
</div><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/user/return_refund/request.blade.php ENDPATH**/ ?>