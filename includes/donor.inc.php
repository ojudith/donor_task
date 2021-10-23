<?php
require_once('db_class/donor.class.php');
include('includes/currency_rates.php');
include('includes/currency_converter.php');

$conn = new Database();
$adapter = $conn->getDefaultAdapter();
$db = $conn->connect($adapter);
$donors = new Donor($db);


/**
 *  Retrieve a donor for edit
 */
if (isset($_GET['id']) && isset($_GET['action'])) {
    $action = htmlspecialchars($_GET['action']);
    $id = htmlspecialchars($_GET['id']);
    if (filter_var($id, FILTER_VALIDATE_INT) && $action == "edit") {
        $edit_donor = $donors->getDonor($id);
    }
}

/**
 *  Set html form fields to retain values on failure or load a donor for edit
 */
if (!empty($_POST)) {
    $donor_values = $_POST;
} else if (isset($edit_donor)) {
    $donor_values = $edit_donor;
}

/**
 *  Submit Handler to create and edit a donor
 */
if (isset($_POST['review'])) {
    $errors = array();
    //validations
    if (empty($_POST['last_name'])) {
        $errors[] = "Please enter your last name";
    } else {
        $last_name = htmlspecialchars(trim($_POST['last_name']));
    }

    if (empty($_POST['first_name'])) {
        $errors[] = "Please enter your first name";
    } else {
        $first_name = htmlspecialchars(trim($_POST['first_name']));
    }

    if (empty($_POST['s_address'])) {
        $errors[] = "Please enter your address";
    } else {
        $s_address = htmlspecialchars(trim($_POST['s_address']));
    }

    if (empty($_POST['city'])) {
        $errors[] = "Please enter your city";
    } else {
        $city = htmlspecialchars(trim($_POST['city']));
    }

    if (empty($_POST['country'])) {
        $errors[] = "Please enter your country";
    } else {
        $country = htmlspecialchars(trim($_POST['country']));
    }

    if (empty($_POST['d_state'])) {
        $errors[] = "Please enter your state/region";
    } else {
        $d_state = htmlspecialchars(trim($_POST['d_state']));
    }

    if (empty($_POST['postal_code'])) {
        $errors[] = "Please enter your postal/code";
    } else {
        $postal_code = htmlspecialchars(trim($_POST['postal_code']));
    }

    if (empty($_POST['phone_number'])) {
        $errors[] = "Please enter your phone_number";
    } else {
        $phone_number = htmlspecialchars(trim($_POST['phone_number']));
    }

    if (empty($_POST['email'])) {
        $errors[] = "Please enter your email";
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please provide a valid email";
    } else {
        $email = htmlspecialchars(trim($_POST['email']));
    }

    if (empty($_POST['p_contact'])) {
        $errors[] = "Please enter your preferred form of contact";
    } else {
        $p_contact = htmlspecialchars(trim($_POST['p_contact']));
    }

    if (empty($_POST['amount'])) {
        $errors[] = "Please enter your amount of donation";
    } else {
        $amount = htmlspecialchars(trim($_POST['amount']));
    }

    if (empty($_POST['p_payment']) && empty($_POST['amount'])) {
        $errors[] = "Please enter your preferred form of payment";
    } else {
        // validate for supported currency and perform conversion
        $p_payment = htmlspecialchars($_POST['p_payment']);
        $supported_currencies = ['usd', 'euro', 'bitcoin'];
        if (in_array(strtolower($p_payment), $supported_currencies)) {

            $amount = CurrencyConverter::convert_to_dollar($p_payment, $amount, $btc_rate, $euro_rate);

        } else {
            $errors[] = "Please use a supported currency";
        }
    }

    if (empty($_POST['f_donation'])) {
        $errors[] = "Please enter your the frequency of your donation";
    } else {
        $f_donation = htmlspecialchars(trim($_POST['f_donation']));
    }

    if (empty($_POST['comment'])) {
        $errors[] = "Please enter your comment";
    } else {
        $comment = htmlspecialchars(trim($_POST['comment']));
    }

    $edit_operation = false;
    $donor_edit_id = null;

    // check if the current request is an edit operation
    if (isset($_POST['donor_edit_id']) && !empty($_POST['donor_edit_id'])) {
        $donor_edit_id = htmlspecialchars($_POST['donor_edit_id']);
        if (filter_var($donor_edit_id, FILTER_VALIDATE_INT)) {
            $edit_operation = true;
        }
    }

    if (empty($errors)) {
        if (!$edit_operation) {
            // check if email is unique for a new donation
            $checkEmail = $donors->checkUniqueEmail($email);
            if ($checkEmail) {
                $errors[] = "Email already exist";
            }
        } else {
            // allow an existing donor with current email pass/edit if it is current donor
            $checkEmailOnUpdate = $donors->checkEmailOnUpdate($email, $donor_edit_id);
            if ($checkEmailOnUpdate) {
                $errors[] = "Email already exist";
            }
        }
    }

    if (empty($errors)) {
        if (!$edit_operation) {
            //store donor entries
            $inserted_donor_id = $donors->store($last_name, $first_name, $s_address, $city, $country,
                $d_state, $postal_code, $phone_number, $email, $p_contact, $p_payment, $f_donation,
                $amount, $comment);

            if ($inserted_donor_id) {
                //get the last inserted donor
                $donor = $donors->getDonor($inserted_donor_id);
                $_SESSION['user'] = $donor;
                $_SESSION['message'] = "We have received your details! you are successfully registered";
                header('Location:index.php?id=' . $inserted_donor_id);
                exit();
            }
        } else {
            //update donor entries
            $result = $donors->update($donor_edit_id, $last_name, $first_name, $s_address, $city, $country,
                $d_state, $postal_code, $phone_number, $email, $p_contact, $p_payment, $f_donation,
                $amount, $comment);

            if ($result) {
                //get the last inserted donor
                $donor = $donors->getDonor($donor_edit_id);
                $_SESSION['user'] = $donor;
                $_SESSION['message'] = "Thank you! your donation info was successfully updated";
                header('Location:index.php?id=' . $donor_edit_id);
                exit();
            }
        }
    } else {
        echo '<h3>Errors: the following error occurred</h3>';
        echo '<ul>';
        foreach ($errors as $error) {
            echo "<li style=\"color: red;\">$error</li>";
        }
        echo '</ul>';
    }

}

