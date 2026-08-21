<?php

session_start();

session_unset();
session_destroy();

header("Location: /vozcr/app/login.php");
exit;

?>