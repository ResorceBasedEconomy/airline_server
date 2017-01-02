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

function deletePlaneById($id) {
    global $conn;
    $sql = "DELETE FROM plane WHERE id=".$id;
    $result = $conn->query($sql);
}

function insertPlane($plane) {
    global $conn;
    $newId = null;
    $sql = 'INSERT INTO plane (model, seat_count) VALUES ' . 
           ' ("' . $plane->model . '", ' . $plane->seat_count .')';

    if ($conn->query($sql) === TRUE) {
        // echo "New record created successfully";
        $newId = $conn->insert_id;
    }
    return $newId;
}

function updatePlane($plane) {
    global $conn;
    $sql = 'UPDATE plane SET model="' .$plane->model .'" , seat_count='.$plane->seat_count.' WHERE id=' . $plane->id;
    $conn->query($sql);
}

?>