<?php

    function display_copyright()
    {
        $copyright = '&copy;';
        echo $copyright;
        echo date('Y');
    }
    function cookie_ends()
    {
        $COOKIE_LIFESPAN = time() + 60*60*24*30;
    }

    // To help with debugging so developers can easily display variables/arrays (i.e. dump) in human-readable form onto a page:
    function dump($arg)
    {
        echo "<pre>";
        echo (is_array($arg))? print_r($arg): $arg;
        echo "</pre>";
    }

    function dd($param)
    {
        die(var_dump($param));
    }


    function display_phone_number($check_phone_number)
    {
        if(!isset($check_phone_number))
        {
           $output .= "<br/>* You must enter a phone number.";
        }
         if(!isset($check_phone_number) || $check_phone_number == "")
        {
            $output .= "<br/>* You must enter a phone number.";
        }
        if (!strlen($check_phone_number) > 10)
        {
             $output .= "<br/>* Entered phone number is not in correct format.";
        }

}


function recursiveDelete($target_dir) {
    if (!file_exists($target_dir)){ //no target, implies nothing to delete, function is done
        return true;
    }
    if (!is_dir($target_dir)) {  //target is a file, not a directory, delete it with unlink() function
        return unlink($target_dir); //will return false is Apache does not have write permissions in $target
    }

    $directoryContents = scandir($target_dir); //target is a directory, get a list of files and directories inside the specified path as an array

    foreach ($directoryContents as $file) { //loop through the target's files and sub-directories
        echo "<br/>File/folder to be deleted: " . $file;
        if ($file == '..' || $file == '.') { //ignore parent and current diectories in file listing
            continue;
        }
        if (!recursiveDelete($target_dir. "/" . $file)) {  //delete items, and sub-directories recursively
            return false;
        }
    }
    return rmdir($target_dir); //delete the original target, now empty
}

function is_valid_postal_code($check_postal_code)
{
    // $check_postal_code = '/^(?!.*[DFIOQU].*)([A-Z][0-9]){3}$';
    // return $check_postal_code

    //         $foreignCountries = array (
    // "Canada" => array ( "regex" => "/^[ABCEGHJKLMNPRSTVXY]d[A-Z] d[A-Z]d$/i", "display" => "A9A 9A9" ),

    //https://smartbear.com/blog/develop/postal-code-validation-in-php/
}


/*
    this function should be passed a integer power of 2, and any decimal number,
    it will return true (1) if the power of 2 is contain as part of the decimal argument
*/
function is_bit_set($power, $decimal) {
    if((pow(2,$power)) & ($decimal))
        return 1;
    else
        return 0;
}


/*
    this function can be passed an array of numbers (like those submitted as
    part of a named[] check box array in the $_POST array).
*/
function sum_check_box($array)
{
    $num_checks = count($array);
    $sum = 0;
    for ($i = 0; $i < $num_checks; $i++)
    {
      $sum += $array[$i];
    }
    return $sum;
}


function randomPassword($password)
{
    $alphanumeric = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array();
    $alphaLength = strlen($alphanumeric) - 1;
    for($i = 0; $i < 8; $i++)
    {
        $n = rand(0, $alphaLength);
        $pass[] .= $alphanumeric[$n];
    }

    return implode($pass);
}

// function listing_preview($listing)
//    {
//      //print_r($listing);
//      $preview = ' <div class="row">
//             <div class="column left" style="background-color:#aaa;">
//             <h2>'.$listing[1].'</h2>
//             <p>Some text..</p>
//             </div>
//             <div class="column right" style="background-color:#bbb;">
//               <h2>Bedrooms: '.$listing[2].'</h2>
//               <h2>Bathrooms: '.$listing[3].'</h2>
//               <p>Some text..</p>
//             </div>
//           </div>';
//     return $preview;
//    }
?>
