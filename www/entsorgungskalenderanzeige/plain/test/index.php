<?php
/**
 * Created by PhpStorm.
 * User: -
 * Date: 04.03.2019
 * Time: 11:08
 */

include_once "../../plain/MicroprocessorLogic.php";

$logic = new MicroprocessorLogic();

include_once "../../CalendarRepository.php";
include_once "../../CalendarDAO.php";

$database = new CalendarRepository(new CalendarDAO());

header("Content-Type: text/plain");

print htmlspecialchars
(
    $logic->getCheckIfCircleIdExists
    (
        $database,
        filter_input(INPUT_GET, 'circleId', FILTER_SANITIZE_SPECIAL_CHARS)
    )
);
print "\n";