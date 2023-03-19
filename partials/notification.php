<?php if (isset($_GET['success']) && !empty($_GET['success'])) : ?>
    <div class="row">
        <div class="alert alert-success">
            <?php if ($_GET['success'] == "created") : ?>
                <p class="mb-0 fs-3 fw-bold text-center">User Account Created Successfully <a href="<?= base_url("login.php") ?>" class="btn btn-primary text-white ms-4 mt-3 mt-sm-0">Login Now</a></p>

            <?php endif ?>


            <?php if ($_GET['success'] == "created") : ?>
                <p class="mb-0 fs-3 fw-bold text-center">Profile Created Successfully</p>

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

            <?php if ($_GET['error'] == "pwdconfirm") : ?>
                <p class="mb-0 fs-5 fw-bold text-center">Password confirmation is not same as password</p>
            <?php endif ?>


            <?php if ($_GET['error'] == "notcreated") : ?>
                <p class="mb-0 fs-5 fw-bold text-center">Email Address already exist!</p>
            <?php endif ?>

            <?php if ($_GET['error'] == "authfailed") : ?>
                <p class="mb-0 fs-5 fw-bold text-center">Authentication failed please try again!</p>
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