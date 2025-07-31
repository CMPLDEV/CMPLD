<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>var site_url='<?php echo e(setting()->website_url); ?>';</script>
<script>var admin_url='<?php echo e(setting()->website_url); ?>/admin';</script>
<script src="admin_assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="admin_assets/libs/metismenujs/metismenujs.min.js"></script>
<script src="admin_assets/libs/simplebar/simplebar.min.js"></script>
<script src="admin_assets/libs/feather-icons/feather.min.js"></script>
<!-- apexcharts -->
<script src="admin_assets/libs/apexcharts/apexcharts.min.js"></script>
<!-- Vector map-->
<script src="admin_assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
<script src="admin_assets/libs/jsvectormap/maps/world-merc.js"></script>
<script src="admin_assets/js/pages/dashboard-sales.init.js"></script>
<script src="admin_assets/js/alertify/alertify.min.js"></script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js integrity="sha512-yrOmjPdp8qH8hgLfWpSFhC/+R9Cj9USL8uJxYIveJZGAiedxyIxwNw4RsLDlcjNlIRR4kkHaDHSmNHAkxFTmgg==" crossorigin=anonymous referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="admin_assets/js/custom.js"></script>
<script src="admin_assets/js/shipping.js"></script>
<script src="admin_assets/js/app.js"></script>

<?php echo $__env->yieldContent('custom-script'); ?>
<script>
 $(document).ready(function(){
  $('#myTable').DataTable();
  let message = '<?php echo e(Session::get('message')); ?>';
  let alert_array = message.split("|");
  let type = alert_array[0];
  let msg = alert_array[1];
  if(message!=""){
   notification(type,msg);
  } 

  $("#checkAll").click(function () {
   $('input:checkbox').not(this).prop('checked', this.checked);
  });
}); 
</script>

</body>
</html><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/admin/layouts/footer.blade.php ENDPATH**/ ?>