
<?php $__env->startSection('title','Product List'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Product List</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Product List</li>
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
<h5 class="card-title"><?php if(isset($edit)): ?> Edit <?php else: ?> Add <?php endif; ?> Product
<a href="<?php echo e(route('product')); ?>" class="btn btn-info btn-sm float-end text-white">Back</a></h5>

<hr>

<form method="post" enctype="multipart/form-data" <?php if(isset($edit)): ?> action="<?php echo e(route('product.update',$edit->id)); ?>" <?php else: ?> action="<?php echo e(route('product.create')); ?>" <?php endif; ?>>
 <?php echo csrf_field(); ?>
 
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-bs-toggle="tab" href="#general">General</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#desc">Description</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#additional_attributes">Additional Attributes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#variants">Variants</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#more_images">More Images/Banner</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#seo">SEO</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" id="general">
  
  <div class="row mb-3">

<div class="col-lg-3">
 <?php if(isset($edit) && !empty($edit->image)): ?>
  <img src="<?php echo e(asset(showImage($edit->image,'uploaded_files/product'))); ?>" alt="image" width="150">
   <br> <a href="<?php echo e(route('product.remove.image',[$edit->id,'image'])); ?>" class="text-danger">Remove</a>
 <?php else: ?> 
  <img src="<?php echo e(asset(noImage())); ?>" alt="image" width="100%" class="img-thumbnail">   
 <?php endif; ?> 
 <input type="file" name="image" id="image" class="form-control <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"> 
 <span class="text-danger"><strong>679px x 679px</strong> , <strong>Size:</strong> 150 KB</span>
 <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>  
</div>

<div class="col-sm-9">
<?php if(isset($edit) && !empty($edit->banner)): ?>
  <img src="<?php echo e(asset(showImage($edit->banner,'uploaded_files/product'))); ?>" alt="image" width="100%">
   <br> <a href="<?php echo e(route('product.remove.image',[$edit->id,'banner'])); ?>" class="text-danger">Remove</a>
 <?php else: ?> 
  <img src="<?php echo e(asset(noBanner())); ?>" alt="image" width="100%" class="img-thumbnail">   
 <?php endif; ?> 
 <input type="file" name="banner" id="banner" class="form-control <?php $__errorArgs = ['banner'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> mt-2"> 
 <span class="text-danger"><strong>Dimension:</strong> 1500px x 300px, <strong>Size:</strong> 200 KB</span>
 <?php $__errorArgs = ['banner'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

</div>

  <div class="row">
 
 <div class="col-sm-8">
 <div class="form-floating mb-3">
 <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="name" placeholder="Enter Name" <?php if(isset($edit)): ?> value="<?php echo e($edit->name); ?>" <?php else: ?> value="<?php echo e(old('name')); ?>" <?php endif; ?>>
 <label for="floatingInput">Name</label>
  <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
 </div>
 </div>   
 
 <div class="col-sm-2">
 <div class="form-floating mb-3">
 <input type="text" class="form-control <?php $__errorArgs = ['sku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="sku" placeholder="Enter SKU" <?php if(isset($edit)): ?> value="<?php echo e($edit->sku); ?>" <?php else: ?> value="<?php echo e(old('sku')); ?>" <?php endif; ?>>
 <label for="floatingInput">SKU</label>
  <?php $__errorArgs = ['sku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
 </div>
 </div>

 <div class="col-sm-2">
 <div class="form-floating mb-3">
 <select class="form-control <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="status">
  <option value="1" <?php if(isset($edit)): ?> <?php if($edit->status == 1): ?> selected <?php endif; ?> <?php endif; ?>>ACTIVE</option>
  <option value="0" <?php if(isset($edit)): ?> <?php if($edit->status == 0): ?> selected <?php endif; ?> <?php endif; ?>>INACTIVE</option>
 </select>
 <label for="floatingInput">Choose Status</label>
  <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
 </div>
</div>

</div>

  <div class="row">

<!-- <select name="category_id" id="category_id" class="form-control <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" onChange="categoryForm(this.value);" <?php if(isset($edit)): ?> disabled <?php endif; ?>>
  </select>-->

<div class="col-sm-3">
<div class="form-floating mb-3">
 <select name="category_id" id="category_id" class="form-control <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" onChange="categoryForm(this.value);" <?php if(isset($edit) && !empty($edit->category_id)): ?> disabled <?php endif; ?>>
 <option value="">Choose Category</option>
  <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <option value="<?php echo e($row->id); ?>" <?php if(isset($edit)): ?> <?php if($row->id == $edit->category_id): ?> selected <?php endif; ?> <?php endif; ?>> &nbsp; <?php echo e($row->name); ?> </option>
   <?php $__currentLoopData = adminCategories($row->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <option value="<?php echo e($row->id); ?>" <?php if(isset($edit)): ?> <?php if($row->id == $edit->category_id): ?> selected <?php endif; ?> <?php endif; ?>> &nbsp; - <?php echo e($row->name); ?> </option>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </select>
  <label>Categories</label>
  <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
 </div>
</div>
    
<div class="col-sm-2">
 <div class="form-floating mb-3">
 <input type="text" class="form-control <?php $__errorArgs = ['mrp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="mrp" placeholder="Enter MRP" <?php if(isset($edit)): ?> value="<?php echo e($edit->mrp); ?>" <?php else: ?> value="<?php echo e(old('mrp')); ?>" <?php endif; ?> title="Enter MRP">
 <label for="floatingInput"> MRP Price </label>
  <?php $__errorArgs = ['mrp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
 </div>
</div>

<div class="col-sm-2">
 <div class="form-floating mb-3">
 <input type="text" class="form-control <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="price" placeholder="Enter Price" <?php if(isset($edit)): ?> value="<?php echo e($edit->price); ?>" <?php else: ?> value="<?php echo e(old('price')); ?>" <?php endif; ?> title="Enter Price, if product is for sale.">
 <label for="floatingInput">Sale Price</label>
  <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
 </div>
</div>

<div class="col-sm-2">
 <div class="form-floating mb-3">
 <input type="text" class="form-control <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="stock" placeholder="Enter Stock" <?php if(isset($edit)): ?> value="<?php echo e($edit->stock); ?>" <?php else: ?> value="<?php echo e(old('stock')); ?>" <?php endif; ?> title="Enter Stock.">
 <label for="floatingInput">Stock</label>
  <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
 </div>
</div>

<div class="col-sm-2">
 <div class="form-floating mb-3">
 <input type="text" class="form-control <?php $__errorArgs = ['asin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="asin" placeholder="Enter Asin" <?php if(isset($edit)): ?> value="<?php echo e($edit->asin); ?>" <?php else: ?> value="<?php echo e(old('asin')); ?>" <?php endif; ?> title="Enter Asin.">
 <label for="floatingInput">Asin</label>
  <?php $__errorArgs = ['asin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
 </div>
</div>
    
</div>

  <div class="row"> 

<div class="col-sm-4">
 <div class="form-floating mb-3">
 <input type="text" class="form-control <?php $__errorArgs = ['keywords'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="keywords" placeholder="Enter Keywords" <?php if(isset($edit)): ?> value="<?php echo e($edit->keywords); ?>" <?php else: ?> value="<?php echo e(old('keywords')); ?>" <?php endif; ?>>
 <label for="floatingInput">Product Keywords</label>
  <?php $__errorArgs = ['keywords'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
 </div>
</div>

<div class="col-sm-3">
 <div class="form-floating mb-3">
 <input type="text" class="form-control <?php $__errorArgs = ['video'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="video" placeholder="Enter Video Code" <?php if(isset($edit)): ?> value="<?php echo e($edit->video); ?>" <?php else: ?> value="<?php echo e(old('video')); ?>" <?php endif; ?> maxlength="11">
 <label for="floatingInput">Youtube Video [11 digits code]</label>
  <?php $__errorArgs = ['video'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
 </div>
</div>

 <div class="col-sm-3">
 <div class="form-floating mb-3">
 <select class="form-control <?php $__errorArgs = ['warranty_period'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="warranty_period">
  <?php for($i = 1; $i <= 36; $i++): ?>
   <option value="<?php echo e($i); ?>" <?php if(isset($edit)): ?> <?php if($edit->warranty_period == $i): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($i); ?></option>
  <?php endfor; ?>
 </select>
 <label for="floatingInput">Choose Warranty Duration (Months)</label>
  <?php $__errorArgs = ['warranty_period'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
 </div>
</div>

<div class="col-sm-2">
<div class="form-floating mb-3">
 <select name="brand_id" id="brand_id" class="form-control <?php $__errorArgs = ['brand_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
 <option value="">Choose Brand</option>
  <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <option value="<?php echo e($row->id); ?>" <?php if(isset($edit)): ?> <?php if($row->id == $edit->brand_id): ?> selected <?php endif; ?> <?php endif; ?>> &nbsp; <?php echo e($row->name); ?> </option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </select>
  <label>Brands</label>
  <?php $__errorArgs = ['brand_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
 </div>
</div>

<div class="col-sm-4">
 <label for="floatingInput"><img src="assets/img/replacement.png" alt="Replacement" width="30"></label>    
 <input type="text" class="form-control <?php $__errorArgs = ['replacement'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="replacement" <?php if(isset($edit)): ?> value="<?php echo e($edit->replacement); ?>" <?php else: ?> value="<?php echo e(old('replacement')); ?>" <?php endif; ?>>
  <?php $__errorArgs = ['replacement'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="col-sm-4">
 <label for="floatingInput"><img src="assets/img/delivery.png" alt="Delivery" width="30"></label>    
 <input type="text" class="form-control <?php $__errorArgs = ['delivery'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="delivery" <?php if(isset($edit)): ?> value="<?php echo e($edit->delivery); ?>" <?php else: ?> value="<?php echo e(old('delivery')); ?>" <?php endif; ?>>
  <?php $__errorArgs = ['delivery'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="col-sm-4">
 <label for="floatingInput"><img src="assets/img/shield.png" alt="Warranty" width="30"></label>     
 <input type="text" class="form-control <?php $__errorArgs = ['warranty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="warranty" <?php if(isset($edit)): ?> value="<?php echo e($edit->warranty); ?>" <?php else: ?> value="<?php echo e(old('warranty')); ?>" <?php endif; ?>>
  <?php $__errorArgs = ['warranty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
</div>

  <div class="row mt-3">
    
<div class="col-sm-4">
 <label for="floatingInput"><img src="assets/img/badge.png" alt="Brand" width="30"></label>    
 <input type="text" class="form-control <?php $__errorArgs = ['brand'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="brand" <?php if(isset($edit)): ?> value="<?php echo e($edit->brand); ?>" <?php else: ?> value="<?php echo e(old('brand')); ?>" <?php endif; ?>>
  <?php $__errorArgs = ['brand'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="col-sm-4">
 <label for="floatingInput"><img src="assets/img/bluedart.png" alt="Blue Dart" width="30"></label>    
 <input type="text" class="form-control <?php $__errorArgs = ['bluedart'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="bluedart" <?php if(isset($edit)): ?> value="<?php echo e($edit->bluedart); ?>" <?php else: ?> value="<?php echo e(old('bluedart')); ?>" <?php endif; ?>>
  <?php $__errorArgs = ['bluedart'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="col-sm-4">
 <label for="floatingInput"><img src="assets/img/secure-transaction.png" alt="Secure Transaction" width="30"></label>    
 <input type="text" class="form-control <?php $__errorArgs = ['secure'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="secure" <?php if(isset($edit)): ?> value="<?php echo e($edit->secure); ?>" <?php else: ?> value="<?php echo e(old('secure')); ?>" <?php endif; ?>>
  <?php $__errorArgs = ['secure'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

</div>
  
  </div>
  <div class="tab-pane container fade" id="desc">
      
  <div class="col-sm-12 mb-3 mt-2">
 <label for="floatingInput">Short Description</label>
 <textarea type="text" class="form-control" id="short_content" rows="3" name="short_content" placeholder="Enter Short Description" <?php if(isset($edit)): ?> value="<?php echo e($edit->short_content); ?>" <?php else: ?> value="<?php echo e(old('short_content')); ?>" <?php endif; ?>><?php if(isset($edit)): ?> <?php echo e($edit->short_content); ?> <?php endif; ?></textarea>
  <?php $__errorArgs = ['short_content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<script>CKEDITOR.replace('short_content');</script>      
  
  <div class="col-sm-12 mt-3">
<label for="">Description</label> 
 <div class="form-floating mb-3"> 
 <textarea type="text" class="form-control" id="content" rows="4" name="content" placeholder="Enter Content" ><?php if(isset($edit)): ?><?php echo e($edit->content); ?><?php endif; ?></textarea>
  <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
 </div>
</div>
<script>CKEDITOR.replace('content');</script>

<div class="col-sm-12 mt-3">
<label for="">Additional Information</label> 
 <div class="form-floating mb-3"> 
 <textarea type="text" class="form-control" id="additional_information" rows="4" name="additional_information" placeholder="Enter Content" ><?php if(isset($edit)): ?><?php echo e($edit->additional_information); ?><?php endif; ?></textarea>
  <?php $__errorArgs = ['additional_information'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
 </div>
</div>
<script>CKEDITOR.replace('additional_information');</script>
  
  </div>
  <div class="tab-pane container fade" id="additional_attributes">
   <br/>
<?php if(isset($edit)): ?>
 <?php if($attributes->isNotEmpty()): ?>
  <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <?php
    $cat_attr_values = array_map('trim', explode(',',$row->cat_attr_value));
   ?>
<div class="row element">

<input type="hidden" name="cat_attr_id[]" value="<?php echo e($row->cat_attr_id); ?>" />     
    
<div class="col-sm-6">
<div class="form-floating mb-3">
<input type="text" class="form-control" id="floatingInput" name="key[]" placeholder="Key" value="<?php echo e($row->pro_attr_key); ?>" readonly><label for="floatingInput">Key</label>
</div>
</div>

<div class="col-sm-6">
<div class="form-floating mb-3">
<select class="form-control" name="value[]">
 <option value="none">None</option>
 <?php $__currentLoopData = $cat_attr_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <option value="<?php echo e($value); ?>" <?php if($value == $row->pro_attr_value): ?> selected <?php endif; ?>><?php echo e($value); ?></option>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>    
<label for="floatingInput">Value</label>
</div>
</div>

</div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <?php endif; ?>
 
<!-- NON ADDED ATTRIBUTES --> 
 
<?php if($category_attributes->isNotEmpty()): ?>
 <?php $__currentLoopData = $category_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php
   $values = explode(',',$row->value);
  ?>
<div class="row element">

<input type="hidden" name="cat_attr_id[]" value="<?php echo e($row->id); ?>" />    
    
<div class="col-sm-6">
<div class="form-floating mb-3">
<input type="text" class="form-control" id="floatingInput" name="key[]" placeholder="Key" value="<?php echo e($row->key); ?>" readonly><label for="floatingInput">Key</label>
</div>
</div>

<div class="col-sm-6">
<div class="form-floating mb-3">
<select class="form-control" name="value[]">
 <option value="none">None</option>
 <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <option value="<?php echo e($value); ?>"><?php echo e($value); ?></option>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>    
<label for="floatingInput">Value</label>
</div>
</div>

</div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <?php endif; ?>
 
<?php endif; ?>

<div id="more_attributes"></div>
  
  </div>
  <div class="tab-pane container fade" id="variants">
   
   <div class="row mt-2">
    <h6>Variant 1</h6> 
    <div class="col-sm-3">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant1_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant1_title" placeholder="Enter Title" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant1_title); ?>" <?php else: ?> value="<?php echo e(old('variant1_title')); ?>" <?php endif; ?>>
    <label for="floatingInput">Title</label>
    <?php $__errorArgs = ['variant1_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
    
    <div class="col-sm-4">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant1_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant1_image" placeholder="Enter Image Link" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant1_image); ?>" <?php else: ?> value="<?php echo e(old('variant1_image')); ?>" <?php endif; ?>>
    <label for="floatingInput">Image Link</label>
    <?php $__errorArgs = ['variant1_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
    
    <div class="col-sm-5">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant1_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant1_url" placeholder="Enter URL" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant1_url); ?>" <?php else: ?> value="<?php echo e(old('variant1_url')); ?>" <?php endif; ?>>
    <label for="floatingInput">URL to Redirect</label>
    <?php $__errorArgs = ['variant1_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
       
   </div>
   <div class="row mt-1">
    <h6>Variant 2</h6> 
    <div class="col-sm-3">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant2_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant2_title" placeholder="Enter Title" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant2_title); ?>" <?php else: ?> value="<?php echo e(old('variant2_title')); ?>" <?php endif; ?>>
    <label for="floatingInput">Title</label>
    <?php $__errorArgs = ['variant2_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
    
    <div class="col-sm-4">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant2_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant2_image" placeholder="Enter Image Link" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant2_image); ?>" <?php else: ?> value="<?php echo e(old('variant2_image')); ?>" <?php endif; ?>>
    <label for="floatingInput">Image Link</label>
    <?php $__errorArgs = ['variant2_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
    
    <div class="col-sm-5">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant2_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant2_url" placeholder="Enter URL" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant2_url); ?>" <?php else: ?> value="<?php echo e(old('variant2_url')); ?>" <?php endif; ?>>
    <label for="floatingInput">URL to Redirect</label>
    <?php $__errorArgs = ['variant2_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
       
   </div>
   <div class="row mt-1">
    <h6>Variant 3</h6> 
    <div class="col-sm-3">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant3_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant3_title" placeholder="Enter Title" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant3_title); ?>" <?php else: ?> value="<?php echo e(old('variant3_title')); ?>" <?php endif; ?>>
    <label for="floatingInput">Title</label>
    <?php $__errorArgs = ['variant3_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
    
    <div class="col-sm-4">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant3_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant3_image" placeholder="Enter Image Link" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant3_image); ?>" <?php else: ?> value="<?php echo e(old('variant3_image')); ?>" <?php endif; ?>>
    <label for="floatingInput">Image Link</label>
    <?php $__errorArgs = ['variant3_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
    
    <div class="col-sm-5">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant3_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant3_url" placeholder="Enter URL" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant3_url); ?>" <?php else: ?> value="<?php echo e(old('variant3_url')); ?>" <?php endif; ?>>
    <label for="floatingInput">URL to Redirect</label>
    <?php $__errorArgs = ['variant3_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
       
   </div>
   <div class="row mt-1">
    <h6>Variant 4</h6> 
    <div class="col-sm-3">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant4_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant4_title" placeholder="Enter Title" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant4_title); ?>" <?php else: ?> value="<?php echo e(old('variant4_title')); ?>" <?php endif; ?>>
    <label for="floatingInput">Title</label>
    <?php $__errorArgs = ['variant4_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
    
    <div class="col-sm-4">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant4_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant4_image" placeholder="Enter Image Link" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant4_image); ?>" <?php else: ?> value="<?php echo e(old('variant4_image')); ?>" <?php endif; ?>>
    <label for="floatingInput">Image Link</label>
    <?php $__errorArgs = ['variant4_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
    
    <div class="col-sm-5">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant4_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant4_url" placeholder="Enter URL" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant4_url); ?>" <?php else: ?> value="<?php echo e(old('variant4_url')); ?>" <?php endif; ?>>
    <label for="floatingInput">URL to Redirect</label>
    <?php $__errorArgs = ['variant4_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
       
   </div>
   <div class="row mt-1">
    <h6>Variant 5</h6> 
    <div class="col-sm-3">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant5_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant5_title" placeholder="Enter Title" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant5_title); ?>" <?php else: ?> value="<?php echo e(old('variant5_title')); ?>" <?php endif; ?>>
    <label for="floatingInput">Title</label>
    <?php $__errorArgs = ['variant5_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
    
    <div class="col-sm-4">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant5_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant5_image" placeholder="Enter Image Link" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant5_image); ?>" <?php else: ?> value="<?php echo e(old('variant5_image')); ?>" <?php endif; ?>>
    <label for="floatingInput">Image Link</label>
    <?php $__errorArgs = ['variant5_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
    
    <div class="col-sm-5">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant5_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant5_url" placeholder="Enter URL" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant5_url); ?>" <?php else: ?> value="<?php echo e(old('variant5_url')); ?>" <?php endif; ?>>
    <label for="floatingInput">URL to Redirect</label>
    <?php $__errorArgs = ['variant5_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
       
   </div>
   <div class="row mt-2">
    <h6>Variant 6</h6> 
    <div class="col-sm-3">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant6_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant6_title" placeholder="Enter Title" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant6_title); ?>" <?php else: ?> value="<?php echo e(old('variant6_title')); ?>" <?php endif; ?>>
    <label for="floatingInput">Title</label>
    <?php $__errorArgs = ['variant6_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
    
    <div class="col-sm-4">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant6_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant6_image" placeholder="Enter Image Link" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant6_image); ?>" <?php else: ?> value="<?php echo e(old('variant6_image')); ?>" <?php endif; ?>>
    <label for="floatingInput">Image Link</label>
    <?php $__errorArgs = ['variant6_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
    
    <div class="col-sm-5">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant6_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant6_url" placeholder="Enter URL" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant6_url); ?>" <?php else: ?> value="<?php echo e(old('variant6_url')); ?>" <?php endif; ?>>
    <label for="floatingInput">URL to Redirect</label>
    <?php $__errorArgs = ['variant6_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
       
   </div>
   <div class="row mt-1">
    <h6>Variant 7</h6> 
    <div class="col-sm-3">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant7_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant7_title" placeholder="Enter Title" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant7_title); ?>" <?php else: ?> value="<?php echo e(old('variant7_title')); ?>" <?php endif; ?>>
    <label for="floatingInput">Title</label>
    <?php $__errorArgs = ['variant7_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
    
    <div class="col-sm-4">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant7_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant7_image" placeholder="Enter Image Link" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant7_image); ?>" <?php else: ?> value="<?php echo e(old('variant7_image')); ?>" <?php endif; ?>>
    <label for="floatingInput">Image Link</label>
    <?php $__errorArgs = ['variant7_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
    
    <div class="col-sm-5">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant7_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant7_url" placeholder="Enter URL" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant7_url); ?>" <?php else: ?> value="<?php echo e(old('variant7_url')); ?>" <?php endif; ?>>
    <label for="floatingInput">URL to Redirect</label>
    <?php $__errorArgs = ['variant7_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
       
   </div>
   <div class="row mt-1">
    <h6>Variant 8</h6> 
    <div class="col-sm-3">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant8_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant8_title" placeholder="Enter Title" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant8_title); ?>" <?php else: ?> value="<?php echo e(old('variant8_title')); ?>" <?php endif; ?>>
    <label for="floatingInput">Title</label>
    <?php $__errorArgs = ['variant8_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
    
    <div class="col-sm-4">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant8_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant8_image" placeholder="Enter Image Link" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant8_image); ?>" <?php else: ?> value="<?php echo e(old('variant8_image')); ?>" <?php endif; ?>>
    <label for="floatingInput">Image Link</label>
    <?php $__errorArgs = ['variant8_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
    
    <div class="col-sm-5">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant8_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant8_url" placeholder="Enter URL" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant8_url); ?>" <?php else: ?> value="<?php echo e(old('variant8_url')); ?>" <?php endif; ?>>
    <label for="floatingInput">URL to Redirect</label>
    <?php $__errorArgs = ['variant8_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
       
   </div>
   <div class="row mt-1">
    <h6>Variant 9</h6> 
    <div class="col-sm-3">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant9_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant9_title" placeholder="Enter Title" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant9_title); ?>" <?php else: ?> value="<?php echo e(old('variant9_title')); ?>" <?php endif; ?>>
    <label for="floatingInput">Title</label>
    <?php $__errorArgs = ['variant9_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
    
    <div class="col-sm-4">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant9_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant9_image" placeholder="Enter Image Link" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant9_image); ?>" <?php else: ?> value="<?php echo e(old('variant9_image')); ?>" <?php endif; ?>>
    <label for="floatingInput">Image Link</label>
    <?php $__errorArgs = ['variant9_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
    
    <div class="col-sm-5">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant9_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant9_url" placeholder="Enter URL" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant9_url); ?>" <?php else: ?> value="<?php echo e(old('variant9_url')); ?>" <?php endif; ?>>
    <label for="floatingInput">URL to Redirect</label>
    <?php $__errorArgs = ['variant9_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
       
   </div>
   <div class="row mt-1">
    <h6>Variant 10</h6> 
    <div class="col-sm-3">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant10_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant10_title" placeholder="Enter Title" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant10_title); ?>" <?php else: ?> value="<?php echo e(old('variant10_title')); ?>" <?php endif; ?>>
    <label for="floatingInput">Title</label>
    <?php $__errorArgs = ['variant10_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
    
    <div class="col-sm-4">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant10_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant10_image" placeholder="Enter Image Link" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant10_image); ?>" <?php else: ?> value="<?php echo e(old('variant10_image')); ?>" <?php endif; ?>>
    <label for="floatingInput">Image Link</label>
    <?php $__errorArgs = ['variant10_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
    
    <div class="col-sm-5">
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['variant10_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="variant10_url" placeholder="Enter URL" <?php if(isset($edit)): ?> value="<?php echo e($edit->variant10_url); ?>" <?php else: ?> value="<?php echo e(old('variant10_url')); ?>" <?php endif; ?>>
    <label for="floatingInput">URL to Redirect</label>
    <?php $__errorArgs = ['variant10_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>
       
   </div>
   
  </div>
  <div class="tab-pane container fade" id="more_images">
   <div class="card mt-2">
    <div class="card-header"> 
    <h6 class="text-white"> Upload More Images : <input type="file" name="more_images[]" multiple> </h6> 
    <small class="text-white">You can select multiple files at once. </small> <br>
    <small class="text-white">File size should be less than or equals to 250 KB.</small>
    </div>
    <div class="card-body">
    
    <div class="row">
    <?php if(isset($edit)): ?>  
    <?php if(moreImages($edit->id)->isNotEmpty()): ?>
    <?php $__currentLoopData = moreImages($edit->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-lg-1 col-xs-6">
    <img src="<?php echo e(asset('uploaded_files/more_image/'.$row->image)); ?>" width="100%"> 
    <center><a href="<?php echo e(route('product.remove.moreimg',$row->id)); ?>" class="text-danger" onClick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a></center>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php endif; ?> 
    </div>
    </div>
    </div>
    <hr>
    <div class="card">
    <div class="card-header"> 
    <h6 class="text-white"> Upload More Banner : <input type="file" name="more_banners[]" multiple> </h6> 
    <small class="text-white">You can select multiple files at once. </small> <br>
    <small class="text-white">File size should be less than or equals to 250KB.</small>
    </div>
    <div class="card-body">
    
    <div class="row">
    <?php if(isset($edit)): ?>  
    <?php if(moreBanners($edit->id)->isNotEmpty()): ?>
    <?php $__currentLoopData = moreBanners($edit->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-lg-1 col-xs-6">
    <img src="<?php echo e(asset('uploaded_files/more_image/'.$row->image)); ?>" width="100%"> 
    <center><a href="<?php echo e(route('product.remove.morebanner',$row->id)); ?>" class="text-danger" onClick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a></center>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php endif; ?> 
    </div>
    </div>
    </div>   
  </div>
  <div class="tab-pane container fade" id="seo">

<div class="col-sm-12 mt-3">
 <div class="form-floating mb-3">
 <textarea type="text" class="form-control" id="floatingInput" rows="3" name="meta_title" placeholder="Enter Meta Title" ><?php if(isset($edit)): ?><?php echo e($edit->meta_title); ?><?php endif; ?></textarea>
 <label for="floatingInput">Meta Title</label>
  <?php $__errorArgs = ['meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
 </div>
</div>

<div class="col-sm-12 mt-3">
 <div class="form-floating mb-3">
 <textarea type="text" class="form-control" id="floatingInput" rows="3" name="meta_description" placeholder="Enter Meta Description"><?php if(isset($edit)): ?><?php echo e($edit->meta_description); ?><?php endif; ?></textarea>
 <label for="floatingInput">Meta Description</label>
  <?php $__errorArgs = ['meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
 </div>
</div>

<div class="col-sm-12 mt-3">
 <div class="form-floating mb-3">
 <textarea type="text" class="form-control" id="floatingInput" rows="3" name="meta_keywords" placeholder="Enter Meta Keywords" ><?php if(isset($edit)): ?><?php echo e($edit->meta_keywords); ?><?php endif; ?></textarea>
 <label for="floatingInput">Meta Keywords</label>
  <?php $__errorArgs = ['meta_keywords'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
 </div>
</div>   
  </div>
</div> 

<div class="row">
<div class="col-sm-3 offset-sm-9 mt-3">
  <button type="submit" class="btn btn-primary float-end">Submit</button>  
</div>

</form>
</div>

</div>
</div>

</div>

</div>
<!-- container-fluid -->
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/admin/addedit-product.blade.php ENDPATH**/ ?>