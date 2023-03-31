<?php


/**
 * Array Debugger
 * Print out all the values of an array
 * @param array $arrayToDebug
 * @param bool $multi true if multiple arrays, false for single array
 * @return void
 */
function debug_array(array $arrayToDebug, bool $multi = false)
{
    if ($multi == true) {




        foreach ($arrayToDebug as $array) {


            echo "<h3>Array Starts</h3>";

            echo "<pre> <code>";
            print_r($array);
            echo "</pre> </code>";
            echo "-----------------------";
            echo "<br>";
        }


        echo strtoupper("<p> Under Development </p>");
        exit(0); // stops the script from loading below
    }



    echo "<h3>Array Starts</h3>";

    echo "<pre> <code>";
    print_r($arrayToDebug);
    echo "</pre> </code>";
    echo "-----------------------";
    echo "<br>";

    echo strtoupper("<p> Under Development </p>");

    exit(0); // stops the script from loading below
}
