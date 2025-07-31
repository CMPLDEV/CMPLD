<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">Update Tracking No</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
</div>
<form method="post" action="<?php echo e(route('order.shipment.update')); ?>">
<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>

<input type="hidden" name="order_id" value="<?php echo e($order->id); ?>" />

<div class="modal-body">

<div class="row">
    
<div class="col-lg-12 mb-4">
 <input type="text" id="tracking_no" name="tracking_no" class="form-control" value="<?php echo e($order->tracking_no); ?>" placeholder="Tracking No">
</div>

<div class="col-lg-12">
 <textarea type="url" id="tracking_link" name="tracking_link" class="form-control" placeholder="Tracking Link"><?php echo e($order->tracking_link); ?></textarea>
</div>

</div>


<div class="modal-footer mt-2">
<div class="hstack gap-2 justify-content-end">
<button type="submit" class="btn btn-success user-submit btn-sm" id="edit-btn">Update</button>
</div>
</div>
</div>
</form>
<?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/admin/modal/shipping/update-tracking.blade.php ENDPATH**/ ?>