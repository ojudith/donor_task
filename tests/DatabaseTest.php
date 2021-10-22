<?php

use PHPUnit\Framework\TestCase;

require_once "config/db_connect.php";
require_once "db_class/donor.class.php";

abstract class DatabaseTest extends TestCase
{
    private $conn;
    private $adapter = null;
    protected $donors;

    final public function getAdapter()
    {
        if ($this->adapter == null) {
            $this->adapter =
                $this->conn->createAdapter($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'], $GLOBALS['DB_DBNAME']);
        }
        return $this->adapter;
    }

    final public function getConnection()
    {
        $this->conn = new Database();
        $this->conn =  $this->conn->connect($this->getAdapter());
        return $this->conn;
    }

    final public function initialiseDonor()
    {
        $this->donors = new Donor($this->conn);
    }

    final public function insertDonors($data)
    {
        return $this->donors->store($data['last_name'], $data['first_name'], $data['s_address'], $data['city'], $data['country'], $data['d_state'], $data['postal_code'], $data['phone_number'],
            $data['email'], $data['p_contact'], $data['p_payment'], $data['f_donation'], $data['currency'], $data['comment']);
    }

    final public function getDonor($donor_id)
    {
        return $this->donors->getDonor($donor_id);
    }

    final public function updateDonor($data,$id)
    {
        return $this->donors->update($id,$data['last_name'], $data['first_name'], $data['s_address'], $data['city'], $data['country'], $data['d_state'], $data['postal_code'], $data['phone_number'],
            $data['email'], $data['p_contact'], $data['p_payment'], $data['f_donation'], $data['currency'], $data['comment']);
    }

}
