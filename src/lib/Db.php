<?php

namespace App\src\lib;

use PDO;

class Db
{
    protected $db;

    public function __construct()
    {
        $config = require __DIR__ .'/../conf/db.php';
        $this->db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['name'] . '', $config['user'],
            $config['password']);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return bool|\PDOStatement
     */
    public function query(string $sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }
        $stmt->execute();
        return $stmt;
    }


    public function row(string $sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return string|bool
     */
    public function column(string $sql, $params = []): string
    {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }

    /**
     * @param string $sql
     * @param array $params
     * @return string
     */
    public function rowCount(string $sql, $params = []): string
    {
        $result = $this->query($sql, $params);
        return $result->rowCount();
    }

    /**
     * @param $var
     * @return string
     */
    public function quote($var):string
    {
       return $this->db->quote($var);
    }
}