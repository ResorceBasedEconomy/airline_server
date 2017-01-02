<?php
header("Access-Control-Allow-Origin: *");
header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );
header('Access-Control-Allow-Methods:  POST, GET,  PUT, DELETE');
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
    updateFlight($entity, $idToUpdate);

} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
     $idToDelete =(int) r('id');
     deleteFlightPass($idToDelete);
    //  $idToRemove = (int)$_REQUEST['id'];
     deleteFlightById($idToDelete);

} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entity = file_get_contents('php://input');
    $entity = json_decode($entity);
   
    insertFlight($entity);
}

$conn->close();
?>