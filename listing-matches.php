<?php


    $file = "listing-matches.php";
    $date = "21 November 2018";
    $title = "Listing Matches ";
    $coursecode = "WEBD3201-02 & WEBD3201-07";
    $description = "Access all of the matches from the search from a session variable. Displays 10 profiles per page.";
    $banner = "Listing Matches";
    $heading = "Dream Home Real Estate: Listing Matches";
    require 'header.php';

    // If there's a user log in, set session
    if (isset($_SESSION['user']))
    {
      $username = $_SESSION['user']['user_id'];
      $username = strtoupper($username);
      $user_type = $_SESSION['user']['user_type'];
      $lastaccessed = $_SESSION['user']['last_access'];
    }
    // // Check if session from listing matches is set:
    // if(!isset($_SESSION['matches']) || sizeof($_SESSION['matches']))
    // {
    //   $_SESSION['message'] = "You must search for listings";
    //   header("Location: ./listing-search.php");
    //   ob_flush();
    // }

    // Must be in listing-search
    //matches = $_SESSION['matches'];

    // Following code snippet below derived from:
    // http://www.phpfreaks.com/tutorial/basic-pagination

    // First find out how many rows are there in the table.
    $listing_select = pg_query($conn,"SELECT * FROM listings WHERE listing_status = 'o' LIMIT ".RECORDS_RETURNED);
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
    // echo "Total pages: " . $total_pages;
    // echo "<br/>Current page: " . $currentpage;

    // The offset of the list, based on the current page,
    // *** Offset basically means to grab x specific rows.
    // *** Computer start at zero.
    $offset = ($currentpage - 1) * RECORDS_PER_PAGE;

    // Get the info from the db.
    // // $sql = "SELECT * FROM listings LIMIT '".$offset."', '".RECORDS_PER_PAGE."'";
    // $results = pg_query($conn, "SELECT * FROM listings LIMIT '".$offset."' OFFSET '".RECORDS_PER_PAGE."'");
    // for($x = ($currentpage - PAGE_RANGE); $x < (($currentpage + PAGE_RANGE) + 1); $x++)
    //   {
    //     // If it's a valid page number.
    //     if(($x > 0) && ($x <= $total_pages))
    //     {
    //       // If we're on the current page,
    //       if($x == $currentpage)
    //       {
    //         // 'Highlight but dont make it a link'
    //         echo "[<b>$x</b>]";
    //       }
    //       // If we're not on the current page.
    //       else
    //       {
    //         // Make it a link.
    //         echo "<a href='{$_SERVER['PHP_SELF']}? currentpage=$x'>$x</a>";
    //       }
    //     }
    //   }
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
?>

<div class="container">
  <h2>Search Results</h2>
  <?php echo $nav; ?>
  <p>

    <?php
      // While there are rows to be fetched...
      // while($list = pg_fetch_assoc($results))
      // {
      //   // Echo data

      //   echo '<tr>';
      //   foreach($list as $field)
      //   {
      //     echo '<td>' . htmlspecialchars($field) . '</td>';
      //   }
      //   echo '</tr>';
      // }

      $output = "";
      for($i = ($currentpage - 1) * 10; $i < $currentpage * 10 && $i < $numrows; $i++)
      {
        //echo $listings[$i];
        //$listing = get_listing($id)
        // get_listing($listing_id);
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
        $listing_status = $listing_results[$i]['listing_status'];
        $output .= listing_preview($listing_results[$i]['listing_id'], $bedrooms, $bathrooms, $basement_type, $city, $heating_type, $parking_spaces, $prices, $property_options, $property_types, $description, $listing_status);
      }
      echo $output;
    ?>
  </p>
  <?php echo $nav; ?>
</div>
