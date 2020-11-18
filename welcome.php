 <!-- For logged in Clients -->
<?php

    $file = "welcome.php";
    $date = "27 September 2018";
    $title = "Welcome Page";
    $coursecode = "WEBD3201-02 & WEBD3201-07";
    $description = "This is a Welcome Page for successfully logged in clients.";
    $banner = "Welcome Page";
    $heading = "Dream Home Real Estate";
    require 'header.php';


    // If there's a user log in, set session
    if (isset($_SESSION['user']))
    {
      $username = $_SESSION['user']['user_id'];
      $username = strtoupper($username);
      $user_type = $_SESSION['user']['user_type'];
      $lastaccessed = $_SESSION['user']['last_access'];




 $listing_select = pg_query($conn,"SELECT f.*, l.* FROM favourites AS f JOIN listings AS l ON f.listing_id = l.listing_id LIMIT ".RECORDS_RETURNED);
 dump($listing_select);
    $listing_results = pg_fetch_all($listing_select);

   /* $listing = pg_execute($conn,"listing_select", array($matches[$i]['listing_id']));
*/
    // $data = array();
    // // for($i = 0; $i < 254; $i++)
    // for($i = 0; $i <= $listing_select; $i++)
    // {
    //   array_push($data, $i);
    // }
    $numrows = sizeof($listing_results);
    dump($numrows);
    // dd($listing_results);

    // Number of rows to show per page.
    $total_pages = ceil($numrows / RECORDS_PER_PAGE);

    // Get the current page or set a default
    if(isset($_GET['page']) && is_numeric($_GET['page']))
    {
      // Cast variable as int; truncation
      $currentpage = (int) $_GET['page'];
    }
    // If the value fails to set or is not numeric:
    else
    {
      // Default page number.
      $currentpage = 1;
    }

    // If current page is greater than total pages,
    if($currentpage > $total_pages)
    {
      // Set current page to last page.
      $currentpage = $total_pages;
    }
    // If current page is less than first page,
    if($currentpage < 1)
    {
      // Set current page to first page.
      $currentpage = 1;
    }

    $offset = ($currentpage - 1) * RECORDS_PER_PAGE;

      $nav = "";
      $nav .= ($total_pages > 1 && $currentpage != 1)?"&nbsp;<a href='{$_SERVER['PHP_SELF']}?page=".($currentpage-1)."''>&lt;</a>&nbsp;":"&nbsp;&nbsp;&nbsp;";
      for($x = 1; $x <= $total_pages; $x++)
      {
          if($x == $currentpage)
          {
            // 'Highlight but dont make it a link'
            $nav .= "&nbsp;[<b>$x</b>]&nbsp;";
          }
          // If we're not on the current page.
          else
          {
            // Make it a link.
            $nav .= "&nbsp;<a href='{$_SERVER['PHP_SELF']}?page=$x'>$x</a>&nbsp;";
          }
      }
    }
?>

<div class="container">
  <h2>Search Results</h2>
  <?php echo $nav; ?>
  <p>

    <?php

      $output = "";
      for($i = ($currentpage - 1) * 10; $i < $currentpage * 10 && $i < $numrows; $i++)
      {
        //echo $listings[$i];
        //$listing = get_listing($id)
        // get_listing($listing_id);
        $listing_status = "";
        $listing_status = $listing_results[$i]['listing_status'];
        $bedrooms = get_property("bedrooms", $listing_results[$i]['bedrooms']);
        $bathrooms = get_property("bathrooms", $listing_results[$i]['bathrooms']);
        $basement_type = get_property("basement_type", $listing_results[$i]['basement_type']);
        $city = get_property("city", $listing_results[$i]['city']);
        $heating_type = get_property("heating_type", $listing_results[$i]['heating_type']);
        $parking_spaces = get_property("parking_spaces", $listing_results[$i]['parking_spaces']);
        $prices = $listing_results[$i]['price'];
        $property_options = get_property("property_options", $listing_results[$i]['property_options']);
        $property_types = get_property("property_types", $listing_results[$i]['property_type']);
        $description = $listing_results[$i]['description'];
        $output .= listing_preview($listing_results[$i]['listing_id'], $bedrooms, $bathrooms, $basement_type, $city, $heating_type, $parking_spaces, $prices, $property_options, $property_types, $description, $listing_status);
      }
      echo $output;
    ?>
  </p>
  <?php echo $nav; ?>
</div>
