<?php
/**
 * Created by PhpStorm.
 * User: -
 * Date: 25.03.2019
 * Time: 11:03
 */

use PHPUnit\Framework\TestCase;

/**
 * Class CalendarRepositoryTest
 */
class CalendarRepositoryTest extends TestCase
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
                    'getCheckIfCircleIdExists'
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
            ->willReturn('100000');

        $_dao->method('getCheckIfCircleIdExists')
            ->willReturn('1');

        try {
            $this->_db = new CalendarRepository($_dao);
        } catch (Error $e) {
            echo $e;
        }
    }

    /**
     *
     */
    public function testGetCheckIfCircleIdExists()
    {
        $repo = new CalendarRepository($this->_db);

        $event = $repo->getCheckIfCircleIdExists(1);

        $this->assertEquals(true, $event);
    }

    /**
     *
     */
    public function testGetCalendarEntries()
    {
        $repo = new CalendarRepository($this->_db);

        $event = $repo->getCalendarEntries();



        $this->assertEquals(
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
        , $event);
    }

    /**
     *
     */
    public function testGetHelloWorld()
    {

        $repo = new CalendarRepository($this->_db);

        $event = $repo->getHelloWorld();

        $this->assertEquals('Array ( [0] => Array ( [@@version] => 5.7.25-log ) ) 1', $event);
    }

    /**
     *
     */
    public function testGetPlainTextStringForMicroprocessorFromDB()
    {

        $repo = new CalendarRepository($this->_db);

        $event = $repo->getPlainTextStringForMicroprocessorFromDB(1);

        $this->assertEquals('100000', $event);

    }


}
