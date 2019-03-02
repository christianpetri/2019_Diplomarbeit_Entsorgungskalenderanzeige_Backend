<?php
define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"]);
include DOCUMENT_ROOT . "/../database/connect.php";
include DOCUMENT_ROOT . "/../common/common.php";

printHeader("Entsorgungskalender");
?>
<h1>Entsorgungskalender</h1>
<h2>Die nächsten 30 Kalendereinträge</h2>
<?php
$result = $DB->getCalendarEntries();
$html = '<table class="result">';
// header row
$html .= '<tr>';
$html .= '<th> Date </th> <th> Type </th> <th> Circle </th>';
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
echo $html;
printFooter();