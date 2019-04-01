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
    <div>Verbunden mit der Datenbank, wenn die Verbindungszeichenfolge korrekt angegeben ist -> -->
        <br/>Erwartetes Ergebnis im Sinne von: Array ([0] => Array ([@@ version] => 5.6.34-log)) 1
    </div>
    <div>---------------------- Start-------------</div>
<?php
print htmlspecialchars(print_r($DB->getHelloWorld()));
?>
    <div>---------------------- Ende-------------</div>
    <h2>/plain</h2>
    <div>Wenn Sie prüfen möchten, geben Sie eine Kreis-ID über einen GET-Request an. z.B. test/?circleId=3</div>
    <div>Hinweis: Am Anfang der Sequenz steht immer eine 1 (oder eine 2) (1 = Kalender erfolgreich geprüft, 2 = Fehler beim Aufrufen des Kalenders).
        <br/>Die folgenden 0 und 1 sind "booleans", um anzuzeigen, ob der Abfall nach draussen gebracht werden kann.
    </div>

    <h3>Wenn Sie die circleId <strong>nicht</strong> angeben.</h3>
    <div>Erwartetes Ergebnis: 200000</div>

    <h3>Wenn Sie die circleId angeben.</h3>
    <div>
    </div>Erwartetes Ergebnis: (Hinweis: Das <strong> 0 </strong> ändert sich entsprechend zu 1, wenn es Zeit ist, den Abfall nach draussen zu bringen.)

    <div>
        Wie das Frontend die Daten vom Backend erhält: Array ( [0] => Array ( [greenWaste] => 0 [cardboard] => 0
        [garbageAndBulkyGoods] => 0 [metal] => 0 [paper] => 0 ) ) 1 <br/>
        Was das Frontend (der Mikrocontroller) erhält: 100000
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
    <div>---------------------- Ende-------------</div>
<?php
printFooter();