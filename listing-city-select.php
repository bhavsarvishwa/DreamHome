
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
    $city = isset($_COOKIE['city'])?$_COOKIE['city']:"";
    $message = "";
    if($_SERVER["REQUEST_METHOD"] == "POST")
     {
        $city = isset($_POST['city'])?sum_check_box($_POST['city']):"";
        if($city == "")
        {
          $_SESSION['city'] = $city;
          header("Location: ./listing-search.php");
          ob_flush();
        }else{
          $message = "You must select at least one city";
        }
     }


  $checked = "";

?>


<img  class="center" src="./images/listing_city.jpg" usemap="#image-map">

<map name="image-map">
    <area target="_blank" class:center1 alt="Pickering" title="Pickering" href="./listing-search.php?city=1" coords="35,581,180,581,179,677,114,677,112,799,51,798,31,757,35,607" shape="poly">
    <area target="_blank" alt="Brooklin" title="Brooklin" href="./listing-search.php?city=2" coords="182,583,276,621" shape="rect">
    <area target="_blank" alt="Ajax" title="Ajax" href="./listing-search.php?city=4" coords="114,680,179,792" shape="rect">
    <area target="_blank" alt="Whitby" title="Whitby" href="./listing-search.php?city=8" coords="182,623,252,786" shape="rect">
    <area target="_blank" alt="Oshawa" title="Oshawa" href="./listing-search.php?city=16" coords="329,586,326,790,287,798,254,791,253,622,277,622,277,584" shape="poly">
    <area target="_blank" alt="Bowmanville" title="Bowmanville" href="./listing-search.php?city=32" coords="621,836,623,617,473,612,471,592,330,591,328,785,348,799,397,816,416,813,434,804,453,804,464,806,478,805,487,811,498,816,510,819,524,826,539,831,556,832,568,834,576,839,582,841,592,842,603,842,613,842" shape="poly">
    <area target="_blank" alt="Port Perry" title="Port Perry" href="./listing-search.php?city=64" coords="313,473,336,441,325,378,184,375,185,584,409,591,472,590,475,502,472,431,341,513,377,474,397,412,384,400,347,432,336,468,318,489,311,501,308,523,300,515,300,493" shape="poly">
</map>

<h3><?php echo $message; ?></h3>
<form align="center" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="City"><b>Select Your Preferred Cities</b></label><br/>
        <?php echo build_checkbox("city", $city); ?><br/>

      </tr>
      </table>
      <div class="clearfix">
        <button type="submit" href="./listing-search.php?city=$sum" class="searchbtn" style="width:97%;">Search</button>
        </div>
        </div>
  <div><p><hr/></p></div>
  <div><p><hr/></p></div>
  </form>

<?php include 'footer.php'; ?>
