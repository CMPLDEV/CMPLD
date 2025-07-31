<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<style>
.user-oder tr{
  background-color: #fff !important;
} 
.user-oder td {
  font-size: 12px;
  vertical-align: middle;
  border-bottom: none;
}
.user-oder th{
  color: #000;
  border-bottom: none;
}
</style>

<section class="user-wrap">
<div class="container-fluid">
<div class="row">
<div class="col-lg-3 p-0">
 <?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<div class="col-lg-9">
<div class="dashboard-box">

<h3 class="mb-4"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"><title>order icon</title><path fill="currentcolor" d="M2.013 0a.89.89 0 0 0-.893.892v2.162h.227c.342 0 .646.16.867.402.215-.968 1.603-1.443 4.226-1.443 2.956 0 4.562.505 4.786 1.487.22-.25.543-.411.901-.411h.193V.893c0-.495-.418-.893-.928-.893h-9.38zM6.44 2.572c-1.355 0-3.637.147-3.693 1.112l-.2 1.548-.158 1.147-.114.901h-.262a1.473 1.473 0 0 0-.403.061c-.035.01-.071.023-.105.035-.06.022-.112.042-.166.07-.013.007-.022.02-.035.027-.063.036-.127.07-.184.113-.078.06-.145.136-.21.21-.012.014-.024.021-.035.035A1.516 1.516 0 0 0 .7 8.12c-.013.028-.023.058-.035.088-.026.068-.054.135-.07.21-.004.017-.005.035-.009.052a1.473 1.473 0 0 0-.026.262v1.908h12.32V8.732c0-.09-.01-.177-.026-.262l-.009-.053a1.454 1.454 0 0 0-.061-.21c-.011-.029-.03-.059-.044-.087a1.366 1.366 0 0 0-.07-.131 1.36 1.36 0 0 0-.105-.158c-.01-.014-.023-.02-.035-.035a1.466 1.466 0 0 0-.21-.21c-.057-.043-.121-.077-.184-.114-.013-.006-.022-.02-.035-.026-.054-.03-.107-.048-.166-.07-.034-.012-.069-.025-.105-.035a1.455 1.455 0 0 0-.402-.061h-.263l-.122-.954-.114-.875-.236-1.741c-.064-1.077-3.554-1.138-4.253-1.138zm0 .56c2.36 0 3.595.42 3.701.63l.28 2.153c-.414.07-1.645.245-3.701.245s-3.287-.174-3.701-.245l.288-2.179c.007-.12.583-.604 3.133-.604zm-5.548.482a.663.663 0 0 0-.638.639v1.54c0 .355.298.673.638.673h.42c.356 0 .674-.297.674-.639v-1.54c0-.355-.298-.673-.639-.673H.892zm11.236.035a.64.64 0 0 0-.64.638v1.54c0 .354.287.64.64.64h.42a.663.663 0 0 0 .638-.64v-1.54a.64.64 0 0 0-.639-.638h-.42zM5.205 7.56h3.028c.192 0 .346.114.411.28.02.051.035.106.035.166v1.348a.44.44 0 0 1-.446.446H5.206a.44.44 0 0 1-.446-.446V8.006a.46.46 0 0 1 .035-.166.433.433 0 0 1 .411-.28zM2.152 8.68h1.295c.112 0 .193.08.193.193v.735c0 .111-.08.192-.193.192H2.152a.186.186 0 0 1-.192-.193v-.734c0-.112.08-.193.192-.193zm7.84 0h1.295c.112 0 .193.08.193.193v.735c0 .111-.08.192-.193.192H9.992a.186.186 0 0 1-.192-.193v-.734c0-.112.08-.193.192-.193zM.56 11.2v1.4h12.32v-1.4H.56zm0 1.96c0 .463.377.84.84.84h1.12c.463 0 .84-.377.84-.84H.56zm9.52 0c0 .463.377.84.84.84h1.12c.463 0 .84-.377.84-.84h-2.8z"></path></svg> Return & Refund
</h3>

<div class="input-group mb-3">
 <select class="form-control" name="order_detail_id" onChange="returnRequest(this.value);">
  <option value="">Choose any</option>
  <?php $__currentLoopData = $returnable_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <option value="<?php echo e($row->id); ?>"><?php echo e($row->item_name); ?></option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 </select>
</div>

<?php if($data->isNotEmpty()): ?>
<div class="card mt-4">
<div class="card-body p-0">
<table class="table table-responsive  mb-0 user-oder">
<thead>
<tr>
    <th scope="col">Order ID</th>
    <th scope="col">Product</th>
    <th scope="col">Status</th>
    <th scope="col">Reason</th>
    <th scope="col">Description</th>
    <th scope="col">Refund Status</th>
    <th scope="col">Date</th>
</tr>
</thead>
<tbody>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <tr>
    <th>#<?php echo e($row->order_id); ?></th>
    <td><a href="<?php echo e(url(Str::slug($row->item_name).'.html')); ?>" target="_blank"><?php echo e($row->item_name); ?></a></td>
    <td><?php echo returnStatus($row->status); ?></td>
    <td><?php echo e($row->reason); ?></td>
    <td><?php echo e($row->description); ?></td>
    <td><?php echo refundStatus($row->refund_status); ?></span></td>
    <td><?php echo e(date('d-m-Y',strtotime($row->created_at))); ?></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div>
</div>
<?php else: ?>
 <h4><img src="assets/img/order.webp" alt="" class="empty">
 No orders have been returned yet!
 <br>
 <!--Looks like you haven't made any purchases yet.
 <br>
 <a href="<?php echo e(route('all-categories')); ?>" class="order-explore-bt">Explore Now</a>-->
 </h4>
<?php endif; ?>
</div>
</div>
</div>
</div>
</section>

<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/user/return_refund/index.blade.php ENDPATH**/ ?>