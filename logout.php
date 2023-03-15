<?php
// Delete the user ID, email, and first name cookies
setcookie("userId", "", time() - 3600, "/");
setcookie("userEmail", "", time() - 3600, "/");
setcookie("fname", "", time() - 3600, "/");
setcookie("position", "", time() - 3600, "/");

// Redirect the user to the login page
header("Location: login.php");