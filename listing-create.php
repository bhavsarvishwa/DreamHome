<!-- // To create new listings -->
<?php

    $file = "listing-create.php";
    $date = "27 September 2018";
    $title = "To create new listings ";
    $coursecode = "WEBD3201-02 & WEBD3201-07";
    $description = "This is admin file which loads when the user gets login with Administator rights.";
    $banner = "Listing Create Page";
    $heading = "Dream Home Real Estate";
    require 'header.php';

    if (isset($_SESSION['user']))
    {
      $username = $_SESSION['user']['user_id'];
      $username = strtoupper($username);
      //$user_type = $_SESSION['user']['user_type'];
      $lastaccessed = $_SESSION['user']['last_access'];

    }
    else
    {

      header("Location: ./login.php");
      ob_flush();
    }


    $listing_status = "";
    $price = "";
    $headline = "";
    $description = "";
    $postalcode = "";
    $images = 0;
    $city = "";
    $property_options = "";
    $property_types = "";
    $bedrooms = "";
    $bathrooms = "";
    $parking_spaces = "";
    $landsize = "";
    $floorspace = "";
    $fireplace = "";
    $storeys = "";
    $builtin = "";
    $basement_type = "";
    $heating_type = "";

    $output = "";
    $result = "";
    $totalRecords = "";

    $_SESSION['message'] = 'New Listing is successfully created';

    if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            // dump($_POST);
            GLOBAL $conn;
            $userid = trim($_SESSION['user']['user_id']);
            $listing_status = isset($_POST["listing_status"])?trim($_POST["listing_status"]):"";
            $price = trim($_POST["price"]);
            $headline = trim($_POST["headline"]);
            $description = trim($_POST["description"]);
            $postalcode = trim($_POST["postalcode"]);
            $city = isset($_POST["city"])?trim($_POST["city"]):"";
            $property_options = isset($_POST["property_options"])?trim($_POST["property_options"]):"";
            $property_types = isset($_POST["property_types"])?trim($_POST["property_types"]):"";
            $bedrooms = isset($_POST["bedrooms"])?trim($_POST["bedrooms"]):"";
            $bathrooms = isset($_POST["bathrooms"])?trim($_POST["bedrooms"]):"";
            $parking_spaces =isset($_POST["parking_spaces"])?trim($_POST["parking_spaces"]):"";
            $landsize = trim($_POST["landsize"]);
            $floorspace = trim($_POST["floorspace"]);
            $fireplace = isset($_POST["fireplace"])?trim($_POST["fireplace"]):"";
            $storeys = isset($_POST["storeys"])?trim($_POST["storeys"]):"";
            $builtin = trim($_POST["builtin"]);
            $basement_type = isset($_POST["basement_type"])?trim($_POST["basement_type"]):"";
            $heating_type = isset($_POST["heating_type"])?trim($_POST["heating_type"]):"";

            if(!isset($listing_status) ||  strlen($listing_status) == 0)
            {
                $output .= "<br/>* You must select a lisiting status for the house.";
                $listing_status = "";
            }
            if(!isset($price) ||  strlen($price) == 0)
            {
                $output .= "<br/>* You must enter the price for the house.";
                $price = "";
            }
            if(!isset($headline) ||  strlen($headline) == 0)
            {
                $output .= "<br/>* You must enter the headline of the house.";
                $headline = "";
            }
            if(!isset($description) ||  strlen($description) == 0)
            {
                $output .= "<br/>* You must enter the description of the house.";
                $description = "";
            }
            if(!isset($postalcode) ||  strlen($postalcode) == 0)
            {
                $output .= "<br/>* You must enter the postal code of the house.";
                $postalcode = "";
            }
            else if($postalcode)
            {
                $postalcode = str_replace(" ", "", $postalcode);
            }

            if(!isset($city) ||  strlen($city) == 0)
            {
                $output .= "<br/>* You must select the city of the house.";
                $city = "";
            }
            if(!isset($property_options) ||  strlen($property_options) == 0)
            {
                $output .= "<br/>* You must select the property option for the house.";
                $property_options = "";
            }
          if(!isset($property_types) ||  strlen($property_types) == 0)
            {
                $output .= "<br/>* You must select the property type for the house.";
                $property_types = "";
            }
            if(!isset($bedrooms) ||  strlen($bedrooms) == 0)
            {
                $output .= "<br/>* You must select the bedrooms for the house.";
                $bedrooms = "";
            }
          if(!isset($bathrooms) ||  strlen($bathrooms) == 0)
            {
                $output .= "<br/>* You must select the bathrooms of the house.";
                $bathrooms = "";
            }
            if(!isset($parking_spaces) ||  strlen($parking_spaces) == 0)
            {
                $output .= "<br/>* You must select the parking spaces of the house.";
                $parking_spaces = "";
            }
            if(!isset($landsize) ||  strlen($landsize) == 0)
            {
                $output .= "<br/>* You must enter the land size of the house.";
                $landsize = "";
            }
            if(!isset($floorspace) ||  strlen($floorspace) == 0)
            {
                $output .= "<br/>* You must enter the floor space of the house.";
                $floorspace = "";
            }
             if(!isset($fireplace) ||  strlen($fireplace) == 0)
            {
                $output .= "<br/>* You must select the storeys of the house.";
                $fireplace = "";
            }
            if(!isset($storeys) ||  strlen($storeys) == 0)
            {
                $output .= "<br/>* You must select the storeys of the house.";
                $storeys = "";
            }
            if(!isset($builtin) ||  strlen($builtin) == 0)
            {
                $output .= "<br/>* You must enter the constrution year of the house.";
                $builtin = "";
            }
            if(!isset($basement_type) ||  strlen($basement_type) == 0)
            {
                $output .= "<br/>* You must select the basement type of the house.";
                $basement_type = "";
            }
            if(!isset($heating_type) ||  strlen($heating_type) == 0)
            {
                $output .= "<br/>* You must select the heating type of the house.";
                $heating_type = "";
            }

            // If errors are 0 then connect with the database
        if ($output == "")
        {
            $new_listing = array($userid, $listing_status,$price, $headline, $description, $postalcode,
            $images, $city, $property_options, $property_types, $bedrooms, $bathrooms, $parking_spaces,
            $landsize, $floorspace, $fireplace, $storeys, $builtin, $basement_type, $heating_type);

            //dump($new_listing);

             $result = pg_execute($conn, "listing_insert", $new_listing);
             //dump($result);
            // dump($_SESSION['message']);



        }
    }

