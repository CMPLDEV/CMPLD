<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<base href="<?php echo e(url('admin/')); ?>">
<title>Admin Dashboard - <?php echo $__env->yieldContent('title','Login'); ?></title>
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="icon" href="<?php echo e(asset('uploaded_files/favicon/'.setting()->favicon)); ?>" />
<!-- plugin css -->
<link href="admin_assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

<!-- Bootstrap Css -->
<link href="admin_assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="admin_assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="admin_assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css" integrity="sha512-g2SduJKxa4Lbn3GW+Q7rNz+pKP9AWMR++Ta8fgwsZRCUsawjPvF/BxSMkGS61VsR9yinGoEgrHPGPn2mrj8+4w==" crossorigin=anonymous referrerpolicy="no-referrer" >
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="admin_assets/css/custom.css">
<link rel="stylesheet" href="admin_assets/css/alertify/alertify.min.css"/>
<link rel="stylesheet" href="admin_assets/css/alertify/default.min.css"/>
<script src="admin_assets/js/ckeditor/ckeditor.js"></script>
</head>
<body>
<!-- Begin page -->
<div id="layout-wrapper">
<?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/admin/layouts/header.blade.php ENDPATH**/ ?>