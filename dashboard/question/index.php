<?php

use Surveyplus\App\Controllers\ProfileController;
use Surveyplus\App\Controllers\QuestionController;

$pageTitle = "All Questions"; ?>

<?php require "../../vendor/autoload.php"; ?>

<?php require DASHBOARD_PATH . "/partials/header.php" ?>

<?php

$questions = new QuestionController();

// Get all questions for user with profile id

$profiles =  new ProfileController();

$profile = $profiles->all_active_profiles($_SESSION["user_id"]);

$all_questions = $questions->show_survey_question($profile["id"]);

?>

<body class="sb-nav-fixed">

    <?php require DASHBOARD_PATH . "/partials/navigation.php" ?>

    <div id="layoutSidenav">

        <?php require DASHBOARD_PATH . "/partials/sidebar.php" ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">


                    <?php require DASHBOARD_PATH . "/partials/notification.php" ?>

                    <div class="row align-items-center">
                        <div class="col-md-6">

                            <h1 class="mt-4"><?= $pageTitle ?></h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">See All Existing Questions</li>
                            </ol>

                        </div>
                        <div class="col-md-6 text-start text-md-end mb-5 mb-md-0">

                            <?php if (isset($_SESSION["handle"]) & !empty($_SESSION["handle"])) : ?>
                                <p class="mb-0 fs-2"><?= $_SESSION["full_name"] ?> </p>
                                <p class="mb-0 fs-5"><?= $_SESSION["handle"] ?> </p>
                            <?php endif ?>

                        </div>
                    </div>

                    <!-- Surveys table -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            <?= $pageTitle ?> Table
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Survey</th>
                                        <th>Answer Type</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Survey</th>
                                        <th>Answer Type</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>



                                    <?php if (isset($all_questions) && !empty($all_questions)) : ?>
                                        <?php foreach ($all_questions as $questions) : ?>


                                            <tr>
                                                <td>
                                                    <?= $questions["name"] ?>

                                                    <?php if ($questions["survey_published"] != 1) : ?>

                                                        <div class="d-block p-0">
                                                            <a href="<?= DASHBOARD_URL . '/question/edit.php?question=' . $questions['id'] . '&action=edit' ?>">Edit Question</a>
                                                        </div>

                                                    <?php endif ?>

                                                </td>
                                                <td>
                                                    <a href="<?= DASHBOARD_URL . "/survey/" ?>"><?= $questions["survey_name"] ?></a> 
                                                    <?php if($questions["survey_published"] == 1): ?>
                                                        <span class="badge bg-primary">Published</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary">Not Published</span>
                                                    <?php endif ?>
                                                </td>
                                                <td><?= ucwords($questions["answer_type"]) ?></td>
                                                <td><?= $questions["createdOn"] ?></td>
                                                <td>
                                                <?php if($questions["survey_published"] != 1): ?>
                                                    <a href="<?= DASHBOARD_URL . '/question/delete.php?question=' . $questions['id'] . '&action=delete' ?>" class="btn btn-danger btn-sm">Delete</a>

                                                <?php endif ?>

                                                </td>
                                            </tr>


                                        <?php endforeach ?>
                                    <?php endif ?>



                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </main>


            <?php require DASHBOARD_PATH . "/partials/content-footer.php" ?>

        </div>

    </div>


    <?php require DASHBOARD_PATH . "/partials/footer.php" ?>

</body>

</html>