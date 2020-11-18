 <?php



 define('DB_HOST', '127.0.0.1');
 define('DB_NAME', 'group17_db');
 define('DB_PORT', '5432'); // The default database port
 define('DB_PASSWORD', 'groop17pw');
 define('DB_USER', 'group17_admin');


//preferred contact methods
 define('OPEN', 'o');
 define('CLOSED', 'c');
 define('SOLD', 's');

//possible statuses of a listing
 define('EMAIL', 'e');
 define('PHONE', 'p');
 define('POSTED_MAIL', 'l');

// valid range of phone number area codes/telephone prefixes (i.e. 200 to 999 inclusive)
 define('MINIMUM_VALID_PHONE_RANGE', 200);
 define('MAXIMUM_VALID_PHONE_RANGE', 999);


 define('MINIMUM_ID_LENGTH', 5);
 define('MAXIMUM_ID_LENGTH', 20);
 define('MINIMUM_PASSWORD_LENGTH', 6);
 define('MAXIMUM_PASSWORD_LENGTH', 15);
 define('MAX_FIRST_NAME_LENGTH', 20);
 define('MAX_LAST_NAME_LENGTH', 30);
 define('MAXIMUM_EMAIL_LENGTH', 255);

// User  types
 define('ADMIN', 's');
 define('AGENT', 'a');
 define('CLIENT', 'c');
 define('PENDING', 'pa');
 define('DISABLED', 'da');

 define('HASH', 'md5');

define('RECORDS_PER_PAGE', 10);
define('RECORDS_RETURNED', 200);


define('maxFileSize', 500000);

?>
