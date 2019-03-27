<?php
date_default_timezone_set('Europe/London');

/**
 * @param $title
 */
function printHeader($title){
?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="/main.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<?php
}
/**
 *
 */
function printFooter(){
?></body>
</html>
<?php
}