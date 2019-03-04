<?php
/**
 * User: -
 * Date: 02.03.2019
 * Time: 13:59
 */

define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"]);
include DOCUMENT_ROOT . "/../database/connect.php";

header("Content-Type: text/plain");

$circle_id = "";

if (isset($_GET["circleId"])) {
    $circle_id = $_GET["circleId"];
}

if ($circle_id != "") {
    $result = $DB->getPlainTextStringForMicroprocessor($circle_id);
    $html = "1"; //to start the sequence
    $html .= htmlspecialchars($result[0]['greenWaste']);
    $html .= htmlspecialchars($result[0]['cardboard']);
    $html .= htmlspecialchars($result[0]['garbageAndBulkyGoods']);
    $html .= htmlspecialchars($result[0]['metal']);
    $html .= htmlspecialchars($result[0]['paper']);
    echo $html;
} else {
    echo "200000";
}
