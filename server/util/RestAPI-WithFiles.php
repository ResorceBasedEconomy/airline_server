<?php

header("Access-Control-Allow-Origin: *");

require('Utils.php');


$entityType = r('entity');

$fileName = $entityType . '.json';

// Read the array from the file 
$strEntities    = file_get_contents($fileName);
$entities       = json_decode($strEntities);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
     
     $idToGet = (int) r('id');

     for ($i=0; $i < count($entities) ; $i++) { 
         if ($entities[$i]->id === $idToGet) {
             $strEntities = json_encode($entities[$i]);
         }
     }

} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
     $idToUpdate = (int)$_REQUEST['id'];

    // Read the JSON we got in the req 
    $entity = file_get_contents('php://input');
    $entity = json_decode($entity);

    // replace the entity in the array
     for ($i=0; $i < count($entities) ; $i++) { 
         if ($entities[$i]->id === $idToUpdate) {
             $entities[$i] = $entity;
         }
     }
    $strEntities = json_encode($entities);

    // Save updated array to file
    file_put_contents($fileName, $strEntities);

} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
     $idToRemove = (int)$_REQUEST['id'];

     $updatedItems = array();
     for ($i=0; $i < count($entities) ; $i++) { 
         if ($entities[$i]->id !== $idToRemove) {
             $updatedEntities[] = $entities[$i];
         }
     }
    $strEntities = json_encode($updatedEntities);

    // Save updated array to file
    file_put_contents($fileName, $strEntities);

} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entity = file_get_contents('php://input');
    $entity = json_decode($entity);
    // set the id for the new item
    if (count($entities) === 0) {
        $entity->id = 1;
    } else {
        $entity->id = $entities[count($entities)-1]->id + 1;
    }
  
    // Push to the end of the array
    $entities[] = $entity;

    $strEntities = json_encode($entities);

    // Save updated array to file
    file_put_contents($fileName, $strEntities);
}



echo $strEntities;
?>