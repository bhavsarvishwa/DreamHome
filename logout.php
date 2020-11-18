<?php

    $file = "logout.php";
    $date = "27 September 2018";
    $title = "Logout Page ";
    $coursecode = "WEBD3201-02 & WEBD3201-07";
    $description = "This is login page.";
    $banner = "Logout Page";
    $heading = "Dream Home Real Estate: Logout Page";
    require 'header.php';
    // unset($_SESSION);
    // session_destroy();


   if(isset($_SESSION))
   {
        //echo 'You have been logged out. <a href="./index.php">Go back</a>';
        session_unset();
        session_destroy();
        session_start();
    }
  else
    {
      header("Location: ./login.php");
      ob_flush();
    }
?>
<div class="container">
<p> <br/><br/>
  <?php echo 'You have been logged out. <a href="./index.php">Go back</a>'; ?>
  To login again click on the <a href="login.php">login page</a>;
</p>
</div>
    <?php include 'footer.php'; ?>
