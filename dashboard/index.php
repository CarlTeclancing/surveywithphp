<?php $pageTitle = "Home"; ?>

<?php require "./../vendor/autoload.php"; ?>

<?php require DASHBOARD_PATH . "/partials/header.php" ?>

<?php

use Surveyplus\App\Controllers\ProfileController;
use Surveyplus\App\Controllers\QuestionController;
use Surveyplus\App\Controllers\SurveyController;
use Surveyplus\App\Controllers\AnswerCategoryController;

    $surveys = new SurveyController();
    $questions = new QuestionController();
    $answer_types = new AnswerCategoryController();
    $profiles = new ProfileController();

    
    $user_id = $_SESSION["user_id"];

    // Get current active user profile
    $profile = $profiles->all_active_profiles($user_id);

    $all_surveys = $surveys->show_all($profile["id"], 2);
    $number_of_surveys = count($surveys->show_all($profile["id"]));
    $number_of_questions = count($questions->show_all($profile["id"]));
    $number_of_answertypes = count($answer_types->show_all());

    // debug_array($_SESSION);

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

                          <h1 class="mt-4">Dashboard</h1>
                          <ol class="breadcrumb mb-4">
                              <li class="breadcrumb-item active">Dashboard</li>
                          </ol>

                      </div>
                      <div class="col-md-6 text-start text-md-end mb-5 mb-md-0">
                         
                        <?php if(isset($_SESSION["handle"]) & !empty($_SESSION["handle"])): ?>
                            <p class="mb-0 fs-2"><?= $_SESSION["full_name"] ?> </p>
                            <p class="mb-0 fs-5"><?= $_SESSION["handle"] ?> </p>
                        <?php endif ?>
                         
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4" style="background-color: #526cfe !important;">
                                <div class="card-body row align-items-center">
                                    <div class="col-lg-6">Surveys</div>
                                    <div class="col-lg-6 text-end fs-6"><?=  !empty($number_of_surveys) ? $number_of_surveys : 0  ?></div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="<?= DASHBOARD_URL . "/survey/" ?>">View</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body row align-items-center">
                                    <div class="col-lg-6">Questions</div>
                                    <div class="col-lg-6 text-end fs-6"><?=  !empty($number_of_questions) ? $number_of_questions : 0  ?></div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="<?= DASHBOARD_URL . "/question/" ?>">View</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4" style="background-color: #526cfe !important;">
                                <div class="card-body row align-items-center">
                                    <div class="col-lg-6">Answers</div>
                                    <div class="col-lg-6 text-end fs-6">0</div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body row align-items-center">
                                    <div class="col-lg-6">Answer Types</div>
                                    <div class="col-lg-6 text-end fs-6"><?=  !empty($number_of_answertypes) ? $number_of_answertypes : 0  ?></div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="<?= DASHBOARD_URL . "/question/" ?>">View</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Area Chart Example
                                </div>
                                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Bar Chart Example
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Recently Added Surveys <a href="<?= DASHBOARD_URL . "/survey/" ?>" class="btn btn-primary btn-sm ms-3">See More Surveys</a>
                        </div>
                        <div class="card-body">
                            
                        <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Published</th>
                                        <th>Expires</th>
                                        <th>Survey Link</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Published</th>
                                        <th>Expires</th>
                                        <th>Survey Link</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php if (isset($all_surveys) && !empty($all_surveys)) : ?>
                                        <?php foreach ($all_surveys as $survey) : ?>

                                            <tr>
                                                <td>
                                                    <?= $survey["name"] ?>
                                                    <?php if($survey["published"] != 1): ?>

                                                        <div class="d-block p-0">
                                                            <a href="<?= DASHBOARD_URL . '/survey/edit.php?survey=' . $survey['id'] . '&action=edit' ?>">Edit Survey</a>
                                                        </div>

                                                    <?php endif ?>
                                                </td>
                                                <td><?= minimize($survey["description"]) ?></td>
                                                <td><?= $survey["createdOn"] ?></td>
                                                <td><?= $survey["updatedOn"] ?></td>
                                                <td>
                                                    <?php if($survey["published"] == 1): ?>
                                                        <span class="badge bg-primary">Published</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary">Not Published</span>
                                                    <?php endif ?>
                                                </td>
                                                <td><?= $survey["expiresOn"] ?></td>
                                                <td>
                                                    <a class="btn btn-warning btn-sm" href="<?= survey($_SESSION["handle"], $survey["id"], $survey["name"], $_SESSION["profile_id"]); ?>" target="_blank">Link</a>
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