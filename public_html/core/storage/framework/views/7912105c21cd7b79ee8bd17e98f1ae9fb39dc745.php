
<?php $__env->startSection('title','Ticket Detail'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Ticket Detail</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Ticket Detail</li>
</ol>
</div>

</div>
</div>
</div>
<!-- end page title -->

<div class="row">

<div class="col-lg-12">

<div class="card">
<div class="card-body">
<div class="mt-3">
<div class="row">
 <div class="col-lg-9">
 <div class="row">
  <div class="col-lg-2">
  
  </div>

  <div class="col-lg-7">

  </div>
 </div> 


 </div>
 <div class="col-lg-3">
 <a href="<?php echo e(route('ticket')); ?>" class="float-end btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Back"> <i class="ri-arrow-left-double-line"></i> Back</a> 
</div> 
</div>
</div>

<style>
.tabc{font-family: sans-serif;padding: 5px 10px;border-bottom: 1px solid lightgray;border-left: 1px solid lightgray;}
.tabc span{color:#eb4924;}
.bg-white{background-color:#fff;padding:20px;}
</style>
<div class="container-fluid mt-3">
 
<h4 style="background-color: #eb4924;padding: 10px;font-family: sans-serif;
        color: #fff;"> # <?php echo e($ticket->id); ?> Complaint Box</h4>
<div class="bg-white">
<div class="row">
<div class="col-lg-9">
<div class="row">
<div class="col-lg-3 tabc" style="border-top: 1px solid lightgray;">
<span> Complaint</span> - <?php echo e($ticket->name); ?>

</div>
<div class="col-lg-3 tabc" style="border-top: 1px solid lightgray;">
<span> Contact No.</span> - <?php echo e($ticket->mobile); ?>

</div>
<div class="col-lg-6 tabc" style="border-top: 1px solid lightgray;">
<span> Email address</span> - <?php echo e($ticket->email); ?>

</div>

<div class="col-lg-4 tabc">
<span> Subject</span> - <?php echo e($ticket->subject); ?>

</div>

<div class="col-lg-8 tabc">
<span> Product</span> - <?php if(!empty($warranty)): ?> <?php echo e($warranty->product_name); ?> <?php else: ?> N/A <?php endif; ?>
</div>

<div class="col-lg-9 tabc">
<span> Message</span> - <?php echo e($ticket->content); ?>

</div>

<div class="col-lg-3 tabc">
<span> Status</span> - <span class="<?php echo e(ticketStatusColor($ticket->status)); ?> fw-bold"><?php echo e($ticket->status); ?></span>
</div>

<?php if(!empty($ticket->attachment)): ?>
<div class="col-lg-12 tabc">
<span> Attachment</span> - <a href="uploaded_files/ticket/<?php echo e($ticket->attachment); ?>" target="_blank">View <i class="fa fa-paperclip"></i> </a>
</div>
<?php endif; ?>
</div>            
</div>
<div class="col-lg-3 tabc" >
<h4>Update Your Comments</h4> <br>
<form method="POST" action="<?php echo e(route('ticket.update.comment')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
<input type="hidden" name="ticket_id" value="<?php echo e($ticket->id); ?>" />

<span>Status</span>
<select class="form-control" name="status">
 <option value="OPEN" <?php if(isset($ticket)): ?> <?php if($ticket->status == "OPEN"): ?> selected <?php endif; ?> <?php endif; ?>>OPEN</option>
 <option value="WORK IN PROGRESS" <?php if(isset($ticket)): ?> <?php if($ticket->status == "WORK IN PROGRESS"): ?> selected <?php endif; ?> <?php endif; ?>>WORK IN PROGRESS</option>
 <option value="SUSPENDED" <?php if(isset($ticket)): ?> <?php if($ticket->status == "SUSPENDED"): ?> selected <?php endif; ?> <?php endif; ?>>SUSPENDED</option>
 <option value="WAITING FOR USER" <?php if(isset($ticket)): ?> <?php if($ticket->status == "WAITING FOR USER"): ?> selected <?php endif; ?> <?php endif; ?>>WAITING FOR USER</option>
 <option value="RESOLVED" <?php if(isset($ticket)): ?> <?php if($ticket->status == "RESOLVED"): ?> selected <?php endif; ?> <?php endif; ?>>RESOLVED</option>
</select>
<br>
<span> Upload attachment </span> 
<input type="file" class="form-control" name="attachment" /> <br>

<textarea type="text" placeholder="Your Comment" rows="3" class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="message"></textarea> <br>
<?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
<button type="submit" class="btn btn-primary" style="width: 100%;background-color: #1b3480;border: none;">Update Comment</button>  
</form>

</div>
</div>
</div>

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
<a href="uploaded_files/ticket/<?php echo e($row->attachment); ?>" title="View Attachment" target="_blank"><i class="fa fa-paperclip"></i></a>
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

</div>
</div>


</div>
</div>

</div>
<!-- container-fluid -->
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/admin/ticket-detail.blade.php ENDPATH**/ ?>