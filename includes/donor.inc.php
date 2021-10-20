<?php # - donor's.inc.php
	
	 // Display the form:
?>
     
    
     <form action="donor.php" method="POST">
    <fieldset><legend>Enter your information in the form below:	
    </legend>
        <p><label>Last Name: <input type="text" name="last_name" placeholder = "Enter your last name"
        value="<?php if (isset($_POST['last_name'])) echo $_POST ['last_name']; ?>"/></label>
        </p>

        <p><label>First Name: <input type="text" name="first_name" placeholder="Enter your first name"
        value="<?php if (isset($_POST['first_name'])) echo $_POST ['first_name']; ?>" /></label>
        </p>

        <p><label>Street Address: <input type="text" name="s_address" placeholder="Enter your street address" value="<?php if (isset($_POST['s_address'])) echo $_POST ['s_address']; ?>"/></label>
        </p>

        <p><label>City: <input type="text" name="city" placeholder="Enter your city" value="<?php if (isset($_POST['city'])) echo $_POST ['city']; ?>"/></label>
        </p>

        <p><label>country: <select name="country">
	 	 	 <option value="africa"<?php if (isset($_POST['country']) && ($_POST['country'] == 'africa'))
                echo 'selected="selected"'; ?>>Africa</option>
               <option value="uk"<?php if (isset($_POST['country']) && ($_POST['country'] == 'uk'))
                echo 'selected="selected"'; ?>>Uk</option>
          </select></label></p>

        <p><label>State/Region: <input type="text" name="d_state" placeholder="Enter your state/region" value="<?php if (isset($_POST['d_state'])) echo $_POST ['d_state']; ?>"/></label>
        </p>

        <!--  -->

        <p><label>Postal Code/Region: <input type="text" name="postal_code" placeholder="Enter your postal code" value="<?php if (isset($_POST['postal_code'])) echo $_POST ['postal_code']; ?>"/></label>
        </p>

        <p><label>Phone number: <input type="text" name="phone_number" placeholder="Enter your phone number" value="<?php if (isset($_POST['phone_number'])) echo $_POST ['phone_number']; ?>"/></label>
        </p>

        <p><label>Email: <input type="text" name="email" placeholder="Enter your email address" value="<?php if (isset($_POST['email'])) echo $_POST ['email']; ?>"/></label>
        </p>

        <p><label>Preferred form of contact: <select name="p_contact">
	 	 	 <option value="phone"<?php if (isset($_POST['p_contact']) && ($_POST['p_contact'] == 'phone'))
                echo 'selected="selected"'; ?>>Phone</option>
               <option value="email"<?php if (isset($_POST['p_contact']) && ($_POST['p_contact'] == 'email'))
                echo 'selected="selected"'; ?>>Email</option>
          </select></label></p>
          
          <p><label>Preferred form of payment: <select name="p_payment">
	 	 	 <option value="usd"<?php if (isset($_POST['p_payment']) && ($_POST['p_payment'] == 'usd'))
                echo 'selected="selected"'; ?>>USD</option>
               <option value="euro"<?php if (isset($_POST['p_payment']) && ($_POST['p_payment'] == 'euro'))
                echo 'selected="selected"'; ?>>Euro</option>
               <option value="bitcon"<?php if (isset($_POST['p_payment']) && ($_POST['p_payment'] == 'bitcon'))
                echo 'selected="selected"'; ?>>Bitcoin</option>
          </select></label></p>
          
          <p><label>Frequency of Donation: <select name="f_donation">
	 	 	 <option value="monthly"<?php if (isset($_POST['f_donation']) && ($_POST['f_donation'] == 'monthly'))
                echo 'selected="selected"'; ?>>Monthly</option>
               <option value="yearly"<?php if (isset($_POST['f_donation']) && ($_POST['f_donation'] == 'yearly'))
                echo 'selected="selected"'; ?>>Yearly</option>
               <option value="one_time"<?php if (isset($_POST['f_donation']) && ($_POST['f_donation'] == 'onetime'))
                echo 'selected="selected"'; ?>>One Time</option>
          </select></label></p>
          

          <!-- <p><label>Currency:
              $ <input type="number" min="0.01" step="0.01" max="2500" value="25.67" /></label>
        </p>      
         -->
        <p><label>Comments: <textarea name="comment" rows="3" cols="40"><?php if (isset($_POST['comment'])) echo $_POST ['comment']; ?></textarea></label></p>
      
 	 </fieldset>	 	
	 	 <p align="center"><input type="submit" name="review" value="Submit My Information" /></p>
    </form>
	
	 <?php include ('includes/footer.html'); ?>