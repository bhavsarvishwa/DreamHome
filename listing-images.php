<?php

$file = "listing-images.php";
$date = "27 September 2018";
$title = "To allow agents to upload and display images for listings";
$coursecode = "WEBD3201-02 & WEBD3201-07";
$description = "This page is used by agents to upload pictures to their ad";
$banner = "Listing Images";
$heading = "Dream Home Real Estate";
require 'header.php';

$error_messages = [];
// check if the form was submitted
if (!empty($_GET['submit'])) {

  $valid = true;

  if (!file_exists('/imguploads')) {
  @mkdir("imguploads", 0755, true);
  }

  // check if there are values in $_POST
  if (!isset($_POST['submit'])) {
    // the form was submitted but post is empty - the max size was exceeded
    $error_messages[] = 'The file was too large.';
    $valid = false;
  }
  else {
      // print_r($file);
    // see http://php.net/manual/en/features.file-upload.errors.php
    if ($_FILES["fileToUpload"]['error'] != UPLOAD_ERR_OK) {
      switch ($_FILES["fileToUpload"]['error']) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:  $error_messages[] = 'The uploaded file was too large.'; $valid = false; break;
        case UPLOAD_ERR_PARTIAL:    $error_messages[] = 'The uploaded file was only partially received.'; $valid = false; break;
        case UPLOAD_ERR_NO_FILE:    $error_messages[] = 'No file was selected.'; $valid = false; break;
        case UPLOAD_ERR_NO_TMP_DIR: $error_messages[] = 'Missing temporary folder.'; $valid = false; break;
        case UPLOAD_ERR_CANT_WRITE: $error_messages[] = 'Failed to write file to disk.'; $valid = false; break;
        case UPLOAD_ERR_EXTENSION:  $error_messages[] = 'The server stopped the upload.'; $valid = false; break;
      }
    }

    if ($valid) {
      //print_r($_FILES);
      $target_dir = "imguploads/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        $error_messages[] = "<br/><br/>Great! This file is an image - " . $check["mime"] . ".";
      } else {
        $error_messages[] = "Your file is not an image.";
        $valid = false;
      }
      // Check if file already exists
      if (file_exists($target_file)) {
        $error_messages[] = "Sorry, this file already exists.";
        $valid = false;
      }
      // Check file size
      if ($_FILES["fileToUpload"]["size"] > maxFileSize) {
        $error_messages[] = "Sorry, this file is too large to upload.";
        $valid = false;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" ) {
        $error_messages[] = "Sorry, only JPG files can be uploaded allowed.";
        $valid = false;
      }
      // Check if $valid is set to false by an error
      if ($valid == false) {
        $error_messages[] = "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            chmod($target_file, 0755);
            // $img=
            echo '<img src= "'.$target_file.'" style= "width:30%; height:15%;">';
            echo '<br/><input type="radio" name="mainimg" value="maingimg">Main Image';
            $error_messages[] = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            $error_messages[] = "Sorry, there was an error uploading your file.";
        }
      }
    }
  }
}

recursiveDelete("DIRECTORY_TO_BE_DELETED");
?>
<!DOCTYPE html>
<html>
<body>

  <?php echo implode('<br>', $error_messages); ?>

<form action="listing-images.php?submit=true" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" multiple>
    <input type="submit" value="Upload Image" name="submit">


</form>

</body>
</html>
<?php include 'footer.php'; ?>
