<?php

/**
 * Class HandelDB
 */
class HandelDB
{
    /**
     * @var array
     */
    private $ini = array();
    /**
     * @var null
     */
    private $conn = null;

    /**
     *
     */
    private function connectToDB()
    {
        $this->ini = parse_ini_file($_SERVER["DOCUMENT_ROOT"] . '/../.ini');
        try {
            $this->conn = new PDO("mysql:host={$this->ini['servername']};dbname={$this->ini['dbname']};charset=utf8mb4", $this->ini['username'], $this->ini['password']);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        $this->ini = "";
    }

    /**
     * @param $sql
     * @return mixed
     */
    private function executeQuery($sql)
    {
        try {
            $this->connectToDB();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
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
     * @return mixed
     */
    public function getFromDB()
    {
        return $this->executeQuery(
            '
                SELECT 
                   
                FROM ;
				');
    }

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
    public function getPlainTextStringForMicroprocessor($circle_id)
    {
         try {
            $this->connectToDB();
            $stmt = $this->conn->prepare('
                SELECT 
				(
                    SELECT count(*) 
                    FROM garbage_collection_calendar			  
                    WHERE
                    DATE_ADD( garbage_collection_calendar_date, INTERVAL -6 HOUR) < DATE_ADD( now(), INTERVAL 9 HOUR)
                    and
                        DATE_ADD( garbage_collection_calendar_date, INTERVAL 7 HOUR) > DATE_ADD( now(), INTERVAL 9 HOUR)
                    and
                        garbage_type_id = 1
                    and
                        circle_id = :circle_id
				) as greenWaste,
				(
                    SELECT count(*) 
                    FROM garbage_collection_calendar			  
                    WHERE
                    DATE_ADD( garbage_collection_calendar_date, INTERVAL -6 HOUR) < DATE_ADD( now(), INTERVAL 9 HOUR)
                    and
                        DATE_ADD( garbage_collection_calendar_date, INTERVAL 7 HOUR) > DATE_ADD( now(), INTERVAL 9 HOUR)
                    and
                        garbage_type_id = 2
                    and
                        circle_id = :circle_id
				) as cardboard,  
				(
                    SELECT count(*) 
                    FROM garbage_collection_calendar			  
                    WHERE
                    DATE_ADD( garbage_collection_calendar_date, INTERVAL -6 HOUR) < DATE_ADD( now(), INTERVAL 9 HOUR)
                    and
                        DATE_ADD( garbage_collection_calendar_date, INTERVAL 7 HOUR) > DATE_ADD( now(), INTERVAL 9 HOUR)
                    and
                        garbage_type_id = 3
                    and
                        circle_id = :circle_id
				) as garbageAndBulkyGoods,
				(
                    SELECT count(*) 
                    FROM garbage_collection_calendar			  
                    WHERE
                    DATE_ADD( garbage_collection_calendar_date, INTERVAL -6 HOUR) < DATE_ADD( now(), INTERVAL 9 HOUR)
                    and
                        DATE_ADD( garbage_collection_calendar_date, INTERVAL 7 HOUR) > DATE_ADD( now(), INTERVAL 9 HOUR)
                    and
                        garbage_type_id = 4
                    and
                        circle_id = :circle_id
				) as metal, 
                (    
                    SELECT count(*) 
                    FROM garbage_collection_calendar			  
                    WHERE
                        DATE_ADD( garbage_collection_calendar_date, INTERVAL -6 HOUR) < DATE_ADD( now(), INTERVAL 9 HOUR)
                    and
                        DATE_ADD( garbage_collection_calendar_date, INTERVAL  7 HOUR) > DATE_ADD( now(), INTERVAL 9 HOUR)
                    and
                        garbage_type_id = 5
                    and
                        circle_id = :circle_id
				) as paper
				');
            $stmt->bindParam(':circle_id', $circle_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    public function getCheckIfCircleIdExists($circle_id)
    {
        try {
            $this->connectToDB();
            $stmt = $this->conn->prepare('
            SELECT count(circle_id) as result
            FROM circle
            WHERE circle_id = :circle_id  
			');
            $stmt->bindParam(':circle_id', $circle_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}

$DB = new HandelDB;
