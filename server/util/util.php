<?php

function dd($mix) {
    echo '<pre>';
    var_dump($mix);
    echo '</pre>';
    die();    
}


function r($name) {
	$value = null;
	if (!empty($_REQUEST[$name])) $value = $_REQUEST[$name];
	return $value;
}

$conn = null;
function dbConnect() {
    global $conn;

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = 'airline_db2';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    //echo ("Connected successfully"); 
    
}
   

?>