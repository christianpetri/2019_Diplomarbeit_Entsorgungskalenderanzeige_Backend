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
    $circle_id = filter_input(INPUT_GET, 'circleId', FILTER_SANITIZE_SPECIAL_CHARS);
    if($circle_id != "") {
        $result = $DB->getCheckIfCircleIdExists($circle_id);
        print htmlspecialchars($result[0]['result']);
    } else{
        print "0";
    }
} else {
    print "0";
}
