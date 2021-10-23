<?php
require_once('db_class/donor.class.php');

// Retrieve a donor in Summary Page after a successful info entry
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    if (filter_var($id, FILTER_VALIDATE_INT)) {
        $conn = new Database();
        $adapter = $conn->getDefaultAdapter();
        $db = $conn->connect($adapter);
        $donors = new Donor($db);
        $donation_summary = $donors->getDonor($id);

        echo "<p>Thanks for registering, " . ucfirst($donation_summary['first_name']) . ". We will be in contact with you shortly
             If you would like to edit or update your entries please click 
             <a href='donor.php?id=" . $donation_summary['id'] . "&action=edit'>here</a></p>";

        if (isset($_SESSION['message'])) {
            $success = $_SESSION['message'];
            echo "<p>$success</p> ";
        }
    }

}
