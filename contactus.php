<?php

    $file = "index.php";
    $date = "27 September 2018";
    $title = "Home Page";
    $coursecode = "WEBD3201-02 & WEBD3201-07";
    $description = "This is main index file and it is going to be our main page to create a website.";
    $banner = "Welcome to Dream Home Real Estate";
    $heading = "Dream Home Real Estate";
    require 'header.php';

    if (isset($_SESSION['user']))
    {
      $username = $_SESSION['user']['user_id'];
      $username = strtoupper($username);
      $user_type = $_SESSION['user']['user_type'];
      $lastaccessed = $_SESSION['user']['last_access'];
    }
?>

<div class="wrapper col5">
  <div id="footer">
    <div id="contactform">
      <h2>Why Not Contact Us Today !</h2>
      <form action="#" method="post">
        <fieldset>
          <legend>Contact Form</legend>
          <label for="fullname">Name:
            <input id="fullname" name="fullname" type="text" value="" />
          </label>
          <label for="emailaddress" class="margin">Email:
            <input id="emailaddress" name="emailaddress" type="text" value="" />
          </label>
          <label for="phone">Telephone:
            <input id="phone" name="phone" type="text" value="" />
          </label>
          <label for="subject" class="margin">Subject:
            <input id="subject" name="subject" type="text" value="" />
          </label>
          <label for="message">Message:<br />
            <textarea id="message" name="message" cols="40" rows="4"></textarea>
          </label>
          <p>
            <input id="submitform" name="submitform" type="submit" value="Submit" />
            &nbsp;
            <input id="resetform" name="resetform" type="reset" value="Reset" />
          </p>
        </fieldset>
      </form>
    </div>
    <!-- End Contact Form -->
    <div id="compdetails">
      <div id="officialdetails">
        <h2>Company Information !</h2>
        <ul>
          <li>Dream Home Real Estate</li>
          <li>Web Development - Intermediate</li>
          <li>Computer Programming Analyst</li>
        </ul>
        <h2>Created By: </h2>
        <p>
          <ul>
            <li>Vishwa Bhavsar</li>
           </ul>
         </p>
      </div>
      <div id="contactdetails">
        <h2>Our Contact Details !</h2>
        <ul>
          <li>Durham College</li>
          <li>2000 Simcoe St N</li>
          <li>Oshawa</li>
          <li>ON L1G 0C5</li>
          <li>Tel: (905) 721-2000</li>

          <li>Website: <a href="https://durhamcollege.ca/">https://durhamcollege.ca/</a></li>

        </ul>
      </div>
      <div class="clear"></div>
    </div>
    <!-- End Company Details -->

    <div class="clear"></div>
  </div>
</div>


<?php include 'footer.php'; ?>
