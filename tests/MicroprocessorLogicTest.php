<?php
/**
 * Created by PhpStorm.
 * User: -
 * Date: 27.03.2019
 * Time: 15:06
 */

use PHPUnit\Framework\TestCase;

class MicroprocessorLogicTest extends TestCase
{

    public function testGetPlainTextStringForMicroprocessor()
    {
        $logic = new MicroprocessorLogic();
        $result = $logic->getPlainTextStringForMicroprocessor(null);
        $this->assertEquals(200000, $result);
    }
}
