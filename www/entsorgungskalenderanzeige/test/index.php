<?php
include_once "../common.php";
include_once "../plain/MicroprocessorLogic.php";

include_once "../CalendarRepository.php";
include_once "../CalendarDAO.php";

$DB = new CalendarRepository(new CalendarDAO());
$logic = new MicroprocessorLogic();

define("CIRCLE_ID", "circleId");

printHeader("Entsorgungskalenderanzeige");
?>
    <h1>Testseite</h1>
    <h2>
        Ist die Datenbank für das Backend richtig konfiguriert?
    </h2>
    <div>Verbunden mit der Datenbank, wenn die Verbindungszeichenfolge (URL zur Datenbank, Benutzername, Passwort,
        Datenbankname) korrekt angegeben ist &rarr;
        <br/>Erwartetes Ergebnis im Sinne von: Array ([0] => Array ([@@ version] => 5.6.34-log)) 1
    </div>
    <div>---------------------- Start-------------</div>
<?php
print htmlspecialchars(print_r($DB->getHelloWorld()));
?>
    <div>---------------------- Ende-------------</div>
    <h2><strong>Programmschnittstelle (API) für das Frontend</strong></h2>
    <h2>/plain</h2>
    <p>Die Schnittstelle hat ihren Namen aus dem englischen "content-type: text/plain" auf Deutsche "Inhaltstyp:
        Klartext" erhalten.
        Er bietet dem Frontend die Möglichkeit den aktuellen Status, ob die Entsorgungsgüter an die Strasse gestellt
        werden dürfen, abzurufen.</p>
    <table>
        <thead>
        <tr>
            <th>URL</th>
            <th>Methode</th>
            <th>Parameter</th>
            <th>Inhaltstyp</th>
            <th>Beschreibung</th>
            <th>Beispiel Resultat</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>/plain</td>
            <td>GET</td>
            <td>circleId</td>
            <td>text/plain</td>
            <td>Ist Abfuhr, wenn ja, welche?</td>
            <td>200000</td>
        </tr>
        <tr>
            <td>/plain/test</td>
            <td>GET</td>
            <td>circleId</td>
            <td>text/plain</td>
            <td>Ist die Kreis-ID korrekt?</td>
            <td>1</td>
        </tr>
        </tbody>
    </table>
    <h3>Tests für /plain</h3>
    <div>Wenn Sie /plain prüfen möchten, geben Sie eine Kreis-ID über einen GET-Request an. z.B. <a
                href="/test/?circleId=3">test/?circleId=3</a></div>
    <p>Link der erfolgreich sein sollte <a href="/test/?circleId=3"> /test/?circleId=3</a></p>
    <p>Link der nicht erfolgreich sein sollte <a href="/test/"> /test/</a></p>
    <p>Direkt Link für das Frontend: <a href="/plain/?circleId=3"> plain/?circleId=3</a></div></p>
    <div>Hinweis: Am Anfang der Sequenz steht immer eine 1 (oder eine 2) (1 = Kalender erfolgreich geprüft, 2 = Fehler
        beim Aufrufen des Kalenders).
        <br/>Die folgenden 0 und 1 sind "booleans", um anzuzeigen, ob der Abfall nach draussen gebracht werden kann.
    </div>

    <h4>Wenn Sie die circleId <strong>nicht</strong> angeben.</h4>
    <div>Erwartetes Ergebnis: 200000</div>

    <h4>Wenn Sie die circleId angeben.</h4>
    <div>
    </div>Erwartetes Ergebnis: (Hinweis: Das
    <strong>0</strong> ändert sich entsprechend zu 1, wenn es Zeit ist, den Abfall nach draussen zu bringen.)

    <div>
        Wie das Frontend die Daten vom Backend erhält: Array ( [0] => Array ( [greenWaste] => 0 [cardboard] => 0
        [garbageAndBulkyGoods] => 0 [metal] => 0 [paper] => 0 ) ) 1 <br/>
        Was das Frontend (der Mikrocontroller) erhält: 100000
    </div>
    <div>---------------------- Start-------------</div>
<?php
print htmlspecialchars
(
    $logic->getPlainTextStringForMicroprocessor
    (
        $DB,
        isset($_GET[CIRCLE_ID]) ? filter_input(INPUT_GET, CIRCLE_ID, FILTER_SANITIZE_SPECIAL_CHARS) : ""
    )
);
?>
    <div>---------------------- Ende-------------</div>
    <h3>Test: Korrekte Kreis-ID</h3>
    <div>Wenn Sie prüfen möchten, ob die Kreis-ID (im Backend) tatsächlich existiert. Geben Sie eine Kreis-ID über einen
        GET-Request an.
    </div>
    <p>Link der erfolgreich sein sollte <a href="/test/?circleId=7"> /test/?circleId=7</a></p>
    <p>Link der nicht erfolgreich sein sollte <a href="/test/?circleId=99"> /test/?circleId=99</a></p>
    <p>Link der nicht erfolgreich sein sollte <a href="/test/"> /test</a></p>
    <p>Direkt Link für das Fronend: <a href="/plain/test/?circleId=3"> /plain/test/?circleId=3</a></p>


    <p>Erwartetes Ergebnis bei Erfolg (Kreis-ID ist korrekt konfiguriert): 1</p>
    <p>Erwartetes Ergebnis bei Misserfolg (Kreis-ID ist nicht korrekt oder sie wurde noch nicht angegeben): 0</p>
    <div id="circleIdTest">---------------------- Start-------------</div>
<?php

print htmlspecialchars
(
    $logic->getCheckIfCircleIdExists
    (
        $DB,
        isset($_GET[CIRCLE_ID]) ? filter_input(INPUT_GET, CIRCLE_ID, FILTER_SANITIZE_SPECIAL_CHARS) : ""
    )
);
?>
    <div>---------------------- Ende-------------</div>
<?
printFooter();