<?php
define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"]);
include DOCUMENT_ROOT . "/../database/connect.php";
include DOCUMENT_ROOT . "/../common/common.php";

printHeader("Entsorgungskalenderanzeige");
?>
<h1>Entsorgungskalenderanzeige Testseite</h1>

<?php

echo print_r($DB->getHelloWorld());

printFooter();