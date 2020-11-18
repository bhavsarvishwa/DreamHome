<!-- // For Logged in Agents -->
<?php

    $file = "password-request.php";
    $date = "08 December 2018";
    $title = "Password Request";
    $coursecode = "WEBD3201-02 & WEBD3201-07";
    $description = "This is password request page.";
    $banner = "Password-Request";
    $heading = "Dream Home Real Estate";
    require("./header.php");

    if (isset($_SESSION['user']))
    {
      // $username = $_SESSION['user']['user_id'];
      // $username = strtoupper($username);
      // $user_type = $_SESSION['user']['user_type'];
      // $lastaccessed = $_SESSION['user']['last_access'];

      header("Location: ./welcome.php");
      ob_flush();
    }
    else
    {
      // header("Location: ./login.php");
      // ob_flush();
    }

    $userid = "";
    $userEmail = "";
    $output = "";
    $result = "";
    $newPassword = "";

    // Start a message session array - used to inform the user that their password request has been sent to their email.
    $_SESSION['message'] = 'Information about your password request has been sent to your email.';

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
      GLOBAL $conn;
      $userid = trim($_POST['login']);
      $userEmail = trim($_POST['email']);

      //Check if user ID has NOT been set.
      if(!isset($userid) || $userid == "")
      {
        $output .= "<br/>* You must enter a login id.";
      }
      // Check if user email has NOT been set.
      else if(!isset($userEmail) || $userEmail == "")
      {
        $output .= "<br/>* You must enter your email.";
      }
      else if(!filter_var($userEmail, FILTER_VALIDATE_EMAIL))
      {
        $output .= "The email address is not valid. Please enter valid email address. ";
      }

      // If no more errors,
      if($output == "")
      {
        $result = pg_execute($conn, "password_request", array($userid, $userEmail));

        if(pg_num_rows($result))
        {
          // Generate random password using randomPassword function from functions.php
          $newPassword .= randomPassword($newPassword);

          dump($newPassword);

          // Hash the newly generated random password.
          $hashNewPassword = hash(HASH, $newPassword);

          // Update the user's new password in the users database.
          $sql = "UPDATE users SET password = '".$hashNewPassword."' WHERE user_id = '".$userid."'";
          $results = pg_query($conn, $sql);

                    // For mail() function.
          $messageTo = 'To: '.$userEmail.'';
          $messageSubject = 'Subject: Password Request';
          $messageBody = 'Body: Hello, you have requested a password. Your new password is: '.$newPassword.'';
          $messageHeader = 'From: dreamhomere@dreamhomere.com';

          // Send an email to the user about the password request.
          mail($messageTo, $messageSubject, $messageBody, $messageHeader);

          // sleep(10);
          // Redirect user to login.php with a session message.
          $_SESSION['message'];
          $_SESSION['mail_format'] = "<p>".$messageTo."<br/>".$messageSubject."<br/>".$messageBody."<br/>".$messageHeader;
          header("Location: ./login.php");
          // ob_flush();
        }
        else
        {
          $output .= "User ID and email not found. Please try again.";
          $userid = "";
          $userEmail = "";
        }
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
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">  <div class="container">
        <p>
          Please fill in this form to request for a password.
        </p>
        <hr>

          <!-- User ID is entered here. -->
        <label for="uname"><b>User ID</b></label><br/>
        <input type="text" name="login" placeholder="Enter your User ID" value="<?php echo $userid; ?>" required >
        <br/><br/>

        <!-- User email is entered here. -->
        <label for="uemail"><b>User Email</b></label>
        <input type="text" name="email" placeholder="Enter your email" value="<?php echo $userEmail; ?>" required >
        <br/><br/>

        <div class="clearfix">
          <button type="button" class="cancelbtn">Cancel</button>
          <button type="submit" class="signupbtn">Confirm</button>
        </div>

        </div>
    </form>
  </p>
</div>

<?php include 'footer.php'; ?>
