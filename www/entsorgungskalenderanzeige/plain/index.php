<?php
/**
 * User: -
 * Date: 02.03.2019
 * Time: 13:59
 */

include_once "logic.php";
include_once "../CalendarRepository.php";
include_once "../CalendarDAO.php";

$database = new CalendarRepository(new CalendarDAO());

header("Content-Type: text/plain");


print htmlspecialchars(
    getPlainTextStringForMicroprocessor
    (
        $database,
        isset($_GET["circleId"]) ? $_GET["circleId"] : ""
    )
);
