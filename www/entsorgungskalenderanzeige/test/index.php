<?php
include_once "../common.php";
include_once "../plain/MicroprocessorLogic.php";

include_once "../CalendarRepository.php";
include_once "../CalendarDAO.php";

$DB = new CalendarRepository(new CalendarDAO());
$logic = new MicroprocessorLogic();

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
print htmlspecialchars(print_r($DB->getHelloWorld()));
?>
    <div>---------------------- End-------------</div>
    <h2>/plain</h2>
    <div>If you want to check /plain, provide a circleId via GET request. e.g. test/?circleId=3</div>
    <div>Note: At the start of the sequence is always a 1 (or a 2) (1=successfully checked the calendar, 2=Error calling
        the calendar).
        <br/>The following 0 and 1s are "booleans" to indicate, if the waste can be put outside
    </div>

    <h3>If you <strong>don't</strong> provide the circleId. </h3>
    <div>Expected Result: 200000</div>

    <h3>If you provide the circleId.</h3>
    <div>
    </div>        Expected Result: (Note: the <strong> => 0</strong> changes accordingly to 1, if it is time to put the waste outside.)

    <div>
        How the Backend get is from the database: Array ( [0] => Array ( [greenWaste] => 0 [cardboard] => 0
        [garbageAndBulkyGoods] => 0 [metal] => 0 [paper] => 0 ) ) 1 <br/>
        What the microcontoller receives: 100000
    </div>
    <div>---------------------- Start-------------</div>
<?php
$result =
    htmlspecialchars
    (
        $logic->getPlainTextStringForMicroprocessor
        (
            $DB,
            isset($_GET["circleId"]) ? filter_input(INPUT_GET, 'circleId', FILTER_SANITIZE_SPECIAL_CHARS) : ""
        )
    );
print $result;
?>
    <div>---------------------- End-------------</div>
<?php
printFooter();