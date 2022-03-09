<?php 

$server = "localhost";
$user = "root";
$pass = "";
$database = "chair";
// $server = "wawangunawan.web.id";
// $user = "u3587903_202124";
// $pass = "umbMeruya";
// $database = "u3587903_kel7202124hair";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}

?>