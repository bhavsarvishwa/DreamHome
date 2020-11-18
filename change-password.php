<?php

    $file = "change-password.php";
    $date = "27 September 2018";
    $title = "Allow user to change their password ";
    $coursecode = "WEBD3201-02 & WEBD3201-07";
    $description = "This page allows user to change their password.";
    $banner = "Change Password Page";
    $heading = "Dream Home Real Estate";
    require("./header.php");

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

    $currentpassword = "";
    $newpassword = "";
    $confirm_password = "";
    $output = "";
    $result = "";

    // Start a message session array - used to inform user that their password has been successfully updated in their appropriate landing page.
    $_SESSION['message'] = 'You password has been successfully changed and updated!';

   if($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $username = trim($_SESSION['user']['user_id']);
      $currentpassword = trim($_POST['currentpass']);
      $newpassword = trim($_POST['newpass']);
      $confirm_password = trim($_POST['confirm_pass']);
      $conn = db_connect();

      $currentpassword = hash(HASH, $currentpassword);

      $results = pg_execute($conn, "user_login", array($username, $currentpassword));

      // echo $username . " - ";

      // echo $rows . " row(s) returned.\n";

      // Checks if current password DOES NOT exist in users table.
      if(!pg_num_rows($results))
      {
        // Clear field:
        $currentpassword = "";

        // Display output message.
        $output = "<br>* Current password does not match/is wrong.";
      }
      // Check if new and confirm passwords are both NOT the same.
      else if(strcmp($newpassword, $confirm_password) !== 0)
      {
        // Display output message.
        $output .= "<br>* New password and confirm password are not the same.";

        // Clear fields:
        $newpassword = "";
        $confirm_password = "";
      }
      // Check if new password is smaller than the minimum length defined.
      else if(strlen($newpassword) < MINIMUM_PASSWORD_LENGTH)
      {
        // Display output message.
        $output .= "<br/>* The new password must be at least ".MINIMUM_PASSWORD_LENGTH." characters.";

        // Clear fields:
        $newpassword = "";
        $confirm_password = "";
      }
      // Check if new password is larger than the maximum length defined.
      else if(strlen($newpassword) > MAXIMUM_PASSWORD_LENGTH)
      {
        // Display output message.
        $output .= "<br/>* The password must be less than ".MAXIMUM_PASSWORD_LENGTH." characters.";

        // Clear fields:
        $newpassword = "";
        $confirm_password = "";
      }
      // Update users' new password in the users database.
      else
      {

        $newpassword = hash(HASH, $newpassword);

        $sql = "UPDATE users SET password = '".$newpassword."' WHERE user_id = '".$username."'";

        $results = pg_query($conn, $sql);

        // Redirect user to their appropraite landing pages.
        if($_SESSION['user']['user_type'] == ADMIN)
        {
          $_SESSION['message'];
          header("Location: ./admin.php");
          ob_flush();
        }
        else if($_SESSION['user']['user_type'] == AGENT)
        {
          $_SESSION['message'];
           header("Location: ./dashboard.php");
           ob_flush();
        }
        else if($_SESSION['user']['user_type'] == CLIENT)
        {
          $_SESSION['message'];
          header("Location: ./welcome.php");
          ob_flush();
        }
        // else if($_SESSION['user']['user_type'] == PENDING)
        // {

        //   header("Location: ./login.php");
        //   echo "Your account has not yet been approved";
        //   ob_flush();
        // }
      }
    }
?>

<div>
  <?php
        echo "<h2>".$output."</h2>";
  ?>
</div>

<div class="container">
  <p>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" style="border:1px solid #ccc">
      <div class="container">
      <!-- <h1>Sign Up</h1> -->
        <p>
          Hello <b><?php echo $username; ?></b>, please fill in this form to change your password.
        </p>
        <hr>

        <label for="currentpassword"><b>Current Password</b></label>
          <input type="password" placeholder="Enter Your Current Password" name="currentpass" value="<?php echo $currentpassword; ?>" required >
        <br/><br/>

        <label for="newpassword"><b>New Password</b></label>
          <input type="password" placeholder="Enter A New Password" name="newpass" value="<?php echo $newpassword; ?>" required >
        <br/><br/>

        <label for="confirmnewpassword"><b>Confirm New Password</b></label>
          <input type="password" placeholder="Confirm Your New Password" name="confirm_pass" value="<?php echo $confirm_password; ?>" required>
        <br/><br/>

          <label>
            <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
          </label>

        <div class="clearfix">

          <button type="button" class="cancelbtn">Cancel</button>
          <button type="submit" class="signupbtn">Confirm</button>


        </div>
        <div><p></p></div>

    </div>
    <div><p><hr/></p></div>
    </form>

  </p>
</div>

<?php include 'footer.php'; ?>
