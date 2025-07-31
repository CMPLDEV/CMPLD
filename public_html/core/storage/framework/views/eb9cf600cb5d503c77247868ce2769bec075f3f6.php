<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">View Ticket History </h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>
<form method="post" onSubmit="event.preventDefault()" id="ajax-form" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="id" value="<?php echo e($data->id); ?>" />

<div class="modal-body">

<div class="row">
 <div class="col-lg-12">
 <label><b>Status : </b></label>
 <span class="<?php echo e(ticketStatusColor($data->status)); ?>"><?php echo e($data->status); ?></span>
 </div> 
</div>

<div class="row">
 <div class="col-lg-12">
 <label><b>Subject : </b></label>
 <?php echo e($data->subject); ?>.
 </div> 
</div>

<div class="row">
 <div class="col-lg-6">
 <label><b>CONTRACT No : </b></label>
 <?php echo e($data->contract_no); ?>

 </div>
</div>

<div class="row mt-2">
 <div class="col-lg-12">
 <label><b>Description : </b></label>
 <?php echo e($data->content); ?>

 </div> 
</div>

<div class="row mt-2">
 <div class="col-lg-12">
 <label><b>Product : </b></label>
 <?php echo e($warranty->product_name); ?>

 </div> 
</div>

<?php if(!empty($data->attachment)): ?>
<div class="row mt-2">
 <div class="col-lg-12">
 <label><b><a href="uploaded_files/ticket/<?php echo e($data->attachment); ?>" target="_blank"> <i class="fa fa-paperclip"></i> View Attachment </a> </b></label>
 </div> 
</div>
<?php endif; ?>

<?php if($data->status == "RESOLVED"): ?>
<div class="row mt-2">
 <div class="col-lg-12">
 <a href="<?php echo e(route('userpanel.ticket.close',$data->id)); ?>" class="btn btn-outline-danger" id="ticket-close" title="Click here if, the issue is resolved." onClick="confirmation(event,'This action will change the status to close.','ticket-close');">Close this ticket</a>
 </div> 
</div>
<?php endif; ?>

<hr>

<div class="row">
 <div class="col-lg-12">       
<?php if($comments->isNotEmpty()): ?>
<div id="accordion">
<div class="card">
<a class="card-link" data-bs-toggle="collapse" data-bs-target="#collapseComment" onclick="">
<div class="card-header bg-info">
<strong class="text-white"><i class="fas fa-comments"></i> &nbsp; Show Comment History</strong>
</div>
</a>
<div id="collapseComment" class="collapse" data-parent="#accordion">
<div class="card-body">

<div class="row">

<div class="col-lg-12">

<table class="table table-striped">
<tbody>
<?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr><td><strong>Date & Time &nbsp;<i class="fa fa-angle-double-right"></i>&nbsp;</strong> 
<?php echo e(date('d-m-Y',strtotime($row->created_at))); ?> | <?php echo e(date('h:i:s a',strtotime($row->created_at))); ?></td>
<td><?php echo e($row->status); ?></td>
</tr>
<tr><td colspan="2"><?php echo e($row->message); ?> 
<?php if(!empty($row->attachment)): ?>
&nbsp; <a href="uploaded_files/ticket/<?php echo e($row->attachment); ?>" target="_blank" title="View Attachment"><i class="fa fa-paperclip"></i></a>
<?php endif; ?>
&nbsp;<small class="text-secondary"> <i class="fas fa-user"></i> Admin </small>
</td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>

</div>

</div> 

</div>
</div>
</div>
</div>
<?php endif; ?>
</div>
</div>
</div>
</form>
<?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/user/view-ticket.blade.php ENDPATH**/ ?>