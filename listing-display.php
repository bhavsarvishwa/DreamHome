<!-- // This page is used to view a specific listing from the results -->
<?php

    $file = "listing-display.php";
    $date = "27 September 2018";
    $title = "To display specific listings from the multiple listings";
    $coursecode = "WEBD3201-02 & WEBD3201-07";
    $description = "This page will be used to display a specific listing from multiple listings.";
    $banner = "Display Results";
    $heading = "Dream Home Real Estate";
    require 'header.php';

    if (isset($_SESSION['user']))
    {
      $username = $_SESSION['user']['user_id'];
      $username = strtoupper($username);
      $user_type = $_SESSION['user']['user_type'];
      $lastaccessed = $_SESSION['user']['last_access'];
    }

    // $listing = get_listing($listing_id);
    // $listing_select =  pg_prepare(db_connect(), "listing_select", "SELECT * FROM listings WHERE listing_id = $1");

?>

<p>
  <div class="row">
              <hr/>
              <div class="column right" style="color:white; width:55%;">
                <p>
                  <a href="./listing-display.php?listing_id=10009"><img src="./images/house7_1.jpg" alt="Dream Home"/></a>
                </p>
                <p><a href="./listing-display.php?listing_id=10009">With Pool and 10 parking spaces having 4659 land area with 3012 floor space. Also having 2 bedrooms and 3 storeys built in 2007 including Fully finished basement and heating is Fireplaces</a></p>
              </div>

              <div class="column right" style="color:white; width:35%;">
                  <h4>Property Type : Bungalow</h4>
                  <h4>Bedrooms      : 8 bedrooms</h4>
                  <h4>Bathrooms     : 6 bathrooms</h4>
                  <h4>Basement Type : Fully finished basement</h4>
                  <h4>Heating Type  : Fireplaces</h4>
                  <h4>Parking Spaces: 10 parking spaces</h4>
                  <h4>Including with: Pool</h4>
                  <h4>Price         : $603752.00</h4>
              </div>



</p>






<?php include 'footer.php'; ?>
