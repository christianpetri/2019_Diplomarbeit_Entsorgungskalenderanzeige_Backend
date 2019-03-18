<?php
/**
 * User: -
 * Date: 02.03.2019
 * Time: 13:59
 */

include_once "../backend.php";
include_once "logic.php";

header("Content-Type: text/plain");


if (isset($_GET["circleId"])) {
    echo getPlainTextStringForMicroprocessor($DB, $_GET["circleId"]);
} else{
    echo "200000";
}

