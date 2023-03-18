<?php


/**
 * Cleans the form data before saving into database
 */
function clean_input(string $data) {
    return htmlspecialchars(stripslashes(trim($data)));
}