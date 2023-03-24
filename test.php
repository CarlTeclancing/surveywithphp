<?php

    require "vendor/autoload.php";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        debug_array($_POST);

    }
?>

<?php 
require "vendor/autoload.php";
session_start();

    debug_array($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <script src="jquery-3.5.1.min.js"></script>

    <style>
        .hide {
            display: none;
        }

        .show {
            display: block !important;
        }
    </style>

</head>

<body>

<form action="test.php" method="POST">


    <select name="test" id="test" style="width: 100%; margin-bottom: 10px;">
        <option selected disabled>Select a type</option>
        <option value="1">One Choice</option>
        <option value="2">Multiple choice</option>
    </select>


    <div class="container" id="question_items" style="padding: 1rem;">


        <div id="one_choice" style="display:none;">

            <button type="button" id="add_one_choice" class="btn btn-primary mb-3 text-white"> + Add Choices</button>

            <div class="container p-0 mb-3" id="one_choice_group" style="margin-top: 1rem;">

            </div>

        </div>



        <div id="multiple_choice" style="display:none;">

            <button type="button" id="add_multi_choice" class="btn btn-primary mb-3 text-white"> + Add Multiple Choices</button>

            <div class="container p-0 mb-3" id="multi_choice_group" style="margin-top: 1rem;">


            </div>

        </div>


    </div>

    <input type="submit" value="Submit and see dummy">

</form>



    <script>
        $(document).ready(function() {

           


            $("#add_one_choice").click(() => {

                 let fieldCount = 1;
                let buttonCount = 1;

                let div = document.createElement("div");
                div.setAttribute("class", "one_choice_field");
                div.setAttribute("id", "one_choice_field_" + fieldCount++);

                let radio = document.createElement("input");
                radio.type = "radio";
                radio.setAttribute("disabled", "disabled");

                let delButton = document.createElement("button");
                delButton.setAttribute("type", "button");
                delButton.classList.add("delete_one_choice");
                delButton.setAttribute("id", "delete_one_choice_" + buttonCount++);
                delButton.textContent = "delete";

                let textInput = document.createElement("input");
                textInput.type = "text";
                textInput.placeholder = "Type choice label"
                textInput.name = "one_choice[]";



                let fragment = document.createDocumentFragment();

                fragment.appendChild(div).appendChild(radio);
                fragment.appendChild(div).appendChild(textInput);
                fragment.appendChild(div).appendChild(delButton);

                $("#one_choice_group").append(fragment);



                let currentFields = $(".one_choice_field");
                let deleteButtons = $(".delete_one_choice");

                for (let i = 0; i < currentFields.length; i++) {

                    deleteButtons[i].addEventListener('click', function() {

                        currentFields[i].remove();
                        deleteButtons[i].remove();

                    });


                }



            });



            $("#add_multi_choice").click(() => {

                let fieldCount = 1;
                let buttonCount = 1;

                let div = document.createElement("div");
                div.classList.add("multi_choice_field");
                div.setAttribute("id", "multi_choice_field_" + fieldCount++);

                let checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.setAttribute("disabled", "disabled");

                let delButton = document.createElement("button");
                delButton.setAttribute("type", "button");
                delButton.setAttribute("class", "delete_multi_choice");
                delButton.setAttribute("id", "delete_multi_choice_" + buttonCount++);
                delButton.textContent = "delete";

                let textInput = document.createElement("input");
                textInput.type = "text";
                textInput.placeholder = "Type choice label"
                textInput.name = "multi_choice[]";



                let fragment = document.createDocumentFragment();

                fragment.appendChild(div).appendChild(checkbox);
                fragment.appendChild(div).appendChild(textInput);
                fragment.appendChild(div).appendChild(delButton);

                $("#multi_choice_group").append(fragment);



                let currentFields = $(".multi_choice_field");
                let deleteButtons = $(".delete_multi_choice");

                for (let i = 0; i < currentFields.length; i++) {

                    deleteButtons[i].addEventListener('click', function() {

                        currentFields[i].remove();
                        deleteButtons[i].remove();

                    });


                }



            });





            $("#test").change(function() {


                if (this.value === "1") {
                    $("#question_items > #one_choice").addClass("show");
                    $("#question_items > #multiple_choice").removeClass("show");

                }

                if (this.value === "2") {
                    $("#question_items > #one_choice").removeClass("show");
                    $("#question_items > #multiple_choice").addClass("show");
                }





                console.log(this.value)


            });






        });
    </script>

</body>

</html>