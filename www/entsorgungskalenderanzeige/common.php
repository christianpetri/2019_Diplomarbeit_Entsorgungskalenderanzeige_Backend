<?php
date_default_timezone_set('Europe/London');

function printHeader($title){
?><!doctype html>
<html lang="en">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
<?php
} ?>

<?php
function printFooter(){
?></body>
</html>
<?php
}