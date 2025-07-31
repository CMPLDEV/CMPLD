<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">Raise ticket</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>
<form method="post" onSubmit="event.preventDefault()" id="ajax-form" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="serial_no" value="<?php echo e($data->serial_no); ?>" />

<div class="modal-body">

<h6>Serial No : <?php echo e($data->serial_no); ?></h6>
<h6>* <?php echo e($data->product_name); ?></h6>

<div class="row">
 <div class="col-lg-12">
 <input type="text" id="subject" name="subject" class="form-control" <?php if(isset($edit)): ?> value="<?php echo e($edit->subject); ?>" <?php else: ?> value="<?php echo e(old('subject')); ?>" <?php endif; ?> placeholder="Enter Subject" onKeyup="$(this).text('');">
<br>

<label>Attachment</label>
<input type="file" class="form-control" name="attachment" />

<br>
<textarea name="content" id="content" cols="30" rows="2" class="form-control" placeholder="Describe your problem"><?php if(isset($edit)): ?><?php echo e($edit->content); ?><?php endif; ?></textarea>

 </div> 

</div>

<div class="modal-footer mt-5">
<div class="hstack gap-2 justify-content-end">
<button type="submit" class="btn btn-success ajax-btn btn-sm" id="edit-btn" onClick="createTicket();">Raise</button>
</div>
</div>
</div>
</form>
<?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/user/raise-ticket.blade.php ENDPATH**/ ?>