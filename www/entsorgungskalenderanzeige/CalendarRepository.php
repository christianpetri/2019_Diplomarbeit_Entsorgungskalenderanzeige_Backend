<?php


/**
 * Class CalendarRepository
 */
class CalendarRepository
{

    /**
     * @var CalendarDAO|null
     */
    private $_dao = null;

    /**
     * CalendarRepository constructor.
     * @param $dao
     */
    public function __construct($dao)
    {
        $this->_dao = $dao;
    }

    /**
     * @return mixed
     */
    public function getHelloWorld()
    {
        return $this->_dao->getHelloWorld();
    }

    /**
     * @return array|null
     */
    public function getCalendarEntries()
    {
        return $this->_dao->getCalendarEntries();
    }


    /**
     * @param $circle_id
     * @return array|null
     */
    public function getPlainTextStringForMicroprocessorFromDB($circle_id)
    {
        return $this->_dao->getPlainTextStringForMicroprocessorFromDB($circle_id);
    }


    /**
     * @param $circle_id
     * @return array|null
     */
    public function getCheckIfCircleIdExists($circle_id)
    {
        return $this->_dao->getCheckIfCircleIdExists($circle_id);
    }
}
