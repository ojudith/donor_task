<?php

use PHPUnit\Framework\TestCase;

/**
 * Class DonorsTest
 */
class DonorsTest extends DatabaseTest
{
    /**
     * Prepare data set for database tests
     */
    public function getDataSet()
    {
        return [
            [
                "last_name" => "john",
                "first_name" => "doe",
                "s_address" => "no 2 street",
                "city" => "ikd",
                "country" => "Nigeria",
                "d_state" => "Lagos",
                "postal_code" => "1234",
                "phone_number" => "1234567890",
                "email" => "test1@gmail.com",
                "p_contact" => "email",
                "p_payment" => "dollar",
                "f_donation" => "yearly",
                "currency" => 500,
                "comment" => "new donor"
            ],
            [
                "last_name" => "tessy",
                "first_name" => "klian",
                "s_address" => "no 5 street",
                "city" => "vegas",
                "country" => "Nigeria",
                "d_state" => "Lagos",
                "postal_code" => "94105",
                "phone_number" => "5688888883",
                "email" => "tessyklian@gmail.com",
                "p_contact" => "phone",
                "p_payment" => "dollar",
                "f_donation" => "yearly",
                "currency" => 2000,
                "comment" => "new donation from tessy"
            ]
        ];
    }

    /**
     *  Donors test to check insert and retrieve to the database
     */
    public function test_donors_insert_and_retrieve()
    {
        $this->getConnection();
        $this->initialiseDonor();
        $dataset = $this->getDataSet();
        // INSERT DATA
        $first_dataset_id = $this->insertDonors($dataset[0]);
        $second_dataset_id = $this->insertDonors($dataset[1]);
        // RETRIEVE INSERTED DATA
        $retrieved_first_donor = $this->getDonor($first_dataset_id);
        $retrieved_second_donor = $this->getDonor($second_dataset_id);

        foreach ($dataset[0] as $key => $data){
            if($dataset[0][$key] == "currency"){
                $this->assertEquals(sprintf("%.2f",$dataset[0][$key]), $retrieved_first_donor[$key]);
            }else {
                $this->assertEquals($dataset[0][$key], $retrieved_first_donor[$key]);
            }
        }

        foreach ($dataset[1] as $key => $data){
            if($dataset[1][$key] == "currency"){
                $this->assertEquals(sprintf("%.2f",$dataset[0][$key]), $retrieved_second_donor[$key]);
            }else {
                $this->assertEquals($dataset[1][$key], $retrieved_second_donor[$key]);
            }
        }
    }

    /**
     *  test to check unique email before inserting it into database
     */
    public function test_unique_email(){
        $this->getConnection();
        $this->initialiseDonor();
        $dataset = $this->getDataSet();

        $test_email = "test".uniqid()."@gmail.com";
        $edited_dataset = $dataset[0];
        $edited_dataset['email'] = $test_email;
        // check if it does not exist
        $first_email_check = $this->donors->checkUniqueEmail($test_email);
        $this->assertFalse($first_email_check);

        // insert dataset with email
        $insert_id = $this->insertDonors($edited_dataset);

        // check if it does exist
        $second_email_check = $this->donors->checkUniqueEmail($test_email);
        $this->assertTrue($second_email_check);

    }

    /**
     *  test to check unique email for a particular donor before inserting it into database
     */
    public function test_unique_email_pass_for_particular_user(){
        $this->getConnection();
        $this->initialiseDonor();
        $dataset = $this->getDataSet();

        $test_email = "test".uniqid()."@gmail.com";
        $edited_dataset = $dataset[0];
        $edited_dataset['email'] = $test_email;
        // check if it does not exist
        $first_email_check = $this->donors->checkUniqueEmail($test_email);
        $this->assertFalse($first_email_check);

        // insert dataset with email
        $insert_id = $this->insertDonors($edited_dataset);

        // update dataset with email
        $second_email_check = $this->donors->checkEmailOnUpdate($test_email,$insert_id);
        $this->assertFalse($second_email_check);

        $edited_dataset['last_name'] = "Johnny";
        $result = $this->updateDonor($edited_dataset,$insert_id);
        $this->assertTrue($result);

        $updated_donor = $this->getDonor($insert_id);
        $this->assertEquals($edited_dataset['last_name'],$updated_donor['last_name']);

    }

}
