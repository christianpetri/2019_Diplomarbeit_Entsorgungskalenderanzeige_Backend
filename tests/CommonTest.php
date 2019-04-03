<?php
/**
 * Created by PhpStorm.
 * User: -
 * Date: 01.04.2019
 * Time: 19:33
 */

use PHPUnit\Framework\TestCase;

class CommonTest extends TestCase
{

    public function testPrintHeader()
    {
        $common = new Common();

        $result = $common->printHeader("Entsorgungskalender");
        $expected = "<!doctype html><html lang='en'><head><meta charset='utf-8'/><title>Entsorgungskalender</title><link rel='stylesheet' type='text/css' href='/main.css'/><meta name='viewport' content='width=device-width, initial-scale=1.0'/></head><body>";

        $this->assertEquals($expected, $result);
    }

    public function testPrintFooter()
    {
        $common = new Common();

        $result = $common->printFooter();
        $expected = "</body></html>";
        $this->assertEquals($expected, $result);

    }
}
