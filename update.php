<!-- // For Registering New Agents/ Client Users -->
<?php

    $file = "update.php";
    $date = "27 October 2018";
    $title = " Update Your Profile  ";
    $coursecode = "WEBD3201-02 & WEBD3201-07";
    $description = "This page allows you to update your user profile.";
    $banner = "Update Page";
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


        $login = "";
          $password = "";
          $conf_password = "";
          $firstname = "";
          $lastname = "";
          $emailaddress = "";

          $output = "";
          $result = "";
          $totalRecords = "";
          $today = date("Y-m-d",time());


          if($_SERVER["REQUEST_METHOD"] == "POST")
          {

              $login = trim($_POST["user_id"]); //the name of the input box on the form, white-space removed
              $password = trim($_POST["passwd"]); //the name of the input box on the form, white-space removed
              $conf_password = trim($_POST["conf_passwd"]); //the name of the input box on the form, white-space removed
              $firstname = trim($_POST["first_name"]); //the name of the input box on the form, white-space removed
              $lastname = trim($_POST["last_name"]); //the name of the input box on the form, white-space removed
              $emailaddress = trim($_POST["email_address"]); //the name of the input box on the form, white-space removed

              //Login Validation
              if(strlen($login) == 0)
              {
                  $output .= "<br/>* You must enter a user id.";
                  $login = "";
              }
              else if(strlen($login) < MINIMUM_ID_LENGTH)
              {
                  $output .= "<br/>* A user id must be at least 5 characters, $login is not long enough.";
                  $login = "";
              }
              else if(strlen($login) > MAXIMUM_ID_LENGTH)
              {
                  $output .= "<br/>* A user id must be less than 15 characters, $login is too long.";
                  $login = "";
              }
              else if(userExists($login))
              {
                  $output .= "<br/>* $login already exists. Please choose another user name.";
                  $login = "";
              }

              //Password Validation
              if(strlen($password) == 0)
              {
                  $output .= "<br/>* You did not enter a password.";
                  $password = "";
              }
              if (strcmp($password, $conf_password) !== 0)
              {
                  $output .= "<br/>* The password and confirm password were not the same. ";
                  $password = "";
              }
              else if(strlen($password) < MINIMUM_PASSWORD_LENGTH)
              {
                  $output .= "<br/>* The password must be at least 5 characters, $login is not long enough.";
                  $password = "";
              }
              else if(strlen($password) > MAXIMUM_PASSWORD_LENGTH)
              {
                  $output .= "<br/>* The password must be less than 15 characters, $login is too long.";
                  $password = "";
              }

              //First name Validation
              if(!isset($firstname) || $firstname == "")
              {
                  $output .= "<br/>* You must enter a login id.";
                  $firstname = "";
              }
              else if(is_numeric($firstname)) //Check if it is numeric
              {
                  $output .= "<br/>* The first name should not contain any digits.";
                   $firstname = "";
              }
              else if(strlen($firstname) > MAX_FIRST_NAME_LENGTH)
              {
                  $output .= "<br/>* The first name must be less than 20 characters, $firstname is too long.";
                   $firstname = "";
              }

              //Last Name Validation
              if(!isset($lastname) || $lastname == "")
              {
                  $output .= "<br/>* You must enter a password.";
                  $lastname = "";
              }
              else if(is_numeric($lastname)) //Check if it is numeric
              {
                  $output .= "<br/>* The first name should not contain any digits.";
                  $lastname = "";
              }
              else if(strlen($lastname) > MAX_LAST_NAME_LENGTH)
              {
                  $output .= "<br/>* The first name must be less than 20 characters, $firstname is too long.";
                  $lastname = "";
              }

              // Email Address Validation
              if(!isset($emailaddress) || $emailaddress == "")
              {
                  $output .= "<br/>* You must enter a password.";
                  $emailaddress = "";
              }
              else if(strlen($emailaddress) > MAXIMUM_EMAIL_LENGTH)
              {
                  $output .= "<br/>* The email address must be less than 255 characters, $emailaddress is too long.";
                  $emailaddress = "";
              }
              else if(!filter_var($emailaddress, FILTER_VALIDATE_EMAIL))
              {
                  $output .= "<br/>* The email address is not valid. Please enter valid email address. ";
                  $emailaddress = "";
              }


              // If errors are 0 then connect with the database
              if ($output == "")
              {

                  $conn = db_connect();

                  $sql = "INSERT INTO users(id, password, first_name, last_name, email_address, enrol_date, last_access) VALUES(

                          '$login',
                          '$password',
                          '$firstname',
                          '$lastname',
                          '$emailaddress',
                          '$today',
                          '$today')";

                          $result = pg_query($conn, $sql);
                          if ($result > 0)
                          {
                                 header("Location:lab9.php");
                                 ob_flush();
                          }
                          else
                          {
                              $output .= "<br/>* Oops! Something went wrong!.";
                          }

              }
          }

        ?>






      <form action="welcome.php" style="border:1px solid #ccc">
      <div class="container">
        <h1>Sign Up</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
        <br/>
        <div class="relative">
    	<label for="firstname"><b>First Name</b></label>
        <input type="text" placeholder="Enter Your First Name" name="First Name" required>
<br/><br/>
    	<label for="lastname"><b>Last Name</b></label>
        <input type="text" placeholder="Enter Your Last Name" name="Last Name" required>
<br/><br/>
    	<label for="Address"><b>Address</b></label>
        <input type="text" placeholder="Enter Your Address" name="Address" required>
<br/><br/>
    	<label for="City"><b>City</b></label>
        <input type="text" placeholder="Enter Your City" name="City" required>
<br/><br/>
    	<label for="Postal Code"><b>Postal Code</b></label>
        <input type="text" placeholder="Enter Your Postal Code" name="Postal Code" required>
<br/><br/>
    	<label for="phonenumber"><b>Phone Number</b></label>
        <input type="text" placeholder="Enter Your Phone Number" name="Phone Number" required>
<br/><br/>
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>
<br/><br/>
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>
<br/><br/>
        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
<br/><br/>
        <!-- <label>
          <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
        </label> -->
      </div>
<br/><br/>


        <div class="clearfix">
          <button type="button" class="cancelbtn">Cancel</button>
          <button type="submit" class="signupbtn">Sign Up</button>
        </div>
      </div>
    </form>
        </p>
<?php include 'footer.php'; ?>
