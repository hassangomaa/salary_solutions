<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="icon" type="image/x-icon" href="/salary_solutions.png">
    <title><?php echo e(trans('panel.site_title')); ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo e(asset('css/adminltev3.css')); ?>" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
    <?php echo $__env->yieldContent('styles'); ?>
</head>

<body class="header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden login-page">
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html>
<?php /**PATH /media/hassan/AE24833A24830515/php_Projects/htdocs/projects/salary_solutions/resources/views/layouts/app.blade.php ENDPATH**/ ?>