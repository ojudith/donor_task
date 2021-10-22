<?php

DEFINE('HOST', 'localhost');
DEFINE('USERNAME', 'root');
DEFINE('PASSWORD', '');
DEFINE('DBNAME', 'wikimedia_task');

class Database
{

    private $db_connection;
    private $error;


    public function createAdapter($db_host, $db_user, $db_pass, $db_name)
    {
        return [
            'conn' => 'mysql:host=' . $db_host . ';dbname=' . $db_name,
            'db_host' => $db_host,
            'db_user' => $db_user,
            'db_pass' => $db_pass,
            'db_name' => $db_name
        ];
    }

    public function getDefaultAdapter()
    {
        return [
            'conn' => 'mysql:host=' . HOST . ';dbname=' . DBNAME,
            'db_host' => HOST,
            'db_user' => USERNAME,
            'db_pass' => PASSWORD,
            'db_name' => DBNAME
        ];
    }

    public function connect($adapter)
    {
        $conn = 'mysql:host=' . $adapter['db_host'] . ';dbname=' . $adapter['db_name'];
        //create a persistent conn
        $options = array(PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        try {
            $this->db_connection = new PDO($conn, $adapter['db_user'], $adapter['db_pass'], $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
        return $this->db_connection;
    }

}




