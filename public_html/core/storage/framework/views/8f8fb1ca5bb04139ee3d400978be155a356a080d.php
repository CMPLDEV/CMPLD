

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('content'); ?>

<main>

<section class="blog__area pt-100 pb-100">
<div class="container"> 
<div class="row">
<div class="col-lg-12">
<div class="market-area-heading">
 <h1><?php echo e($page->name); ?></h1>
</div>
<div class="market-area">

<h4><a href="javascript:void(0);">Pages</a></h4>
<ul class="row">
<?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <li class="col-md-3 col-sm-6 col-12 my-2 market-aera-name"><a href="<?php echo e(route($row->slug)); ?>"><?php echo e($row->name); ?></a></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>

<h4><a href="javascript:void(0);">Blogs</a></h4>
<ul class="row">
<?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <li class="col-md-3 col-sm-6 col-12 my-2 market-aera-name"><a href="<?php echo e(route('blog.detail',$row->slug)); ?>"><?php echo e($row->name); ?></a></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>

<h4><a href="javascript:void(0);">Categories</a></h4>
<ul class="row">
<?php $__currentLoopData = categories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <li class="col-md-3 col-sm-6 col-12 my-2 market-aera-name"><a href="<?php echo e(categoryURL($row->slug)); ?>"><?php echo e($row->name); ?></a></li>
 <?php $__currentLoopData = categories($row->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <li class="col-md-3 col-sm-6 col-12 my-2 market-aera-name"><a href="<?php echo e(categoryURL($row->slug)); ?>"><?php echo e($row->name); ?></a></li>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>

<h4><a href="javascript:void(0);">Products List</a></h4>
<ol class="row" type="1" >
<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <li class="col-md-12 col-sm-12 col-12 my-2 market-aera-name"> <b><?php echo e(++$i); ?>.</b> <a href="<?php echo e(productURL($row->slug)); ?>"><?php echo e($row->name); ?></a></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ol>
<?php echo e($products->links()); ?>

</div>  
</div> 

</div>

</div>
</section>
</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/sitemap.blade.php ENDPATH**/ ?>