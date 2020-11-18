
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

?>
<img align="center"  src="images/durhammap2008_2.jpg" usemap="#image-map">

<map align="center" name="image-map">
    <area target="_blank" alt="Oshawa" title="Oshawa" href="./listing-search.php?city=32" coords="245,350,297,476" shape="rect">
    <area target="_blank" alt="Clarington" title="Clarington" href="https://www.clarington.ca/"  coords="299,348,492,489" shape="rect">
    <area target="_blank" alt="Whitby" title="Whitby" href="https://www.whitby.ca/"  coords="190,352,241,475" shape="rect">
    <area target="_blank" alt="Ajax" title="Ajax" href="https://www.ajax.ca/"  coords="143,410,189,476" shape="rect">
    <area target="_blank" alt="Pickering1" title="Pickering1" href="https://www.pickering.ca/"  coords="95,352,186,408" shape="rect">
    <area target="_blank" alt="Pickering2" title="Pickering2" href="https://www.pickering.ca/"  coords="94,409,142,472" shape="rect">
    <area target="_blank" alt="Uxbridge" title="Uxbridge" href="https://www.uxbridge.ca/"  coords="93,178,189,350" shape="rect">
    <area target="_blank" alt="Scugog1" title="Scugog1" href="https://www.scugog.ca/"  coords="189,228,289,349" shape="rect">
    <area target="_blank" alt="Scugog2" title="Scugog2" href="https://www.scugog.ca/"  coords="290,244,393,348" shape="rect">
    <area target="_blank" alt="Brock" title="Brock" href="https://www.brock.ca/"  coords="286,27,189,226" shape="rect">
</map>

<?php include 'footer.php'; ?>
