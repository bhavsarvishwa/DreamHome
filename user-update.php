<!-- user-update.php --><!-- // For Registering New Agents/ Client Users -->
<?php

    $file = "user-update.php";
    $date = "27 September 2018";
    $title = "To Register New Agent/ Client  ";
    $coursecode = "WEBD3201-02 & WEBD3201-07";
    $description = "This is register page to let user register for the site.";
    $banner = "Register Page";
    $heading = "Dream Home Real Estate";
    require 'header.php';

    if (isset($_SESSION['user']))
    {
      $username = $_SESSION['user']['user_id'];
      $username = strtoupper($username);
      $user_type = $_SESSION['user']['user_type'];
      $lastaccessed = $_SESSION['user']['last_access'];
    }
     else
    {

      header("Location: ./login.php");
      ob_flush();
    }

    if($user_type == PENDING || $user_type == DISABLED)
    {
    	$_SESSION['message'] = 'Disabled or Pending User are not allowed to update their information';
    	header("Location: ./login.php");
        ob_flush();
    }

        $userid = trim($_SESSION['user']['user_id']);
        $salutations = "";
        $firstname = "";
        $lastname = "";
        $streetaddress1 = "";
        $streetaddress2 = "";
        $city = "";
        $province = "";
        $postalcode = "";
        $primaryphonenumber = "";
        $secondaryphonenumber = "";
        $faxnumber = "";
        $preferredcontactmethod = "";

        $emailaddress= "";
        $usertype= "";

        $userinfo = "";
        $output = "";
        $result = "";
        $totalRecords = "";
        $today = date("Y-m-d",time());

        $_SESSION['message'] = 'User Information is updated successfully ';


    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //dump($_POST);

        GLOBAL $conn;
        $userid = trim($_SESSION['user']['user_id']); //the name of the input box on the form, white-space removed
        $salutations = isset($_POST["salutations"])?trim($_POST["salutations"]):""; //the name of the input box on the form, white-space removed
        $firstname = trim($_POST["firstname"]); //the name of the input box on the form, white-space removed
        $lastname = trim($_POST["lastname"]); //the name of the input box on the form, white-space removed
        $streetaddress1 = trim($_POST["streetaddress1"]); //the name of the input box on the form, white-space removed
        $streetaddress2 = trim($_POST["streetaddress2"]); //the name of the input box on the form, white-space removed
        $city = trim($_POST["city"]); //the name of the input box on the form, white-space removed
        $province = isset($_POST["province"])?trim($_POST["province"]):""; //the name of the input box on the form, white-space removed
        $postalcode = trim($_POST["postalcode"]); //the name of the input box on the form, white-space removed
        $primaryphonenumber = trim($_POST["primaryphonenumber"]); //the name of the input box on the form, white-space removed
        $secondaryphonenumber = trim($_POST["secondaryphonenumber"]); //the name of the input box on the form, white-space removed
        $faxnumber = trim($_POST["faxnumber"]); //the name of the input box on the form, white-space removed
        $preferredcontactmethod = isset($_POST["preferred_contact_method"])?
            trim($_POST["preferred_contact_method"]):""; //the name of the input box on the form, white-space removed
        $emailaddress = trim($_POST["emailaddress"]); //the name of the input box on the form, white-space removed
        $usertype = isset($_POST["usertype"])?trim($_POST["usertype"]):CLIENT; //the name of the input box on the form, white-space removed


        //First name validation
        if(!isset($firstname) || strlen($firstname)== 0)
        {
            $output .= "<br/>* You must enter a first name.";
            $firstname = "";
        } else if(is_numeric($firstname)) //Check if it is numeric
        {
            $output .= "<br/>* The first name should not contain any digits.";
             $firstname = "";
        } else if(strlen($firstname) > MAX_FIRST_NAME_LENGTH)
        {
            $output .= "<br/>* The first name must be less than ".MAX_FIRST_NAME_LENGTH." characters, $firstname is too long.";
             $firstname = "";
        }

        //Last Name Validation
        if(!isset($lastname) || strlen($lastname) == 0)
        {
            $output .= "<br/>* You must enter a last name.";
            $lastname = "";
        }
        else if(is_numeric($lastname)) //Check if it is numeric
        {
            $output .= "<br/>* The last name should not contain any digits.";
            $lastname = "";
        }
        else if(strlen($lastname) > MAX_LAST_NAME_LENGTH)
        {
            $output .= "<br/>* The last name must be less than ".MAX_LAST_NAME_LENGTH." characters, $lastname is too long.";
            $lastname = "";
        }


        if($postalcode)
        {
            $postalcode = str_replace(" ", "", $postalcode);
        }


        // Email Address Validation
        if(!isset($emailaddress) || strlen($emailaddress == ""))
        {
            $output .= "<br/>* You must enter a password.";
            $emailaddress = "";
        }
        else if(strlen($emailaddress) > MAXIMUM_EMAIL_LENGTH)
        {
            $output .= "<br/>* The email address must be less than ".MAXIMUM_EMAIL_LENGTH." characters, $emailaddress is too long.";
            $emailaddress = "";
        }
        else if(!filter_var($emailaddress, FILTER_VALIDATE_EMAIL))
        {
            $output .= "<br/>* The email address is not valid. Please enter valid email address. ";
            $emailaddress = "";
        }


        if(!isset($primaryphonenumber) || strlen($primaryphonenumber== 0))
        {
            $output .= "<br/>* You must enter primary phone number.";
            $userid = "";
        }


        // If errors are 0 then connect with the database
        if ($output == "")
        {
        	// $userinfo =

            $user = array($userid, $emailaddress, $usertype, $today);
            //dump($user);
            $person = array($userid, $salutations, $firstname, $lastname, $streetaddress1, $streetaddress2, $city, $province, $postalcode, $primaryphonenumber, $secondaryphonenumber, $faxnumber, $preferredcontactmethod);
            //dump($person);



            $result = pg_execute($conn, "user_update", $user);

            $result = pg_execute($conn, "person_update", $person);


            setcookie('LAST_LOGIN_ID',$userid,cookie_ends());
            //dump($usertype);

           if($result)
            {
                // if($usertype == CLIENT)
                // {

                //    header("Location:welcome.php");
                //    ob_flush();
                   $_SESSION['message'];
                // }
                // else if ($usertype == AGENT)
                // {
                // 	 $_SESSION['message'];
                //     header("Location:index.php");
                //     ob_flush();
                // }
            }
            else
            {
                $output .= "<br/>* Oops! Something went wrong!.";
            }
        }

    }
