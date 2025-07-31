

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('content'); ?>

<main>
<?php if(!empty($page->banner)): ?>   
 <img src="<?php echo e(showImage($page->banner,'uploaded_files/page')); ?>" alt="<?php echo e(setting()->comp_name); ?>" title="<?php echo e(setting()->comp_name); ?>" class="w-100"> 
<?php endif; ?>
<section class="blog__area pt-100 pb-50">
<div class="container"> 
<div class="row">
<?php if($data->isNotEmpty()): ?>
<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">
<div id="accordion">
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <div class="card">
<div class="card-header">
  <a class="btn" data-bs-toggle="collapse" href="#collapse<?php echo e($row->id); ?>">
    Q<?php echo e($i++); ?>. <?php echo e($row->question); ?>

  </a>
</div>
<div id="collapse<?php echo e($row->id); ?>" class="collapse show" data-bs-parent="#accordion">
  <div class="card-body">
    <?php echo $row->answer; ?>

  </div>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>
<?php endif; ?>

</div>
</div>

</section>

</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/faq.blade.php ENDPATH**/ ?>