<?php session_start(); ?>
<?php
    $check = new Surveyplus\App\Middleware\CheckLoggedInUser();
    $check->userOnly();
    $check->createProfile();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="shortcut icon" href="<?= base_url("images/favicon.png") ?>" type="image/x-icon">
        <title>Surveyplus Dashboard - <?= isset($pageTitle) ? $pageTitle : ""; ?></title>
        <link href="<?= DASHBOARD_URL ?>/assets/datatables/style.css" rel="stylesheet" />
        <link href="<?= DASHBOARD_URL ?>/css/styles.css" rel="stylesheet" />
        <script src="<?= DASHBOARD_URL ?>/assets/fontawesome/js/all.js" crossorigin="anonymous"></script>
        <script src="<?= DASHBOARD_URL ?>/assets/jquery-3.5.1.min.js"></script>
    </head>

    