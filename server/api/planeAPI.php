<?php
header("Access-Control-Allow-Origin: *");

require_once '../util/util.php';
require_once '../model/plane.php';

dbConnect();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
     
     $srcToGet = (int) r('src');

     if ($srcToGet) {
        $plane = getPlaneById($srcToGet);
        echo json_encode($plane);
     } else {
        $planes = getPlanes();
        echo json_encode($planes);
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