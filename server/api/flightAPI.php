<?php
header("Access-Control-Allow-Origin: *");

require_once '../util/util.php';
require_once '../model/flight.php';

dbConnect();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
     $originToGet = r('origin');

     if ($originToGet && $originToGet !== '""') {
        $flight = getFlightBySrc($originToGet);
        echo json_encode($flight);
     } else {
        $flights = getFlights();
        echo json_encode($flights);
     }

} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
     $idToUpdate = (int)$_REQUEST['id'];

    // Read the JSON we got in the req 
    $entity = file_get_contents('php://input');
    $entity = json_decode($entity);
    updatePlane($entity);

} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
     $idToRemove = (int)$_REQUEST['id'];

     deletePlaneById($idToRemove);

} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entity = file_get_contents('php://input');
    $entity = json_decode($entity);
   
    insertPlane($entity);
}

$conn->close();
?>