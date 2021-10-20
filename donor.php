
<?php # - Prospective donors to Wikimedia Foundation
$page_title = "Donor | Wikimedia Foundation";
include('includes/header.html');
include('config/db_connect.php'); //include db

if(isset($_POST['review'])) {
    $errors = array();
    //validations
    if(empty($_POST['last_name'])){
        $errors[] = "Please enter your last name";
    } else {
        $last_name = trim($_POST['last_name']);
    }

    if(empty($_POST['first_name'])){
        $errors[] = "Please enter your first name";
    } else {
        $first_name = trim($_POST['first_name']);
    }

    if(empty($_POST['s_address'])){
        $errors[] = "Please enter your address";
    } else {
        $s_address = trim($_POST['s_address']);
    }

    if(empty($_POST['city'])){
        $errors[] = "Please enter your city";
    } else {
        $city = trim($_POST['city']);
    }

    if(empty($_POST['country'])){
        $errors[] = "Please enter your country";
    } else {
        $country = trim($_POST['country']);
    }


    if(empty($_POST['d_state'])){
        $errors[] = "Please enter your state/region";
    } else {
        $d_state = trim($_POST['d_state']);
    }

    if(empty($_POST['postal_code'])){
        $errors[] = "Please enter your postal/code";
    } else {
        $postal_code = trim($_POST['postal_code']);
    }
    if(empty($_POST['phone_number'])){
        $errors[] = "Please enter your phone_number";
    } else {
        $phone_number = trim($_POST['phone_number']);
    }

    if(empty($_POST['email'])){
        $errors[] = "Please enter your email";
    } else {
        $email = trim($_POST['email']);
    }

    if(empty($_POST['p_contact'])){
        $errors[] = "Please enter your preferred form of contact";
    } else {
        $p_contact = trim($_POST['p_contact']);
    }


    if(empty($_POST['p_payment'])){
        $errors[] = "Please enter your preferred form of payment";
    } else {
        $p_payment = trim($_POST['p_payment']);
    }

    if(empty($_POST['f_donation'])){
        $errors[] = "Please enter your the frequency of your donation";
    } else {
        $f_donation = trim($_POST['f_donation']);
    }

    // if(empty($_POST['amount'])){
    //     $errors[] = "Please enter your amount of donation";
    // } else {
    //     $amount = trim($_POST['amount']);
    // }

    if(empty($_POST['comment'])){
        $errors[] = "Please enter your comment";
    } else {
        $comment = trim($_POST['comment']);
    }
    $sql = "INSERT INTO donors
    (last_name, first_name, s_address, city, country, d_state, postal_code, phone_number, email, p_contact, p_payment, f_donation, comment) VALUES(:last_name, :first_name, :s_address, :city, :country, :d_state, :postal_code, :phone_number, :email, :p_contact, :p_payment, :f_donation, comment)";

        $stmt = $pdo->prepare($sql);

        $result = $stmt->execute
        (array(':last_name'=> $last_name, ':first_name' => $first_name, ':s_address' => $s_address, ':city' => $city, ':country' => $country, ':d_state' => $d_state, ':postal_code' => $postal_code, ':phone_number' => $phone_number, ':email' => $email, ':p_contact' => $p_contact));

        if($result){ //if the insertion was successful
            echo 'Thank you! you are successfully registered';
        }

}
include('includes/donor.inc.php');
?>