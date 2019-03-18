<?php
/**
 * User: -
 * Date: 02.03.2019
 * Time: 13:59
 */

include_once "../backend.php";
include_once "logic.php";

$DB = new HandelDB();

header("Content-Type: text/plain");


echo htmlspecialchars(
    getPlainTextStringForMicroprocessor
    (
        $DB,
        isset($_GET["circleId"]) ? $_GET["circleId"] : ""
    )
);
