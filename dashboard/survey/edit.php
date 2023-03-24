<?php

use Surveyplus\App\Controllers\SurveyController;
use Surveyplus\App\Controllers\ProfileController;

$pageTitle = "Edit Survey"; ?>

<?php require "../../vendor/autoload.php"; ?>

<?php require DASHBOARD_PATH . "/partials/header.php" ?>

<?php

if(isset($_GET["survey"]) && isset($_GET["action"]) && $_GET["action"] == "edit"){

    $survey_id = $_GET["survey"];
    $user_id = $_SESSION["user_id"];

    $surveys = new SurveyController();

     // Check if survey you want to update is already published
     $is_published = $surveys->is_published($survey_id);

     if($is_published){
         header("Location:" . DASHBOARD_URL . "/survey/index.php?type=survey&error=updatenotallowed");
         exit(0);
     }


    // Modify survy for a particular profile id only
    $profiles =  new ProfileController();

    $profile = $profiles->all_active_profiles($user_id);
    
    $survey = $surveys->edit($survey_id, $profile["id"]);
}


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
                                <li class="breadcrumb-item active">Modify Survey</li>
                            </ol>

                        </div>
                        <div class="col-md-6 text-start text-md-end mb-5 mb-md-0">

                            <?php if (isset($_SESSION["handle"]) & !empty($_SESSION["handle"])) : ?>
                                <p class="mb-0 fs-2"><?= $_SESSION["full_name"] ?> </p>
                                <p class="mb-0 fs-5"><?= $_SESSION["handle"] ?> </p>
                            <?php endif ?>

                        </div>
                    </div>

                
        

                    <div class="container p-0 mt-3">


                        <form action="<?= DASHBOARD_URL . "/includes/survey/update.inc.php" ?>" method="POST">

                                <input type="hidden" name="survey_id" value="<?= $survey_id ?>">


                               <div class="form-group mb-4">
                                    <label for="name" class="mb-2 fw-bold">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control border border-1 border-primary rounded-0" placeholder="Type your Survey Name" name="name" value="<?= $survey["name"] ?>" required>
                               </div> 


                               <div class="form-group mb-4">
                                    <label for="description" class="mb-2 fw-bold">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control border border-1 border-primary rounded-0" style="resize:none" name="description" required><?= $survey["description"] ?></textarea>
                               </div> 

                               <div class="form-group mb-4">
                                    <label for="visibility" class="mb-2 fw-bold">Visibility <span class="text-danger">*</span></label>
                                    <select name="visibility" class="form-select border border-1 border-primary rounded-0" required>
                                        <option selected disabled>Select Survey Visibility</option>

                                        <?php if($survey["published"] == 1): ?>
                                            <option value="1" selected>Published</option>
                                            <option value="0">Not Published</option>
                                        <?php else: ?>
                                            <option value="1">Published</option>
                                            <option value="0" selected>Not Published</option>
                                        <?php endif ?>
                                    </select>
                               </div> 


                               <div class="form-group mb-4">
                                <label for="expires_on" class="mb-2 fw-bold">Expiry Date <span class="text-danger">*</span></label>
                                <input type="date" name="expires_on" id="expiresOn" min="" class="form-control border border-1 border-primary" value="<?= $survey["expiresOn"] ?>" required>
                               </div>

                               <div class="form-group">
                                    <button type="submit" class="btn btn-primary rounded-0 w-100">Update Survey</button>
                               </div>


                        </form>



                    </div>




                </div>
            </main>


            <?php require DASHBOARD_PATH . "/partials/content-footer.php" ?>

        </div>

    </div>


    <?php require DASHBOARD_PATH . "/partials/footer.php" ?>



</body>

</html>