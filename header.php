
<?php
      require './includes/constants.php';
      require './includes/functions.php';
      require './includes/db.php';

      ob_start();

      // start the session

      if(!session_start())
      {
          session_start();
      }

    if (isset($_SESSION['user']))
    {
      $username = $_SESSION['user']['user_id'];
      $username = strtoupper($username);
      $user_type = $_SESSION['user']['user_type'];




      }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<!--
Template Name: Corporation
Author: <a href="http://www.os-templates.com/">OS Templates</a>
Author URI: http://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: http://www.os-templates.com/template-terms
-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="./css/layout.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="./css/webd3201.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> -->
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> -->
    <title>WEBD3201 -  <?php echo $title; ?></title>

      <!--
            Group 17
            WEBD3201
            Sep 27, 2018
            File: <?php echo $file . "\n"; ?>
            Date: <?php echo $date . "\n"; ?>
            Description: <?php echo $description . "\n"; ?>
    -->
  </head>
<body id="top">
<div class="wrapper col1">
  <div id="head">
    <div class="logo">
        <a href="./index.php"><img src="./images/realestatelogo1.png" alt="Dream Home Real Estate"/></a>
    </div>
    <div id="topnav">
      <ul>
        <li><a class="active" href="index.php">Home</a></li>
         <?php
      if (isset($_SESSION['user']['user_id']))
      {
        ?>
        <li><a href="logout.php">Logout</a>
          <ul>
            <li><a href="./change-password.php">Change Password</a></li>
            <li><a href="./user-update.php">Update Info</a></li>
          </ul>
        </li>


    <?php
      }
      else
      {
        ?>
        <li><a href = "./login.php">Login</a>
              <ul>
                <li><a href="./register.php">Register</a></li>
              </ul>
            </li>
             <?php
          }
          ?>
        <!-- <li><a href="login.php">Login</a></li> -->
        <li><a href="./change-password.php">Change-Password</a></li>
        <li><a href="#">Listing</a>
          <ul>
            <li><a href="./listing-create.php">Create</a></li>
            <li><a href="./listing-display.php">Display</a></li>
            <li><a href="./listing-update.php">Update</a></li>
            <li><a href="./listing-search.php">Search</a></li>
            <li><a href="./listing-city-select.php">Search by City</a></li>
            <li><a href="./listing-matches.php">Search by Pages</a></li>
            <li><a href="./listing-search-results.php">Results</a></li>
          </ul>
        </li>

           <?php

            if(isset($_SESSION['user']['user_type']) == ADMIN)
            {

              ?>
                  <li><a href="./admin.php">Admin</a></li>
            <?php

                }

                else if(isset($_SESSION['user']['user_type']) == AGENT)
                {
            ?>

                    <li><a href="./dashboard.php">Dashboard</a></li>
            <?php
                }
                else if(isset($_SESSION['user']['user_type']) == CLIENT)
                {
            ?>
                   <li><a href="./welcome.php">Welcome</a></li>
            <?php
                }

            ?>


       <!--  <li><a href="#">About</a></li> -->
        <li class="last"><a href="./contactus.php">Contact Us</a></li>
      </ul>
    </div>

  </div>
</div>
