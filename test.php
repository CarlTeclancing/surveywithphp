<?php

require "vendor/autoload.php";

use Surveyplus\App\Controllers\UserController;

    $users = new UserController();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Space</title>
</head>
<body>


    <?php print_r($users->show()); ?>
    
</body>
</html>