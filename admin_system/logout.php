<?php
require_once 'config.php';
session_start();
?>

<?php
session_start();
session_destroy();
header("Location: login.php");
exit;
