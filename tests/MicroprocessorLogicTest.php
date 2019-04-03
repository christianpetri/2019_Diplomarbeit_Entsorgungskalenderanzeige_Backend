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
    /**
     * @var
     */
    protected $_db;

    /**
     * @throws ReflectionException
     */
    protected function setUp(): void
    {
        parent::setUp();
        $_dao = $this->getMockBuilder('CalendarDAO')
            ->setMethods(
                array(
                    'getHelloWorld',
                    'getCalendarEntries',
                    'getPlainTextStringForMicroprocessorFromDB',
                    'getCheckIfCircleIdExistsInTheDB'
                )
            )
            ->getMock();

        $_dao->method('getHelloWorld')
            ->willReturn('Array ( [0] => Array ( [@@version] => 5.7.25-log ) ) 1');

        $_dao->method('getCalendarEntries')
            ->willReturn(
                array(
                    0 =>
                        array(
                            'circle_id' => '10',
                            'collection_date' => '2019-03-25',
                            'garbage_type_description' => 'Karton',
                            'circle_description' => '8',
                        ),
                    1 =>
                        array(
                            'circle_id' => '11',
                            'collection_date' => '2019-03-25',
                            'garbage_type_description' => 'Karton',
                            'circle_description' => '9',
                        ),
                    2 =>
                        array(
                            'circle_id' => '7',
                            'collection_date' => '2019-03-25',
                            'garbage_type_description' => 'Karton',
                            'circle_description' => '5',
                        )
                )
            );
        $_dao->method('getPlainTextStringForMicroprocessorFromDB')
            ->with(1)
            ->willReturn(Array
            (
                0 => Array
                (
                    'garbageTypeId' => 0
                )

            ));

        $_dao->method('getCheckIfCircleIdExistsInTheDB')
            ->willReturn(Array(0 => Array('result' => 1 )));


        try {
            $this->_db = new CalendarRepository($_dao);
        } catch (Error $e) {
            print htmlspecialchars($e->getMessage());
        }
    }

    public function testGetPlainTextStringForMicroprocessor()
    {
        $logic = new MicroprocessorLogic();
        $result = $logic->getPlainTextStringForMicroprocessor(null);
        $this->assertEquals(200000, $result);

        $repo = new CalendarRepository($this->_db);
        $result1 = $logic->getPlainTextStringForMicroprocessor($repo, 1);
        $this->assertEquals(100000, $result1);

    }

    public function testGetCheckIfCircleIdExists()
    {
        $logic = new MicroprocessorLogic();
        $result = $logic->getCheckIfCircleIdExists(null);
        $this->assertEquals(0, $result);

        $repo = new CalendarRepository($this->_db);
        $result1 = $logic->getCheckIfCircleIdExists($repo, 1);
        $this->assertEquals(1, $result1);

    }
}
