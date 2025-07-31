<div class="modal-header order-header">
<h4 class="modal-title">#<?php echo e($order->id); ?> Cancel</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
 <h2 style="font-size: 15px !important;">Write A Cancel Note</h2>
 <form method="POST" action="<?php echo e(route('userpanel.order.cancel')); ?>">
<?php echo csrf_field(); ?>    
<input type="hidden" name="id" value="<?php echo e($order->id); ?>">
<textarea type="text" class="form-control mb-1 <?php $__errorArgs = ['cancel_note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="cancel_note" placeholder="Write your reason here" rows="3"><?php echo e($order->cancel_note); ?></textarea>
<button type="submit" class="btn update-btn">Cancel</button>
</form>

</div><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/user/cancel-order.blade.php ENDPATH**/ ?>