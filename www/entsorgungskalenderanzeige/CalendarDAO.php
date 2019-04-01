<?php
/**
 * Created by PhpStorm.
 * User: -
 * Date: 25.03.2019
 * Time: 10:41
 */

class CalendarDAO
{
    private $_pdo = null;

    /**
     * @return bool|PDO
     */
    public function __construct()
    {
        /**
         * if (!file_exists($_SERVER["DOCUMENT_ROOT"] . '/connect.php')) {
         * return false;
         * }*/
        include_once 'connect.php';
        if (isset($connection['host']) && !empty($connection['host'])
            && isset($connection['base']) && !empty($connection['base'])
            && isset($connection['user'])
            && isset($connection['password'])
        ) {
            try {
                $conn = new PDO("mysql:host={$connection['host']};dbname={$connection['base']};charset=utf8mb4", $connection['user'], $connection['password']);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->_pdo = $conn;
                return true;
            } catch (PDOException $e) {
                print "Connection failed: " . htmlspecialchars($e->getMessage());
            }
        }
        // Do not keep database credentials in memory.
        $connection = null;
        unset($connection);
        return false;
    }


    /**
     * @param $sql
     * @return array|null
     */
    private function executeQuery($sql)
    {
        try {
            $stmt = $this->_pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print htmlspecialchars($e->getMessage());
        }
        return null;
    }

    /**
     * @return mixed
     */
    public function getHelloWorld()
    {
        return $this->executeQuery('
				SELECT @@version;
				');
    }

    /**
     * @return array|null
     */
    public function getCalendarEntries()
    {
        return $this->executeQuery('
                  SELECT
                    garbage_collection_calendar.circle_id AS circle_id,
                    garbage_collection_calendar_date AS collection_date,
                    garbage_type_description,
                    circle_description
                  FROM `garbage_collection_calendar`
                  LEFT JOIN circle on circle.circle_id = garbage_collection_calendar.circle_id
                  LEFT JOIN garbage_type ON garbage_type.garbage_type_id = garbage_collection_calendar.garbage_type_id
                  WHERE garbage_collection_calendar_date >= DATE(DATE_ADD( NOW(), INTERVAL 9 HOUR))
                  ORDER BY garbage_collection_calendar_date
                  LIMIT 30
                ');
    }


    /**
     * @param $circle_id
     * @return array|null
     */
    public function getPlainTextStringForMicroprocessorFromDB($circle_id)
    {
        try {
            $stmt = $this->_pdo->prepare(' 
                SELECT garbage_type_id as garbageTypeId
                FROM garbage_collection_calendar			  
                WHERE
                  DATE_ADD( garbage_collection_calendar_date, INTERVAL -6 HOUR) < DATE_ADD( now(), INTERVAL 9 HOUR)
                and
                  DATE_ADD( garbage_collection_calendar_date, INTERVAL 7 HOUR) > DATE_ADD( now(), INTERVAL 9 HOUR)
                and   
                  circle_id = :circle_id
            ');

            $stmt->bindParam(':circle_id', $circle_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print htmlspecialchars($e->getMessage());
        }
        return null;
    }


    /**
     * @param $circle_id
     * @return array|null
     */
    public function getCheckIfCircleIdExistsInTheDB($circle_id)
    {
        try {
            $stmt = $this->_pdo->prepare('
                SELECT count(circle_id) as result
                FROM circle
                WHERE circle_id = :circle_id 
                LIMIT 1 
			');
            $stmt->bindParam(':circle_id', $circle_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print htmlspecialchars($e->getMessage());
        }
        return null;
    }
}