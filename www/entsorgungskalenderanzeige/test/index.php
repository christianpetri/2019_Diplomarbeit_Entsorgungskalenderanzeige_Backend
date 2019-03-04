<?php
define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"]);
include DOCUMENT_ROOT . "/../database/connect.php";
include DOCUMENT_ROOT . "/../common/common.php";

printHeader("Entsorgungskalenderanzeige");
?>
    <h1>Entsorgungskalenderanzeige Testseite</h1>
    <h2>
        Database
    </h2>
    <div>Connected to the database, if the connection String is correctly provided -->
        <br/> Expected result along the lines of: Array ( [0] => Array ( [@@version] => 5.6.34-log ) ) 1
    </div>
    <div>---------------------- Start-------------</div>
<?php
echo print_r($DB->getHelloWorld());
?>
    <div>---------------------- End-------------</div>
    <h2>/plain</h2>
    <div>If you want to check /plain, provide a circleId via GET request. e.g. test/?circleId=3</div>
    <div>Note: At the start of the sequence is always a 1 (or a 2) (1=successfully checked the calendar, 2=Error calling
        the calendar).
        <br/>The following 0 and 1s are "booleans" to indicate, if the waste can be put outside
    </div>

    <h3>If you <b>don't</b> provide the circleId. </h3>
    <div>Expected Result: 200000</div>

    <h3>If you provide the circleId.</h3>
    <div>
        Expected Result: (Note: the <b> => 0</b> changes accordingly to 1, if it is time to put the waste outside.)
    </div>
    <div>
        How the Backend get is from the database: Array ( [0] => Array ( [greenWaste] => 0 [cardboard] => 0
        [garbageAndBulkyGoods] => 0 [metal] => 0 [paper] => 0 ) ) 1 <br/>
        What the microcontoller receives: 100000
    </div>
    <div>---------------------- Start-------------</div>
<?php

if (isset($_GET["circleId"])) {
    $circle_id = $_GET["circleId"];
    if ($circle_id != "") {


        $result = $DB->getPlainTextStringForMicroprocessor($circle_id);
        echo "How it is received from the database:<br/>";
        echo print_r($result);
        ?>
        <br/>
        <div>How the microcontroller receives it:</div>
        <?php
        $html = "1"; //to start the sequence
        $html .= htmlspecialchars($result[0]['greenWaste']);
        $html .= htmlspecialchars($result[0]['cardboard']);
        $html .= htmlspecialchars($result[0]['garbageAndBulkyGoods']);
        $html .= htmlspecialchars($result[0]['metal']);
        $html .= htmlspecialchars($result[0]['paper']);
        echo $html;
    }
} else {
    ?>
    <div>No circleId was provided, therefore no call to the database was made.</div>
    <div>How the microcontroller receives it:</div>
    <?php
    echo "200000";
}
?>
    <div>---------------------- End-------------</div>
<?php
printFooter();