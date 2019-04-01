<?php
include_once "common.php";

include_once "CalendarRepository.php";
include_once "CalendarDAO.php";

$DB = new CalendarRepository(new CalendarDAO());

printHeader("Entsorgungskalender");
?>  <a href="/test" target="_blank">Testseite</a>
    <h1>Entsorgungskalender</h1>
    <h2>Die nächsten 30 Kalendereinträge</h2>
<?php
$result = $DB->getCalendarEntries();
$html = '<table class="result">';
// header row
$html .= '<tr>';
$html .= '<th> Datum </th> <th> Typ </th> <th> Kreis </th>';
$html .= '</tr>';

// data rows
foreach ($result as $key => $value) {
    $html .= '<tr>';
    $html .= '<td>' . htmlspecialchars($result[$key]['collection_date']) . '</td>';
    $html .= '<td>' . htmlspecialchars($result[$key]['garbage_type_description']) . '</td>';
    $html .= '<td><span title="circle_id ' . htmlspecialchars($result[$key]['circle_id']) . '">' . htmlspecialchars($result[$key]['circle_description']) . '</span></td>';
    $html .= '</tr>';
}
// finish table and return it
$html .= '</table>';
print $html;
printFooter();
