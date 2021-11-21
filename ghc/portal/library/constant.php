<?php
date_default_timezone_set('Africa/Lagos');

 $today = date('ymd');
   $dd = date('ymd');
    $mm = date('ym'); 
	$yy = date('y');
	$ww = date('yW');
	$yyyy = date('Y');
	$lm = $mm-1;
	$lw = $ww-1; 
	






  ////change this item to and id number and not name 

		


define ("STATUSBETA", sha1(56));
define ("STATUSALPHA", sha1(65));
define ("MATRIX", 5);


/**
 * Special Names and Level Constants - the admin
 * page will only be accessible to the user with
 * the admin name and also to those users at the
 * admin user level. Feel free to change the names
 * and level constants as you see fit, you may
 * also add additional level specifications.
 * Levels must be digits between 0-9.
 */


define("TODAY", date("Y-m-d"));

\
/**
 * Timeout Constants - these constants refer to
 * the maximum amount of time (in minutes) after
 * their last page fresh that a user and guest
 * are still considered active visitors.
 */
define("USER_TIMEOUT", 10);
define("ADMIN_TIMEOUT", 5);

/**
 * Cookie Constants - these are the parameters
 * to the setcookie function call, change them
 * if necessary to fit your website. If you need
 * help, visit www.php.net for more info.
 * <http://www.php.net/manual/en/function.setcookie.php>
 */
define("COOKIE_EXPIRE", 60*60*24*100);  //100 days by default
define("COOKIE_PATH", "/");  //Avaible in whole domain

/**
 * Email Constants - these specify what goes in
 * the from field in the emails that the script
 * sends to users, and whether to send a
 * welcome email to newly registered users.
 */
define("URL", "https://www.thegreatheights.com/");
define("EMAIL_FROM_NAME", "Believers Family");
define("EMAIL_FROM_ADDR", "no_reply@thegreatheights.com");
define("ADMIN_EMAIL", "admin@thegreatheights.com");
define("EMAIL_WELCOME", true);//set this false if you do not want your users to receive a welcome Email after registration
define("CTIME",time());
define("CPHONE","08032318588");
define("ACCNO","UBA 0000000000 BFN");
define("SMSUSER","greaterheight");
define("SMSPASS","greater");
define("SENDERID","GREATER");

define("LOANINT","0.065");
define("INVESTINT","0.024");
define("PROFEE","0.03");




define("DB_SERVER", "localhost");
define("DB_USER", "root");//enter your database username
define("DB_PASS", "");//databse password
define("DB_NAME", "ghc");//database name
$db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);


?>
