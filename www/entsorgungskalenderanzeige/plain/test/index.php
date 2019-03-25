<?php
/**
 * Created by PhpStorm.
 * User: -
 * Date: 04.03.2019
 * Time: 11:08
 */

include_once "../../CalendarRepository.php";
include_once "../../CalendarDAO.php";

$DB = new CalendarRepository(new CalendarDAO());

header("Content-Type: text/plain");

$circle_id = "";

if (isset($_GET["circleId"])) {
    $circle_id = $_GET["circleId"];
    if($circle_id != "") {
        $result = $DB->getCheckIfCircleIdExists($circle_id);
        echo htmlspecialchars($result[0]['result']);
    } else{
        echo "0";
    }
} else {
    echo "0";
}
