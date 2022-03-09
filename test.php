<?php
$servername = "localhost";
$database = "databasename";
$username = "username";
$password = "password";
// $servername = "wawangunawan.web.id";
// $username = "u3587903_202124";
// $password = "umbMeruya";
// $database = "u3587903_kel7202124";
// Create connection


$db = new mysqli($servername, $username, $password, $database);

if ($db->connect_error) {
        die('Connect Error (' . $db->connect_errno . ') '
            . mysqli->connect_error);
} elseif ($result = $db->query("SELECT DATABASE()")) {
        $row = $result->fetch_row();
        if ($row[0] != 'database_b') {
                //oops! We're connected to mysql, but not to database_b
        }
}
?>
?>
