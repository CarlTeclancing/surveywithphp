<?php if (isset($_GET['success']) && !empty($_GET['success'])) : ?>
    <div class="row mt-3">
        <div class="alert alert-success">
            <?php if ($_GET['success'] == "profilecreated") : ?>
                <p class="mb-0 fs-3 fw-bold text-center">Profile Created Successfully</p>
            <?php endif ?>


            <?php if ($_GET['success'] == "loggedin") : ?>
                <p class="mb-0 fs-3 fw-bold text-center">Welcome Back!</p>
            <?php endif ?>
            
        </div>
    </div>
<?php endif ?>




<?php if (isset($_GET['error']) && !empty($_GET['error'])) : ?>
    <div class="row">
        <div class="alert alert-danger">
            <?php if ($_GET['error'] == "emptyfield") : ?>
                <p class="mb-0 fs-5 fw-bold text-center">Please fill all required fields</p>
            <?php endif ?>

            <?php if ($_GET['error'] == "notcreated") : ?>
                <p class="mb-0 fs-5 fw-bold text-center">Email Address already exist!</p>
            <?php endif ?>

            <?php if ($_GET['error'] == "profilenotcreated") : ?>
                <p class="mb-0 fs-5 fw-bold text-center">Sorry! Profile not created please try again!</p>
            <?php endif ?>

            <?php if ($_GET['error'] == "usernameexists") : ?>
                <p class="mb-0 fs-5 fw-bold text-center">Sorry! Username not available</p>
            <?php endif ?>

        </div>
    </div>
<?php endif ?>