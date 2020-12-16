<?php
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > (60*5))) {
    // if last request was more than 5 minutes ago
    setcookie(session_name(),'',time()-1); // deletes the session cookie containing the session ID
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
    session_start();
} else {
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
}

require_once ( __DIR__ . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'File.php');
require_once (File::build_path(array('lib','Session.php')));

require_once (File::build_path(array('controller','routeur.php')));
?>
