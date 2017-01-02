<?php
function getPlanes() {
    global $conn;
    $planes = array();
    $sql = "SELECT * FROM plane";
    $result = $conn->query($sql);

    while($plane = $result->fetch_object()) {
        $planes[] = $plane;
    }
    
    return $planes;
}

function getPlaneById($id) {
    global $conn;
    $sql = "SELECT * FROM plane WHERE id=".$id;
    $result = $conn->query($sql);
    $plane = $result->fetch_object();
    return $plane;
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