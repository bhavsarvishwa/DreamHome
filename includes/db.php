  <?php

function db_connect()
{
  $connection = pg_connect("host=".DB_HOST." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASSWORD."");
    return $connection;
}

$conn = db_connect();

$stmt1 = pg_prepare($conn, 'user_login', 'SELECT * FROM users WHERE user_id = $1 AND password = $2');

$stmt2 = pg_prepare($conn, 'user_id_query', 'SELECT * FROM users WHERE user_id = $1');

$stmt3 = pg_prepare($conn, 'user_last_access_query', 'UPDATE users SET last_access = $1 WHERE user_id = $2');


$stmt4 = pg_prepare($conn, "user_insert", 'INSERT INTO users (user_id,password,user_type,email_address,enrol_date,last_access) VALUES ($1,$2,$3, $4, $5, $6)');

$stmt5 = pg_prepare($conn, 'person_insert', 'INSERT INTO persons(user_id, salutation, first_name, last_name, street_address1, street_address2, city, province, postal_code, primary_phone_number, secondary_phone_number, fax_number, preferred_contact_method) VALUES($1,$2,$3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13)');

$stmt6 = pg_prepare($conn, 'listing_insert', 'INSERT INTO listings(user_id, listing_status, price, headline, description, postal_code, images, city, property_options, property_type, bedrooms, bathrooms, parking_spaces, land_size, floor_space, fireplace, storeys, built_in, basement_type, heating_type) VALUES($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16, $17, $18, $19, $20)');

$stmt7 = pg_prepare($conn, 'update_listing', 'UPDATE listings
   SET user_id=$2,
       listing_status=$3,
       price=$4,
       headline=$5,
       description=$6,
       postal_code=$7,
       images=$8,
       city=$9,
       property_options=$10,
       property_type=$11,
       bedrooms=$12,
       bathrooms=$13,
       parking_spaces=$14,
       land_size=$15,
       floor_space=$16,
       fireplace=$17,
       storeys=$18,
       built_in=$19,
       basement_type=$20,
       heating_type=$21 WHERE listing_id=$1');

  $stmt8 = pg_prepare($conn, 'user_update','UPDATE users
    SET email_address=$2,
        user_type=$3,
        last_access=$4 WHERE user_id=$1');

   $stmt8 = pg_prepare($conn, 'person_update','UPDATE persons
    SET salutation=$2,
        first_name=$3,
        last_name=$4,
        street_address1=$5,
        street_address2=$6,
        city=$7,
        province=$8,
        postal_code=$9,
        primary_phone_number=$10,
        secondary_phone_number=$11,
        fax_number=$12,
        preferred_contact_method=$13 WHERE user_id=$1');

   $stmt9 = pg_prepare($conn, 'dashboard', 'SELECT * from listings WHERE user_id = $1 AND listing_status = $2 OR (user_id = $1 AND listing_status = $3)');

function userExists($user_id)
{

    $conn = db_connect();
    $result = pg_execute($conn, "user_id_query", array($user_id));
    if (pg_num_rows($result) > 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function build_radio($table, $prechecked = "")
{
  $conn = db_connect();
  $sql = "SELECT * FROM ".$table;
  $results = pg_query($conn, $sql);
  $output = "&nbsp;&nbsp;";

    for($i = 0; $i < pg_num_rows($results); $i++)
      {
        $property = pg_fetch_result($results, $i, "property");
        $value = pg_fetch_result($results, $i, "value");
        $checked = ($prechecked == $value)?" checked=\"checked\" ":"";
        $output .= "<input type='radio' name='".$table."' value='".$value."' ".$checked." />".$property."<br/>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;";
      }

      $output .="</select>";
      return $output;
}


// function build_checkbox($table, $preselected = "")
// {
//   $conn = db_connect();
//   $sql = "SELECT * FROM $table";
//   $results = pg_query($conn, $sql);
//   $output = "&nbsp;&nbsp;";
//   for($i = 0; $i < pg_num_rows($results); $i++)
//   {
//     $property = pg_fetch_result($results, $i, "property");
//     $value = pg_fetch_result($results, $i, "value");
//     $selected = (is_bit_set($i, $preselected))?" checked=\"checked\" ":"";
//     $output .= "<input type='checkbox' name='".$table."[]' value='".$value."' ".$preselected ." >".$property."<br/>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;";
//   }
//   $output .="";
//   return $output;
// }

function build_checkbox($table, $preselected = "")
{
  $conn = db_connect();
  $sql = "SELECT * FROM $table";
  $results = pg_query($conn, $sql);
  $output = "<div><table style='width:100%;border-color:transparent;'>";
  for($i = 0; $i < pg_num_rows($results); $i++)
  {
    $property = pg_fetch_result($results, $i, "property");
    $value = pg_fetch_result($results, $i, "value");
    $selected = (is_bit_set($i, $preselected))?" checked=\"checked\" ":"";
    $output .= "<tr><td align='center'><input type='checkbox' name='".$table."[]' value='".$value."' ".$preselected ." >".$property."</td></tr>";
  }
  $output .="<tr>";
  return $output;
}

function build_simple_dropdown($table, $preselected)
{
  $conn = db_connect();
  $sql = "SELECT * FROM $table";
  $results = pg_query($conn, $sql);
  $output = "<select name=".$table."> <option value='".""."'> </option>";

 for($i = 0; $i < pg_num_rows($results); $i++)
  {
    $property = pg_fetch_result($results, $i, "property");
    $value = pg_fetch_result($results, $i, "value");
    $selected = ($value == $preselected)?" selected=\"select\" ":"";
    $output .= "<option value=".$value." ".$selected.">".$property."</option>";
  }

  $output .="</select>";
  return $output;
}


function build_simple_dropdown1($table, $preselected)
{
  $conn = db_connect();
  $sql = "SELECT * FROM $table";
  $results = pg_query($conn, $sql);
  $output = "<select name=".$table."> <option value='".""."'> </option>";

 for($i = 0; $i < pg_num_rows($results); $i++)
  {

    $value = pg_fetch_result($results, $i, "value");
    $selected = ($value == $preselected)?" selected=\"select\" ":"";
    $output .= "<option value=".$value." ".$selected.">".$value."</option>";
  }

  $output .="</select>";
  return $output;
}

// function build_simple_dropdown($table, $preselected)
// {
//   $conn = db_connect();
//   $sql = "SELECT * FROM $table";
//   $results = pg_query($conn, $sql);
//   $output = "<select name=".$table."> <option value='".""."'> </option>";

//  for($i = 0; $i < pg_num_rows($results); $i++)
//   {

//     $value = pg_fetch_result($results, $i, "value");
//     $selected = ($value == $preselected)?" selected=\"select\" ":"";
//     $output .= "<option value=".$value." ".$selected.">".$value."</option>";
//   }

//   $output .="</select>";
//   return $output;
// }


function get_property($table_name, $value)
{
  global $conn;

  $sql = "SELECT property FROM ".$table_name." WHERE value = ".$value;
  $result = pg_query($conn, $sql);
  // $records = pg_num_rows($result);
  $property = pg_fetch_result($result, 0, "property");

  return $property;
}


   $listing_select =  pg_prepare(db_connect(), "listing_select", "SELECT * FROM listings WHERE listing_id = $1");

   function get_listing($listing_id)
   {
    $result = pg_execute(db_connect(), "listing_select", array($listing_id));
    return (pg_num_rows($result) == 1)?pg_fetch_assoc($result, 0):"";
   }
  // function get_listing($listing_id)
  //  {
  //   $result = pg_execute(db_connect(), "listing_select", array($listing_id));
  //   return (pg_num_rows($result) == 1)?pg_fetch_assoc($result, 0):"";
  //  }

   function listing_preview($listing, $bedrooms, $bathrooms, $basement_type, $city, $heating_type, $parking_spaces, $prices, $property_options, $property_types, $description, $listing_status)
   {

     //print_r($listing);
     $preview = ' <div class="row">
            <hr/>
            <div class="column right" style="color:white; width:55%;">
              <p>
                <a href="./listing-display.php?listing_id='.$listing.'"><img src="./images/house7_1.jpg" alt="Dream Home"/></a>
              </p>
              <p><a href="./listing-display.php?listing_id='.$listing.'">'.$description.'</a></p>
            </div>

            <div class="column right" style="color:white; width:35%;">
                <h4>Status        : '.$listing_status.'</h4>
                <h4>Property Type : '.$property_types.'</h4>
                <h4>Bedrooms      : '.$bedrooms.'</h4>
                <h4>Bathrooms     : '.$bathrooms.'</h4>
                <h4>Basement Type : '.$basement_type.'</h4>
                <h4>Heating Type  : '.$heating_type.'</h4>
                <h4>Parking Spaces: '.$parking_spaces.'</h4>
                <h4>Including with: '.$property_options.'</h4>
                <h4>Price         : $'.$prices.'.00</h4>
            </div>

          </div>'

          ;
    return $preview;
   }
   function listing_preview_v2($listing_id)
   {

     //print_r($listing);
    $listing = get_listing($listing_id);
    $image = "./images/no-photo.png";
    if($listing['images'] > 0)
    {
      $image = "./listings/".$listing_id."/".$listing_id ."_1.jpg";
    }
     $preview = ' <div class="row">
            <hr/>
            <div class="column right" style="color:white; width:55%;">
              <p>
                <a href="./listing-display.php?listing_id='.$listing_id.'">
                <img src="./images/house7_1.jpg" alt="Dream Home"/></a>
              </p>
              <p>'.$description.'</a></p>
            </div>

            <div class="column right" style="color:white; width:35%;">
                <h4><a href="./listing-display.php?listing_id='.$listing_id.'">'.$listing['headline'].'</a></h4>
                <h4>Property Type : '.get_property("property_types", $property_types).'</h4>
                <h4>Bedrooms      : '.$bedrooms.'</h4>
                <h4>Bathrooms     : '.$bathrooms.'</h4>
                <h4>Basement Type : '.$basement_type.'</h4>
                <h4>Heating Type  : '.$heating_type.'</h4>
                <h4>Parking Spaces: '.$parking_spaces.'</h4>
                <h4>Including with: '.$property_options.'</h4>
                <h4>Price         : $'.$prices.'.00</h4>
            </div>

          </div>';
    return $preview;
   }

 function build_listing_preview_search($listing)
   {
     //print_r($listing);
     $preview = ' <div class="row">
            <div class="column left" style="background-color:#aaa;">
            <h2>'.$listing[1].'</h2>
            <p>Some text..</p>
            </div>
            <div class="column right" style="background-color:#bbb;">
              <h2>Bedrooms: '.$listing[2].'</h2>
              <h2>Bathrooms: '.$listing[3].'</h2>
              <p>Some text..</p>
            </div>
          </div>';
    return $preview;
   }
// BACK_UP
 // function listing_preview($listing, $bedrooms, $bathrooms)
 //   {

 //     //print_r($listing);
 //     $preview = ' <div class="row">
 //            <div class="column left" style="background-color:#aaa;">
 //            <h2>'.$listing.'</h2>
 //            <p><img src="images/house4_1.jpg" alt="Dream Home"/></p>
 //            </div>
 //            <div class="column right" style="background-color:#bbb;">
 //              <h2>Bedrooms: '.$bedrooms.'</h2>
 //              <h2>Bathrooms: '.$bathrooms.'</h2>
 //              <p>Some text..</p>
 //            </div>
 //          </div>';
 //    return $preview;
 //   }



//Link: Source: http://codepad.org/UL8k4aYK
?>