?>

<div>
  <?php
        if($output == "" && $result != 0)
        {
          echo "<h1>".$_SESSION['message']."</h1>";
          $listing_status = "";
          $price = "";
          $headline = "";
          $description = "";
          $postalcode = "";
          $images = 0;
          $city = "";
          $property_options = "";
          $property_types = "";
          $bedrooms = "";
          $bathrooms = "";
          $parking_spaces = "";
          $landsize = "";
          $floorspace = "";
          $fireplace = "";
          $storeys = "";
          $builtin = "";
          $basement_type = "";
          $heating_type = "";

          $output = "";
          $result = "";
          $totalRecords = "";
      }
        else
          echo "<h2>".$output."</h2>";

  ?>
</div>

<div class="container">
  <h1>Create New Listing: </h1>
  <p>Please fill in this form to create a new listing.</p>
  <hr/>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

  <label for="Listingstatus"><b>Listing Status</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?php echo build_simple_dropdown("listing_status", $listing_status); ?><br/>

  <label for="Price"><b>Price</b></label><br/>
  <input type="text" placeholder="Enter the Price" name="price" value="<?php echo $price; ?>"><br/>

  <label for="Headline"><b>Headline</b></label><br/>
  <input type="text" placeholder="Enter headline for the house" name="headline" value="<?php echo $headline; ?>"><br/>

  <label for="Description"><b>Description</b></label><br/>
  <input type="text" placeholder="Enter description for the house" name="description" value="<?php echo $description; ?>"><br/>

  <label for="Postalcode"><b>Postal code</b></label><br/>
  <input type="text" placeholder="Enter postal code for the house" name="postalcode" value="<?php echo $postalcode; ?>"><br/>

  <!-- <label for="Images"><b>Images</b></label><br/>
  <input type="text" placeholder="Add images for the house" name="images" value="<?php echo $images; ?>"><br/>
 -->
  <label for="City"><b>City</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?php echo build_simple_dropdown("city", $city); ?><br/>

  <label for="Propertyoption"><b>Property Option</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?php echo build_simple_dropdown("property_options", $property_options); ?><br/>

  <label for="Propertytype"><b>Property Type</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?php echo build_simple_dropdown("property_types", $property_types); ?><br/>

  <label for="Bedrooms"><b>Bedrooms</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?php echo build_simple_dropdown("bedrooms", $bedrooms); ?><br/>

  <label for="Bathrooms"><b>Bathrooms</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?php echo build_simple_dropdown("bathrooms", $bathrooms); ?><br/>

  <label for="Parkingspaces"><b>Parking Spaces</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?php echo build_simple_dropdown("parking_spaces", $parking_spaces); ?><br/>

  <label for="Landsize"><b>Land Size</b></label><br/>
  <input type="text" placeholder="Enter Land Size of the house" name="landsize" value="<?php echo $landsize; ?>"><br/>

  <label for="Floorspace"><b>Floor Space</b></label><br/>
  <input type="text" placeholder="Enter Floor Space for the house" name="floorspace" value="<?php echo $floorspace; ?>"><br/>

   <label for="Fireplace"><b>Fireplace</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <?php echo build_simple_dropdown("fireplace", $fireplace); ?><br/>

   <label for="Storeys"><b>Storeys</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?php echo build_simple_dropdown("storeys", $storeys); ?><br/>

  <label for="Builtin"><b>Built In</b></label><br/>
  <input type="text" placeholder="Enter the year of construction" name="builtin" value="<?php echo $builtin; ?>"><br/>

  <label for="Basementtype"><b>Basement Type</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?php echo build_simple_dropdown("basement_type", $basement_type); ?><br/>

  <label for="heating_type"><b>Heating Type</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?php echo build_simple_dropdown("heating_type", $heating_type); ?><br/>

  <div class="clearfix">
        <button type="submit" class="createbtn" style="width:97%;">Create</button>
  </div>
  <div><p></p></div>
  <div><p><hr/></p></div>
  </form>
  </div>


<?php include 'footer.php'; ?>
