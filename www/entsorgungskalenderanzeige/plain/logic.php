<?php
/**
 * Created by PhpStorm.
 * User: -
 * Date: 13.03.2019
 * Time: 11:09
 */

/**
 * @param $DB
 * @param $circle_id
 * @return string
 */
function getPlainTextStringForMicroprocessor($DB, $circle_id){
    if ($circle_id != "") {
        /** @var HandelDB $DB */
        $result = $DB->getPlainTextStringForMicroprocessorFromDB($circle_id);

        $isGarbageDue = array(1 => false, 2 => false, 3 => false, 4 => false, 5 => false);
        foreach ($result as $key => $value) {
            $isGarbageDue[$result[$key]['garbageTypeId']] = true;
        }

        //star
        $html = "1"; //to start the sequence
        for ($i = 1; $i < 6; $i++) {
            $html .= htmlspecialchars($isGarbageDue[$i] ? "1" : "0");
        }
        return $html;
    }
    else {
        return "200000";
    }
}