?>
 <div>
 <?php
        if($output == "" && $result != 0)
        {
			echo "<h1>".$_SESSION['message']."</h1>";
			$userid = trim($_SESSION['user']['user_id']);
			$salutations = "";
			$firstname = "";
			$lastname = "";
			$streetaddress1 = "";
			$streetaddress2 = "";
			$city = "";
			$province = "";
			$postalcode = "";
			$primaryphonenumber = "";
			$secondaryphonenumber = "";
			$faxnumber = "";
			$preferredcontactmethod = "";

			$emailaddress= "";
			$usertype= "";

			$userinfo = "";
			$output = "";
			$result = "";
			$totalRecords = "";

        }
        else
          echo "<h2>".$output."</h2>";

  ?>
</div>
<div class="container">

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

        <h1>Update Information</h1>
          <p>Please fill in this form to update your information.</p>
        <hr/>

        <label for="userid"><b>User ID</b></label><br/>
        <input type="text" placeholder="Enter Your User ID" name="userid" readonly value="<?php echo $userid; ?>"><br/>

        <label for="salutations"><b>Salutation</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo build_simple_dropdown1("salutations", $salutations);?><br/>

        <label for="firstname"><b>First Name</b></label><br/>
        <input type="text" placeholder="Enter Your First Name" name="firstname" value="<?php echo $firstname; ?>"><br/>

        <label for="lastname"><b>Last Name</b></label><br/>
        <input type="text" placeholder="Enter Your Last Name" name="lastname" value="<?php echo $lastname; ?>"><br/>

        <label for="StreetAddress1"><b>Address</b></label><br/>
        <input type="text" placeholder="Enter Your Address" name="streetaddress1" value="<?php echo $streetaddress1; ?>"><br/>

        <label for="StreetAddress2"><b>Address Continued</b></label><br/>
        <input type="text" placeholder="" name="streetaddress2" value="<?php echo $streetaddress2; ?>"><br/>

        <label for="City"><b>City</b></label><br/>
        <input type="text" placeholder="Enter Your City" name="city" value="<?php echo $city; ?>"><br/>

        <label for="Province"><b>Province</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo build_simple_dropdown1("provinces", $province); ?><br/>

        <label for="PostalCode"><b>Postal Code</b></label><br/>
        <input type="text" placeholder="Enter Your Postal Code" name="postalcode" value="<?php echo $postalcode; ?>"><br/>

        <label for="PrimaryPhoneNumber"><b>Primary Phone Number</b></label><br/>
        <input type="text" placeholder="Enter Your Phone Number" name="primaryphonenumber" value="<?php echo $primaryphonenumber; ?>"><br/>

        <label for="SecondaryPhoneNumber"><b>Other Phone Number</b></label><br/>
        <input type="text" placeholder="Enter Other Phone Number" name="secondaryphonenumber" value="<?php echo $secondaryphonenumber; ?>"><br/>

        <label for="FaxNumber"><b>Fax Number</b></label><br/>
        <input type="text" placeholder="Enter Fax Number" name="faxnumber" value="<?php echo $faxnumber; ?>"><br/>

       <label for="preferredcontactmethod"><b>Preferred Contact Method</b></label>

        <?php echo build_radio("preferred_contact_method",  $preferredcontactmethod); ?><br/>

        <label for="emailaddress"><b>E-mail</b></label><br/>
        <input type="text" placeholder="Enter Email Address" name="emailaddress" value="<?php echo $emailaddress; ?>" ><br/>

        <label><br/>
        <input type="checkbox" name="usertype" style="margin-bottom:15px"
            value="<?php echo AGENT; ?>" <?php echo (($usertype == AGENT)? " checked='checked' ":""); ?> > Are you an Agent?
        </label><br/>

        <div class="clearfix">
        <button type="button" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Sign Up</button>
      </div>

  </form> </div>

<?php include 'footer.php'; ?>
