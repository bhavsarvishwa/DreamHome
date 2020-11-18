<!-- // This page is used to show a preview of multiple listings -->
<?php

    $file = "listing-search-results.php";
    $date = "27 September 2018";
    $title = "To display the resuts based on the requirements";
    $coursecode = "WEBD3201-02 & WEBD3201-07";
    $description = "This page will be used to display preiviews of multiple listings.";
    $banner = "Preview of Multiple Listings";
    $heading = "Dream Home Real Estate";
    require 'header.php';

    if (isset($_SESSION['user']))
    {
      $username = $_SESSION['user']['user_id'];
      $username = strtoupper($username);
      $user_type = $_SESSION['user']['user_type'];
      $lastaccessed = $_SESSION['user']['last_access'];
    }
   /*if(!isset($_SESSION['listings'])||sizeof($_SESSION['listings'])==0)
   {
     header("Location:./listing-search.php");
   }*/
   $listings = array();
   for($i = 1; $i <= 25; $i++)
   {
     $temp = array($i, "Headline for Property " . $i, $i . " bedrooms", $i . " bathrooms");
     array_push($listings, $temp);
   }





?>

<?php

  $output = "";
  for($i = 0; $i < sizeof($listings); $i++)
  {
    //echo $listings[$i];
    //$listing = get_listing($id)
    $output .= build_listing_preview($listings[$i]);
  }
  echo $output;
?>
    <!-- <div class="container">
</div> -->

<?php include 'footer.php'; ?>
