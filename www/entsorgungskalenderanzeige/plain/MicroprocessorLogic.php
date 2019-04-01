<?php

/**
 * Created by PhpStorm.
 * User: -
 * Date: 13.03.2019
 * Time: 11:09
 */


/**
 * Class MicroprocessorLogic
 */
class MicroprocessorLogic
{
    /**
     * @param $database
     * @param $circle_id
     * @return string
     */
    public function getPlainTextStringForMicroprocessor($database, $circle_id = ''):string
    {
        if ($circle_id != "") {
            /** @var CalendarRepository $database */
            $result = $database->getPlainTextStringForMicroprocessorFromDB($circle_id);

            //1 Grüngut, 2 Karton, 3 Kehricht und Sperrgut, 4 Metall und 5 Papier
            $isGarbageDue = array(1 => false, 2 => false, 3 => false, 4 => false, 5 => false);

            foreach (array_keys($result) as $key) {
                $isGarbageDue[$result[$key]['garbageTypeId']] = true;
            }

            //start
            $html = "1"; //to start the sequence
            for ($i = 1; $i < 6; $i++) {
                $html .= htmlspecialchars($isGarbageDue[$i] ? "1" : "0");
            }
            return $html;
        }
        return "200000";
    }

    public function getCheckIfCircleIdExists($database, $circle_id = ''):string
    {
        if ($circle_id != "") {
            /** @var CalendarRepository $database */
            $result = $database->getCheckIfCircleIdExistsInTheDB($circle_id);
            return htmlspecialchars($result[0]['result']);
        }
        return "0";
    }
}