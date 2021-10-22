<?php # - Prospective donors to Wikimedia Foundation
$page_title = "Home Page | Wikimedia Foundation";
include('templates/header.php');
include('includes/currency_rates.php');
include_once ('includes/summary.php');

?>

<?php if (isset($donation_summary)) { ?>
    <h2>Summary</h2>
    <hr>
    <div class="summary_list">
        <p><b>Last Name :</b> <?php echo ucfirst($donation_summary["last_name"]) ?></p>
        <p><b>First Name :</b> <?php echo ucfirst($donation_summary["first_name"]) ?></p>
        <p><b>Street Address :</b> <?php echo $donation_summary["s_address"] ?></p>
        <p><b>City :</b> <?php echo ucfirst($donation_summary["city"]) ?></p>
        <p><b>State/Region:</b> <?php echo ucfirst($donation_summary["d_state"]) ?></p>
        <p><b>Country :</b> <?php echo ucfirst($donation_summary["country"]) ?></p>
        <p><b>Postal Code :</b> <?php echo($donation_summary["postal_code"]) ?></p>
        <p><b>Phone Number :</b> <?php echo($donation_summary["phone_number"]) ?></p>
        <p><b>Email :</b> <?php echo($donation_summary["email"]) ?></p>
        <p><b>Preferred form of contact :</b> <?php echo($donation_summary["p_contact"]) ?></p>
        <p><b>Preferred form of payment :</b> <?php echo($donation_summary["p_payment"]) ?></p>
        <p><b>Frequency Donation :</b> <?php echo($donation_summary["f_donation"]) ?></p>
        <p><b>Amount Donation :</b>
            <?php if ($donation_summary["p_payment"] == 'euro'){
                echo "$" . number_format($donation_summary['currency']);
            } else if ($donation_summary["p_payment"] == 'bitcoin') {
                echo "$" . $donation_summary['currency'];
            } else {
                echo "$" . number_format($donation_summary['currency']);
            } ?></p>
        <p><b>Total Projected donation for a year :</b>
            <?php echo "$" . number_format($donation_summary['currency'] * 12); ?></p>
    </div>
<?php } else { ?>
    <div class="main_page_container">
    <h3>Thank you for considering to be our Donor,
    <a href="donor.php">click here to donate</a></h3>
    </div>
<?php } ?>

<?php include('templates/footer.html'); ?>
