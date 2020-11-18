<!-- // For Registering New Agents/ Client Users -->
<?php

    $file = "register.php";
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

      header("Location: ./index.php");
      ob_flush();
    }


        $userid = "";
        $password = "";
        $confirm_password = "";
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


        $output = "";
        $result = "";
        $totalRecords = "";
        $today = date("Y-m-d",time());

        $_SESSION['message'] = 'You have successfully registered.';

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //dump($_POST);
        GLOBAL $conn;
        $userid = trim($_POST["userid"]); //the name of the input box on the form, white-space removed
        $password = trim($_POST["password"]); //the name of the input box on the form, white-space removed
        $confirm_password = trim($_POST["confirm_password"]); //the name of the input box on the form, white-space removed
        $salutations = isset($_POST["salutations"])?trim($_POST["salutations"]):""; //the name of the input box on the form, white-space removed
        $firstname = trim($_POST["firstname"]); //the name of the input box on the form, white-space removed
        $lastname = trim($_POST["lastname"]); //the name of the input box on the form, white-space removed
        $streetaddress1 = trim($_POST["streetaddress1"]); //the name of the input box on the form, white-space removed
        $streetaddress2 = trim($_POST["streetaddress2"]); //the name of the input box on the form, white-space removed
        $city = trim($_POST["city"]); //the name of the input box on the form, white-space removed
        $province = trim($_POST["provinces"]); //the name of the input box on the form, white-space removed
        $postalcode = trim($_POST["postalcode"]); //the name of the input box on the form, white-space removed
        $primaryphonenumber = trim($_POST["primaryphonenumber"]); //the name of the input box on the form, white-space removed
        $secondaryphonenumber = trim($_POST["secondaryphonenumber"]); //the name of the input box on the form, white-space removed
        $faxnumber = trim($_POST["faxnumber"]); //the name of the input box on the form, white-space removed
        $preferredcontactmethod = isset($_POST["preferred_contact_method"])?
            trim($_POST["preferred_contact_method"]):""; //the name of the input box on the form, white-space removed
        $emailaddress = trim($_POST["emailaddress"]); //the name of the input box on the form, white-space removed
        $usertype = isset($_POST["usertype"])?trim($_POST["usertype"]):PENDING; //the name of the input box on the form, white-space removed

        //Login Validation
        if(!isset($userid) ||  strlen($userid) == 0)
        {
            $output .= "<br/>* You must enter a user id.";
            $userid = "";
        }else if(strlen($userid) < MINIMUM_ID_LENGTH)
        {
            $output .= "<br/>* A user id must be at least ".MINIMUM_ID_LENGTH." characters, $userid is not long enough.";
            $userid = "";
        }else if(strlen($userid) > MAXIMUM_ID_LENGTH)
        {
            $output .= "<br/>* A user id must be less than ".MAXIMUM_ID_LENGTH." characters, $userid is too long.";
            $userid = "";
        }else if(userExists($userid))
        {
            $output .= "<br/>* $userid already exists. Please choose another user name.";
            $userid = "";
        }

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

        //Password Validation

        if (strcmp($password, $confirm_password) !== 0)
        {
            $output .= "<br/>* The password and confirm password were not the same. ";
            $password = "";
        }else if(strlen($password) == 0)
        {
            $output .= "<br/>* You did not enter a password.";
            $password = "";
        }else if(strlen($password) < MINIMUM_PASSWORD_LENGTH)
        {
            $output .= "<br/>* The password must be at least ".MINIMUM_PASSWORD_LENGTH." characters, $userid is not long enough.";
            $password = "";
        }else if(strlen($password) > MAXIMUM_PASSWORD_LENGTH)
        {
            $output .= "<br/>* The password must be less than ".MINIMUM_PASSWORD_LENGTH." characters, $userid is too long.";
            $password = "";
        }else{
            $password = hash(HASH, $password);
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
            $user = array($userid, $password, $usertype, $emailaddress, $today, $today);
            //dump($user);
            $person = array($userid, $salutations, $firstname, $lastname, $streetaddress1, $streetaddress2, $city, $province, $postalcode, $primaryphonenumber, $secondaryphonenumber, $faxnumber, $preferredcontactmethod);
            //dump($person);



            $result = pg_execute($conn, "user_insert", $user);

            $result = pg_execute($conn, "person_insert", $person);


            setcookie('LAST_LOGIN_ID',$userid,cookie_ends());
            //dump($usertype);

           if($result)
            {
                if($usertype == CLIENT)
                {
                   header("Location:welcome.php");
                   ob_flush();
                }
                else if ($usertype == AGENT)
                {
                    header("Location:index.php");
                    ob_flush();
                }
            }
            else
            {
                $output .= "<br/>* Oops! Something went wrong!.";
            }
        }

    }
?>
 <div>
  <div>
 <?php
        if($output == "" && $result != 0)
        {
          echo "<h1>".$_SESSION['message']."</h1>";
        }
        else
          echo "<h2>".$output."</h2>";

  ?>
</div>
<div class="container">

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

        <h1>Sign Up</h1>
          <p>Please fill in this form to create an account.</p>
        <hr/>

        <label for="userid"><b>User ID</b></label><br/>
        <input type="text" placeholder="Enter Your User ID" name="userid" value="<?php echo $userid; ?>"><br/>

        <label for="Salutations"><b>Salutation</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo build_simple_dropdown1("salutations", $salutations);?><br/>

        <label for="firstname"><b>First Name</b></label><br/>
        <input type="text" placeholder="Enter Your First Name" name="firstname" value="<?php echo $firstname; ?>"><br/>

        <label for="lastname"><b>Last Name</b></label><br/>
        <input type="text" placeholder="Enter Your Last Name" name="lastname" value="<?php echo $lastname; ?>"><br/>

        <label for="password"><b>Password</b></label><br/>
        <input type="password" placeholder="Enter Password" name="password" value="<?php echo $password; ?>"><br/>

        <label for="password-repeat"><b>Repeat Password</b></label><br/>
        <input type="password" placeholder="Repeat Password" name="confirm_password" value="<?php echo $confirm_password; ?>"><br/>

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
   <div><p></p></div>
 <div><p></p></div>
  </form> <div><p><hr/></p></div>
  </div>


<?php include 'footer.php'; ?>
