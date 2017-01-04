<?php
function getFlights() {
    global $conn;
    $flights = array();
    $sql = "SELECT * FROM flight";
    $result = $conn->query($sql);

    while($flight = $result->fetch_object()) {
        $flights[] = $flight;
    }
    
    return $flights;
}

function getFlightBySrc($src) {

    // dd($src);
    global $conn;
    $flights = array();
    $sql = "SELECT * FROM flight WHERE origin=".$src;
    $result = $conn->query($sql);
    // $flight = $result->fetch_object();
     while($flight = $result->fetch_object()) {
        $flights[] = $flight;
    }
    return $flights;
}
function deleteFlightPass($id) {
    global $conn;
    $sql = "DELETE FROM flight_passenger WHERE flight_id=".$id;
    $result = $conn->query($sql);
}
function deleteFlightById($id) {
    global $conn;
  
    $sql = "DELETE FROM flight WHERE id=".$id;
    $result = $conn->query($sql);
    // dd($sql);
}

function insertFlight($flight) {
    global $conn;
    $newId = null;
    $sql = 'INSERT INTO flight (origin, dest, plane_id) VALUES ' . 
           ' ("' . $flight->origin . '", "' . $flight->dest .'", ' . $flight->plane_id .')';
           
    if ($conn->query($sql) === TRUE) {
        // echo "New record created successfully";
        $newId = $conn->insert_id;
    }
    return $newId;
}

function updateFlight($flight, $id) {
    global $conn;
    $sql = 'UPDATE flight SET origin="' 
                    .$flight->origin .'" , dest="'
                    .$flight->dest.'", plane_id=' 
                    .$flight->plane_id.' WHERE id=' .$id;
                    $conn->query($sql);
    // dd($sql);    
}

?>