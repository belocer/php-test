<?php

class Dbconnect
{
    public $isConn;
    public $datab;

    // Connect to db
    public function __construct()
    {
        $username = 'root';
        $pass = '';
        $host = '127.0.0.1';
        $dbname = 'testcomment';

        $this->isConn = TRUE;
        try {
            $this->datab = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $pass);
            /* TODO отключить отладочные методы */
            $this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->datab->exec('SET CHARACTER SET utf8');
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Disconnect form db
    public function Disconnect()
    {
        $this->datab = NULL;
        $this->isConn = FALSE;
    }

    // get row
    public function getRow($query, $params = [])
    {
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // get rows
    public function getRows($query, $params = [])
    {
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // insert row
    public function insertRow($query, $params = [])
    {
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $this->datab->lastInsertId(); // возвращаю id последней записи в бд
            //return TRUE;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // update row
    public function updateRow($query, $params = [])
    {
        $this->insertRow($query, $params);
    }

    // delete row
    public function deleteRow($query, $params = [])
    {
        $this->insertRow($query, $params);
        return $this->datab->lastInsertId(); // возвращаю id последней записи в бд
    }
}