<?php

/**
 * Main Model
 */
class Model
{


    public $host    = DB_HOST;
    public $user    = DB_USER;
    public $pass    = DB_PASS;
    public $dbname  = DB_NAME;
    public $con;
    public $result;

    public function __construct()
    {
        try {
            $options = [
                PDO::ATTR_PERSISTENT                => TRUE,
                PDO::ATTR_EMULATE_PREPARES          => FALSE,
                PDO::MYSQL_ATTR_USE_BUFFERED_QUERY  => TRUE,
                PDO::ATTR_DEFAULT_FETCH_MODE        => PDO::FETCH_OBJ,
                PDO::ATTR_ERRMODE                   => PDO::ERRMODE_EXCEPTION
            ];
            return $this->con = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8", $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            echo 'Server Error: ' . $e->getMessage();
        }
    }

    public function Query($qry, $params = [])
    {

        if (empty($params)) {

            $this->result = $this->con->prepare($qry);
            return $this->result->execute();
        } else {
            $this->result = $this->con->prepare($qry);
            return $this->result->execute($params);
        }
    }

    public function rowCount()
    {

        return $this->result->rowCount();
    }

    public function fetchall()
    {

        return $this->result->fetchAll();
    }

    public function fetch()
    {

        return $this->result->fetch();
    }
}
