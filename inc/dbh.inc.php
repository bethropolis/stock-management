<?php
$servername = 'localhost';
$dBUsername = 'root';
$dBPassword = '';
$dBName = 'kellu';
$timeZone = new DateTimeZone('Africa/Nairobi');

try {
  $conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName) or die("Connection failed"); 

  $conn->set_charset('utf8mb4');
} catch (Throwable $th) {
     // set 500 error status code
      http_response_code(500);
      exit();
 }

 function DB($sql)
{
    global $conn;
    $f = $conn->query($sql)->fetch_assoc();
    return $f ;
}

?>
