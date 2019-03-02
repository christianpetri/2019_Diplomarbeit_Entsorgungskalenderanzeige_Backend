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
}

$DB = new HandelDB;
