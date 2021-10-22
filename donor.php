<?php # - Prospective donors to Wikimedia Foundation
$page_title = "Donor | Wikimedia Foundation";
include('templates/header.php');
include('includes/countries.php');
require('includes/donor.inc.php');

?>

<form action="donor.php" method="POST" onsubmit="return validateForm()">
    <fieldset>
        <legend>Enter your information in the form below:
        </legend>
        <div class="form_list">

            <div class="form_input">
                <label for="last_name">Last Name: </label>
                <input type="text" name="last_name" id="last_name" placeholder="Enter your last name" id="last_name"
                       value="<?php echo isset($donor_values['last_name']) ? $donor_values['last_name'] : ""; ?>"/>
            </div>

            <div class="form_input">
                <label>First Name: <input type="text" name="first_name" id="first_name"
                                          placeholder="Enter your first name"
                                          value="<?php echo isset($donor_values['first_name']) ? $donor_values['first_name'] : ""; ?>"/></label>
            </div>

            <div class="form_input">
                <label>Street Address: <input type="text" name="s_address" id="s_address"
                                              placeholder="Enter your street address"
                                              value="<?php echo isset($donor_values['s_address']) ? $donor_values['s_address'] : ""; ?>"/></label>
            </div>

            <div class="form_input">
                <label>City: <input type="text" name="city" id="city" placeholder="Enter your city"
                                    value="<?php echo isset($donor_values['city']) ?
                                        $donor_values['city'] : ""; ?>"/></label>
            </div>

            <div class="form_input">
                <label>Country: <select name="country" id="country">
                        <option value="">Enter your country</option>
                        <?php foreach ($countries as $country) { ?>
                            <option value="<?php echo $country ?>"
                                <?php if (isset($donor_values['country'])
                                    && ($donor_values['country'] == $country)) echo 'selected="selected"'; ?>>
                                <?php echo $country ?>
                            </option>
                        <?php } ?>
                    </select></label>
            </div>

            <div class="form_input">
                <label>State/Region: <input type="text" name="d_state" id="d_state"
                                            placeholder="Enter your state/region"
                                            value="<?php echo isset($donor_values['d_state']) ? $donor_values['d_state'] : ""; ?>"/></label>
            </div>

            <div class="form_input">
                <label>Postal Code/Region: <input type="text" name="postal_code" id="postal_code"
                                                  placeholder="Enter your postal code"
                                                  value="<?php echo isset($donor_values['postal_code']) ? $donor_values['postal_code'] : ""; ?>"/></label>
            </div>

            <div class="form_input">
                <label>Phone number: <input type="text" name="phone_number" id="phone_number"
                                            placeholder="Enter your phone number"
                                            value="<?php echo isset($donor_values['phone_number']) ? $donor_values['phone_number'] : ""; ?>"/></label>
            </div>

            <div class="form_input">
                <label>Email: <input type="text" name="email" id="email" placeholder="Enter your email address"
                                     value="<?php echo isset($donor_values['email']) ? $donor_values['email'] : ""; ?>"/></label>
            </div>

            <div class="form_input">
                <label>Preferred form of contact: <select name="p_contact" id="p_contact">
                        <option value="">Enter preferred form of contact</option>
                        <option value="phone"<?php if (isset($donor_values['p_contact']) && ($donor_values['p_contact'] == 'phone'))
                            echo 'selected="selected"'; ?>>Phone
                        </option>
                        <option value="email"<?php if (isset($donor_values['p_contact']) && ($donor_values['p_contact'] == 'email'))
                            echo 'selected="selected"'; ?>>Email
                        </option>
                    </select></label>
            </div>

            <div class="form_input">
                <label>Preferred form of payment:
                    <select name="p_payment" id="p_payment">
                        <option value="">Enter preferred form of payment</option>
                        <option value="usd"<?php if (isset($donor_values['p_payment']) && ($donor_values['p_payment'] == 'usd'))
                            echo 'selected="selected"'; ?>>USD
                        </option>
                        <option value="euro"<?php if (isset($donor_values['p_payment']) && ($donor_values['p_payment'] == 'euro'))
                            echo 'selected="selected"'; ?>>Euro
                        </option>
                        <option value="bitcoin"<?php if (isset($donor_values['p_payment']) && ($donor_values['p_payment'] == 'bitcoin'))
                            echo 'selected="selected"'; ?>>Bitcoin
                        </option>
                    </select>
                </label>
            </div>

            <div class="form_input">
                <label>Frequency of Donation: <select name="f_donation" id="f_donation">
                        <option value="">Enter Donation frequency</option>
                        <option value="monthly"<?php if (isset($donor_values['f_donation']) && ($donor_values['f_donation'] == 'monthly'))
                            echo 'selected="selected"'; ?>>Monthly
                        </option>
                        <option value="yearly"<?php if (isset($donor_values['f_donation']) && ($donor_values['f_donation'] == 'yearly'))
                            echo 'selected="selected"'; ?>>Yearly
                        </option>
                        <option value="one_time"<?php if (isset($donor_values['f_donation']) && ($donor_values['f_donation'] == 'one_time'))
                            echo 'selected="selected"'; ?>>One Time
                        </option>
                    </select></label>
            </div>

            <div class="form_input">
                <label>Amount: </label>

                <input type="text" name="amount" id="amount"
                       placeholder="Enter Amount"
                       value="<?php if (isset($edit_donor) && isset($donor_values['currency'])) {
                           echo CurrencyConverter::convert_from_dollar($donor_values['p_payment'], $donor_values['currency'], $btc_rate, $euro_rate);
                       } elseif (isset($donor_values['currency'])) {
                           echo $donor_values['currency'];
                       } ?>"/>

            </div>

            <div class="form_input">
                <label>Comments: <textarea name="comment" rows="3" id="comment"
                                           cols="40"><?php echo isset($donor_values['comment']) ? $donor_values['comment'] : ""; ?></textarea></label>
            </div>
        </div>

    </fieldset>
    <div class="submit_actions ">
        <?php if (isset($edit_donor)) { ?>
            <input type="hidden" name="donor_edit_id" value="<?php echo $edit_donor['id']; ?>"/>
            <input type="submit" name="review" value="Update"/>
        <?php } else { ?>
            <input type="submit" name="review" value="Submit My Information"/>
        <?php } ?>
        <input type="button" value="Cancel" onclick="history.back(-1)"/>
    </div>
</form>

<?php include('templates/footer.html'); ?>
