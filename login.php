<?php

    $file = "login.php";
    $date = "27 September 2018";
    $title = "Login Page";
    $coursecode = "WEBD3201-02 & WEBD3201-07";
    $description = "This page is used for login and directs the user to the authorized page";
    $banner = "Login Page";
    $heading = "Dream Home Real Estate";
    require 'header.php';

    $output = "";
    $login = isset($_COOKIE['LAST_LOGIN_ID'])?$_COOKIE['LAST_LOGIN_ID']:"";

    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
       //print_r($_GET);
        if(isset($_COOKIE['users']))
        {
          $login = $_COOKIE['users'];
          $password = "";
        }
        else
        {
          $login = "";
          $password = "";
        }

        $user_type = "";
        $lastaccess = "";
        $output = "";
        $result = "";
        $totalRecords = "";
        $validUser = "";

    }
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {

        GLOBAL $conn;
        $login = trim($_POST["login"]); //the name of the input box on the form, white-space removed
        $password = trim($_POST["pass"]);

        if(!isset($login) || $login == "")
        {
            $output .= "<br/>* You must enter a login id.";

        }
        // Password Validation for empty string
        if(!isset($password) || $password == "")
        {
            $output .= "<br/>* You must enter a password.";
        }

        if ($output == "")
        {
            $password = hash(HASH, $password);
            $result = pg_execute($conn, "user_login", array($login, $password));

            // $result = pg_execute($conn, "user_last_access_query", array($last_access, $login));
            if(pg_num_rows($result))
            {

                $user = pg_fetch_assoc($result, 0);
                $_SESSION['user'] = $user;

                setcookie('LAST_LOGIN_ID',$login,cookie_ends());

                $result = pg_execute($conn, "user_last_access_query", array(date("Y-m-d"), $login));

                //echo session_id();
                //unset($_POST['confirm_password']);

                if($_SESSION['user']['user_type'] == ADMIN)
                {

                    header("Location: ./admin.php");
                    ob_flush();
                }
                else if($_SESSION['user']['user_type'] == AGENT)
                {

                    header("Location: ./dashboard.php");
                    ob_flush();
                }
                else if($_SESSION['user']['user_type'] == CLIENT)
                {

                    header("Location: ./welcome.php");
                    ob_flush();
                }
                else if($_SESSION['user']['user_type'] == PENDING)
                {

                    header("Location: ./login.php");
                      echo "Your account has not yet been approved";
                    ob_flush();

                }
                else if($_SESSION['user']['user_type'] == DISABLED)
                {

                    header("Location: ./login.php");
                    echo "Your account has been suspended";
                    ob_flush();

                }
            }

            else
            {

              $sql = "SELECT user_id FROM users
              WHERE user_id = '".$login."'";
              $result = pg_query($conn, $sql);
              $validUser = pg_num_rows($result);
              if($validUser > 0)
              {

                  $output = "Incorrect Password. Please try again! ".$login. " is not logged in.";
              }
              else
              {
                  $output = "Incorrect ID / Password. Please try again!".$login. " is not logged in.";

              }
            }
        }
    }

?>

<div class = "container">
    <?php
             echo "<h2>".$output."</h2>";
    ?>
</div>
<div class="container">
<form action = "<?php echo $_SERVER['PHP_SELF'];  ?>" method="post">

  <div class="contactform label">
      <label for="uname"><b>Login ID</b></label>
      <input type="text" name="login" value="<?php echo $login; ?>" size="20" required/>

      <label for="psw"><b>Password</b></label>
      <input type="password" name="pass" value="<?php echo $password; ?>" size="20"/>

      <div class="clearfix">
        <button type="submit" class="loginbtn">Login</button>
        <button type="reset" class="resetbtn">Reset</button></div>
      </div>

      <div>

      <!-- <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
      </label> -->
  <!-- </div> -->
</form>
</div>

<?php require "footer.php"; ?>
