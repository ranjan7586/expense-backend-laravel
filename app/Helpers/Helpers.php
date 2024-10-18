<?php


if (!function_exists('pre')) {
    function pre($data, $exit = false)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        if ($exit) {
            die;
        }
    }
}
