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


<div class="wrapper col2">
  <div id="gallery">
    <ul>
      <li class="placeholder" style="background-image:url(images/image45.jpg);">Image Holder</li>
      <li><a class="swap" style="background-image:url(images/image1_1.jpg);" href="#gallery"><strong>Services</strong><span><img src="images/image1.jpg" alt="" /></span></a></li>
      <li><a class="swap" style="background-image:url(images/image51_51.jpg);" href="#gallery"><strong>Products</strong><span><img src="images/image51.jpg" alt="" /></span></a></li>
      <li class="last"><a class="swap" style="background-image:url(images/image29_29.jpg);" href="#gallery"><strong>Company</strong><span><img src="images/image29.jpg" alt="" /></span></a></li>
    </ul>
    <div class="clear"></div>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">
    <div id="content">
      <h1>About Dream Home Real Estate</h1>
      <p>Welcome to Dream Home Real Estate! If you are looking for a beautiful home where you can relax and have good time with your love ones, then this is the perfect place where we will help you to make your dream come true. We select each houses very carefully to take care of our client's expectations. Prestigious location with great neighbourhood, charming cottages with sparkling pool and private spa - within your budget. We always consider your expectations as our requirements to serve you best.</p>
      <!--
      <p>Lacusenim inte trices lorem anterdum nam sente vivamus quis fauctor mauris. Wisinon vivamus wisis adipis laorem lobortis curabiturpiscingilla dui platea ipsum lacingilla.</p>
      <p>Semalique tor sempus vestibulum libero nibh pretium eget eu elit montes. Sedsemporttis sit intesque felit quis elis et cursuspenatibulum tincidunt non curabitae.</p> -->
      <div class="homecontent">
        <ul>
          <li>
            <p class="imgholder"><img src="images/image25_25.jpg" alt="Dream Home" /></p>

          <li class="last">
            <p class="imgholder"><img src="images/image50_50.jpg" alt="Dream Home" /></p>
            <!-- <h2>Indonectetus facilis leo nibh</h2>
            <p>Nullamlacus dui ipsum conseque loborttis non euisque morbi penas dapibulum orna.</p>
            <p>Urnaultrices quis curabitur phasellentesque congue magnis vestibulum quismodo nulla et feugiat. Adipisciniapellentum leo ut consequam ris felit elit id nibh sociis malesuada.</p>  -->
            <!-- <p class="readmore"><a href="#">Read More &raquo;</a></p> -->
          </li>
        </ul>
        <div class="clear"></div>
      </div>
      <!-- <p>Odiointesque at quat nam nec quis ut feugiat consequet orci liberos. Tempertincidunt sed maecenas eros elerit nullam vest rhoncus diam consequat amet. Diamdisse ligula tincidunt a orci proin auctor lacilis lacilis met vitae.</p> -->
    </div>
    <div id="column">
      <div id="featured">
        <ul>
          <li>
            <h2>About Us: </h2>
            <p class="imgholder"><img src="images/image11_11.png" alt="Dream Home" /></p>
            <p>We are currently studying Computer Programming Analyst at <a href = "https://durhamcollege.ca/">Durham College</a>. This website is a part of our assignemnt for <a href = "http://opentech2.durhamcollege.org/pufferd/webd3201/index.php">Web Development - Intermediate</a> subject. Thank you for visiting our website.</p>
            <!-- <p class="more"><a href="#">Read More &raquo;</a></p> -->
          </li>
        </ul>
      </div>
    <!--   <div class="holder">
        <div class="imgholder"><img src="images/demo/290x100.gif" alt="" /></div>
        <p>Nullamlacus dui ipsum conseque loborttis non euisque morbi penas dapibulum orna.</p>
        <p class="readmore"><a href="#">Read More &raquo;</a></p>
      </div>
 -->    </div>
    <div class="clear"></div>
  </div>
</div>

<?php include 'footer.php'; ?>
