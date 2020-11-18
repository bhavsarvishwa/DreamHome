<?php


 require('./includes/constants.php');
 require('./includes/db.php');
 require('./includes/functions.php');
 require('./includes/names.php');
 //$male_names, $female_names, $last_names
$user_types = array("c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","a","a","a","a","a","a","pa","pa","da","s", "c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c","c");
$salutations = array("Mr.", "Mr.", "Mr.", "Mr.", "Mr.", "Mr.", "Mr.", "Mr.", "Mr.", "Mr.", "Mr.", "Mr.", "Mr.", "Mr.", "Mrs.", "Ms.", "Mrs.", "Ms.", "Mrs.", "Ms.", "Mrs.", "Ms.", "Mrs.", "Ms.", "Mr.", "Mrs.", "Ms.","Miss", "Miss", "Miss", "Master", );
$provinces = array("AB", "AB", "AB","AB","BC", "BC", "BC", "BC", "MB", "MB", "NB", "NF", "NS", "NS", "NT", "NT", "NU", "NU", "NU", "NU", "ON", "ON","ON", "ON", "ON", "ON","ON", "ON", "ON", "ON","ON", "ON", "ON", "ON","ON", "ON", "ON", "ON","ON", "ON", "PE", "PE", "PE", "PQ", "PQ", "SK", "SK", "SK", "SK", "SK", "YT", "YT", "YT");

$preferred_contact_methods = array("e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "p", "p",  "p", "p", "p", "p", "p", "l", "l", "l", "l", "l", "e", "p", "l", "e", "p", "l", "e", "p", "l", "e", "p", "l", "e", "p", "l");

$street_names1 = array("Main St.", "Place");

$postal_codes = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");


function get_random_element($array)
{
  if(!is_array($array))
    return $array;
  else {
    return $array[mt_rand()%sizeof($array)];
  }
}

//print get_random_element($female_names);
// function get_random_element($female_names)
{
  for($i = 1; $i <= 1000; $i++)
  {
    global $conn;
    $first_name = strtolower(($i%2 == 1)?get_random_element($male_names):get_random_element($female_names));
    $last_name = strtolower(get_random_element($last_names));

    $id = strtolower($last_name . substr($first_name, 0, 1));
    $password = hash("md5","password");
    $user_type = get_random_element($user_types);
    $email_address = $first_name . ".".$last_name."@dcmail.ca";
    $enrol_date = (2010 + mt_rand()%7) . "-" . (mt_rand()%12 + 1) . "-".(mt_rand()%28 + 1);
    $last_access = (2017 + mt_rand()%2) . "-" . (mt_rand()%10 + 1) . "-". (mt_rand()%28 + 1);

    $street_address1 = mt_rand()%1000 + 1 . get_random_element("street_names1");
    $street_address2 = "";
    $city = "";
    $postal_code = "";
    $j = 0;
    while ($j < 6) {
      $postal_code .= (($j%2 == 0)? get_random_element($postal_codes):mt_rand(0,9));
      $j++;
    }
    $primary_phone_number = mt_rand(200,999)."-".mt_rand(200,999)."-".str_pad(mt_rand(0, 9999), 4, "0", STR_PAD_LEFT);

    $secondary_phone_number = "";
    $fax_number = "";
    $salutation = get_random_element($salutations);
    $province = get_random_element($provinces);
    $preferred_contact_method = get_random_element($preferred_contact_methods);
    echo $id ." ".$first_name." ".$last_name." ".$password." ".$user_type." ".$email_address ." ".$enrol_date." ".$last_access."<br/>";

    echo $first_name." ".$last_name." ".$street_address1." ".$city." ".$province." ".$postal_code." -    -  ".$primary_phone_number." ".$preferred_contact_method."<br/>";



    pg_execute($conn, "user_insert", array($id,$password,$user_type,$email_address,$enrol_date,$last_access));
    pg_execute($conn, "person_insert", array($id, $salutation, $first_name, $last_name, $street_address1, $street_address2, $city, $province, $postal_code, $primary_phone_number, $secondary_phone_number, $fax_number, $preferred_contact_method));


   }
}
function random_email($emailaddress)
{
  if(!is_array($emailaddress))
  {
    return $emailaddress;

  }
  else {
    return $emailaddress[mt_rand()%sizeof($emailaddress)];
  }

}

$tlds = array("info", "com", "net", "ca","org", "edu", "gov");

$char = $first_name;

  for ($i = 1; $i <= 8; $i++)
  {
    $ulen = mt_rand(5, 10);
    $dlen = mt_rand(7, 10);

    $emailaddress = "";

    for ($i = 1; $i <= $ulen; $i++)
    {
      $emailaddress .= substr($char, mt_rand(0, strlen($char)), 1);
    }

    $emailaddress .= "@";

    for ($i = 1; $i <= $dlen; $i++){
      $emailaddress .= substr($char, mt_rand(0, strlen($char)), 1);
    }

    $emailaddress .= ".";

    $emailaddress .=$tlds[mt_rand(0, (sizeof($tlds) -1 ))];

      echo "<a href=\"mailto:". $emailaddress. "\">". $emailaddress. "</a><br>\n";

      echo "</p>\n";
  }

?>
