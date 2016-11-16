<?php

$config = simplexml_load_file("../config.xml");
$mysqliconfig = $config -> mysqli;



$mysqli = new mysqli($mysqliconfig -> host, $mysqliconfig -> user, $mysqliconfig -> password, $mysqliconfig -> tablename);
if ($mysqli->connect_errno) {
    die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}


$query_all_user = "SELECT email, passhash, reg_date FROM user";

$all_users = $mysqli -> query($query_all_user);


echo "<ul class='list-group'>";

if ($all_users->num_rows > 0) {
    echo "<ul class='list-group'>";
    while($row = $all_users->fetch_assoc()) {
        echo "  <li class='list-group-item'><h2>". $row["email"]."</h2><p>". $row["reg_date"]."</p></li>";
    }
    echo "</ul>";

} else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">No Users Found</div>";
}
$mysqli->close();



function throw_error(){
    header('HTTP/1.1 500 Internal Server ERROR');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
}
