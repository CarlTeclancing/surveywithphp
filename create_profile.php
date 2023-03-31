<?php $pageTitle = "Create Profile"; ?>
<?php require "partials/header.php"?>
<?php
    $check = new Surveyplus\App\Middleware\CheckLoggedInUser();
    $check->userOnly();
?>
<?php require "partials/navigation.php"?>
<main>

    <div class="container mt-5 p-5 px-lg-0 py-lg-5">

    
        <?php require "partials/notification.php"?>

        <div class="row">

          
            <div class="col-lg-6 mt-5 mb-5 mx-auto">

                <span class="display-5 d-block text-center fw-bold mb-3"> New Profile </span>

                <p class="text-center mb-3">Create a User Profile</p>

                
                    <form action="<?= base_url("includes/profile/create.inc.php") ?>" method="POST">
                    
                        <div class="form-group mb-3">
                            
                            <label for="first_name" class="fw-bold mb-2"> First Name</label>

                            <input type="text" class="form-control border border-1 border-primary rounded-0" name="first_name" placeholder="Enter Your First Name" />

                        </div>


                        <div class="form-group mb-3">

                            <label for="last_name" class="fw-bold mb-2"> Last Name</label>

                            <input type="text" class="form-control border border-1 border-primary rounded-0" name="last_name" placeholder="Enter Your Last Name" />

                        </div>

                        <div class="form-group mb-3">

                            <label for="username" class="fw-bold mb-2"> Username</label>

                            <input type="text" class="form-control border border-1 border-primary rounded-0" name="username" placeholder="Enter Your Username" />

                        </div>
                        

                        <div class="form-group mb-3">

                            <label for="dateofbirth" class="fw-bold mb-2"> Date of Birth</label>

                            <input type="date" class="form-control border border-1 border-primary rounded-0" name="date_of_birth" id="dateofbirth" placeholder="Date of Birth" />

                        </div>


                        <div class="form-group mb-3">

                            <label for="signature" class="fw-bold mb-2"> Signature</label>

                            <input type="text" class="form-control border border-1 border-primary rounded-0" name="signature" placeholder="Enter your signature" />

                        </div>

                        <div class="form-group mb-3">

                             <label for="gender" class="fw-bold mb-2"> Gender</label>

                            <select name="gender" id="gender" class="form-select border border-1 border-primary rounded-0">
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>


                        </div>




                        <div class="form-group mb-3">


                        <button type="submit" class="btn btn-primary text-white w-100 rounded-0">Create Profile</button> 
                            
                            
                          

                        </div>


                        </form>

            

            </div>


        </div>



    </div>



</main>




<?php require "partials/footer.php"?>