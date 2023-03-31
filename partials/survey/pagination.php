<?php require "vendor/autoload.php"; ?>

<div class="row text-center mt-5">

    <div class="col-md-6 mx-auto">

        <ul class="pagination flex justify-content-center">

            <!-- Previous button -->
            <?php if (isset($_GET["q"]) && isset($_GET["page"]) && $_GET["page"] >= 2) : ?>

                <!-- If page has query -->
                <li class="page-item"><a class="page-link rounded-0" href="<?= base_url("explore.php") . "?page=" . $_GET["page"] - 1 . "&q=" . $_GET["q"] ?>"> &laquo; Previous</a></li>

            <?php elseif (isset($_GET["page"]) && $_GET["page"] >= 2) : ?>

                <li class="page-item"><a class="page-link rounded-0" href="<?= base_url("explore.php") . "?page=" . $_GET["page"] - 1 ?>"> &laquo; Previous</a></li>

            <?php endif ?>

            <?php for ($index = 1; $index <= $numberOfPages; $index++) : ?>


                <!-- Show navigation if more thatn 1 page -->
                <?php if ($numberOfPages > 1) : ?>



                    <?php if (isset($_GET["q"]) && !empty($_GET["q"])) : ?>


                        <?php if (isset($_GET["page"]) && $index == $_GET["page"]) : ?>

                            <li class="page-item active"><a class="page-link rounded-0" href="<?= base_url("explore.php") . "?page=" . $index . "&q=" . $_GET["q"]  ?>"><?= $index ?></a></li>

                        <?php else : ?>


                            <li class="page-item"><a class="page-link rounded-0" href="<?= base_url("explore.php") . "?page=" . $index . "&q=" . $_GET["q"] ?>"><?= $index ?></a></li>


                        <?php endif ?>



                    <?php else : ?>


                        <?php if (isset($_GET["page"]) && $index == $_GET["page"]) : ?>



                            <li class="page-item active"><a class="page-link rounded-0" href="<?= base_url("explore.php") . "?page=" . $index  ?>"><?= $index ?></a></li>

                        <?php else : ?>

                            <li class="page-item"><a class="page-link rounded-0" href="<?= base_url("explore.php") . "?page=" . $index  ?>"><?= $index ?></a></li>


                        <?php endif ?>


                    <?php endif ?>



                <?php endif ?>




            <?php endfor ?>

            <!-- Next button -->
            <?php if (isset($_GET["q"]) && isset($_GET["page"]) && $_GET["page"] < $numberOfPages) : ?>

                <!-- If page has query -->
                <li class="page-item"><a class="page-link rounded-0" href="<?= base_url("explore.php") . "?page=" . $_GET["page"] + 1 . "&q=" . $_GET["q"] ?>">Next &raquo;</a></li>

            <?php elseif (isset($_GET["page"]) && $_GET["page"] < $numberOfPages) : ?>

                <li class="page-item"><a class="page-link rounded-0" href="<?= base_url("explore.php") . "?page=" . $_GET["page"] + 1 ?>">Next &raquo;</a></li>



            <?php endif ?>

        </ul>

    </div>

</div>