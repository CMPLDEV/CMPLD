<footer class="footer">
<div class="container-fluid">
<div class="row">
<div class="col-sm-6">
<script>document.write(new Date().getFullYear())</script> &copy; Web Media Tricks.
</div>
<div class="col-sm-6">
<div class="text-sm-end d-none d-sm-block">
Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="https://www.webmediatricks.com/" target="_blank" class="text-reset">Web Media Tricks</a>
</div>
</div>
</div>
</div>
</footer>

<!-- MODAL FOR ADD/EDIT USER START -->
<div class="modal fade addedit-user" data-bs-backdrop="static" data-bs-keyboard="false">
<div class="modal-dialog modal-dialog-scrollable" id="user-modal">
<div class="modal-content rounded-0 addedit-user-content">
</div>
</div>
</div>
<!-- MODAL FOR ADD/EDIT USER END -->

<!-- MODAL FOR PROFILE START -->
<div class="modal fade myprofile" data-bs-backdrop="static" data-bs-keyboard="false">
<div class="modal-dialog modal-dialog-scrollable">
<div class="modal-content rounded-0 profile-content">
</div>
</div>
</div>
<!-- MODAL FOR PROFILE END -->

<!-- Import Product POPUP -->
<div class="modal" id="importProduct" data-bs-backdrop="static" data-bs-keyboard="false">
<div class="modal-dialog">
<div class="modal-content rounded-0">
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">Import Product</h4>
  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<!-- Modal body -->
<div class="modal-body">
<form action="{{route('product.import')}}" method="post" enctype="multipart/form-data">
  @csrf
  <input type="file" name="import_product" id="import_product">
  <button type="submit" class="btn btn-info">Import</button>
</form>
</div>
</div>
</div>
</div>

<!-- Import Identify Product POPUP -->
<div class="modal" id="importIdentifyProduct" data-bs-backdrop="static" data-bs-keyboard="false">
<div class="modal-dialog">
<div class="modal-content rounded-0">
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">Import Identify Product</h4>
  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<!-- Modal body -->
<div class="modal-body">
<form action="{{route('identify.product.import')}}" method="post" enctype="multipart/form-data">
  @csrf
  <input type="file" name="import" id="import">
  <button type="submit" class="btn btn-info">Import</button>
</form>
</div>
</div>
</div>
</div>

<!-- Import User POPUP -->
<div class="modal" id="importUser" data-bs-backdrop="static" data-bs-keyboard="false">
<div class="modal-dialog">
<div class="modal-content rounded-0">
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">Import User</h4>
  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<!-- Modal body -->
<div class="modal-body">
<form action="{{route('user.import')}}" method="post" enctype="multipart/form-data">
  @csrf
  <input type="file" name="import_user" id="import_user">
  <button type="submit" class="btn btn-info">Import</button>
</form>
</div>
</div>
</div>
</div>