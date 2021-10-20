
<?php # - Prospective donors to Wikimedia Foundation
$page_title = "Donor | Wikimedia Foundation";
include('includes/header.html');
?>

    <form action="handle_form.php" method="POST">
    <fieldset><legend>Enter your information in the form below:	
    </legend>
        <p><label>Last Name: <input type="text" name="last_name" placeholder = "Enter your last name"/></label>
        </p>

        <p><label>First Name: <input type="text" name="first_name" placeholder="Enter your first name" /></label>
        </p>

        <p><label>Street Address: <input type="text" name="address" placeholder="Enter your street address" /></label>
        </p>

        <p><label>City: <input type="text" name="city" placeholder="Enter your city"/></label>
        </p>

        <p><label>State/Region: <input type="text" name="city" placeholder="Enter your state/region"/></label>
        </p>

        <!--  -->

        <p><label>Postal Code/Region: <input type="text" name="postal_code" placeholder="Enter your postal code"/></label>
        </p>

        <p><label>Phone number: <input type="text" name="phone_number" placeholder="Enter your phone number"/></label>
        </p>

        <p><label>Phone number: <input type="text" name="email" placeholder="Enter your email address"/></label>
        </p>

        <p><label>Email: <input type="text" name="text" placeholder="Enter your email address"/></label>
        </p>

        <p><label>Preferred form of contact: <select name="p_contact">
	 	 	 <option value="phone">Phone</option>
               <option value="email">Email</option>
          </select></label></p>
          
          <p><label>Preferred form of payment: <select name="p_payment">
	 	 	 <option value="usd">USD</option>
               <option value="euro">Euro</option>
               <option value="bitcoin">Bitcoin</option>
          </select></label></p>
          
          <p><label>Frequency of Donation: <select name="f_donation">
	 	 	 <option value="monthly">Monthly</option>
               <option value="yearly">Yearly</option>
               <option value="one_time">One Time</option>
          </select></label></p>
          

          <p><label>Currency:
              $ <input type="number" min="0.01" step="0.01" max="2500" value="25.67" /></label>
        </p>      
        
        <p><label>Comments: <textarea name="comments" rows="3" cols="40"></textarea></label></p>
      
 	 </fieldset>	 	
	 	 <p align="center"><input type="submit" name="submit" value="Submit My Information" /></p>
    </form>
    
<?php
include('includes/footer.html');
?>