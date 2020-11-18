<!-- // for logged in admin users -->
<?php

    $file = "admin.php";
    $date = "27 September 2018";
    $title = "Logged in Admin Users ";
    $coursecode = "WEBD3201-02 & WEBD3201-07";
    $description = "This is admin file which loads when the user gets login with Administator rights.";
    $banner = "Admin Page";
    $heading = "Dream Home Real Estate";
    require 'header.php';
    //print_r($_SESSION);
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

    $conn = db_connect();

    $sql = "SELECT user_id, email_address, enrol_date, last_access FROM users WHERE user_type = 'pa'";
    $result = pg_query($conn, $sql);
    $pendingList = pg_num_rows($result);
    $pending_results = pg_fetch_all($result);

    $numrows = sizeof($pending_results);


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
?>

<div class="container">
<p>
      Welcome back, <b><?php echo $username; ?></b>. You last accessed the site <b><?php echo $lastaccessed; ?></b>.<!--  Why don't you start by clicking __ to manage
  who accesses the site? -->
</p>

<table border="1" width="75%">
  <h2>Pending Users: </h2>
  <?php
     $output = "";

    // $pendingList = pg_execute($conn, "pending_users", array("pa"));
    for($i = ($currentpage - 1) * 10; $i < $currentpage * 10 && $i < $numrows; $i++)
    {
      for($i = 0; $i < $pendingList; $i++)
      {
        $output .= "\n\t<tr>\n\t\t<td><b>".pg_fetch_result($result, $i, "user_id")."</b></td>";
        // $output .= "\n\t<tr>\n\t\t<td>".pg_fetch_result($result, $i, "password")."</td>";
        $output .= "\n\t<tr>\n\t\t<td>".pg_fetch_result($result, $i, "email_address")."</td>";
        // $output .= "\n\t<tr>\n\t\t<td>".pg_fetch_result($result, $i, "user_type")."</td>";
        $output .= "\n\t<tr>\n\t\t<td>".pg_fetch_result($result, $i, "enrol_date")."</td>";
        $output .= "\n\t<tr>\n\t\t<td>".pg_fetch_result($result, $i, "last_access")."</td>";
      }
    }
    echo $output;
    echo $nav;
  ?>
</table>

</div>

<?php include 'footer.php'; ?>
