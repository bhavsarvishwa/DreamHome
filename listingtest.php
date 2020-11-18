<?php

 require('./includes/constants.php');
 require('./includes/db.php');
 require('./includes/functions.php');


function get_random_element($array)
{
  if(!is_array($array))
    return $array;
  else {
    return $array[mt_rand()%sizeof($array)];
  }
}

$statuses= array("o", "c", "s", "h", "o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o", "c", "c", "c", "c", "c", "c", "c", "c", "c", "c", "c", "s", "s", "s", "s", "s", "s", "h", "h", "h", "h", "h", "h", "h", "h", "h", "h", "h", "h", "h", "h", "h", "h", "h", "h");
$agents = pg_fetch_all(pg_query($conn, "SELECT user_id FROM users WHERE user_type='a'"));

$listing_statuses = pg_fetch_all(pg_query($conn, "SELECT property, value FROM listing_status"));

// $descriptions = array("Water-side House", "Beautiful Home", "Prestigious Location", "Private Spa", "Sparkling Pool", "In your budget");

$cities = pg_fetch_all(pg_query($conn, "SELECT property,value FROM city"));
$bedrooms = pg_fetch_all(pg_query($conn, "SELECT property,value FROM bedrooms"));
$bathrooms = pg_fetch_all(pg_query($conn, "SELECT property,value FROM bathrooms"));

$parking_spaces = pg_fetch_all(pg_query($conn, "SELECT property,value FROM parking_spaces"));
$basement_types = pg_fetch_all(pg_query($conn, "SELECT property,value FROM basement_type"));
$storeys = pg_fetch_all(pg_query($conn, "SELECT property,value FROM storeys"));
$fireplaces = pg_fetch_all(pg_query($conn, "SELECT property,value FROM fireplace"));
$heating_types = pg_fetch_all(pg_query($conn, "SELECT property,value FROM heating_type"));

$postal_codes = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");

$property_options = pg_fetch_all(pg_query($conn, "SELECT property,value FROM property_options"));

$property_types = pg_fetch_all(pg_query($conn, "SELECT property,value FROM property_types"));

  for($i = 1; $i <= 1500; $i++)
  {
    global $conn;

    $agent = get_random_element($agents);
    $user_id = $agent['user_id'];

    $listing_status = $listing_statuses[mt_rand()%sizeof($listing_statuses)];

    $price = mt_rand(100000,1000000);

    $city = $cities[mt_rand()%sizeof($cities)];
    $bedroom = $bedrooms[mt_rand()%sizeof($bedrooms)];
    $bathroom = $bathrooms[mt_rand()%sizeof($bathrooms)];

    $headline = $bedroom['property'] .", ". $bathroom['property'] ."  in ". $city['property'] . " for $" . $price;
    $property_option = $property_options[mt_rand()%sizeof($property_options)];

    $parking_space = $parking_spaces[mt_rand()%sizeof($parking_spaces)];
    $land_size = mt_rand(1000, 5000);
    $floor_space = mt_rand(800, 4000);
    $fireplace = $bedrooms[mt_rand()%sizeof($fireplaces)];
    $storey = $storeys[mt_rand()%sizeof($storeys)];
    $built_in = mt_rand(1990, Date('Y'));
    $basement_type = $basement_types[mt_rand()%sizeof($basement_types)];
    $heating_type = $heating_types[mt_rand()%sizeof($heating_types)];
    $property_type = $property_types[mt_rand()%sizeof($property_types)];


    $description = "With ".$property_option['property'] ." and ". $parking_space['property']." having ".$land_size." land area with ".$floor_space." floor space".". Also having ".$fireplace['property']." and ".$storey['property']." built in ".$built_in." including ".$basement_type['property']." and heating is ".$heating_type['property'];

    $j = 0;
    $postal_code = "";
    while ($j < 6) {
      $postal_code .= (($j%2 == 0)? get_random_element($postal_codes):mt_rand(0,9));
      $j++;
    }

    $images = 0;

    $listing = array($user_id, $listing_status['value'], $price, $headline, $description, $postal_code, $images, $city['value'], $property_option['value'], $property_type['value'], $bedroom['value'], $bathroom['value'], $parking_space['value'], $land_size, $floor_space, $fireplace['value'], $storey['value'], $built_in, $basement_type['value'], $heating_type['value']);
    dump($listing);

    pg_execute($conn, "listing_insert", $listing);

}

?>
