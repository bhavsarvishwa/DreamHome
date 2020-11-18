<!-- // To serch the a listing from the database -->
<?php

    $file = "listing-search.php";
    $date = "27 September 2018";
    $title = "To create new listings ";
    $coursecode = "WEBD3201-02 & WEBD3201-07";
    $description = "This is used to search any particular listing from the database.";
    $banner = "Listing Search Page";
    $heading = "Dream Home Real Estate";
    require 'header.php';
    if (isset($_SESSION['user']))
    {
      $username = $_SESSION['user']['user_id'];
      $username = strtoupper($username);
      $user_type = $_SESSION['user']['user_type'];
      $lastaccessed = $_SESSION['user']['last_access'];
    }

    $location = "";
    $city = isset($_COOKIE['city'])?$_COOKIE['city']:0;
    $city = isset($_SESSION['city'])?$_SESSION['city']:$city;
    $city = (isset($_GET['city'])&&is_numeric(trim($_GET['city'])))?$_GET['city']:$city;
//    $city = isset($_POST['city'])?$num_check_box{$_POST['city']}:$city;

  if($city == 0)
  {
    $_SESSION['message'] = "You have not selected anything";
    header("Location:listing-city-select.php");
    ob_flush();
  }
  else
  {
    setcookie("city", $city, cookie_ends());
  }

  $and_clause = "";

  // Melissa recommended that instead of having several block statements, that we should just put them all together in one piece

  // So in here, in the GET method, we check if there are cookies set for various variables like bedrooms, bathrooms, etc...
  if($_SERVER['REQUEST_METHOD'] == "GET")
  {
    $property_types = isset($_COOKIE["property_type"])?$_COOKIE["property_type"]:0;
    $and_clause = "";
    $bedrooms = isset($_COOKIE["bedrooms"])?$_COOKIE["bedrooms"]:0;
    $and_clause = "";
    $property_options = isset($_COOKIE["property_options"])?$_COOKIE["property_options"]:0;
  }
  // And then in here, in the POST method, we check if the user has selected the following options
  else if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    $property_types = isset($_POST["property_type"])?$_POST["property_type"]:0;
    if($property_types != 0)
    {
      setcookie("property_types", $property_types, cookie_ends());
      $and_clause .= ""; //AND (property_options = 1 OR ....)
    }
    $bedrooms = isset($_POST["bedrooms"])?$_POST["bedrooms"]:0;
    if($bedrooms != 0)
    {
      setcookie("bedrooms", $bedrooms, cookie_ends());
      $and_clause .= ""; //AND (property_options = 1 OR ....)
    }
    $property_options = isset($_POST["property_options"])?sum_check_box($_POST["property_options"]):0;
    if($property_options != 0)
    {
      setcookie("property_options", $property_options, cookie_ends());
      $and_clause .= ""; //AND (property_options = 1 OR ....)
    }
  }

  // I got lost around this part, but what this code snippet basically tell us is that
  // to select listing_id from listings table (find exact match?) and...
  $sql = "SELECT listing_id from listings WHERE 1 = 1";

  if($city > 0)   // If at least 1 city was selected, this one is from the city cookie I think
  {
    $sql .= " AND ("; // Add an 'AND' statement to the SQL file
    if(($city & ($city - 1)) == 0)  // The '&' does binary comparison, and it was really complicated here
    {
      $sql .= "city = '".$city."'"; // I guess this only applies for 1 city.
    }
    else  // In here, I think more than 1 city was selected
    {
      for($i = 0; pow(2, $i) < $city; $i++) // So iterate through each city selected
      {
        $sql .= (is_bit_set($i, $city))? "city = '".pow(2, $i)."' OR " : "";  // Find which cities were selected?
      }

      $sql = substr($sql, 0, (strlen($sql) - strlen(" OR ")));  // I forgot what this does
    }
    $sql .= ")";  // Close SQL statements' brackets
  }
//echo $sql;
  $results = pg_query($conn, $sql);
  $matches = pg_num_rows($results);
  $page = 1;

?>


<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
  <div class="container">
  Houses: <br/>
  <?php echo build_checkbox("property_types", $property_options); ?>
  <br/><br/>

  Bedrooms: <br/>
  <?php echo build_checkbox("bedrooms"); ?>
  <br/><br/>

  Additional: <br/>
  <?php echo build_checkbox("property_options"); ?>
  <br/><br>
</div>
        <div class="clearfix">
          <button type="button" class="cancelbtn">Cancel</button>
          <button type="submit" href="./listing-search.php?city=$sum" class="searchbtn">Search</button>
<!--                    <input type="submit" href="./listing-search.php?city=$sum" class="searchbtn" value="Search"/>
-->
  </div>
  <div><p></p></div>

  </div>
  <div><p><hr/></p></div>
  </form>


<?php include 'footer.php'; ?>
