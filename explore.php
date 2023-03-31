<?php $pageTitle = "Explore Surveys"; ?>
<?php require "partials/header.php" ?>
<?php require "partials/navigation.php" ?>

<?php

use Surveyplus\App\Controllers\SurveyController;

if (!isset($_GET["q"]) && empty($_GET["q"])) {


    $surveys = new SurveyController();
    $allPublishedSurveys = $surveys->showAllPublished(true);

    $perPage = 4;

    if (isset($_GET['page']) && !empty($_GET["page"])) {
        $page = $_GET['page'];
    } else {
        $page = "";
    }

    // If page is empty or one then you're in the first page (limit = 0)
    if ($page == "" || $page == 1) {

        $pageLimit = 0;
    } else {

        $pageLimit = ($page * $perPage) - $perPage;
    }


    $totalSurveys = count($allPublishedSurveys);
    $numberOfPages = ceil($totalSurveys / $perPage);


    $paginate = [
        "limit" => $pageLimit,
        "offset" => $perPage
    ];

    $allSurveys = $surveys->showAllPublished(true, $paginate);
} else {

    $query = isset($_GET["q"]) ? trim($_GET["q"]) : ""; // search query

    $search = [
        "q" => $query
    ];

    $surveys = new SurveyController();
    $allSearchedPublishedSurveys = $surveys->searchAllPublished(true, null, $search);

    $perPage = 3;

    if (isset($_GET['page']) && !empty($_GET["page"])) {

        $page = $_GET['page'];
    } else {
        $page = "";
    }

    // If page is empty or one then you're in the first page (limit = 0)
    if ($page == "" || $page == 1) {
        $pageLimit = 0;
    } else {

        $pageLimit = ($page * $perPage) - $perPage;
    }

    if (is_array($allSearchedPublishedSurveys)) {
        $totalSurveys = count($allSearchedPublishedSurveys);
        $numberOfPages = ceil($totalSurveys / $perPage);
    } else {

        $totalSurveys = 0;
        $numberOfPages = 0;
    }



    $paginate = [
        "limit" => $pageLimit,
        "offset" => $perPage
    ];


    $allSurveys = $surveys->searchAllPublished(true, $paginate, $search);
}


?>


<main>
    <section class="bg-light p-5 px-lg-0 py-lg-5">

        <div class="container">

            <h2 class="text-center fw-bolder">Checkout some already existing surveys!</h2>

            <form action="<?= base_url("explore.php") ?>" method="GET">
                <div class="form-group row mt-5">
                    <div class="col-12 col-md-8 mx-auto">

                        <div class="input-group">
                            <input type="search" placeholder="Search Something" name="q" id="search" class="form-control form-control-lg rounded-0 border border-1 border-primary" value="<?= isset($_GET['q']) ? trim($_GET['q']) : "" ?>" required>
                            <input type="hidden" name="u" value="<?= strtolower($_SERVER["HTTP_USER_AGENT"]) ?>">

                            <button type="submit" class="btn btn-primary rounded-0 text-white">Search</button>

                        </div>

                    </div>
                </div>
            </form>

            <div class="row mt-5 py-3 justify-content-between align-items-center gy-3">


                <?php if (isset($allSurveys) && !empty($allSurveys)) : ?>

                    <?php foreach ($allSurveys as $survey) : ?>

                        <div class="col-12 col-md-8 mx-auto">

                            <div class="card rounded-0 shadow-md">
                                <div class="card-body">

                                  <div class="row">
                                    <div class="col-12 col-md-8">
                                        <h3 class="text-center text-md-start mb-3 fw-bold"><?= $survey["title"] ?></h3>
                                    </div>
                                    <div class="col-12 col-md-4 text-center text-md-end">
                                        <p class="mb-0 fs-4"><?= $survey["handle"] ?></p>
                                    </div>
                                  </div>
                                    <p class="text-center text-md-start"><?= $survey["description"] ?></p>

                                    <div class="row align-items-center text-center text-md-start">
                                        <div class="col-12 col-md-6">
                                            <p class="mb-0"><span class="fw-bold">Published Date: </span><small><?= $survey["createdDate"] ?></small></p>
                                        </div>
                                        <div class="col-12 col-md-6 text-center text-md-end mt-3 mt-md-0">
                                            <a href="<?= survey($survey["handle"], $survey["surveyID"], $survey["title"], $survey["profileID"]) ?>" class="btn btn-primary rounded-0 text-white" target="_blank">Click Here Take Survey</a>
                                        </div>
                                    </div>


                                </div>

                            </div>

                        </div>

                    <?php endforeach ?>

                    <?php require_once BASE_PATH . "/partials/survey/pagination.php"; ?>



                <?php else : ?>


                    <div class="col-12 col-md-8 mx-auto py-5 text-center">
                        <p class="mb-0 fw-bold text-primary fs-2 text-center">Sorry! No surveys found at the moment!</p>
                    </div>


                <?php endif ?>




            </div>


        </div>


    </section>


</main>



<?php require "partials/footer.php" ?>