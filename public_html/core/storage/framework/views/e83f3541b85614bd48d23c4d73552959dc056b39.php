

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('content'); ?>

<style>
/* Container for the certificate */
.certificate-container {
  width: 350px;
  background: #fff;
  border-radius: 12px;
  border: 2px solid #dcdcdc;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
  padding: 25px;
  font-family: 'Verdana', sans-serif;
  margin: 30px auto;
  text-align: center;
}

/* Header with border */
.certificate-header {
  background: #f4f4f4;
  padding: 15px;
  border-radius: 8px;
  margin-bottom: 15px;
  border: 1px solid #e0e0e0;
}

.certificate-title {
  font-size: 22px;
  color: #333;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 3px;
  margin: 0;
}

/* Recipient's name */
.certificate-name {
  font-size: 32px;
  color: #2c3e50;
  font-weight: 600;
  margin-top: 20px;
  font-family: 'Georgia', serif;
  position: relative;
}

.certificate-name::after {
  content: "";
  position: absolute;
  width: 50%;
  height: 3px;
  background-color: #3498db;
  bottom: -8px;
  left: 25%;
}

/* Description of achievement */
.certificate-description {
  font-size: 18px;
  color: #7f8c8d;
  margin-top: 15px;
  font-style: italic;
}

/* Date of issue */
.certificate-date {
  font-size: 14px;
  color: #95a5a6;
  margin-top: 15px;
  font-weight: bold;
  text-transform: uppercase;
}

/* Hover effect */
.certificate-container:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

</style>

<main>
<section class="blog__area pt-100 pb-50 mt-5">
<div class="container"> 
<div class="row">
    
<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-12">

<div class="certificate-container">
 <a href="<?php echo e(url('buy-with-confidence/2022-epeat-purchaser-award')); ?>">    
  <div class="certificate-header">
    <h2 class="certificate-title">2022 Epeat Purchaser Award</h2>
  </div>
  <div class="certificate-body">
    <h3 class="certificate-name">CMPL</h3>
    <p class="certificate-description"><i class="fad fa-shield-alt fa-2x"></i></p>
    <p class="certificate-date">Issued: 11 November 2022</p>
  </div>
  </a>
</div>

</div>

<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-12">
    
<div class="certificate-container">
 <a href="<?php echo e(url('buy-with-confidence/certificate-of-compliance')); ?>">    
  <div class="certificate-header">
    <h2 class="certificate-title">Certificate of Compliance</h2>
  </div>
  <div class="certificate-body">
    <h3 class="certificate-name">CMPL</h3>
    <p class="certificate-description"><i class="fad fa-shield-alt fa-2x"></i></p>
    <p class="certificate-date">Issued: 10 October 2024</p>
  </div>
  </a>
</div>    
    
</div>

<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-12">

<div class="certificate-container">
 <a href="<?php echo e(url('buy-with-confidence/bureau-of-indian-standards')); ?>">    
  <div class="certificate-header">
    <h2 class="certificate-title">Bureau of Indian Standards</h2>
  </div>
  <div class="certificate-body">
    <h3 class="certificate-name">CMPL</h3>
    <p class="certificate-description"><i class="fad fa-shield-alt fa-2x"></i></p>
    <p class="certificate-date">Issued: 28 November 2022</p>
  </div>
  </a>
</div>    
    
</div>

<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-12">

<div class="certificate-container">
 <a href="<?php echo e(url('buy-with-confidence/certificate-of-recognition')); ?>">    
  <div class="certificate-header">
    <h2 class="certificate-title">Certificate of Recognition</h2>
  </div>
  <div class="certificate-body">
    <h3 class="certificate-name">CMPL</h3>
    <p class="certificate-description"><i class="fad fa-shield-alt fa-2x"></i></p>
    <p class="certificate-date">Issued: 01 October 2024</p>
  </div>
  </a>
</div>     
    
</div>

<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-12">

<div class="certificate-container">
 <a href="<?php echo e(url('buy-with-confidence/msme-certificate')); ?>">    
  <div class="certificate-header">
    <h2 class="certificate-title">MSME Certificate</h2>
  </div>
  <div class="certificate-body">
    <h3 class="certificate-name">CMPL</h3>
    <p class="certificate-description"><i class="fad fa-shield-alt fa-2x"></i></p>
    <p class="certificate-date">Issued: 17 August 2016</p>
  </div>
  </a>
</div>    
    
</div>

</div>

</div>
</section>
<!-- blog area end -->
</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/buy-with-confidence.blade.php ENDPATH**/ ?>