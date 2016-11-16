<?php

$config = simplexml_load_file("../config.xml");
$mysqliconfig = $config -> mysqli;

$raw_post = file_get_contents('php://input');
$post = getRealPOST();

$usremail = $post["email"];
$usrpass = $post["password"];

if($usremail == null or $usrpass == null){
    //throw_error();
}

$mysqli = new mysqli($mysqliconfig -> host, $mysqliconfig -> user, $mysqliconfig -> password, $mysqliconfig -> tablename);
if ($mysqli->connect_errno) {
    echo "FAIL DB";
    die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}else{
    echo "SUCCESS DB";
}



$create_user_table = "CREATE TABLE user (
email VARCHAR(100) NOT NULL PRIMARY KEY ,
passhash VARCHAR(100) NOT NULL,
reg_date TIMESTAMP
)";

$timestamp = date("Y-m-d H:i:s");

$insert_user_table = "INSERT INTO user (email, passhash, reg_date) VALUES ('$usremail', '$usrpass', '$timestamp');";

$query_all_user = "SELECT email, passhash, reg_date FROM user";


if ($mysqli->query($create_user_table) === TRUE) {
    echo "Table Users created successfully";
} else {
    echo "Error creating table: " . $mysqli->error;
}

if ($mysqli->query($insert_user_table) === TRUE) {
    echo "User added successfully";
} else {
    echo "Error adding user: " . $mysqli->error;
}

$all_users = $mysqli -> query($query_all_user);

$mysqli -> close();



echo "LOG IN SIGN UP  EMAIL: " . $post["email"]."\n PASSWORD".$post["password"] .
    "\n<br>".$raw_post."\n".file_get_contents("php://input");

function throw_error(){
    header('HTTP/1.1 500 Internal Server ERROR');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
}

function getRealPOST() {
    $pairs = explode("&", file_get_contents("php://input"));
    $vars = array();
    foreach ($pairs as $pair) {
        $nv = explode("=", $pair);
        $name = urldecode($nv[0]);
        $value = urldecode($nv[1]);
        $vars[$name] = $value;
    }
    return $vars;
}