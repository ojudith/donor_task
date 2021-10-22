<?php

/**
 * Class Used for Donors Database Operations
 * (Store, Retrieve)
 */
class Donor
{
    private $conn; //database connection
    private $table = "donors"; //table name

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * INSERTING A DONOR
     * @param $last_name [last name of the donor]
     * @param $first_name [first name of the donor]
     * @param $s_address [street address of the donor]
     * @param $city [city of the donor]
     * @param $country [country of the donor]
     * @param $d_state [state of the donor]
     * @param $postal_code [postal of the donor]
     * @param $phone_number [phone number of the donor]
     * @param $email [email of the donor]
     * @param $p_contact [preferred contact of the donor]
     * @param $p_payment [preferred payment of the donor]
     * @param $f_donation [frequency of the donation]
     * @param $amount [amount of donation]
     * @param $comment [comment of donor]
     * @return integer [id of the last inserted donor]
     */
    function store($last_name, $first_name, $s_address, $city, $country, $d_state, $postal_code, $phone_number,
                   $email, $p_contact, $p_payment, $f_donation, $amount, $comment)
    {
        $sql = "INSERT INTO $this->table (last_name, first_name, s_address, city, country, d_state, postal_code, phone_number, email, p_contact, p_payment, f_donation, currency, comment) VALUES(:last_name, :first_name, :s_address, :city, :country, :d_state, :postal_code, :phone_number, :email, :p_contact, :p_payment, :f_donation, :amount,:comment)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':last_name' => $last_name,
            ':first_name' => $first_name,
            ':s_address' => $s_address,
            ':city' => $city,
            ':country' => $country,
            ':d_state' => $d_state,
            ':postal_code' => $postal_code,
            ':phone_number' => $phone_number,
            ':email' => $email,
            ':p_contact' => $p_contact,
            ':p_payment' => $p_payment,
            ':amount' => $amount,
            ':f_donation' => $f_donation,
            ':comment' => $comment]);
        return $this->conn->lastInsertId();
    }


    /**
     * RETRIEVING A DONOR
     * @param $donor_id
     * @return array [ returns a single donor ]
     */
    function getDonor($donor_id)
    {
        $sql = "SELECT * FROM $this->table WHERE id= :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $donor_id]);
        return $stmt->fetch();
    }

    /**
     * UPDATE A DONOR
     * @param $donor_id
     * @param $last_name [last name of the donor]
     * @param $first_name [first name of the donor]
     * @param $s_address [street address of the donor]
     * @param $city [city of the donor]
     * @param $country [country of the donor]
     * @param $d_state [state of the donor]
     * @param $postal_code [postal of the donor]
     * @param $phone_number [phone number of the donor]
     * @param $email [email of the donor]
     * @param $p_contact [preferred contact of the donor]
     * @param $p_payment [preferred payment of the donor]
     * @param $f_donation [frequency of the donation]
     * @param $amount [amount of donation]
     * @param $comment [comment of donor]
     * @return integer [id of the last inserted donor]
     */
    function update($donor_id, $last_name, $first_name, $s_address, $city, $country, $d_state, $postal_code, $phone_number,
                    $email, $p_contact, $p_payment, $f_donation, $amount, $comment)
    {
        $sql = "UPDATE $this->table SET last_name = :last_name, first_name = :first_name, s_address = :s_address,
                       city = :city, country = :country, d_state = :d_state, postal_code = :postal_code,
                       phone_number = :phone_number, email = :email, p_contact = :p_contact, p_payment = :p_payment, 
                       f_donation = :f_donation, currency = :amount, comment = :comment
                       WHERE id = :id ";
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute(
            [   ':id' => $donor_id,
                ':last_name' => $last_name,
                ':first_name' => $first_name,
                ':s_address' => $s_address,
                ':city' => $city,
                ':country' => $country,
                ':d_state' => $d_state,
                ':postal_code' => $postal_code,
                ':phone_number' => $phone_number,
                ':email' => $email,
                ':p_contact' => $p_contact,
                ':p_payment' => $p_payment,
                ':amount' => $amount,
                ':f_donation' => $f_donation,
                ':comment' => $comment]);
        return $result != 0;
    }

    /**
     * @param $email [email address]
     * @param $check_id [ check in-case it is the current donor being edited and null for a new donor]
     * @return bool [ result ]
     */
    function checkUniqueEmail($email){
        // will be null for insert operations
        $sql = "SELECT * FROM $this->table WHERE email=:email  LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->rowCount() >= 1;

//        if($check_id == null){
//            $sql = "SELECT * FROM $this->table WHERE email= :email LIMIT 1";
//            $stmt = $this->conn->prepare($sql);
//            $stmt->execute([':email' => $email]);
//            return $stmt->rowCount() >= 1;
//        }else{
//            // will not be null for update operations
//            $sql = "SELECT * FROM $this->table WHERE email= :email LIMIT 1";
//            $stmt = $this->conn->prepare($sql);
//            $stmt->execute([':email' => $email]);
//            $result = $stmt->fetch();
//            if(empty($result)){
//                return false;
//            }else {
//                return $result['id'] != $check_id;
//            }
//        }
    }
    public function checkEmailOnUpdate($email, $check_id){
        $sql = "SELECT * FROM $this->table WHERE email= :email AND id !=:id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email, ':id'=>$check_id]);
        return $stmt->rowCount() >= 1;
    }

    public function deleteDonor($id){
        if($id == null) {
            $sql = "DELETE FROM $this->table";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
    }


}
